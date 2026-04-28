<?php
//18.04.2026 I changed images.php into index.php because its useless otherwise, I also included init.php in header.phtml because it would've just been useless like that too...
//I might add posts to this too, but that would be more work. I really am making r34 aren't I?
//sooo... basic restructuring due to elementary mistakes and a few untested functions... yay. I still have to reach the class quota of 3 though... I want to cry.

//25.04.2026
//it would be pretty cool if I could make galleries, or images connected together not just by users...
//right now I need to do the rest first ;-;
//what will I do today? I don't know... let's start with just adding stuff that uses the arrays we got (in html like <p><?=stuff></p> ya know?) 
//anyways, I've added a bit to image.php so that it actually shows something, though I still need to add JS there. users.php also has displaying info and has hrefs to profile.php but that one is still empty.
//I want to add comments, maybe even galleries(groups of pictures) so that some pictures can be related in adifferent way than just users, but that's just too much work.
//galleries could also work as group projects depending on who you invite or add, but that's like 2, maybe 3 more tables... (galleries, gallery connections, gallery people)
//What I've done so far: image.php bits, users.php stuff, profile.php stuff, that's about it I guess.
//what I need to do:
//-tag search implementation (+ actually adding tags to use because they're an empty table right now)
//-css to everything (I'm scared)
//-fix the mess that is header.php (mostly just css, but still pretty bad)
//-js to stuff for more UI features.
//- I wonder when my classmates are going to help me, I did message them only a few times but still they've done nothing. I shouldn't complain because my struggles are due to my own incompetence though.
//- comments, this is a hard one because I kinda want to make cascading comments where people continuously reply to eachother on different threads, kinda like reddit, but I'm stuck between doing it or just not wasting my time with useless stuff I'm gonna throw away anyways.

//26.04.2026
//I added some small changes to profile.php to display more information and you can click on images now to get to their pages
//I still need to make comments too... though that would require me doing a table that references on itself (a recursive I think?). Comments would reference eachother as a way of replying to eachother but implementing that would be a nightmare, so I guess I will go with just simple comments for now.
//I havent' even begun work on implementing the tags... It's just a js that adds it to a hidden form but still...
//Today I've added tag functionality when searching (only the js and php, no css or actual tags added to the database yet.) to index.php
//I also started work on comments, you can see them under images, create new ones and delete them
//I also fixed a bunch of stuff, mainly changeImage which had been bugged out for a while.
include "block/header.phtml";


if (isset($_POST["addPic"])){
    addImage($db, $_POST["text"], $_FILES["imgFile"]);//tohle mi trvalo asi 2 hodiny rozpracovat... chyba byla ze misto $_FILES jsem mel $_FILE... chce se mi brecet 
}
?>
<form method="GET">
    <input type="text" name="search" id="search">
    <input type="submit" value="search">
    <div id="tagInput"></div>
    <!--<input type="hidden" name="tagInput" id="tagInput" value="">-->
    <div id="tagLister"><!-- this one just holds the listed tags-->
        <?php
        foreach(listTags($db) as $tag){
        ?>
        <div class="tag">
            <p class="tagName"><?=$tag["tagName"]?></p>
            <p class="tagDesc"><?=$tag["tagDesc"]?></p>
        </div>
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
    $(document).ready(function(){
        $("#tagLister .tag").click(()=>{
            let tag = $(this).children[0].text();//get the name of the tag (there shouldn't be any duplicates with how I've built this so far, so it can get used as an ID as well :D)
            let isThere=false;//checks if the tag is already selected
            $("#tagInput").children().foreach((tagI, index)=>{
                if (tagI.val()===tag){// if input with tag value is there, then change value of isThere and change name and css according to that
                    isThere = true;
                    if (tagI.getAttribute("name")==="tags[yes]") {
                        tagI.classList.add("tagNo");//css stuff, though I could use toggle... nah this is fine
                        tagI.classList.remove("tagYes");//I could just do a .toggle here, but I still need the if else for attributing the name
                        tagI.attr("name", "tags[no]")
                    }
                    else {
                        tagI.classList.add("tagYes");
                        tagI.classList.remove("tagNo");
                        tagI.attr("name", "tags[yes]")
                    }
                }
            });
            if (!isThere){
                let input =$("#tagInput").appendChild($("<input>");
                input.attr("name", "tags[yes]"));//add input element to tagInput with a name for array use
                input.classList.add("tagButton");//add for interactions and base css customization
                input.classList("tagYes");//change class for css
                input.val()=tag;//add value
            }
        });
        $(".tagButton").click(()=>{//if click on button, then remove it from tagInput and this
            $(this).remove();//just removing it is fine
        })//now that I've changed it from working with a single text input to just adding input elements, it seems to be much easier to work with      
    })
</script>
<?php

if (isset($_SESSION["user"])){//form for adding images (should make a different page entirely to make adding images good)
        ?>
<form method="post" enctype="multipart/form-data" action="">
    <input type="text" name="text" id="text">
    <input type="file" name="imgFile" id="imgFile">
    <input type="submit" name="addPic" id="addPic">
    <!-- What I need here: display a list of tags you can assign and add them to this div, similar to the tag search but for creating a picture. I can use -->
    <div id="tagJoinList">
    <?php
        foreach(listTags($db) as $tag){//apologies, I don't think Imma be able to just make tags when you type them in because that's too much work. You have the title for that too, so whatever.
            ?>
            <div class="tagJoin">
                <p class="tagName"><?=$tag["tagName"]?></p>
                <p class="tagDesc"><?=$tag["tagDesc"]?></p>
            </div>
            <?php    
        }
            ?>
    </div>
</form>
<script>
    //if you click on a tag, it lights up and an input is generated into the appropriate array.
    $(document).ready(function(){
        $("#tagJoinList .tagJoin").click(()=>{
            let tag = $(this).children[0].text();
            if($(this).children[2]!==null){
                $(this).children[2].remove();
            }
            else{
                let input =$(this).appendChild($("<input>");
                input.attr("name", "tagsJoin[]"));//add input element to tagInput with a name for array use
                input.classList.add("tagButton");//add for interactions and base css customization
                input.classList("tagYes");//change class for css
                input.val()=tag;//add value
            }
        });
        $(".tagButton").click(()=>{//if click on button, then remove it from tagInput and this
            $(this).remove();//just removing it is fine
        })//now that I've changed it from working with a single text input to just adding input elements, it seems to be much easier to work with      
    })
</script>
<?php
}
//search results
if (isset($_GET["search"])) $images = listImages($db, $_GET["search"], $_GET["tags"]);
else $images = listImages($db);

if (is_array($images)){
    foreach($images as $image){
        ?>
    <a href="image.php?imgId=<?= $image["imgId"]?>" class="imageObject"><!--IT WORKS!-->
        <?php var_dump($image);?>
        <p><?=$image["title"]?></p>
        <img src="<?=$image["imgFile"]?>" alt="">
    </a>
<?php
}
};
?>