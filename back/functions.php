<?php
/** code placed here:
 * Stmt object - basic object functions, bind, exe, fetch.
 * additional functions - checkImg
 * user functions - listUsers, login, register, changeImage
 * image functions - listImages, userImages addImage, editImage, delImage
 * tag functions - listTags, listImgTags, addTags, joinTags, unjoinTags
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

    function bind($type, $param){//08.05.2026 I changed it so that param is passed by reference, hopefully this will fix all the problems with bind_param reference error messages
        //type is a string made of {i(int),d(float),s(string),b(blob)} which sets the types of the variables 
        //and param is an array of the variables assigned with those types
        //!!!they need to have the same index placement!!!
        //bind params from these values using the statement in this class (ONLY NEEDED IF THERE ARE VARIABLES IN STATEMENTS!!!)
    
        //09.0.5.2026 Aight, Imma rework it cuz it's stupid.
        //this line of code turns single values into arrays and removes every value of an array that might be somehow wrong.
        
        if (is_array($param))$param = array_values($param);//the [0] at the end is there because it keeps putting it into another array.
        else $param= array($param);
        //Now, I want to turn each variable inside said array into a reference, so that I may later pass it on to call_user_func_array. (This took me way too long)
        //the problem was in the fact that references don't play nice with foreach, so the values were all messed up, in the end I used the regular for which finally worked.
        for ($i=0; $i<count($param);$i++){
            $arr[$i]=&$param[$i];
        }
        //var_dump($arr);echo"<br>";
        //THERE, NOW THERE SHOULDN'T BE ANYTHING WRONG WITH THESE PARAMS (It would've been so much easier if I've just made a for() here and done it myself, but call_user_func_array is genuinely interesting, so I'm keeping it
        call_user_func_array(array($this->stmt, "bind_param"), array_merge(array($type), $arr));
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
    $stmt->bind("s", $name);//VALUES MUST BE IN array(&) to WORK
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
function register($db, $name, $pass){// WORKS although it could get changed to reflect the complexity of a normal fotogallery by losing that $tel
    //make the class and see if account name is already used
    $stmt = new Stmt($db, "SELECT * FROM users WHERE name=?");
    $stmt->bind("s", $name);
    $stmt->exe();
    if(($user = $stmt->fetch())!==array()){
        var_dump($user);
        echo "<div class='err'>ucet s timto jmenem uz existuje</div>";
        return 0;
    };
    //add the account to database
    $stmt->stmt ="INSERT INTO users(name, password, userImage) VALUES (?, ?, ?);";//set the statement 
    $hashedPass =password_hash($pass, PASSWORD_BCRYPT);
    $imagePath = "userImages/default.png";
    $stmt->bind("sss", array($name, $hashedPass, $imagePath));//bind the params
    $stmt->exe();
    //fetch again for session values
    $stmt->stmt ="SELECT * FROM users WHERE name=?";
    $stmt->bind("s", $name);
    $stmt->exe();
    $_SESSION["user"]=$stmt->fetch()[0];
    echo "<div class='err'>congratulations on creating your account!</div>";
    }
function changeImage($db, $image){//WORKS :D
    if (($imagePath = checkImg($image, "userImages"))!==null){
        $stmt = new Stmt($db, "UPDATE users SET userImage = ? WHERE userId = ?;"); 
        var_dump($_SESSION);
        echo "SSSSS";
        $stmt->bind("si", array($imagePath, $_SESSION["user"]["userId"]));
        $stmt->exe();
        if ($_SESSION["user"]["userImage"]!=="userImages/default.png") unlink($_SESSION["user"]["userImage"]);//needs to be an if here, else the default would get deleted (I'm glad I realised this before it happened)
        $_SESSION["user"]["userImage"]=$imagePath;
    }
}

function listUsers($db, $string="%"){//list according to searched string
    $stmt = new Stmt($db, "SELECT * FROM users WHERE name LIKE ?");
    $stmt->bind("s", $string);
    $stmt->exe();
    return $stmt->fetch();
}
function getUser($db, $userId){//get everything about a single user (maybe I could just limit listUsers, but I don't really see the point in that right now)
    $stmt = new Stmt($db, "SELECT * FROM users WHERE userId = ?");
    $stmt->bind("i", $userId);
    $stmt->exe();
    return $stmt->fetch()[0];
}
//10.05.2026 Why is there a modular editing here??? I probably don't need this stuff, but whatever... I guess I just wanted to not waste too much time copying stuff and combined them into a single function even if its bad practice
//add editing stuff
function editUserS($db, $edit, $value){//change string value (if email, update privilege to user with email)
    $stmt = new Stmt($db, "UPDATE users SET ".$edit." = ?".(($edit==="email")?", privileges = 1 ":" ")." WHERE userId = ?");
    $stmt->bind("si", array($value, $_SESSION["user"]["userId"]));
    $stmt->exe();
    $_SESSION["user"][$edit]=$value;
}
function delUser($db, $id, $imgFiles){
    foreach($imgFiles as $i) unlink($i);//deletes all images belonging to user from the storage

    //deletes user (I put ON DELETE CASCADE on everything, so this is enough)
    $stmt= new Stmt($db, "DELETE FROM users WHERE userId = ?");
    $stmt->bind("i", $id);
    $stmt->exe();
}
//change privilige level later as well when email or phone number is added
?>




<?php
//IMAGE STUFF
function listImages($db, $search=null, $tags=null){//works, just needs css on the frontend
    if (isset($search)) $search = "%".$search."%";//if search is not just % allow for easier searching, else finding someone would be really hard... It's not the best but its atleast something I guess
    else $search="%";

    $statement="SELECT DISTINCT * FROM images WHERE title LIKE ?";
    $bindTypes = "s";
    $bindValues = array($search);
    
    //04.05.2026
    //PROBLEM: this sql request doesn't work...
    //I need to get: ALL images connected to specified tags. This means that I need to get images that 
    //this could be solved by just using a t.tagName IN(), but that would result in an OR search type... which is bad. I want an AND, which means subqueries or something...
    //I could make a subquery that returns a count of tags and if it matches the tags that are supposed to be there, then its fine, but it wouldn't work very well for the exclusion of tags.

    //I'm working on it, found a way that works, just that it seems to have some problems
    //IT WORKS!!!! AND IT'S ONLY A SINGLE REQUEST!!!
    //I could add a way to somehow get the tags as well and have them show up as little buttons that then take you to a search with that tag... That is another request tho...
    //I found a way to have multiple SELECTS in one query, but it sadly doesn't work for more than one column, so I guess Imma stick with this then.
    //it would be great if I could get an array like images[image=>{*}, tags=>{*}], kinda like in listImage, but Imma just keep this to one query.
    //this is much better than the GROUPCONCAT solution with MULTIPLE requests on my last php project. It makes me happy to have found this solution.
    //PROBLEM: exclusion doesn't work
    //fixed it after fiddling with it a bit. Nice. Now I need to add the tag management, because you can only add or delete them. Editing would be greatly appreciated

    if (isset($tags)){
        $statement = "
        SELECT i.* FROM images i
        LEFT JOIN tagConnections tc ON tc.imgId = i.imgId
        LEFT JOIN tags t ON t.tagId = tc.tagId
        WHERE title LIKE ?
        GROUP BY i.imgId
        ";
        $bindTypes = 's';
        $bindValues = array($search);
        if (isset($tags["yes"]))foreach($tags["yes"] as $key => $tag){
            if ($key===0) $statement.="HAVING SUM(CASE WHEN t.TagName = ? THEN 1 ELSE 0 END) = 1";//I had something similar in mind where the count of correct things would work, but this works as well. (I found it on stack overflow and I find it really nice) 
            else $statement.=" AND SUM(CASE WHEN t.TagName = ? THEN 1 ELSE 0 END) = 1";//if this returns 1, then it has the tag connected, if it doesn't then it returns 0.
            $bindTypes.='s';
            array_push($bindValues, $tag);//already a reference, since it's the value $tags["yes"][n] AS $tag
        }
        if (isset($tags["no"]))foreach($tags["no"] as $key =>$tag){
            if ($key===0 && !isset($tags["yes"][0])) $statement.="HAVING SUM(CASE WHEN t.TagName = ? THEN 1 ELSE 0 END) = 0";
            else $statement.=" AND SUM(CASE WHEN t.TagName = ? THEN 1 ELSE 0 END) = 0";
            $bindTypes.='s';
            array_push($bindValues, $tag);
        }
    }
    echo "<br><br>";
    var_dump($bindTypes);
    var_dump($bindValues);
    echo"<br>".$statement;

    $stmt = new Stmt($db, $statement);
    $stmt->bind($bindTypes, $bindValues);//search according to title (kinda useless with images tho)
    $stmt->exe();
    return $stmt->fetch();//no [0] here because its built with that in mind
    //I just realised that this returns only the image stuff... I could return the tags as well, but that's unnecessary complications.
}
function userImages($db, $userId){//returns images of the user for use in displaying the profile I guess?
    $stmt = new Stmt($db, "SELECT * FROM images WHERE userId = ?");//TODO: expand this to accomodate SUM and AVG of different metrics using JOIN ON
    $stmt->bind("i", $userId);
    $stmt->exe();
    return $stmt->fetch();
}
function listImage($db, $imgId){//returns info about image array(info->{user, image}, tags->{every tag connected to this})
    //get info about image and user, put it into array
    $stmt = new Stmt($db, "
    SELECT i.*, u.* FROM images i 
    JOIN users u ON i.userId = u.userId 
    WHERE imgId = ? 
    ");//TODO: expand this to accomodate SUM and AVG of different metrics using JOIN ON
    $stmt->bind("i", $imgId);
    $stmt->exe();
    $fetch["info"] = $stmt->fetch()[0];
    
    //increase the number of times the image was displayed in image.php (it doesn't differentiate from the creator looking at it, but whatever I guess)
    $fetch["info"]["views"]++;
    $stmt->stmt="UPDATE images SET views = ? WHERE imgId = ?";
    $stmt->bind("ii", array($fetch["info"]["views"], $fetch["info"]["imgId"]));
    $stmt->exe();

    //get tags related to image and put it into array
    $stmt->stmt="
    SELECT t.* FROM tagConnections tc 
    JOIN tags t ON tc.tagId = t.tagId
    WHERE tc.imgId = ?";
    $stmt->bind("i", $imgId);
    $stmt->exe();
 
    $fetch["tags"] = $stmt->fetch();
    return $fetch;
}
function addImage($db, $title, $image){//should work as well.
    if(($imgPath =checkImg($image, "images"))!==null){   
        $stmt = new Stmt($db, "INSERT INTO images(userId, title, imgFile) VALUES (?,?,?)");
        $stmt->bind("iss", array($_SESSION["user"]["userId"], $title, $imgPath));
        $stmt->exe();
    } 
}
//add function for getting your images, editing images, removing images. (17.04.2026)
function editImage($db, $imgId, $title, $image, $prevImage, $newTags, $oldTags){//edit image (button will show up if the image you're viewing matches its userId to the current user's userId)
//I STILL NEED TO EDIT TAGS I WANT TO CRY
    if ($image["error"]===4){//if there is no new image, keep the previous one and just change the title.
        $stmt = new Stmt($db, "UPDATE images SET title = ? WHERE imgId = ?");
        $stmt->bind("si", array($title, $imgId));
        $stmt->exe();
    }
    else if(($imgPath =checkImg($image, "images"))!==null){
        //I need to delete the previous image though... I can probably just do it later, but that would feel wrong sooo Imma add it into this function to keep it together
        $stmt = new Stmt($db, "UPDATE images SET title = ?, imgFile = ? WHERE imgId = ?");
        $stmt->bind("ssi", array($title, $imgPath, $imgId));
        $stmt->exe();
        unlink($prevImage);
    }

    //07.05.2026 new tags, old tags. If newTags are different from old tags then run this thing
    //PROBLEM: user can just reset the page to insert more tags, causing duplicates
    //PROBLEM: if either is null, it throws errors FIX? isset()
    $newTags = isset($newTags)?$newTags:array();
    $oldTags = isset($oldTags)?$oldTags:array();
    //this way there shouldn't be any problem


    //for the tags I need to: get rid of everything that doesn't change between the new and old tags, add those that are only in newtags and remove all that are in the oldTags
    //remove stuff that doesn't change

    if (($newTemp = array_values(array_diff($newTags, $oldTags)))!=null){//this leaves only added tags and activates if there's something to be done
        echo"<br> ADDING TAGS";var_dump($newTemp);
        //this is gonna need

        $stat="SELECT tagId FROM tags WHERE tagName IN(";
        $type='';
        $arr=array();
        foreach($newTemp as $key=>$tag){
            if ($key==0)$stat.="?";
            else $stat.=",?";
            $type.='s';
            array_push($arr, $tag);
        }
        $stat.=")";
        /*
        echo "<br>".$stat;
        echo "<br>".$type."<br>";
        var_dump($arr);
        echo "<br>";
        */
        $stmt->stmt = $stat;
        $stmt->bind($type, $arr);
        $stmt->exe();
        $tagIds = $stmt->fetch();
        //var_dump($tagIds);

        $stat="
        INSERT INTO tagConnections (imgId, tagId)
        VALUES ";
        $type='';
        $arr=array();
        foreach($tagIds as $key=>$tag){
            if ($key==0)$stat.="(?, ?)";
            else $stat.=", (?, ?)";
            //echo $key;
            $type.='ii';
            array_push($arr, $imgId, $tag["tagId"]);
        }
/*
        echo "<br>".$stat;
        echo "<br>".$type."<br>";
        var_dump($arr);
        echo "<br>";
*/
        $stmt->stmt = $stat;
        $stmt->bind($type, $arr);
        //var_dump($type); var_dump($arr);
        $stmt->exe();
    }
    //var_dump($oldTags, $newTags);
    if (($newTemp = array_values(array_diff($oldTags, $newTags)))!=null){//this leaves only removed tags and activates if there's something to be done
        echo"<br> REMOVING TAGS"; var_dump($newTemp);
        $stat = "
        DELETE tagConnections FROM tagConnections
        JOIN tags ON tagConnections.tagId = tags.tagId
        WHERE tagConnections.imgId = ? AND tags.tagName IN(";
        $type="i";
        $arr = array($imgId);
        foreach($newTemp as $key=>$tag){//I wanted to use implode, but that would mean using the values meant for binding.
            if ($key==0) $stat.="?";
            else $stat.=", ?";
            $type.="s";
            array_push($arr, $tag);
        }
        $stat.=")";
/*        
        echo "<br>".$stat;
        echo "<br>".$type."<br>";
        var_dump($arr);
        echo "<br>";
*/
        $stmt->stmt=$stat;
        $stmt->bind($type, $arr);
        $stmt->exe();
    }//this should all work... in theory

}

function delImage($db, $imgId, $imgFile){
    $stmt = new Stmt($db, "DELETE FROM images WHERE imgId = ?");//since I added cascading stuff, everything should go with it as well... except comments... I forgot about those
    $stmt->bind("i", $imgId);
    $stmt->exe();
    unlink($imgFile);//works perfectly :)
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
//I just realised(22:57) that I might not need user tags after all... It's already connected with the users and I've decided to make a separate search thingy for images specific for users, so checking if it doesn't equal user is kinda useless
function addTag($db, $tagName, $tagDesc=null){//add tag if it doesn't exist yet (tagDesc is because of user tags)
    if ($tagDesc===null) $tagDesc=$tagName;//if no description, then make name the description...
    $stmt = new Stmt($db, "SELECT * FROM tags WHERE tagName = ? AND tagDesc = ?");//tagDesc shows up to explain the tag further, though I'm having second thoughts if it has to be here
    $stmt->bind("ss", array($tagName, $tagDesc));
    $stmt->exe();
    if ($stmt->fetch()[0]===null){//fetch() returns everything, so it needs to be on a [0] to see if its actually null
        $stmt->stmt ="INSERT INTO tags(tagName, tagDesc) VALUES (?, ?)";
        $stmt->bind("ss", array($tagName, $tagDesc));
        $stmt->exe();
    }
}
function joinTag($db, $imgId, $tag){//joins single tag!
    //get tagIds and create connection
    $stmt = new Stmt($db, "SELECT tagId FROM tags WHERE tagName = ?");//problem: how to make fanwork? Well, user tags are for stuff created by the user, while the rest are just fanworks I guess
    $stmt->bind("s", $tag);
    $stmt->exe();
    $tagId = $stmt->fetch()[0]["tagId"];
    $stmt->stmt = "INSERT INTO tagConnections(tagId, imgId) VALUES (?, ?)";
    $stmt->bind("ii", array($tagId, $imgId));
    $stmt->exe();
}//to actually use this, I need the imgId which means another fetch request.
function joinAllTags($db, $tags){//join all tags (gets imgId)
    $stmt = new Stmt($db, "SELECT imgId FROM images WHERE userId = ? ORDER BY dateAdded DESC LIMIT 1");
    $stmt->bind("i", $_SESSION["user"]["userId"]);
    $stmt->exe();
    $imgId = $stmt->fetch()[0]["imgId"];//mysqli_fetch_all pust everything into an associative array, if it fetches only one thing it still ends up in an array.
    foreach ($tags as $tag) {
        joinTag($db, $imgId, $tag);
    }
}
function unjoinTag($db, $imgId, $tagId){//this is useless because I put an ON DELETE CASCADE on tagJoin, so there is no need for this to exist
    $stmt = new Stmt($db, "DELETE FROM tagConnections WHERE tagId = ? AND imgId = ?");
    $stmt->bind("s", $tag);
    $stmt->exe();
}
function editTag($db, $tagName, $tagDesc){
    $stmt = new Stmt($db, "UPDATE tags SET tagDesc = ? WHERE tagName = ?");
    $stmt->bind("ss", array($tagDesc, $tagName));
    $stmt->exe();
}
function delTag($db, $tagId){
    $stmt = new Stmt($db, "DELETE FROM tags WHERE tagId = ?");
    $stmt->bind("i", $tagId);
    $stmt->exe();
}

?>


<?php
//COMMENT STUFF
function listComments($db, $imgId){
    $stmt = new Stmt($db, "
    SELECT c.*, u.* FROM comments c
    JOIN users u ON u.userId = c.userId
    WHERE imgId = ?");
    $stmt->bind("s", $imgId);
    $stmt->exe();
    return $stmt->fetch();
}
function createComment($db, $imgId, $text){
    $stmt = new Stmt($db, "INSERT INTO comments(userId, imgId, comText) VALUES (?, ?, ?)");
    $stmt->bind("iis", array($_SESSION["user"]["userId"], $imgId, $text));
    $stmt->exe();
    header("Location: image.php?imgId=".$imgId);
}
function deleteComment($db, $comId){
    $stmt = new Stmt($db, "DELETE FROM comments WHERE comId = ?");
    $stmt->bind("i", $comId);
    $stmt->exe();
}

?>