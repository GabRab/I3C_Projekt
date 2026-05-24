<?php
//this page is used for displaying the selected image in detail (its tags, author, hopefully comments and statistics as well)
require "block/header.phtml";
if (isset($_POST["createComment"])){
    createComment($db, $_POST["imgId"], $_POST["text"]);//don't think that I can just put the imgId from get here
}
if (isset($_POST["del"])) deleteComment($db, $_POST["comId"]);
if (isset($_POST["editImage"])){
    echo "<br> NEWTAGS:";if (isset($_POST["editImage"]["newTags"]))var_dump($_POST["editImage"]["newTags"]);
    echo "<br> OLDTAGS:";if (isset($_POST["editImage"]["oldTags"]))var_dump($_POST["editImage"]["oldTags"]);
    echo "<br>";var_dump($_POST["editImage"]);

    //scrapped idea
    ?>
    <script> //history.go(-2); </script>
<?php
    if ($_POST["editImage"]["del"]==="delete") delImage($db, $_POST["editImage"]["imgId"], $_POST["editImage"]["prevImage"]);
    else editImage($db, $_POST["editImage"]["imgId"], $_POST["editImage"]["title"], $_FILES["imgFile"], $_POST["editImage"]["prevImage"], isset($_POST["editImage"]["newTags"])?$_POST["editImage"]["newTags"]:array(), isset($_POST["editImage"]["oldTags"])?$_POST["editImage"]["oldTags"]:array());
}
echo"<br>";if (isset($_POST["editImage"]))var_dump($_POST["editImage"]);
//REMEMBER: POST AND GET STUFF NEEDS TO BE BEFORE LIST STUFF
$image = listImage($db, $_GET["imgId"]);
$comms = listComments($db, $_GET["imgId"]);
echo"<br>";var_dump($image);
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
if (isset($_SESSION["user"])&&$_SESSION["user"]["userId"]===$image["info"]["userId"]){
?>
    <form action="#" method="POST" enctype="multipart/form-data">
        <input type="text" value="<?=$image["info"]["title"]?>" name="editImage[title]" id="text">
        <input type="file" name="imgFile" id="imgFile">
        <input type="hidden" name="editImage[imgId]" value="<?=$image["info"]["imgId"]?>"><!--probably not a good idea to have these here since anyone can check the html, though since its the user it should be fine I guess-->
        <input type="hidden" name="editImage[prevImage]" value="<?=$image["info"]["imgFile"]?>">
        <div id="tagStuff">
            <?php
            foreach($image["tags"] as $tag){//these are hidden inputs that show the initial tags used during editImage
            ?>
                <input type="hidden" name="editImage[oldTags][]" value="<?=$tag["tagName"]?>">
            <?php
            }
            ?>
            <div id="tagJoinInput" style="background:green">
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
            <div id="tagList" style="background:blue">
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
        <input type="submit" value="edit image" name="editImage[sub]">
    </form>
    <form action="index.php" method="POST">
        <input type="hidden" name="editImage[imgId]" value="<?=$image["info"]["imgId"]?>">
        <input type="hidden" name="editImage[prevImage]" value="<?=$image["info"]["imgFile"]?>">
        <input type="submit" value="delete" name="editImage[del]">
    </form>
    <script>
        //so, what I'm thinking is switching the tags between the tagList and tagInput because having the tags stay in the tagList is a bit too many tags (I hate myself)
        //this often results in stuff losing their index and ending on the back. Imma fix this by just appending them to the beginning instead, its not great, but its something.
        $(document).on("click", "#tagList .tagJoin", function(){
            $(this).prependTo("#tagJoinInput");
            $(this).children("input").attr("name", "editImage[newTags][]");
            console.log("moved tag to active tags");
        })
        $(document).on("click", "#tagJoinInput .tagJoin", function(){
            $(this).prependTo("#tagList");
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
        <form action="index.php" method="post">
            <input type="submit" value="editImage[del]">
        </form>
    <?php
}
?>
<div><!--ADD CSS TO THIS-->
    <p><?=$image["info"]["title"]?></p>
    <p><?=$image["info"]["dateAdded"]?></p>
    <a href="profile.php?userId=<?=$image["info"]["userId"]?>"><?=$image["info"]["name"]?></a>
    <img src="<?=$image["info"]["imgFile"]?>">
</div>
<div id="tagSpace">
<?php
//it would be really cool if they just got added to a search tab, so that you could search for multiple images with the same tags at once
foreach($image["tags"] as $tag){
    ?>
    <a href="index.php?search=&tags%5Byes%5D%5B%5D=<?=$tag["tagName"]?>" class="tag"><!--USE JQUERY FOR INTERACTIONS HERE LATER-->
        <p class="tagName"><?=$tag["tagName"]?></p><!--this is the main text that shows up with the tag body-->
        <p class="tagDesc"><?=$tag["tagDesc"]?></p><!--this doesn't actually show up, only when you hover over it kinda like a tooltip-->
        <p style="display:none"><?=$tag["tagId"]?></p><!--maybe for later use, I dunno.-->
    </a>
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
    <a href="profile.php?userId=<?=$com["userId"]?>" class="userName"><?=$com["name"]?></a>
    <p class="commentDate"><?=$com["commDate"]?></p>
    <p class="commentText"><?=$com["comText"]?></p>
</div>
<?php
}
?>
</div>