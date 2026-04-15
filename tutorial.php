<?php
//this is a tutorial of sorts
//functions, ways to do stuff, etc. extracted from the something project in order to get
// learning material

//both for the same thing, but 'require' makes inclusion necessary
require "tutorial.php";
include "tutorial.php";

//start new session to get $_SESSION working
session_start();
//connect to db using account, password and specific part of db? Also set charset.
$db = mysqli_connect("localhost", "root", "", "something");
mysqli_set_charset($db, "utf8mb4");

//isset is for checking if values aren't null, $_SESSION is for keeping clients login
//even when traversing other pages on a site.
if (isset($_SESSION["user"])){
}
//GET is similar to POST, but it is used to get stuff from the server
//the request can be observed in the url
if (isset($_GET["user"])){
}


array_push();
foreach($something as $some);

explode();//explode a string into an array based on dividers
strpos();//find index of string in string
substr();//return part of string after given index
array_search();//search for specific things in an array from left
implode();//implode an array into a string

//execute a fetch query into db
$stuff = mysqli_fetch_all(mysqli_query($db, "SELECT * FROM tags"), MYSQLI_ASSOC);
//it only works for SELECT I think
$thingtagStmt = mysqli_query($db, "
        SELECT thingtags.thingId, GROUP_CONCAT(DISTINCT thingtags.tagId ORDER BY thingtags.tagId ASC) AS thingTags
        FROM thingtags
        WHERE userId IS NULL
        GROUP BY thingtags.thingId
        ");
        //make sure to use mysqli_query() to AVOID SQL INJECTIONS.
        $things=[];
        $Jeremy =mysqli_fetch_all($thingtagStmt, MYSQLI_ASSOC);

?>