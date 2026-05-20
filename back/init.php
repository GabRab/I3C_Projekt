<?php
    //get the database object from server
    session_start();
    $db = mysqli_connect("localhost", "root", "", "projkov");
    if ($db===false){
        echo "<div class='err'>Pripojeni k databazi selhalo</div>";
        exit;
    }
    mysqli_set_charset($db, "utf8mb4")

    //I wonder... do I actually need this here? Probably better than changing it I guess.
?>