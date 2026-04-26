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

//minor differences with privilege level (kinda like a blue checkmark, except you get it when you give email and maybe telephone number to make sure you're not a bot. People without such things are restricted on how much stuff they can do.)
foreach($users as $user){
    ?>
<a href="profile.php?userId=<?=$user["userId"]?>"><!--ADD CSS HERE TOO--><!--surely there's no problem with just doing this right? Like security wise.-->
    <p><?=$user["name"]?></p>
    <p><?=$user["userCreation"]?></p><!--date of user account creation-->
    <img src="<?=$user["userImage"]?>">
</a>
<?php
}


?>