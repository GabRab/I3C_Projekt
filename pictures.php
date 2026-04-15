<?php
require "index.php";


if (isset($_POST["addPic"])){
    addPicture($db, $_POST["text"], $_FILES["imgFile"]);//tohle mi trvalo asi 2 hodiny rozpracovat... chyba byla ze misto $_FILES jsem mel $_FILE... chce se mi brecet 
}
if (isset($_SESSION["user"])){
        ?>
<form method="post" enctype="multipart/form-data" action="">
    <input type="text" name="text" id="text">
    <input type="file" name="imgFile" id="imgFile">
    <input type="submit" name="addPic" id="addPic">
</form>
<?php
}

$pictures = listPictures($db);

if (is_array($pictures)){
    foreach($pictures as $picture){
        ?>
<div>
    <?php var_dump($picture);?>
    <img src="<?=$picture["file"]?>" alt="">
</div>




<?php


}
};
?>

<h1>
    hell (if this is displayed, it means everything before it didn't make this crash)
</h1>