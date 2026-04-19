<?php
//this is the page created for the user themselves, where various statistics and customizations are in place as well as their creations.
require "block/header.phtml";

//plans for this page:
// get userId using a post from that gets sent when you click on yourself or on a user from users.php
// get list of statistics about a user (maybe privacy settings too? Later, right now I need this to work...)

if (isset($_POST["userId"])){
    $images = userImages($db, $_POST["userId"]);//get images of user
    $user = getUser($db, $_POST["userId"]);//get info of user
    var_dump($images);
    var_dump($user);
}
?>