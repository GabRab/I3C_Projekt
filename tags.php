<?php
//this page is for adding and editing tags
include "block/header.phtml";
if (isset($_POST["subAddTag"])){
    addTag($db, $_POST["tagName"], $_POST["tagDesc"]);
}
if (isset($_POST["subDelTag"])){//deleting tags could cause a whole array of problems...
    delTag($db, $_POST["tagDelId"]);//WHY DOESN'T ALTER TABLE tagConnections ADD CONSTRAINT foreing_tag FOREIGN KEY(tagId) REFERENCES tags(tagId) ON DELETE CASCADE WORK, THERE'S NOTHING WRONG!!!!
}//ALERT: IF A SQL REQUEST ON ALTER DOESN'T WORK, JUST DROP THE TABLE!!!


if (isset($_SESSION["user"])){
    if ($_SESSION["user"]["privileges"]>=1){//a user has to add an email to his account to change tags. This doesn't stop trolls, but it at least deters bots.
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

$tags = listTags($db);
foreach($tags as $tag){
    var_dump($tag);
    if ($_SESSION["user"]["privileges"]>=1){
    ?>
    <form action="" method="POST">
        <input type="hidden" value="<?=$tag["tagId"]?>" name="tagDelId">
        <input type="submit" value="delete tag" name="subDelTag">
    </form>
    <?php
    }
}

?>