<?php
//this is the page created for the user themselves, where various statistics and customizations are in place as well as their creations.
require "block/header.phtml";

//plans for this page:
// get userId using a post from that gets sent when you click on yourself or on a user from users.php
// get list of statistics about a user (maybe privacy settings too? Later, right now I need this to work...)

if (isset($_GET["userId"])){
    $images = userImages($db, $_GET["userId"]);
    $user = getUser($db, $_GET["userId"]);
    var_dump($images);
    var_dump($user);
}

if ($_SESSION["user"]["userId"]==$_GET["userId"]){//some authority stuff for editing profile I guess

}


//25.04.2026
//post is bad for this, am just using get instead
//I need to add comment
?>
<div id="userSpace">
    <p><?=$user["name"]?></p>
    <img src="<?=$user["userImage"]?>">
    <p><?=$user["userCreation"]?></p><!--date of user account creation-->
    <?php
    if ($_GET["userId"]===$_SESSION["user"]["userId"]){//stuff to show only when user (email and telephone number)
        ?>
        <div id="additionalUserInfo">
            <p><?=$user["email"]?></p><!--would love to do checks to see if the email is actually theirs by sending them a form they would have to click on, but I'm not sure if I got enough time for that-->
            <p><?=$user["telephone"]?></p><!--same here-->
        </div>
        <?php
    }
    ?>
</div>



<div id="imageSpace">
<?php
foreach($images as $image){
    var_dump($image);
    ?>
    <a href="image.php?imgId=<?=$image["imgId"]?>">
        <p><?=$image["title"]?></p>
        <p><?=$image["dateAdded"]?></p>
        <img src="<?=$image["imgFile"]?>">
    </div>
    <?php
}
?>
</div><!-- end of imageSpace-->