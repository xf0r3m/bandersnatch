<?php

if ( ( ! empty($_POST) ) && ( empty($_GET['mod_id']) ) ) {

    $tName = 'servers';
    if ( $_POST['servers_auth'] === 'pass' ) {
        $csh = 'addr,uname,auth,pass';
        $_POST['servers_pass'] = encryptRSAPassword($connection, $_POST['servers_pass']);

    } else {
        $csh = 'addr,uname,auth';
    }

    $pKL = generatePKL($tName, $csh);
    $whereValue = 'id=' . $_POST['servers_id'];

    $result = updatef($connection, $tName, $csh, $pKL, $whereValue);
    if ( mysql_check_result($connection, $result) ) {
        header('Location: index.php?page=addservers&modserver=1');
    }
}

echo "<p>&nbsp;</p>
<p class=\"sectionLabel\">Modyfikacja wpisu serwera</p>";
echo "<hr class=\"horizonLine\" />";

$mod_id = $_GET['mod_id'];

$tName = 'servers';
$csh = '*';
$whereValue = 'id=' . $mod_id;

$result = selectf($connection, $tName, $csh, $whereValue);
if ( mysql_check_result($connection, $result) ) {
    if ( mysqli_num_rows($result) > 0 ) {
        $row = mysqli_fetch_row($result);
    
        if ( $row[3] === 'pass' ) {

            $cipherPass = base64_decode($row[4]);

            if ( ( ! empty($_SESSION['secret']) ) || ( ! empty($_POST['secret']) ) ) {

                if ( (empty($_SESSION['secret'])) && ( ! empty($_POST['secret']) ) ) {
                        $_SESSION['secret'] = $_POST['secret'];
                        $plainPassword = decryptRSAPassword($connection, $cipherPass, $_POST['secret']);

                } else if ( ! empty($_SESSION['secret']) ) {
                        $plainPassword = decryptRSAPassword($connection, $cipherPass, $_SESSION['secret']);
                }

                if ( $plainPassword === FALSE ) {

                        echo "<p>&nbsp;</p>";
    
                        echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                        <strong>Nie odnaleziono</strong> klucza bezpieczeństwa haseł.
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>";
 
                } else { include('forms/modserver.php'); }

            } else {

                echo "<form action=\"index.php?page=" . $_GET['page'] . "&mod_id=" . $row[0] . "\" method=\"post\">";
                echo "<div class=\"form-group\">
                    <label for=\"secretPassword\">Hasło klucza bezpieczeństwa:</label>
                    <div class=\"input-group\">
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

        } else { include('forms/modserver.php'); 
        }
    }
}

?>