<?php

    $db_host = "localhost";
    $db_user = "bsnatch";
    $db_pass = "bsnatch1234";
    $db = "bandersnatch";

    $connection = mysqli_connect($db_host, $db_user, $db_pass, $db);

    if ( ! $connection ) {
        echo "Błąd: " . mysqli_connect_error() . "<br />";
        exit;
    }

?>