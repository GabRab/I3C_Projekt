<?php
//this page is for adding and editing tags
include "block/header.phtml";
if (isset($_POST["subAddTag"])){
    addTag($db, $_POST["tagName"], $_POST["tagDesc"]);
}
//deleting tags could cause a whole array of problems...
if (isset($_POST["subDelTag"])) delTag($db, $_POST["tagDelId"]);//WHY DOESN'T ALTER TABLE tagConnections ADD CONSTRAINT foreing_tag FOREIGN KEY(tagId) REFERENCES tags(tagId) ON DELETE CASCADE WORK, THERE'S NOTHING WRONG!!!!
//ALERT: IF A SQL REQUEST ON ALTER DOESN'T WORK, JUST DROP THE TABLE!!!
//DON'T WASTE TIME.
if (isset($_POST["editTagSub"])) editTag($db, $_POST["editTagId"], $_POST["editTagDesc"]);//these could all just use the tagName since its a UID in of itself. Oh well.

if (isset($_SESSION["user"])){
    if ($_SESSION["user"]["privileges"]>0){//a user has to add an email to his account to change tags. This doesn't stop trolls, but it at least deters bots.
    //this is mainly because tags are annoying to make, so you might at least give it to the community to do.
    ?>
    <form action="" method="POST">
        <input type="text" name="tagName">
        <input type="text" name="tagDesc">
        <input type="submit" value="add tag" name="subAddTag">
    </form>
        <?php
    }
}
?>
<div id="tags">
<?php
$tags = listTags($db);
foreach($tags as $tag){
?>
    <a class="tag" href="index.php?search=&tags%5Byes%5D%5B%5D=<?=$tag["tagName"]?>">
        <p class="tagName"><?=$tag["tagName"]?></p>
        <p class="tagDesc"><?=$tag["tagDesc"]?></p>

    <?php if (isset($_SESSION["user"])&&$_SESSION["user"]["privileges"]>1){?>
    
    <!-- editing might actually be worse than removing the tag entirely since it removes the original definition and replaces it with a new one... huh.
        <form action="">
            <input type="hidden" value="<?=$tag["tagId"]?>" name="editTagId">
            <label for="editTagDesc">tag description</label>
            <input id="editTagDesc" type="text" value="<?=$tag["tagDesc"]?>" name="editTagDesc">
            <input type="submit" value="edit tag description" name="editTagSub">
        </form>
-->
        <form action="" method="POST">
            <input type="hidden" value="<?=$tag["tagId"]?>" name="tagDelId">
            <input type="submit" value="delete tag" name="subDelTag">
        </form>
    <?php }//It's ugly, but the amount of lines is driving me nuts! ?>
    
</a>
<?php }?>
</div>