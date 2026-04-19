<?php
//this page is for adding and editing tags
include "block/header.phtml";
$tags = listTags($db);


foreach($tags as $tag){
    var_dump($tag);
}

?>