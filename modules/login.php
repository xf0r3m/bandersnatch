<?php
    if ( ! empty($_POST) ) {

        $tName = 'users';
        $csh = 'hash';
        $whereValue = "uname='" . mysqli_real_escape_string($connection, $_POST['login_uname']) . "'";

        $result = selectf($connection, $tName, $csh, $whereValue);
        if ( mysql_check_result($connection, $result) ) {
            if ( mysqli_num_rows($result) > 0 ) {

                $row = mysqli_fetch_row($result);

                if ( password_verify($_POST['login_passwd'], $row[0]) ) {
                    if ( session_status() !== 2 ) { session_start(); }
                    $_SESSION['username'] = $_POST['login_uname'];
                    header("Location: index.php?page=start&login=1");
                } else {
                    echo "<div class=\"alert alert-danger\" role=\"alert\">
                    Logowanie <strong>nie powiodło</strong> się. Sprawdź nazwę użytkownika oraz hasło.
                  </div>";
                }

            } else {
                echo "<div class=\"alert alert-danger\" role=\"alert\">
                Logowanie <strong>nie powiodło</strong> się. Sprawdź nazwę użytkownika oraz hasło.
              </div>";
            }
        }

    }
        include('forms/login.php');
?>