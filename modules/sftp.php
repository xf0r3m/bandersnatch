<?php

    $id = $_GET['id'];
    $action = $_GET['action'];
    $path = $_GET['path'];
    if ( ! empty($_GET['lpath']) ) { $lpath = $_GET['lpath']; }
    if ( ! empty($_GET['rpath']) ) { $rpath = $_GET['rpath']; }

    $tName = 'servers';
    $csh = 'addr,uname,auth,pass';
    $whereValue = 'id=' . $id;

    $result = selectf($connection, $tName, $csh, $whereValue);
    if ( mysql_check_result($connection, $result) ) {
        if ( mysqli_num_rows($result) > 0 ) {
            $row = mysqli_fetch_row($result);

            $addr = $row[0];
            $uname = $row[1];
            $auth = $row[2];

            if ( $auth === 'pass' ) { $cipherPass = base64_decode($row[3]); }
        } else {

            echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
            <strong>Nie odnaleziono</strong> serwera.
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>";

        }
    }

    if ( $auth === 'pass' ) {

        if ( session_status() !== 2 ) { session_start(); }

        if ( ( ! empty($_SESSION['secret']) ) || ( ! empty($_POST['secret']) ) ) {

            if ( (empty($_SESSION['secret'])) && ( ! empty($_POST['secret']) ) ) {
                    $_SESSION['secret'] = $_POST['secret'];
                    $plainPassword = decryptRSAPassword($connection, $cipherPass, $_POST['secret']);

            } else if ( ! empty($_SESSION['secret']) ) {
                    $plainPassword = decryptRSAPassword($connection, $cipherPass, $_SESSION['secret']);
            }

            include('Net/SFTP.php');

            $key = new Crypt_RSA();
        
            $sftp = new Net_SFTP($addr);
            if ( ! $sftp->login($uname, $plainPassword) ) {
                if ( ! empty($_SESSION['secret']) ) { unset($_SESSION['secret']); }
                header("Location: index.php?page=" . $_GET['page'] . "&id=" . $id . "&action=" . $action . "&path=" . $path . "&loginerror=1");
            }

            if ( $action === 'get' ) {
                $sftp->get($path, 'files/' . basename($path));
            } else {
               $sftp->put($rpath . '/' . basename($lpath), $lpath, NET_SFTP_LOCAL_FILE);
            }

            header("Location: index.php?page=rfiles&id=" . $id);

        } else {

            if ( ! empty($_GET['loginerror']) ) {

                echo "<p>&nbsp;</p>";

                echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                Logowanie do serwera <strong>nie powiodło</strong> się.
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>";

            }

            echo "<form action=\"index.php?page=" . $_GET['page'] . "&id=" . $id . "&action=" . $action . "&path=" . $path . "\" method=\"post\">";
            echo "<div class=\"form-group\">
                <label for=\"secretPassword\">Hasło klucza bezpieczeństwa:</label>";
            echo "<div class=\"input-group\">
                        <input id=\"secretPassword\" class=\"form-control\" type=\"password\" name=\"secret\" placeholder=\"Hasło\" aria-describedby=\"secretPasswordHelp\" data-toggle=\"password\" required />
                        <div class=\"input-group-append\">
                            <span class=\"input-group-text\">
                                <i class=\"far fa-eye\"></i>
                            </span>
                        </div>
                </div>
                <small id=\"secretPasswordHelp\" class=\"form-text text-muted\">W powyższe pole wpisz hasło klucz bezpieczeństwa haseł.</small>
            </div>
                <button type=\"submit\" class=\"btn btn-success\">Wyślij</button>
            </form>";

        }


    } else {

        $tName = 'rsa_keys';
        $csh = 'id,priv_key';
        $whereValue = '1=1 ORDER BY id DEST LIMIT 1';

        $result = selectf($connection, $tName, $csh, $whereValue);
        if ( mysql_check_result($connection, $result) ) {
            if ( mysqli_num_rows($result) > 0 ) {
                $row = mysqli_fetch_row($result);
                $privKey = $row[1];
            } else {
                
                echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                    <strong>Nie odnaleziono</strong> klucza.
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                    </button>
                </div>";
            }
        } 

        include('Crypt/RSA.php');
        include('Net/SFTP.php');

        $key = new Crypt_RSA();
        $key->loadkey($privKey);

        $sftp = new Net_SFTP($addr);
        if ( ! $sftp->login($uname, $key) ) {

                echo "<p>&nbsp;</p>";

                echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                Logowanie do serwera <strong>nie powiodło</strong> się.
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>";

        }

        if ( $action === 'get' ) {
            $sftp->get($path, 'files/' . basename($path));
        } else {
            $sftp->put($rpath . '/' . basename($lpath), $lpath, NET_SFTP_LOCAL_FILE);
        }

        header("Location: index.php?page=rfiles&id=" . $id);

    }

?>