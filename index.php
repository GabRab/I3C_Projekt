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
//-fix the mess that is header.phtml (mostly just css, but still pretty bad)
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

//01.05.2026
//Today I tried to fix the tag js... it didn't work. WHY DOESN'T IT WORK???? I GOT STUCK AT GETTING THE tagName SO I COULDN'T EVEN GET TO THE CONFUSING STUFF!!
//I've been stuck on this for another buncha hours. I dunno why it doesn't work. I did download jquery-4.0.0.js because I was tired of the lag it caused when I just didn't have it locally
//I've also changed the tagName to unique because working with that would've been a nightmare. I know that some words have multiple definitions, but that is easily avoided by just making another tag.

//02.05.2026 I fixed the js from yesterday, the mistake I made was listening for stuff made at the documents creation, which doesn't work on dynamic elements.
//that's pretty much it, I've still got some stuff to work on but it's 22:15 already...

//03.05.2026 I fixed the adding of tags to images, both js and php... I still need to add css and the general feel of this thing because it doesn't actually feel good right now. (It's called the UX, the User eXperience.)
//I also added the part where tags don't get reset every time you search, that was more js fun... (irony)
//there was also a slight issue with the php, that took me another 1/2 hour to fix, ended up just being a typo in a variable name... I'm stupid.
//there still is an issue in listImages() with wrong numbers of variables I need to fix somehow.... Oh well.

//04.05.2026 I fixed listImages() so that it searches with tags. I also added editing tags on images, though the JS is still missing.

//07.05.2026 Did some light repairs in image.php, added some isset()s to clear up the error log and got stuck at the tag section of editImage again... it keeps sending binding errors and is very janky. it's 22:01 already ;-;

//08.05.2026 I fixed it, the tag editing on image.php ... I woke up at 11:30 and was done by 12:00 ... yay.
//although it's screaming at me about bind parameters not being passed by reference, I'm too tired to deal with that and I need to visit my grandma today as well... Maybe later.
//even the search function is throwing so many binding errors despite working. I want to cry.
//21:46 I added an '&' so that $stmt->bind() can work without the errors of values, though this is UNTESTED, so I guess I'll check if it actually works tomorrow, otherwise I will have to waste more time or just ignore it. 

//09.05.2026 I fixed $stmt->bind() so that it won't throw any binding errors with references and I don't need to do the ugly and repettetive array(&$val) so that it passes as a reference anymore, great.
//So, what do I still have to do? css, testing stuff, JS bits, privileges and admin stuffs, tag editing(for privileged users, like moderators to edit tags and create them...), statistics(likes, views), fix the horrifying mess that is header.phtml, rename header.php to something that makes sense, some other functions, easter eggs.

//10.05.2026 I also need to add stuff to profile.php, like editing, statistics related to the user, etc. Privileges are shown by the colour and text-decorations of the username, though that might make moderators and other people targets of attacks.
//I guess I'm just gonna make it so that there's only two colors for the different privileges, gray for those without emails and black/green or whatever for everyone else.
//The privileges are as follows: unsigned(gets to view the images and search), signed in(commenting and adding images), with email(can create tags), moderators(can delete tags, edit them and delete images, maybe even lower the privileges of a user), admins(can delete users), owner(can do everything)
//I think I should add views, likes and dislikes today. views are easy, just add a column to images and increase it every time listImage() gets used (the one used in image.php)
//Likes and dislikes on the other hand aren't so simple, they need to be connected both to the image and the user, also a list of favourited things should be shown in the profile.php along with the statistics of the users own images.
//this means that likes and dislikes need their own table, which is much more trouble again. I could add 2 tables with 2 FKs and an ID, or I could add 1 table with 2FKs, an ID and a control value that determines if its a like or a dislike.
//QUESTION: do I make css files for each page? Idk, having it all in header.css might sound bad but at least you don't have to go to a different page every time. Just do it similar to functions.php I guess.
//QUESTION: why don't I just use the same Stmt object i did everywhere? Why make a new one each function? Idk lol.
//So, today I've done: 
// a bit of restructuring(renaming header.php to functions.php and putting it into back/, and making header.css to make header.phtml less scary) 
// a bit of sql correction(adding ON CASCADE to stuff) 
// fixed $stmt->bind() AGAIN, because for SOME REASON I DIDN'T JUST USE AN IF STATEMENT (it works now, I tested it) 
// fixed a bunch of stuff that broke due to previous changes(changeImage() is fixed)
// profile.php : editing the image, username, email
//               amount of times an image was displayed in image.php which is displayed under images, needs css to look good though.
//I'm tired, cuz its 20:32 and I've been doing this pretty much the whole day. I dunno what's tomorrow so I gotta have at least a bit of prep time.

include "block/header.phtml";


if (isset($_POST["addPic"])){
    addImage($db, $_POST["text"], $_FILES["imgFile"]);//tohle mi trvalo asi 2 hodiny rozpracovat... chyba byla ze misto $_FILES jsem mel $_FILE... chce se mi brecet 
    joinAllTags($db, $_POST["tags"]["join"]);
}
?>
<style>
    .tagNo{
        background:red;
    }
    .tagYes{
        background:green;
    }
</style>
<form method="GET" action='#'>
    <input type="text" name="search" id="search" value='<?=(isset($_GET["search"]))?$_GET["search"]:null?>'>
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
            <p class="tagName"><?=$tag["tagName"]?></p>
            <p class="tagDesc"><?=$tag["tagDesc"]?></p>
        </a>
        <?php
        
        }
        ?>

    </div>
    <input type="submit" value="search">
<!--I also need to display tags here...-->
<a href="#" id="test">
    test
</a>
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
<form method="post" enctype="multipart/form-data" action="#">
    <input type="text" name="text" id="text">
    <input type="file" name="imgFile" id="imgFile">
    <input type="submit" name="addPic" id="addPic">
    <!-- What I need here: display a list of tags you can assign and add them to this div, similar to the tag search but for creating a picture. I can use -->
    <div id="tagJoinList">
    <?php
        foreach(listTags($db) as $tag){//apologies, I don't think Imma be able to just make tags when you type them in because that's too much work. You have the title for that too, so whatever.
            ?>
            <div class="tagJoin">
                <a href="#" class="tagName"><?=$tag["tagName"]?></a>
                <a href="#" class="tagDesc"><?=$tag["tagDesc"]?></a>
            </div>
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
//search results
//miluju necitelne ternarni operatory (tohle tu nemusi byt, ale hazi mi to chyby kvuli nenalezenym hodnotam)
$images = (!isset($_GET["search"]))?listImages($db):((isset($_GET["tags"]))?listImages($db, $_GET["search"], $_GET["tags"]):listImages($db, $_GET["search"]));


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