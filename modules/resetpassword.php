<?php

if ( ! empty($_POST) ) {

    $tName = 'users';
    $csh = 'hash';
    $whereValue = 'id=' . $_GET['user_id'];
    $pKL = generatePKL($tName, $csh);

    $_POST['users_hash'] = password_hash($_POST['reset_password'], PASSWORD_DEFAULT);

    $result = updatef($connection, $tName, $csh, $pKL, $whereValue);
    if ( mysql_check_result($connection, $result) ) {

        echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
        <strong>Pomyślnie</strong> zresetowano hasło.
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
    </div>";

    }


}

$id = $_GET['user_id'];

$tName = 'users';
$csh = 'uname';
$whereValue = 'id=' . $id;

$result = selectf($connection, $tName, $csh, $whereValue);
if ( mysql_check_result($connection, $result) ) {
    if ( mysqli_num_rows($result) > 0 ) {

        $row = mysqli_fetch_row($result);

        echo "<p>&nbsp;</p>
        <div class=\"alert alert-primary\" role=\"alert\">
        Resetowanie hasła dla użytkownika: <strong>" . $row[0] . "</strong>.
    </div>";

        include('forms/resetpassword.php');

    }
}

?>