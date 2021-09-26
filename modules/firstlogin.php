<?php

if ( ! empty($_POST) ) {
    $tName = 'users';
    $csh = 'uname,hash,role';
    $pKL = generatePKL($tName, $csh);

    $_POST['users_hash'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $result = insertf($connection, $tName, $csh, $pKL);

    if ( mysql_check_result($connection, $result) ) {
        header("Location: index.php?page=start&login=1");
    }

} else {

    echo "<p>&nbsp;</p>
    <p class=\"sectionLabel\">Pierwsza rejestracja</p>
    <hr class=\"horizonLine\" />";

    include('forms/firstlogin.php');
}

?>