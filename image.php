<?php
//this page is used for displaying the selected image in detail (its tags, author, hopefully comments and statistics as well)
require "block/header.phtml";
if (isset($_POST["createComment"])){
    createComment($db, $_POST["imgId"], $_POST["commentText"]);//don't think that I can just put the imgId from get here
}
if (isset($_POST["del"])) deleteComment($db, $_POST["comId"]);
if (isset($_POST["editImage"])){
    //echo "<br> NEWTAGS:";if (isset($_POST["editImage"]["newTags"]))var_dump($_POST["editImage"]["newTags"]);
    //echo "<br> OLDTAGS:";if (isset($_POST["editImage"]["oldTags"]))var_dump($_POST["editImage"]["oldTags"]);
    ////echo "<br>";var_dump($_POST["editImage"]);

    //scrapped idea
    ?>
    <script> //history.go(-2); </script>
<?php
    if ($_POST["editImage"]["del"]==="delete") delImage($db, $_POST["editImage"]["imgId"], $_POST["editImage"]["prevImage"]);
    else editImage($db, $_POST["editImage"]["imgId"], $_POST["editImage"]["title"], $_FILES["imgFile"], $_POST["editImage"]["prevImage"], isset($_POST["editImage"]["newTags"])?$_POST["editImage"]["newTags"]:array(), isset($_POST["editImage"]["oldTags"])?$_POST["editImage"]["oldTags"]:array());
}
//echo"<br>";if (isset($_POST["editImage"]))var_dump($_POST["editImage"]);
//REMEMBER: POST AND GET STUFF NEEDS TO BE BEFORE LIST STUFF
$image = listImage($db, $_GET["imgId"]);
$comms = listComments($db, $_GET["imgId"]);
//echo"<br>";var_dump($image);
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
//var_dump($image);

//LATER: ADD A BUTTON TO REVEAL THIS WITH JS (just a query to toggle the form, nothing hard tbh.)
if (isset($_SESSION["user"])&&($_SESSION["user"]["userId"]===$image["info"]["userId"]||$_SESSION["user"]["privilege"]>1)){
?>
<a href="#" id="openEdit">edit</a>
<div id="ImageEditStuff">
<?php
    if (isset($_SESSION["user"])&&$_SESSION["user"]["userId"]===$image["info"]["userId"]){
        ?>
    <form action="#" method="POST" enctype="multipart/form-data" id="ImageEditForm">
        <input type="text" value="<?=$image["info"]["title"]?>" name="editImage[title]" id="ImgEditText">
        <input type="file" name="imgFile" id="ImgEditFile">
        <input type="hidden" name="editImage[imgId]" value="<?=$image["info"]["imgId"]?>"><!--probably not a good idea to have these here since anyone can check the html, though since its the user it should be fine I guess-->
        <input type="hidden" name="editImage[prevImage]" value="<?=$image["info"]["imgFile"]?>">
        <div id="ImageEditTagStuff">
            <?php
            foreach($image["tags"] as $tag){//these are hidden inputs that show the initial tags used during editImage
            ?>
                <input type="hidden" name="editImage[oldTags][]" value="<?=$tag["tagName"]?>">
                <?php
            }
            ?>
            <div id="ImageTagJoinInput" style="background:green">
                <?php
            foreach($image["tags"] as $tag){//these are the ones that actually change, add JS for it at some point later.
            ?>
                <div class="tagJoin">
                    <a href="#" class="tagName"><?=$tag["tagName"]?></a>
                    <a href="#" class="tagDesc"><?=$tag["tagDesc"]?></a>
                    <input class="tagVal" type="hidden" value="<?=$tag["tagName"]?>" name="editImage[newTags][]">
                </div>
                <?php
            }
            ?>
            </div>
            <div id="ImageTagList" style="background:blue">
                <?php
                $tags = listTags($db);
                
                foreach($image["tags"] as $tag) for($i=0; $i<count($tags); $i++) $tags[$i]=array_diff($tags[$i], $tag);//this gets rid of items in arrays (array_diff doesn't work on multi-dimensional arrays)
                foreach($tags as $key=>$tag){
                    if(count($tag)===0)unset($tags[$key]);
                    }//this gets rid of the resulting empty arrays
                    foreach($tags as $tag){
                        ?>
                <div class="tagJoin">
                    <a href="#" class="tagName"><?=$tag["tagName"]?></a>
                    <a href="#" class="tagDesc"><?=$tag["tagDesc"]?></a>
                    <input class="tagVal" type="hidden" value="<?=$tag["tagName"]?>" name="editImage[NO][]">
                </div>
                <?php

}
?>
            </div>
        </div>
        <input type="submit" value="edit image" name="editImage[sub]" id="ImageEditSub">
    </form>
    <form action="index.php" method="POST" id="ImageDelForm">
        <input type="hidden" name="editImage[imgId]" value="<?=$image["info"]["imgId"]?>">
        <input type="hidden" name="editImage[prevImage]" value="<?=$image["info"]["imgFile"]?>">
        <input type="submit" value="delete" name="editImage[del]" id="ImageEditDel">
    </form>
    <script>
        //so, what I'm thinking is switching the tags between the tagList and tagInput because having the tags stay in the tagList is a bit too many tags (I hate myself)
        //this often results in stuff losing their index and ending on the back. Imma fix this by just appending them to the beginning instead, its not great, but its something.
        $(document).on("click", "#ImageTagList .tagJoin", function(){
            $(this).appendTo("#ImageTagJoinInput");
            $(this).children("input").attr("name", "editImage[newTags][]");
            console.log("moved tag to active tags");
        })
        $(document).on("click", "#ImageTagJoinInput .tagJoin", function(){
            $(this).prependTo("#ImageTagList");
            $(this).children("input").attr("name", "editImage[NO][]");
            console.log("moved tag to list");
        })
        </script>
<?php
} else if ($_SESSION["user"]["privilege"]>1){//reminder 0=user without email, 1=user with email, 2=moderator, 3=admin, 4=owner  Most of these are useless because they require more code to function
//I wanted moderators to be only able to update images into "REMOVED DUE TO: bad" but that sounds like a bother.
//user without email can only comment and add images (I would add a time limit but that also seems like a bother)
//email user can add tags
//moderators can edit and remove tags and remove images
//admins can remove users and images and tag stuff
//owner can do all, but can also delete admins
?>
        <form action="index.php" method="post" id="ImageDelForm">
            <input type="hidden" name="editImage[imgId]" value="<?=$image["info"]["imgId"]?>">
            <input type="hidden" name="editImage[prevImage]" value="<?=$image["info"]["imgFile"]?>">
            <input type="submit" value="delete" name="editImage[del]" id="ImageEditDel">
        </form>
        <?php
}?>
<script>
    $(document).ready(function(){
        $("#openEdit").click(function(){
            $("#ImageEditStuff").toggle();
        })
    });
</script>
<?php
}
?>
</div><!--encompassing the whole of edit stuff-->
<div id="Image"><!--ADD CSS TO THIS-->
    <div id="ImageInfo">
        <h2 id="ImageTitle"><?=$image["info"]["title"]?></h2>
        <a id="ImageUser" href="profile.php?userId=<?=$image["info"]["userId"]?>"><h3><?=$image["info"]["name"]?></h3></a>
        <p id="ImageDate"><?=$image["info"]["dateAdded"]?></p>
    </div>
    <div id="ImageImage">
        <img id="ImageFile" src="<?=$image["info"]["imgFile"]?>">
    </div>
</div>

<?php echo new Tags($image["tags"], "ImageTags", "tag");?>

<div id="ImageComments">
<?php
if (isset($_SESSION["user"])){
?>
    <form action="#" method="POST" id="ImageCommentAddForm"><!--could be textarea, but whatever I guess-->
        <input type="text" name="commentText" id="ImageCommentAddText">
        <input type="submit" value="submit Comment" name="createComment" id="ImageCommentAddSub">
        <input type="hidden" name="imgId" value="<?=$image["info"]["imgId"]?>">
    </form>
<?php
}

foreach($comms as $com){
?>
<div class="ImageComment">
    <?php
    if ($com["userId"]===$_SESSION["user"]["userId"]){
        ?>
        <form action="#" method="post" class="ImageCommentDelForm">
            <input type="hidden" name="comId" value="<?=$com["comId"]?>">
            <input type="submit" class="ImageCommentDelSub" name="del" value="delete comment">
        </form>
        <?php
    }
    ?>
    <div class="commentInfo">
        <a href="profile.php?userId=<?=$com["userId"]?>" class="commentUsername"><?=$com["name"]?></a>
        <div class="commentDate"><?=$com["commDate"]?></div>
    </div>
    <p class="commentText"><?=$com["comText"]?></p>
</div>
<?php
}
?>
</div>