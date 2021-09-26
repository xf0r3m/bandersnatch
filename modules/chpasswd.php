<?php

if ( ! empty($_POST) ) {

    $tName = 'users';
    $csh = 'hash';
    
    if ( session_status() !== 2 ) { session_start(); }
    $whereValue = "uname='" . $_SESSION['username'] . "'";

    $result = selectf($connection, $tName, $csh, $whereValue);
    if ( mysql_check_result($connection, $result) ) {
        if ( mysqli_num_rows($result) > 0 ) {
            $row = mysqli_fetch_row($result);
            $passwordHash = $row[0];
            if ( password_verify($_POST['current_passwd'], $passwordHash) ) {

                $tName = 'users';
                $csh = 'hash';
                $whereValue = "uname='" . $_SESSION['username'] . "'";
                $pKL = generatePKL($tName, $csh);

                $_POST['users_hash'] = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

                $result = updatef($connection, $tName, $csh, $pKL, $whereValue);
                if ( mysql_check_result($connection, $result) ) {
                    echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                    <strong>Pomyślnie</strong> zmieniono hasło.
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                    </button>
                </div>";
                }


            } else {
                echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                Podane obecne hasło jest <strong>niepoprawne</strong>.
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>";
            }

        } else {
            echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
            <strong>Nie odnaleziono</strong> użytkownika.
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>";
        }
    }


} 

include('forms/chpasswd.php');

?>