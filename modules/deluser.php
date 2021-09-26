<?php

    $del_id = $_GET['user_id'];

    $tName = 'users';
    $whereValue = 'id=' . $del_id;

    $result = deletef($connection, $tName, $whereValue);
    if ( mysql_check_result($connection, $result) ) {
        header("Location: index.php?page=adduser&deluser=1");
    }

?>