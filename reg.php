<?php
include "back/init.php";
require "block/header.phtml";
  if (isset($_POST["submitReg"]) && $_POST["pass"] === $_POST["pass2"]){
    register($db, $_POST["name"], $_POST["pass"]);
    }

?>

<form id="regist" method="POST">
  <input name="name" id="nameReg" type="text" placeholder="username">
  <input name="pass" id="passReg" type="password" placeholder="password">
  <input name="pass2" id="passReg2" type="password" placeholder="password check">
  <!-- this can just be optional stuff to be added later for improved privileges
  <input name="tel" id="tel" type="tel" placeholder="telephone number">  
  <input name="email" id="email" type="email"  placeholder="email">
-->
  <input type="submit" name="submitReg"> 
</form>