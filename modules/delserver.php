<?php

$del_id = $_GET['del_id'];

$tName = 'servers';
$whereValue = 'id=' . $del_id;

$result = deletef($connection, $tName, $whereValue);

if ( mysql_check_result($connection, $result) ) {
    header("Location: index.php?page=addservers&delserver=1");
}

?>