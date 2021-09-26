<?php
function mysql_check_result ($connection, $result) {

    if ( ! $result ) {

        echo "<p>&nbsp;</p>
        <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
        Błąd: " . mysqli_error($connection) . ".
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
    </div>";

        return false;
    } else {
        return $result;
    }

}

function selectf($connection, $tName, $csh, $whereValue = 'true') {

    $query = "SELECT " . $csh . " FROM " . $tName . " WHERE " . $whereValue . ";";

    $result = mysqli_query($connection, $query);

    return $result;

}

function isInteger($value) {

    if ( ! preg_match('/\D/', $value) ) {
        return true;
    } else {
        return false;
    }

}

function insertf($connection, $tName, $csh, $pKL) {

    $cshTab = explode(',', $csh);
    $pklTab = explode(',', $pKL);

    $query = "INSERT INTO " . $tName . " (" . $csh . ") VALUES (";

    for ($i=0; $i < count($pklTab); $i++) {

        if ( ! $pklTab[$i] === 'servers_pass' ) {

            $_POST[$pklTab[$i]] = mysqli_real_escape_string($connection, $_POST[$pklTab[$i]]);
        } 
        if ( $pklTab[$i] === 'servers_pass' ) {
            $_POST[$pklTab[$i]] = base64_encode($_POST[$pklTab[$i]]);
        }

        if ( $i === ( count($pklTab) - 1) ) {
            if ( isInteger($_POST[$pklTab[$i]]) ) {
                $query .= $_POST[$pklTab[$i]];
            } else {
                $query .= "'" .  $_POST[$pklTab[$i]] . "'";
            }
        } else {
            if ( isInteger($_POST[$pklTab[$i]]) ) {
                $query .= $_POST[$pklTab[$i]] . ",";
            } else {
                $query .= "'" . $_POST[$pklTab[$i]] . "',";
            }
        }

    }

    $query .= ");";

    $result = mysqli_query($connection, $query);

    return $result;
}

function generatePKL($tName, $csh) {

    $cshTable = explode(',', $csh);

    for($i=0; $i < count($cshTable); $i++) {

        if ( $i === 0 ) {
            if ( $i === ( count($cshTable) - 1) ) {
                $pKL = $tName . "_" . $cshTable[$i];
            } else {
                $pKL = $tName . "_" . $cshTable[$i] . ",";
            }
        } else {
            if ( $i === ( count($cshTable) - 1) ) {
                $pKL .= $tName . "_" . $cshTable[$i];
            } else {
                $pKL .= $tName . "_" . $cshTable[$i] . ",";
            }
        }

    }

    return $pKL;

}

function updatef($connection, $tName, $csh, $pKL, $whereValue) {

    $cshTab = explode(',', $csh);
    $pklTab = explode(',', $pKL);

    $query = "UPDATE " . $tName . " SET ";

    for($i=0; $i < count($pklTab); $i++) {

        if ( ! $pklTab[$i] === 'servers_pass' ) {

            $_POST[$pklTab[$i]] = mysqli_real_escape_string($connection, $_POST[$pklTab[$i]]);
        } 
        
        if ( $pklTab[$i] === 'servers_pass' ) {
            $_POST[$pklTab[$i]] = base64_encode($_POST[$pklTab[$i]]);
        }

        if ( $i === (count($pklTab) - 1) ) {
            if ( isInteger($_POST[$pklTab[$i]]) ) {
                $query .= $cshTab[$i] . '=' . $_POST[$pklTab[$i]];
            } else {
                $query .= $cshTab[$i] . "='". $_POST[$pklTab[$i]] . "'";
            }
        } else {
            if ( isInteger($_POST[$pklTab[$i]]) ) {
                $query .= $cshTab[$i] . '=' . $_POST[$pklTab[$i]] . ",";
            } else {
                $query .= $cshTab[$i] . "='". $_POST[$pklTab[$i]] . "',";
            }
        }

    }

    $query .= " WHERE " . $whereValue;

    $result = mysqli_query($connection, $query);

    return $result;

}

function encryptRSAPassword($connection, $plainPass) {

    $tName = 'secret_key';
    $csh = 'id,pub_key';
    $whereValue = '1=1 ORDER BY id DESC LIMIT 1';
    $result = selectf($connection, $tName, $csh);
    if ( mysql_check_result($connection, $result) ) {
        if ( mysqli_num_rows($result) > 0 ) {
            $row = mysqli_fetch_row($result);
            $publickey = $row[1];
        } else {
            header("Location: index.php?page=" . $_GET['page'] . "&keynotfound=1");
        }
    }

    include('Crypt/RSA.php');

    $rsa = new Crypt_RSA();

    $rsa->loadKey($publickey);

    $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
    $cipherText = $rsa->encrypt($plainPass);
    
    return $cipherText;
}

function decryptRSAPassword($connection, $cipherPass, $secret) {
    
    $tName = 'secret_key';
    $csh = 'id,priv_key';
    $whereValue = '1=1 ORDER BY id DESC LIMIT 1';
    $result = selectf($connection, $tName, $csh);
    if ( mysql_check_result($connection, $result) ) {
        if ( mysqli_num_rows($result) > 0 ) {
            $row = mysqli_fetch_row($result);
            $privatekey = $row[1];
        } else {
            return FALSE;
        }
    }
    if ( ! class_exists('Crypt_RSA') ) { include('Crypt/RSA.php'); }
    //include('Crypt/RSA.php');

    $rsa = new Crypt_RSA();

    $rsa->setPassword($secret);
    $rsa->loadKey($privatekey);

    $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
    $plainPass = $rsa->decrypt($cipherPass);
    
    return $plainPass;
}

function deletef($connection, $tName, $whereValue) {

    $query = 'DELETE FROM ' . $tName . ' WHERE ' . $whereValue;

    $result = mysqli_query($connection, $query);

    return $result;

}

?>