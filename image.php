<?php
//this page is used for displaying the selected image in detail (its tags, author, hopefully comments and statistics as well)
require "block/header.phtml";
if (isset($_POST["createComment"])){
    createComment($db, $_POST["imgId"], $_POST["text"]);//don't think that I can just put the imgId from get here
}
if (isset($_POST["del"])) deleteComment($db, $_POST["comId"]);
//REMEMBER: POST AND GET STUFF NEEDS TO BE BEFORE LIST STUFF
$image = listImage($db, $_GET["imgId"]);
$comms = listComments($db, $_GET["imgId"]);
//how do I get the image details though? Good question... idk.
//when clicking on image, get redirected to image.php?imgId="?" that's where.
//wait, is it possible to do ajax like this? That would be AWESOME. 
//25.04.2026 THIS IS VERY STUPID, DON'T DO IT. Ajax uses API's to get data results, kinda like a function. This returns a whole page. YOU DON'T WANT TO MAINTAIN AN API, TRUST ME.

/* what the array looks like to use when building this page(not today 19.04.2026)
image = {
    "info"->{
        imgId
        userId
        imgFile = image file
        title
        dateAdded
        userId
        name = username
        password
        userImage
        telephone
        email
        privileges = int 
        userCreation
    }
    "tags"->{
        [0]->{
            tagId
            tagName = name of tag
            tagDesc = description of tag (contents of tooltip)
        }
    }
}
*/
var_dump($image);
?>
<div><!--ADD CSS TO THIS-->
    <p><?=$image["info"]["title"];?></p>
    <p><?=$image["info"]["dateAdded"]?></p>
    <a href="profile.php?userId=<?=$image["info"]["userId"]?>"><?=$image["info"]["name"]?></a>
    <img src="<?=$image["info"]["imgFile"]?>">
</div>
<div id="tagSpace">
<?php
//it would be really cool if they just got added to a search tab, so that you could search for multiple images with the same tags at once
foreach($image["tags"] as $tag){
    ?>
    <div class="tag"><!--USE JQUERY FOR INTERACTIONS HERE LATER-->
        <p class="tagName"><?=$tag["tagName"]?></p><!--this is the main text that shows up with the tag body-->
        <p class="tagDesc"><?=$tag["tagDesc"]?></p><!--this doesn't actually show up, only when you hover over it kinda like a tooltip-->
        <p style="display:none"><?=$tag["tagId"]?></p><!--maybe for later use, I dunno.-->
    </div>
    <?php
}
if (isset($_SESSION["user"])){
?>
</div>
<div id="commSpace">
    <form action="#" method="POST"><!--could be textarea, but whatever I guess-->
        <input type="text" name="text" id="text">
        <input type="submit" value="submit Comment" name="createComment">
        <input type="hidden" name="imgId" value="<?=$image["info"]["imgId"]?>">
    </form>
<?php
}

foreach($comms as $com){
?>
<div class="comment">
    <?php
    if ($com["userId"]===$_SESSION["user"]["userId"]){
        ?>
        <form action="#" method="post">
            <input type="hidden" name="comId" value="<?=$com["comId"]?>">
            <input type="submit" name="del" value="delete comment">
        </form>
        <?php
    }
    ?>
    <p class="userName"><?=$com["name"]?></p>
    <p class="commentDate"><?=$com["commDate"]?></p>
    <p class="commentText"><?=$com["comText"]?></p>
</div>
<?php
}
?>
</div>