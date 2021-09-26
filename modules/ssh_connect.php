<?php
    
    include('Net/SSH2.php');
    include('Crypt/RSA.php');

    $tName = 'rsa_keys';
    $csh = 'id,priv_key';
    $whereValue = '1=1 ORDER BY id DESC LIMIT 1';

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
        $_GET['loginerror'] = 1;
        }
    }

    $tName = 'servers';
    $csh = 'addr,uname,auth,pass';
    $whereValue = 'id=' . $_GET['id'];

    $result = selectf($connection, $tName, $csh, $whereValue);

    if ( mysql_check_result($connection, $result) ) {

        if ( mysqli_num_rows($result) ) {
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
        $_GET['loginerror'] = 1;
        }

    }

    if ( $auth === 'pass' ) {

        if ( session_status() !== 2 ) { session_start(); }

        if ( ( ! empty($_POST['secret']) ) || (! empty($_SESSION['secret']) ) ) {
             
            if ( ! empty($_POST['secret']) ) {
                $_SESSION['secret'] = $_POST['secret'];  
                $password = decryptRSAPassword($connection, $cipherPass, $_POST['secret']);
 
            } else {
                $password = decryptRSAPassword($connection, $cipherPass, $_SESSION['secret']);
            }

            $ssh = new Net_SSH2($addr);
        
            if ( ! $ssh->login($uname, $password) ) {

                if ( ! empty($_SESSION['secret']) ) { unset($_SESSION['secret']); }

                if ( $password === FALSE ) {
                    header("Location: index.php?page=" . $_GET['page'] . "&id=" . $_GET['id'] . "&loginerror=1&secretnotfound=1"); 
                } else {
                    header("Location: index.php?page=" . $_GET['page'] . "&id=" . $_GET['id'] . "&loginerror=1");
                }

            } else {

                echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                        Połączenie z " . $addr . " zostało <strong>ustanowione</strong>.
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>";
            }     

        } else {

            if ( ! empty($_GET['loginerror']) ) {


                echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                Logowanie do serwera <strong>nie powiodło</strong> się.
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>";

            }

            if ( ! empty($_GET['secretnotfound']) ) {

                echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                <strong>Nie odnaleziono</strong> klucza bezpieczeństwa haseł.
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>";

            }

            echo "<form action=\"index.php?page=" . $_GET['page'] . "&id=" . $_GET['id'] . "\" method=\"post\">";
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

        $ssh = new Net_SSH2($addr);
        $key = new Crypt_RSA();
    
        $key->loadKey($privKey);
    
        if ( ! $ssh->login($uname, $key) ) {
            

            echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                    Logowanie do serwera <strong>nie powiodło</strong> się.
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                    </button>
                </div>";

            $_GET['loginerror'] = 1;

        } else {

            echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                    Połączenie z " . $addr . " zostało <strong>ustanowione</strong>.
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                    </button>
                </div>";
        }
    }





?>