<?php
/** code placed here:
 * login user function
 * register user function
 * Stmt object (currently only construct, get, set, toString, destruct; bind, exe and fetch)
 */
class Stmt{
    private $db;
    private $stmt;//statement object

    public function __construct($db, $stmt="SELECT * FROM users"){
        $this->db = $db;
        if(($this->stmt=$db->prepare($stmt))===false){
            echo"<div class='err'> stmt failed".mysqli_error($db)."</div>";
            exit;
        }
    }
    function __toString(){return "Stmt object <br>database connnection:".var_dump($this->db)."<br> mysqli_statement_Object";}
    function __get($th='stmt'){return $this->$th;}//get the object you want $stmt->stmt
    function __set($name, $val){//set the object you want using $stms->stmt = "/*NEW QUERY THING HERE*/";
        if ($name=="stmt"){
            $this->$name = $this->db->prepare($val);
            if ($this->$name==false){
                echo "<div class='err'>stmt set error</div>";
                exit;
            }
            
        }
        else $this->$name = $val;
    }
    function __destruct(){mysqli_stmt_close($this->stmt);}//what happens when the object gets destroyed

    function bind($type, $param){
        //type is a string made of {i(int),d(float),s(string),b(blob)} which sets the types of the variables 
        //and param is an array of the variables assigned with those types
        //!!!they need to have the same index placement!!!
        //bind params from these values using the statement in this class (ONLY NEEDED IF THERE ARE VARIABLES IN STATEMENTS!!!)
        call_user_func_array(array($this->stmt, "bind_param"), array_merge(array($type), $param));
    }
    function exe(){//execute statement and when error arises, then report it
        if(!$this->stmt->execute()){
            echo "<div class='err'>execution error</div>".mysqli_error($this->db);
            exit;
        }
    }
    function fetch(){//fetch assoc field of stmt results object
        return mysqli_fetch_all($this->stmt->get_result(), MYSQLI_ASSOC);
    }
}


function checkImg($image, $filepath="userImages"){
    $imagePath=null;
    if ($image["error"]===UPLOAD_ERR_OK){
        if (!file_exists($filepath)){mkdir($filepath);}//if no filepath directory exists, create one
        
        $imagePath =$filepath."/".uniqid().$image["name"];
        move_uploaded_file($image["tmp_name"], $imagePath);
        return $imagePath;
    }
    else echo "<div class='err'> something is wrong <br> error code:".$image["error"]." </div>";
    return $imagePath;
    
}
// USER STUFFS

function login($db, $name, $pass){
    $controlActual = "1.check <br>";
    $stmt = new Stmt($db, "SELECT * FROM users WHERE name= ?");
    $stmt->bind("s", array(&$name));//VALUES MUST BE IN array(&) to WORK
    $stmt->exe();
    $controlActual.= "2.check <br>";
    if(($user = $stmt->fetch())==null){
        echo "<div class='err'>ucet nenalezen</div>";
        return 0;
    };
    $controlActual .= "3.check <br>";
    if(!password_verify($pass, $user["password"])){
        echo "<div class='err'>heslo je spatne</div>";
        return 0;
    }
    $controlActual .= "4.check <br>";
    $_SESSION["user"]=$user;//don't just fetch it again dumbass, a single fetch is enough
    //redirection is not needed because I managed to put login in the navbar
    //header("Location: ./index.php");
    echo "<div class='err'>".$controlActual."<br>DONE!</div>";
}
function register($db, $name, $pass, $email, $tel){
    //make the class and see if account name is already used
    $stmt = new Stmt($db, "SELECT * FROM users WHERE name=?");
    $stmt->bind("s", array(&$name));
    $stmt->exe();
    if(($user = $stmt->fetch())!==null){
        echo "<div class='err'>ucet s timto jmenem uz existuje</div>";
        return 0;
    };
    //add the account to database
    $stmt->stmt ="INSERT INTO users(name, password, image, email, telephone) VALUES (?, ?, ?, ?, ?);";//set the statement 
    $hashedPass =password_hash($pass, PASSWORD_BCRYPT);
    $imagePath = "userImages/default.png";
    $stmt->bind("sssss", array(&$name, &$hashedPass, &$imagePath, &$email, &$tel));//bind the params
    $stmt->exe();
    //fetch again for session values
    $stmt->stmt ="SELECT * FROM users WHERE name=?";
    $stmt->bind("s", array(&$name));
    $stmt->exe();
    $_SESSION["user"]=$stmt->fetch();
    echo "<div class='err'>congratulations on creating your account!</div>";
    }
function changeImage($db, $image){//BROKEN

    if (($imagePath = checkImg($image))===-1) return 0;
    $stmt = new Stmt($db, "UPDATE users SET image = ? WHERE id = ?;"); 
    $stmt->bind("si", array(&$imagePath, &$_SESSION["user"]["id"]));
    $stmt->exe();
    $_SESSION["user"]["image"]=$imagePath;
    
    header("Location: index.php");
}


//PRODUCT STUFF

function listProducts($db, $search="%", $tag="%", $pageNumber=0, $priceRangeTop=999999, $priceRangeBottom=0, $rating="desc", $onetime=true){//default values, so it should be fine right?
    //search="%" means that I can just avoid if statements, $tag is... idk, just gonna keep that at "%" as well
    //pagenumber can stay at 0 by default, pricerangeTop needs to be set to something otherwise it will show stupidly overpriced products all the time, pricerangeBottom is just simple...
    // rating is DESC and ASC in sql, searching for individual ratings is actually very stupid because they keep changing anyways.
    //onetime is there for the different pages having different sources, so false would mean its supplied by a warehous while true would mean its a private deal like on craigslist

    //1. get the products procured by the search
    //So I need:
    // a. where the name of product it LIKE the search thing
    // b. where the product values match the values set in search conditions (if its a one-time product, if its rated good, etc.)
    // I don't want to do what I did last year with the stupidly overcomplicated tag search system ;-; 

    //what happens if the values are null???
    //stuff probably breaks ;-;
//prepare statement according to stuff that we search for (I could've just put values preemptively, but that's a bad idea)

    //apparently its impossible to just have a single rating value update based on 

    
/*
    $statement = "   
    SELECT *
    FROM products
    JOIN users ON products.user_id = users.id
    WHERE price>=?
 ";    
    $bindarray=array(&$priceRangeBottom);
    $bindtags="d";
    if (isset($tag)) {
        $statement.=" AND tag=?"; 
        $tager = &$tag;
        $bindtags.="s";
        array_push($bindarray, $tager);
        }
    if (isset($oneTime)) {
        $statement.=" AND one_time=?";
        $timer = &$oneTime;
        $bindtags.="i";
        array_push($bindarray, $timer);
        }
    if (isset($priceRangeTop)) {
        $statement.=" AND price<=?";
        $toper = &$priceRangeTop;
        $bindtags.="d";
        array_push($bindarray, $toper);
        }
    if (isset($search)) {
        $statement.=" AND name LIKE ?"; 
        $serach = &$search;
        $bindtags.="s";
        array_push($bindarray, $serach);
        }
    if (isset($rating)) {
        $statement.=" AND rating>=?";
        $rater = &$rating;
        $bindtags.="d"; 
        array_push($bindarray, $rater);
        }

        //limits to 10 items per page
        $statement.=" 
        LIMIT 10 OFFSET ?
        ";
        $pageNumber= $pageNumber*10;
        $pager = &$pageNumber;
        array_push($bindarray, $pager);
        $bindtags.="i";
*/
//mistakes in this:
// 1. searching by rating is stupid
// 2. having onetime as a boolean is also stupid, just make a different page for commercial products and one page for independent
// 3. putting stuff in a variable like this doesn't feel right...

//oh no, I'm gonna need to add another table for orders AIAHHS

    $stmt = new Stmt($db, "
    SELECT *
    FROM products
    JOIN users ON products.user_id = users.id
    WHERE price>=? AND price<=? AND 
    ");
    $stmt->bind($bindtags, $bindarray);
    $stmt->exe();
    return $stmt->fetch();
    //It's so short without a complicated tag system... wow.
    //tag v tomhle pripade je jenom upresneni produktu. Napr. med je jidlo, pocitac je elektronika, atd. 
}

function createProduct($db, $name, $description, $image, $currentSupply, $purchaseLimit, $one_time=true, $price, $tag){
    if (($imagePath = checkImg($image))===-1) return 0;
    $stmt = new Stmt($db, "INSERT INTO products(user_id, name, description, image, current_supply, purchase_limit, one_time, price, tag) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind("sssiiid", array(&$_SESSION["user"]["id"],&$name, &$description, &$imagePath, &$currentSupply, &$purchaseLimit, &$one_time, &$price, &$tag));
    $stmt->exe();
}

function editProduct($db, $id, $name, $description, $image, $currentSupply, $purchaseLimit, $one_time=true, $price, $tag){
    if (($imagePath = checkImg($image))===-1) return 0;
    $stmt = new Stmt($db, "
    UPDATE products
    SET name = ?, description = ?, image = ?, current_supply = ?, purchase_limit = ?, one_time = ?, price = ?, tag = ?
    WHERE products.id = ?;
    ");
    $stmt->bind("sssiiids", array(&$name, &$description, &$imagePath, &$currentSupply, &$purchaseLimit, &$one_time, &$price, &$tag));
    $stmt->exe();
}

//product rating stuffs
function addRating($db, $productId, $rating, $description){
    $stmt = new Stmt($db, "INSERT INTO ratings (user_id, product_id, rating, description) VALUES (?, ?, ?, ?);");
    $stmt->bind("iiis", array(&$_SESSION["user"]["id"],&$productId, &$rating, &$description));
    $stmt->exe();
    updateRating($stmt, $productId);
}
function editRating($db, $id, $rating, $description, $productId){
    $stmt = new Stmt($db, "
    UPDATE ratings
    SET rating = ?, description = ?
    WHERE id = ?;
    ");
    $stmt->bind("isi", array(&$rating, &$description, &$id));
    $stmt->exe();
    updateRating($stmt, $productId);
}
function deleteRating($db, $id, $productId){//button only shows up for author, so it should be fine
    $stmt = new Stmt($db, "DELETE FROM ratings WHERE id = ?");
    $stmt->bind("i", array(&$id));
    $stmt->exe();
    updateRating($stmt, $productId);
}

function updateRating($stmt, $productId){
    //now that the rating is created, we need to update the products rating
    //how do we do that? Easy in php :D (I searched in sql for about an hour and found that triggers are simply too much for this)
    //we get the average of the ratings
    $stmt->stmt="SELECT AVG(rating) FROM ratings WHERE product_id = ?";
    $stmt->bind("i", array(&$productId));
    $stmt->exe();
    $rating =$stmt->fetch();
    //then we update the product ratings
    $stmt->stmt="
    UPDATE products
    SET rating = ?
    WHERE id = ?;
    ";
    $stmt->bind("ii", array(&$rating, &$productId));
    //done! only... 3 hours? why am I so slow?    
}


?>






<?php
function listPictures($db){
    $stmt = new Stmt($db, "SELECT DISTINCT * FROM pictures ");
    $stmt->exe();

    return $stmt->fetch();
}
function addPicture($db, $title, $image){
    if(($imgPath =checkImg($image, "images"))!==null){   
        $stmt = new Stmt($db, "INSERT INTO pictures(userId, title, file) VALUES (?,?,?)");
        $stmt->bind("iss", array(&$_SESSION["user"]["id"], &$title, &$imgPath));
        $stmt->exe();
    } 
}



?>