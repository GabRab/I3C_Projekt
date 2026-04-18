<?php
//18.04.2026 I changed pictures.php into index.php because its useless otherwise, I also included init.php in header.phtml because it would've just been useless like that too...
//I might add posts to this too, but that would be more work. I really am making r34 aren't I?
//sooo... basic restructuring due to elementary mistakes and a few untested functions... yay. I still have to reach the object quota of 3 though... I want to cry.
require "header.phtml";


if (isset($_POST["addPic"])){
    addImage($db, $_POST["text"], $_FILES["imgFile"]);//tohle mi trvalo asi 2 hodiny rozpracovat... chyba byla ze misto $_FILES jsem mel $_FILE... chce se mi brecet 
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

$pictures = listImages($db);

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