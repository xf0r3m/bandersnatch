<?php
    if ( ! empty($_POST) ) {

        if ( isset($_POST['rsa_keys_change']) ) {

            $tName = 'rsa_keys';
            $csh = 'priv_key,pub_key';
            $pKL = generatePKL($tName, $csh);

            include('modules/genRsaOpensshKeys.php');

            $_POST['rsa_keys_priv_key'] = $privatekey;
            $_POST['rsa_keys_pub_key'] = $publickey;

            $result = insertf($connection, $tName, $csh, $pKL);

            if ( mysql_check_result($connection, $result) ) {

                echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                <strong>Pomyślnie</strong> wygenrowano klucze.
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>";

            }
            

        } else {
            
            $tName = 'rsa_keys';
            $csh = 'priv_key,pub_key';
            $pKL = generatePKL($tName, $csh);

            $result = insertf($connection, $tName, $csh, $pKL);

            if ( mysql_check_result($connection, $result) ) {
               
                echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                <strong>Pomyślnie</strong> wczytano klucze.
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>";

            }

        }
    }

    echo "<p>&nbsp;</p><p class=\"sectionLabel\">Obecne klucze</p>
            <hr class=\"horizonLine\" />";
    $tName = 'rsa_keys';
    $csh = "*";
    $result = selectf($connection, $tName, $csh);
    if ( mysql_check_result($connection, $result) ) {
        if ( mysqli_num_rows($result) > 0 ) {
            mysqli_data_seek($result, (mysqli_num_rows($result) - 1));
            $row = mysqli_fetch_row($result);
            include('forms/keymgmt_mod.php');
        } else {
            include('forms/keymgmt.php');
        }
    }

    echo "<p>&nbsp;</p><p class=\"sectionLabel\">Utwórz parę kluczy<p>";
    echo "<hr class=\"horizonLine\" />
    <p>&nbsp</p>";
    echo "<form action=\"index.php?page=keymgmt\" method=\"post\">
            <input type=\"hidden\" name=\"rsa_keys_change\" value=\"1\" />
            <button class=\"btn btn-success\" type=\"submit\">Wygeneruj nową parę kluczy</button>
        </form>";
    
?>