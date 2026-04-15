<?php
require "block/header.phtml";

?>
<div>
    HELLOO?
</div>
<form method="get">
    <input type="text">
    <input type="text">
    <input type="text">
</form>
<?php

//DOESN'T WORK???
//$products = listProducts($db, $_GET["search"], $_GET["tag"], $_GET["pageNumber"], $_GET["oneTime"], $_GET["priceRangeTop"], $_GET["priceRangeBottom"], $_GET["rating"]);
var_dump($_POST);

echo "stuff";
?>
<div>
    HELOO?
</div>
<form method="get">
    <input type="text">
    <input type="text">
    <input type="text">
</form>
<?php
foreach($products as $product){
    var_dump($product);
}

?>
