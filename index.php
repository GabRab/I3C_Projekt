<?php
include "block/header.phtml";

if (isset($_POST["editImage"]["del"])) delImage($db, $_POST["editImage"]["imgId"], $_POST["editImage"]["prevImage"]);
if (isset($_POST["addImgSub"])){
    addImage($db, $_POST["addImgText"], $_FILES["addImgFile"]);//tohle mi trvalo asi 2 hodiny rozpracovat... chyba byla ze misto $_FILES jsem mel $_FILE... chce se mi brecet 
    joinAllTags($db, (isset($_POST["tags"]["join"])?$_POST["tags"]["join"]:null));
}
//var_dump($_SESSION);
?>

<form method="GET" action='#' id="searchForm">
    <input placeholder="search for titles here" type="text" name="search" id="search" value='<?=(isset($_GET["search"]))?$_GET["search"]:null?>'>
    <input id="searchSubmit" type="submit" value="search">
    <div id="tagInput">
<?php
    if (isset($_GET["tags"])){
        if (isset($_GET["tags"]["yes"]))foreach($_GET["tags"]["yes"] as $tagy){
            ?>
            <input class='tagButton tagYes' value='<?=$tagy?>' name='tags[yes][]'></input>
            <?php
        }
        if (isset($_GET["tags"]["no"]))foreach($_GET["tags"]["no"] as $tagn){
            ?>
            <input class='tagButton tagNo' value='<?=$tagn?>' name='tags[no][]'></input>
            <?php
        }
    }
?>

    </div>
    <!--<input type="hidden" name="tagInput" id="tagInput" value="">-->
    <div id="tagLister"><!-- this one just holds the listed tags-->
        <?php
        foreach(listTags($db) as $tag){
        ?>
        <a href="#" class="tag">
            <div class="tagName"><?=$tag["tagName"]?></div>
            <div class="tagDesc"><?=$tag["tagDesc"]?></div>
        </a>
        <?php
        
        }
        ?>

    </div>
    
<!--I also need to display tags here...-->
</form>
<script>
    //if you click on a tag button, it gets added to the 'tags' input and added to a div of selected tags
    //if you click on a tag button while it is in the 'tags' input, it gets added as a NOT (doesn't have that specific tag) though I don't really know how to exactly do that... I would probably have to make a dynamic sql statement ;-; (Its just one if statement tho...) I already have to make a dynamic sql statement anyways.
    //add newly added tags as selected tags into another div as buttons that disappear and remove the tag from tagInput when you click on them
    $(document).ready(function( ){//PROBLEM!!!: THIS DOESN'T WORK EVEN IN THEORY, I NEED THE tagId, WHICH JUST ISN'T USED HERE. THIS MEANS THAT I NEED TO REWORK THIS WHOLE THING (prefferably with it using arrays)
    //So... a pretty simple fix, where I extend it a bit and use all the children to create a new input element whose value is the Id, the name is displayed there somehow and the description is a tooltip...
    //but with inputs the value is the text? I DON'T CARE, just make it a label and have the input be hidden or whatever... doesn't have to be an input, can be just a <p> or something... put it in a div so its atleast manageable
    //all this is for tomorrow (yay) I'm too tired today and I've been here for 4 hours because I made the mistake of trying to alter a table instead of just recreating it. 28.04.2026
    //01.05.2026 WHY DOESN'T $(this) WORK?????
        
        $("#tagLister .tag").click(function(){
            let tag = $(this).children(".tagName").text();//get the name of the tag (there shouldn't be any duplicates with how I've built this so far, so it can get used as an ID as well :D)
            console.log($(this).children(".tagName"));
            let tagI = $("#tagInput").children("input[value='"+tag+"']");
            console.log(tagI);
            if (tagI.length!==0){
                //this straight up searches for the input with a specific value, so Imma use it instead of the costly foreach
                if (tagI.attr("name")==="tags[yes][]") {
                    tagI.addClass("tagNo");
                    tagI.removeClass("tagYes");
                    tagI.attr("name", "tags[no][]");
                    console.log("tagInput changed to no");
                }
                else {
                    tagI.addClass("tagYes");
                    tagI.removeClass("tagNo");
                    tagI.attr("name", "tags[yes][]")
                    console.log("tagInput changed to yes");
                }
            }
            else{
                console.log("added to tagInput");
                $("#tagInput").append("<input class='tagButton tagYes' value='"+tag+"' name='tags[yes][]'></input>");
            }
        })
    })
    $(document).on("click", ".tagButton", function(){//I have no idea why this doesn't even register with the input, I'm tired and its 23:41 right now (1.5.2026)
        console.log("HLP");
        $(this).remove();//just removing it is fine
    })
</script>
<?php

if (isset($_SESSION["user"])){//form for adding images (should make a different page entirely to make adding images good)
        ?>
<form id="addImgForm" method="post" enctype="multipart/form-data" action="#">
    <div id="addImgInputs">
        <input type="text" name="addImgText" id="addImgText" placeholder="image title here">
        <input type="file" name="addImgFile" id="addImgFile">
        <input type="submit" name="addImgSub" id="addImgSub">
    </div>
    <!-- What I need here: display a list of tags you can assign and add them to this div, similar to the tag search but for creating a picture. I can use -->
    <div id="tagJoinList">
    <?php
        foreach(listTags($db) as $tag){//apologies, I don't think Imma be able to just make tags when you type them in because that's too much work. You have the title for that too, so whatever.
            ?>
            <a class="tagJoin">
                <div href="#" class="tagName"><?=$tag["tagName"]?></div>
                <div href="#" class="tagDesc"><?=$tag["tagDesc"]?></div>
            </a>
            <?php    
        }
            ?>
    </div>
</form>
<script>
    //I originally had an input be here all the time and only change the name of the input, but after a few seconds of consideration I decided that this slows it down very much since you still send the inputs even if they don't have a name
    $(document).on("click", "#tagJoinList .tagJoin", function(){
            let tag = $(this).children(".tagName").text();
            console.log($(this).children(".tagJoinVal"))
            if($(this).children(".tagJoinVal").length!==0){
                console.log("unjoining tag "+tag);
                $(this).children(".tagJoinVal").remove();
            }
            else {
                $(this).append("<input class='tagJoinVal tagYes' value='"+tag+"' name='tags[join][]'></input>");
                console.log("joining tag "+tag);
            }
    })
</script>
<?php
}

?>
<div id="listedImages">
<?php
//search results
//miluju necitelne ternarni operatory (tohle tu nemusi byt, ale hazi mi to chyby kvuli nenalezenym hodnotam)
$images = (!isset($_GET["search"]))?listImages($db):((isset($_GET["tags"]))?listImages($db, $_GET["search"], $_GET["tags"]):listImages($db, $_GET["search"]));
if (is_array($images)){
    foreach($images as $image){
        ?>
    <a href="image.php?imgId=<?= $image["imgId"]?>" class="imageObject"><!--IT WORKS!-->
        <img class="imageView" src="<?=$image["imgFile"]?>" alt="<?=$image["title"]?>">
    </a>
<?php
}
};
?>
</div>