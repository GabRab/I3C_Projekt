<?php
//this page is meant for searching for users, after which you click on a specific user to see all their work and statistics
//this is due to me not wanting to incorporate user tags into this, instead opting for simpler userId searching.
require "block/header.phtml";

if (isset($_GET["search"])) $users = listUsers($db, $_GET["search"]);
else $users = listUsers($db);//sadly need to have this here because null still counts as a value
?>
<form method="GET">
    <input type="text" name="search" id="search">
    <input type="submit">
</form>

<?php



foreach($users as $user){
var_dump($user);//add css to make look good I guess?
?>
<div></div>
<?php
}


?>