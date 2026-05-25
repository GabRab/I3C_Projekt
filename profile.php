<?php
//this is the page created for the user themselves, where various statistics and customizations are in place as well as their creations.
require "block/header.phtml";

//plans for this page:
// get userId using a post from that gets sent when you click on yourself or on a user from users.php
// get list of statistics about a user (maybe privacy settings too? Later, right now I need this to work...)

if ($_SESSION["user"]["userId"]==$_GET["userId"]){//some authority stuff for editing profile I guess
    if(isset($_POST["subName"])){
        editUserS($db, "name", $_POST["username"]);
    }
    if (isset($_FILES["userImageP"])){
        echo"<br>";var_dump($_FILES["userImageP"]);
        changeImage($db, $_FILES["userImageP"]);
    }
    if(isset($_POST["subEmail"])){
        editUserS($db, "email", $_POST["email"]);
    }
}

if (isset($_GET["userId"])){
    $images = userImages($db, $_GET["userId"]);
    $user = getUser($db, $_GET["userId"]);
    //var_dump($images);
    var_dump($user);
    echo"<br>"; var_dump($_SESSION["user"]);
}
else echo"<h1>CO TU DELAS PARCHANTE</h1>";//easter egg for those who want to mess with the url



//25.04.2026
//post is bad for this, am just using get instead
//I need to add comment
?>
<div id="userSpace">
<?php
if ($_SESSION["user"]["privileges"]>2 && $user["privileges"]<3){
    ?>
    <form action="index.php" method="post">
        <input type="hidden" name="delUser[userId]" value="<?=$user["userId"]?>"><!--I know I could just have the id be in the submit input value, but that would mean that the submit text itself is the id :(-->
        <input type="submit" value="delete user" name="delUser[Sub]">
        <?php foreach($images as $image){ ?> <input type="hidden" name="delUser[images][]" value=<?=$image["imgFile"]?>> <?php } ?>
    </form>
    <?php
}
?>
        <h3 id="profileName"><?=$user["name"]?></h3> 
        <?php if ($user["userId"]===$_SESSION["user"]["userId"]){ ?> 
            <a href="#" id="changeUsername">change name</a>
            <form action="#" method="post" id="changeInputName" style="display:none">
                <input type="text" name="username" value="<?=$user["name"]?>">
                <input type="submit" name="subName">
            </form>
        <script>$(document).ready(function(){$("#changeUsername").click(function(){$("#changeInputName").toggle();})})//I love that you can just do this and get yelled at despite it working </script>
        <?php }?>
        
        <?php 
        if ($user["userId"]===$_SESSION["user"]["userId"]){ 
        ?> 
            <form action="#" method="post" enctype="multipart/form-data" id="changeImage" name="changeImage">
                <label for="userImageP"> <img src="<?=$user["userImage"]?>"> </label>
                <input accept="image/" style="display:none" type="file" name="userImageP" id="userImageP">
            </form>
            <script>$(document).ready(function(){$("#userImageP").change(function(){$("#changeImage").submit();})}) </script>
        <?php 
        } 
        else{ 
        ?>
            <img id="profileImg" src="<?=$user["userImage"]?>"> 
        <?php 
        } 
        ?>

        <p id="profileCreation"><?=$user["userCreation"]?></p><!--date of user account creation-->
        <?php if ($user["userId"]===$_SESSION["user"]["userId"]){ ?>
            <form method="post" id="additionalUserInfo">
                <p id="profileEmail"><?=$user["email"]?></p>
                <a href="#" id="changeEmail">change Email</a><!--I could send confirmation emails, but that's a novelty that would get in the way of testing for now-->
                <div id="changeInputEmail" style="display:none">
                    <input type="email" name="email" value="<?=$user["email"]?>">
                    <input type="submit" name="subEmail">
                    <script>$(document).ready(function(){$("#changeEmail").click(function(){$("#changeInputEmail").toggle();})})</script>
                </div>
            </form>
        <?php }//removed phone numbers, because they're too much and I don't know how to incentivize people to add them without making the UX too limited without them.
        ?>
        <!--total statistics here (just add them as subqueries to getUser(), shouldn't be too hard since its just counting the amount of views, likes and dislikes.-->
        <!--The rest of the statistics could be stuff you're liked before, history is too much data so Imma leave it out, stuff you dislike(dunno why you would want to see stuff that you don't like though)-->
        <!--folders of images you like would be also interesting, but that's another table...-->
        <!--Another idea is a customizable background image, but I don't wanna deal with problems like resolution or repeating the image in the background even if its just css because css scares me-->
        </div>
<div id="imageSpace">
    <?php
foreach($images as $image){
    ?>
    <a class="profileImages" href="image.php?imgId=<?=$image["imgId"]?>">
        <p class="imageTitle"><?=$image["title"]?></p>
        <p class="imageDate"><?=$image["dateAdded"]?></p>
        <p class="views"><?=$image["views"]?></p>
        <img class="imageFile" src="<?=$image["imgFile"]?>">
    </a><!-- ADD STATISTICS TO THIS AS WELL LATER WHEN THEY'RE ADDED-->
    <?php
}
?>
</div><!-- end of imageSpace-->