# I3C_Projekt
projekt do WEA
<div>
gab{
<ul>
1.4. - <li>večer jsem začal pracovat na tomhle projektu, zatím jenom bojování s css a trochu rozpracování classy do php</li>
</ul>
<ul>
2.4. - <li>celý den jsem pracoval na projektu do WEA, rozpracoval jsem přihlašování a přidal trochu css</li>
</ul>
<ul>   
3.4. - <li>moc jsem toho neudělal, jenom další bojování s css, přihlašování je funkční ale měl jsem super nápad a hodil všechno na jednu stránku, takže budu muset bojovat s css a dalšími věcmi.</li>
</ul>
<ul>
4.4. - <li>další bojování s css, já prohrávám... trochu jsem popřeházel věci, ale budu se muset vrátit k css později. Taky jsem stihl udělat odhlášení.</li>
</ul>
<ul>
5.4. - <li>zase další bojování s css, někam se dostávám ale je to hrozně pomalé a radši bych aspoň udělal kostru dnež se vrátím k mučení s css (zas tak velký masochista nejsem). Celý den pracoju na fotkách uživatele, ale nikam to nejde protože to furt blbne divně. Rozhodl jsem se že budu dělat e-shop.</li>
</ul>
<ul>
06.04 - <li>I woke up and immediately started working, at least the backend. Css sometime later... Hopefully after I finally make it work.</li>
        <li>I added a bunch of php, everything after the user functions today. That means products, ratings and that's about it...</li>
</ul>
<ul>
13.04 - <li>I'm back! I took a break because I was falling apart thinking too much about how it wasn't working so I focused on school and did some reading over the weekend so I didn't have time to do this sadly...</li>
        <li>Today I want to make this thing work, because the stuff I added last time is a mess and just straight up doesn't work.</li>
        <li>Ok, so instead of going through the depression that is dealing with products, I instead spent... 3 hours (maybe?) making pictures.php and adding stuff to it. It works as well and I improved some more stuff on header.php</li>
        <li>Why am I putting every function into header.php? I... dunno. I kinda don't want to stop despite it being a clearly good idea from the amount of lines its accumulating.</li>
</ul>
<ul>
15.04 - <li>brought to git today. I'll see where I left off and try to continue. Please excuse the ramblings of previous dates... I'm tired despite not even doing much today.</li>
        <li>Last time I added pictures.php and made it all work, today I guess I'm going to expand on that a little bit.</li>
        <li>Zapomněl jsem že děláme fotogalerii, takže můžu zahodit většinu těch věcí co tam jsou. Zatím jenom v php naštěstí.</li>
        <li>Css bude dělat Martin, protože mi vůbec nejde.</li>
        <li>Spravil jsem funkce v php, takze uz funguje vsechno co tam zatim máme. (až na produkty ale to stejně zahodím)</li>
</ul>
<ul>
17.04 - <li>added functions for adding images, getting specifically your images, editing and removing (untested)</li>
</ul>
<ul>
18.04 - <li>I changed pictures.php into index.php because its useless otherwise, I also included init.php in header.phtml because it would've just been useless like that too...</li>
        <li>I might add posts to this too, but that would be more work. I really am making r34 aren't I?</li>
        <li>sooo... basic restructuring due to elementary mistakes and a few untested functions(also untested)... yay. I still have to reach the object quota of 3 though... I want to cry.</li>
</ul>
<ul>
19.04. - <li>fixed some stuff I added last time, general fixes in html, functions, ...</li>
         <li>I expanded on some stuff and removed some stuff</li>
         <li>I also changed some stuff so that it is a bit more comprehensible (header.phtml is still a mess tho ;-;)</li>
</ul>
<ul>
25.04. - <li>sorry for a lack of updates, I've been too tired to do anything this week and didn't have time.</li>
         <li>anyways, I've added a bit to image.php, users.php and profile.php so that the info shows up in the html templates.</li>
         <li>I can't remember much after that</li>
         <li>my plans so far are: tag search implementation, css (I'm scared), fix header.phtml because its an ugly mess, I wonder when my classmates are going to help me, comments (cool if recursive, but I don't know how to do that)</li>
</ul>
<ul>
26.04. - <li>I added tag searching, comments(creation, listing based on images and deletion) that work, fixed changeImage which was broken for a while...</li>
         <li>I also expanded on some other stuff and learnt some nice stuff... PUT THE UPDATES BEFORE GETTING THE LISTINGS IN PHP (it's an issue that I solved today, which broke me last year)</li>
         <li>I wonder when my classmates are going to help me... One said he wants to help with css so I've been putting it off and the other... I dunno he didn't say anything, he just skipped the topic.</li>
</ul>
<ul>
28.04. - <li>I messed around a bit, fixed some stuff and now you can finally add tags. You might even be able to join them, though that's still not working as well as tag searching (js is a mess)</li>
        <li>tomorrow I will (hopefully) fix tag searching, fix tag joining... finish some more parts of this and maybe finally get back to css.</li>
</ul>
<p>everything after this point was added 10.05. because I didn't have time to send it every day, more info can be found in index.php where I initially make my notes before putting them here</p>
<ul>
01.05. - <li>tried to fix tag Js</li>
        <li>added jquery file due to delays from fetching it online</li>
        <li>changed sql so that tagName is unique because multiple definitions is a nightmare</li>
</ul>
<ul>
02.05. - <li>fixed JS from yesterday (it was due to being in$(document).ready())</li>
</ul>
<ul>
03.05. - <li>fixed adding tags to images, both js and php</li>
        <li>added part where tags reset using JS</li>
        <li>fixed a typo in php variable name which took me 1/2 hour</li>
        <li>there's still an issue with listImages(), but its too late right now</li>
</ul>
<ul>
04.05. - <li>fixed listImages(), it can now search with tags</li>
        <li>added editing tags on images (JS still missing though)</li>
</ul>
<ul>
07.05. - <li>light repairs in image.php</li>
        <li>added isset() conditions to prevent useless error messages about null values</li>
        <li>got stuck at editImage again... its 22:21 and keeps throwing binding errors along with general jank</li>
</ul>
<ul>
08.05. - <li>fixed tag editing on image.php (I woke up and did it immediately 11:30-12:00)</li>
        <li>went to visit my grandma, so I couldn't work on it much</li>
</ul>
<ul>
09.05. - <li>finally changed $stmt->bind() so that it doesn't look bad whenever I use it</li>
</ul>
<ul>
10.05. - <li>fixed yesterday's solution because it still kept throwing errors (it actually works now)</li>
        <li>a bit of restructuring (changed block/header.php to back/functions.php, created a standalone header.css to make header.phtml less scary)</li>
        <li>changed a bit of sql(just added ON CASCADE to comments and views counter to images)</li>
        <li>fixed a bunch of stuff that broke due to previous changes(mainly changeImage() because it kept referencing a variable whose name I changed)</li>
        <li>added editing to profile.php (image, username, mail)</li>
        <li>image views are shown in profile.php, plan on adding it later to image.php</li>
        <li>I also plan on adding likes/dislikes, though thats a whole table and a bunch of functions that I don't want to make because forms reset the page. I'll see if I have the time to mess around with this considering my biggest foe (css) is still present</li>
</ul>
<p>This is the end of stuff added at 10.05. Once again I implore you to check index.php for further explanations about stuff. It's 21:10 already again, so Imma go do something else now.</p>
<p>ALSO If you see empty images somewhere, that's not a bug, I'm just too tired to deal with that since downloading so many files is a hassle.</p>

<p> stuff added at 20.05.</p>
<ul>
16.05. - <li>added deletion button to images</li>
         <li>figured out how to properly utilise the action attribute and fixed an issue with it</li>
</ul>
<ul>
17.05. - <li>Small fixes and changes</li>
         <li>found problems during testing (editing an image causes the current page to turn into a submission page, meaning you can't really go back when you do that)(searching with tagNo gives no imgId)</li>
</ul>
<ul>
19.05. - <li>fixed the imgId problem, a rookie sql request mistake</li>
         <li>theorising about how to fix the other issue </li>
</ul>
<ul>
20.05. - <li>completing the privilege implementation</li>
         <li>testing and fixing stuff</li>
         <li>removing images leftover from when the files weren't deleted with deletion in the database</li>
</ul>
<p>end of stuff added at 20.05. I might make a dedicated file for these logs later because I simply don't like the look of README.md right now.</p>
}
</div>
