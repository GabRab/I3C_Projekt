<?php
//HELLO, this is a place where I migrated most of the logs from index.php and README.md because they were getting too annoying.
//This is kinda like an easter egg where it just doesn't even get used anywhere and even if you somehow manage to find it then nothing gets displayed for the user since its all comments.
//anyways, here's some logs of what I did when. I'm not sure how accurate they are, but the dates at least say which days I worked on this.

//1.4. večer jsem začal pracovat na tomhle projektu, zatím jenom bojování s css a trochu rozpracování classy do php

//2.4. celý den jsem pracoval na projektu do WEA, rozpracoval jsem přihlašování a přidal trochu css

//3.4. moc jsem toho neudělal, jenom další bojování s css, přihlašování je funkční ale měl jsem super nápad a hodil všechno na jednu stránku, takže budu muset bojovat s css a dalšími věcmi.

//4.4. další bojování s css, já prohrávám... trochu jsem popřeházel věci, ale budu se muset vrátit k css později. Taky jsem stihl udělat odhlášení.

//5.4. zase další bojování s css, někam se dostávám ale je to hrozně pomalé a radši bych aspoň udělal kostru dnež se vrátím k mučení s css (zas tak velký masochista nejsem). Celý den pracoju na fotkách uživatele, ale nikam to nejde protože to furt blbne divně. Rozhodl jsem se že budu dělat e-shop.

//06.04 
// I woke up and immediately started working, at least the backend. Css sometime later... Hopefully after I finally make it work.
//I added a bunch of php, everything after the user functions today. That means products, ratings and that's about it...

//13.04
//I'm back! I took a break because I was falling apart thinking too much about how it wasn't working so I focused on school and did some reading over the weekend so I didn't have time to do this sadly...
//Today I want to make this thing work, because the stuff I added last time is a mess and just straight up doesn't work.
//Ok, so instead of going through the depression that is dealing with products, I instead spent... 3 hours (maybe?) making pictures.php and adding stuff to it. It works as well and I improved some more stuff on header.php
//Why am I putting every function into header.php? I... dunno. I kinda don't want to stop despite it being a clearly good idea from the amount of lines its accumulating.

//15.04 -
//brought to git today. I'll see where I left off and try to continue. Please excuse the ramblings of previous dates... I'm tired despite not even doing much today.
//Last time I added pictures.php and made it all work, today I guess I'm going to expand on that a little bit.
//Zapomněl jsem že děláme fotogalerii, takže můžu zahodit většinu těch věcí co tam jsou. Zatím jenom v php naštěstí.
//Css bude dělat Martin, protože mi vůbec nejde.
//Spravil jsem funkce v php, takze uz funguje vsechno co tam zatim máme. (až na produkty ale to stejně zahodím)
//17.04 -
//added functions for adding images, getting specifically your images, editing and removing (untested)
//18.04 -
//I changed pictures.php into index.php because its useless otherwise, I also included init.php in header.phtml because it would've just been useless like that too...
//I might add posts to this too, but that would be more work. I really am making r34 aren't I?
//sooo... basic restructuring due to elementary mistakes and a few untested functions(also untested)... yay. I still have to reach the object quota of 3 though... I want to cry.
//19.04. -
//fixed some stuff I added last time, general fixes in html, functions, ...
//I expanded on some stuff and removed some stuff
//I also changed some stuff so that it is a bit more comprehensible (header.phtml is still a mess tho ;-;)

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

//16.05.2026 I took a break for school... not a good excuse but whatever
//added deletion button to images so that I can remove some of the useless testing images and hopefully decrease the amount of useless files I put on the repository. (it worked 1st try :D)
//failed to find out how to redirect after output
//tried the same thing with register(), but that didn't work either. Oh well. I remember having a lot of trouble with this before, so I'm scared I'll waste another few tens of hours on this instead of doing any progress.
//though it would be better if I could send the thing to index.php and then deal with it.
//so far my ideas are as follows:
//put an action attribute and send it to be processed in index.php, this could work, though I'm not sure about this.
//IT WORKED
//I also did the same for register, though I'm gonna move both into header.phtml due to the need to update before listing something
//so what's left? css, privilege implementation, checking everything actually works, placeholder items(just putting in data for the tags and images so its not just an empty page)

//17.05.2026 Small changes and fixes I find while testing.
//now I just gotta do the stuff mentioned yesterday and fix the mess that is header.phtml
//problem: when you edit an image it uses a post so if you edit an image you can't go back without form resubmissions. This is bad.
//with each new post it goes to a new page, which means that you can't really go back. I could make it go back to index.php but that's inconvenient and just making it go back on itself just does nothing, so idk.
//I also need to get to header.phtml and make the user thing redirect to your own page.
//problem: when you search for everything without tags(tagNo) the search works but you don't get their ids so the redirect to image.php doesn't.

//19.05.2026 the second problem found on 17.05.2026(no imgId on tagNo search) was due to using * durin a joined select, causing the assoc array to have multiple things reffered to as "imgId". Fixed by just using i.* instead. A beginner mistake.
//I still haven't come up with a solution for the first problem found on 17.05.2026 though. I wish there was one though.
//I can't think of any, since during the submission of a form you always turn the page into something that sends data and go to the one mentioned in action. You can't just do it without that submission page, nor can you really remove it... can you?
//What if I just... do a js script that sends you back 2 pages after you edit. That could theoretically work. BUT it would cause there to just be random "oh you can go forward here for some reason" which is BAD.
//Best I can do is just send the user somewhere else afterwards to mask the fact that you even changed pages. So it would be something like: 
// form_send->page turns to submission page and sends you to action="" -> window.history.back(2) sends you to index? (I'll figure it out later I guess?) -> gets sent to image again.
//Okay, so its history.go(-2) and it sends me to index.php, but I need to somehow also get back to image.php with the correct id without having to click on it again.
//I could have a form, but there is no way to actually do that since forms just send you somewhere again...
//OR I could do some trickery, where I send the user to ANOTHER page when he edits the image.
//something like image.php -> edit.php -> action="" -> history.go(-2) which COULD work BUT STILL THERE'S THAT FORWARD. (so, just something similar to a register page? How can one be this stupid.)
//I guess I'll just ignore this issue for now :(

//20.05.2026 I feel the progress has been quite lacking the past couple of days, so today I'm gonna actually do something
//What's on the agenda today?
//-privilege implementation (just a bunch of if statements) - DONE I think? The only 
//-more testing durning that
//-adding more placeholder items during testing
//Current progress:
//-privilege implementation{user deletion, image deletion, tags deletion was already there. I could add a part where the image is retained but thats more of a social site thing...}
//-testing{fixing stuff, removing unnecessary images}
//-adding more placeholder items{I deleted them during testing :( }
//I do feel that all that remains is fixing header.phtml and fixing the css
//header.phtml works perfectly, it just looks bad.
//oh, and fixing the html everywhere as well I guess... But imma leave that for tomorrow :) Hurray to procrastination!

//21.05.2026 I don't feel like it but oh well, I guess Imma just try and make this work then.
//I'm scared boss.
//steps: 1. change names of ids to make css manageable to understand; 2.make css work; 3.pray(optional); 4.sacrifice a part of yourself to the mad god (not optional D:

//23.05.2026 messing with css, this is pain
//24.05.2026 more css :(, also a few minor changes to prevent unnecessary error messages.
//25.05.2026 added more css to tags.php, fixed up some on index.php and users.php, but there's still a bunch of work to do. Also changed up profile.php a bit, still not done but its 22:35 again... still not done :(
//26.05.2026 More adjusting of css... almost looks usable, yet there still is work to be done. Mainly just the frontend though.
//27.06.2026 Making image.php more presentable, more little css changes, I hate css so much.  Also added some php objects to make tags a bit better.
//What's next? Dividing images into pages could be done, but thats kinda unnecessary. Make pretty, no, pls no more css. Fix header.php, It's not broken, just feels ugly. 
//fixed header.php, though there's some jquery stuff that I'm not touching.

//30.05.2026 I have bad premonitions about this. At the very least I want a 2 for all my hard work, even though I put so much work into this yet did so little because of my own inadquacy.
//I fixed some css, checked that everything works and will make the document because I have serious worries that something will happen.
//My groupmates still didn't respond to my message. All they did was ask if I had started working on it a couple of months ago, that's it. Nothing more.
?>