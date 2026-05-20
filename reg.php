<?php
require "block/header.phtml";
?>
<form id="regist" method="POST" action="index.php">
  <input name="name" id="nameReg" type="text" placeholder="username">
  <input name="pass" id="passReg" type="password" placeholder="password">
  <input name="pass2" id="passReg2" type="password" placeholder="password check">
  <!-- this can just be optional stuff to be added later for improved privileges
  <input name="tel" id="tel" type="tel" placeholder="telephone number">  
  <input name="email" id="email" type="email"  placeholder="email">
-->
  <input type="submit" name="submitReg"> 
</form>