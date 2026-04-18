<?php
/** code placed here:
 * user functions - login, register, changeImage(not sure if it works)
 * image functions - addImage, listImages
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
        return mysqli_fetch_all($this->stmt->get_result(), MYSQLI_ASSOC);//ALERT!!! using mysqli_fetch_all causes an empty array instead of null when getting 0 result rows!!!
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

?>


<?php
// USER STUFFS
function login($db, $name, $pass){//WORKS :D
    $stmt = new Stmt($db, "SELECT * FROM users WHERE name= ?");
    $stmt->bind("s", array(&$name));//VALUES MUST BE IN array(&) to WORK
    $stmt->exe();
    echo "first";
    if(($user = $stmt->fetch())===array()){
        echo "<div class='err'>ucet nenalezen</div>";
        return 0;
    };
    var_dump($user);
    if(!password_verify($pass, $user[0]["password"])){
        echo "<div class='err'>heslo je spatne</div>";
        return 0;
    }
    echo "second";
    $_SESSION["user"]=$user[0];//don't just fetch it again dumbass, a single fetch is enough
    //redirection is not needed because I managed to put login in the navbar
    //header("Location: ./index.php");
}
function register($db, $name, $pass, $email, $tel){// WORKS although it could get changed to reflect the complexity of a normal fotogallery by losing that $tel
    //make the class and see if account name is already used
    $stmt = new Stmt($db, "SELECT * FROM users WHERE name=?");
    $stmt->bind("s", array(&$name));
    $stmt->exe();
    if(($user = $stmt->fetch())!==array()){
        var_dump($user);
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
    $_SESSION["user"]=$stmt->fetch()[0];
    echo "<div class='err'>congratulations on creating your account!</div>";
    }
function changeImage($db, $image){//WORKS :D
    if (($imagePath = checkImg($image, "userImages"))!==null){//don't need second parameter here... Just wanna keep it here for some reason... idk
        $stmt = new Stmt($db, "UPDATE users SET image = ? WHERE id = ?;"); 
        //var_dump($_SESSION);
        $stmt->bind("si", array(&$imagePath, &$_SESSION["user"]["id"]));
        $stmt->exe();
        $_SESSION["user"]["image"]=$imagePath;
    }
    
    header("Location: index.php");
}




?>

<?php
//IMAGE STUFF
function listImages($db){//works, just needs css on the frontend
    $stmt = new Stmt($db, "SELECT DISTINCT * FROM images ");
    $stmt->exe();
    return $stmt->fetch();//no [0] here because its built with that in mind
}
function addImage($db, $title, $image){//should work as well.
    if(($imgPath =checkImg($image, "images"))!==null){   
        $stmt = new Stmt($db, "INSERT INTO images(userId, title, file) VALUES (?,?,?)");
        $stmt->bind("iss", array(&$_SESSION["user"]["id"], &$title, &$imgPath));
        $stmt->exe();
    } 
}
//add function for getting your images, editing images, removing images. (17.04.2026)
function editImage($db, $title, $image, $imageId){//edit image (button will show up if the image you're viewing matches its userId to the current user's userId)
    if(($imgPath =checkImg($image, "images"))!==null){   
        $stmt = new Stmt($db, "UPDATE images SET title = ?, file = ? WHERE imgId = ?");
        $stmt->bind("iss", array(&$title, &$imgPath, &$imageId));
        $stmt->exe();
    } 
}
function userImages($db, $userId){//returns images of the user for use in displaying the profile I guess?
    $stmt = new Stmt($db, "SELECT * FROM images WHERE userId = ?");//TODO: expand this to accomodate SUM and AVG of different metrics using JOIN ON
    $stmt->bind("i", array(&$userId));
    $stmt->exe();
    return $stmt->fetch();
}
function delImage($db, $imageId){
    $stmt = new Stmt($db, "DELETE FROM images WHERE imgId = ?");
    $stmt->bind("i", array(&$imageId));
    $stmt->exe();
}
//maybe after that comments under images, likes, views, idk?
//don't make a tag search system, don't make rule34, don't... bad thoughts
//sums of views and likes on profile page. Profile page is just statistics I think?
?>



<?php
//TAG STUFF (18.04.2026)
function listTags($db){//return tags for tag list
    $stmt = new Stmt($db, "SELECT * FROM tags");
    $stmt->exe();
    return $stmt->fetch();
}
function listImgTags($db, $imgId){//return tags of specific image
    $stmt = new Stmt($db, "
    SELECT * FROM tags t
    JOIN tagConns tc ON t.tagId = tc.tagID
    WHERE tc.imgId = ?
    ");
    $stmt->bind("i", array(&$imageId));
    $stmt->exe();
    return $stmt->fetch();
}
//I just realised(22:57) that I might not need user tags after all... It's already connected with the users and I've decided to make a separate search thingy for images specific for users, so checking if it doesn't equal user is kinda useless
function addTag($db, $tagName, $tagDesc=''){//add tag if it doesn't exist yet (tagDesc is because of user tags)
    $stmt = new Stmt($db, "SELECT * FROM tags WHERE tagName = ? AND tagDesc = ?");//tagDesc shows up to explain the tag further, though I'm having second thoughts if it has to be here
    $stmt->bind("ss", array(&$tagName, &$tagDesc));
    if ($stmt->fetch()[0]!==null){
        $stmt->stmt ="INSERT INTO tags(tagName, tagDesc) VALUES (?, ?)";
        $stmt->bind("ss", array(&$tagName, &$tagDesc));
        $stmt->exe();
    }
}
function joinTag($db, $imgId, $tag){//joins single tag!
    //if tag donesn't exist, make with empty string and add later in tag stuff page
    addTag($db, $tag);
    //get tagIds and create connection
    $stmt = new Stmt($db, "SELECT * FROM tags WHERE tagName = ?");//problem: how to make fanwork? Well, user tags are for stuff created by the user, while the rest are just fanworks I guess
    $stmt->bind("s", array(&$tag));
    $stmt->exe();
    $tagId = $stmt->fetch()[0]["tagId"];
    $stmt->stmt = "INSERT INTO tagConnections(tagId, imgId) VALUES (?, ?)";
    $stmt->bind("ii", array(&$imgId, &$tagId));
    $stmt->exe();
}
function unjoinTag($db, $imgId, $tagId){//get tagId and imgId from edit page
    $stmt = new Stmt($db, "DELETE FROM tagConnections WHERE tagId = ? AND imgId = ?");
    $stmt->bind("s", array(&$tag));
    $stmt->exe();
}


?>