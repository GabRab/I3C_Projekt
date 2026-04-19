<?php
//this page is used for displaying the selected image in detail (its tags, author, hopefully comments and statistics as well)
require "block/header.phtml";
$image = listImage($db, $_GET["imgId"]);
//how do I get the image details though? Good question... idk.
//when clicking on image, get redirected to image.php?imgId="?" that's where.
//wait, is it possible to do ajax like this? That would be AWESOME. 

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