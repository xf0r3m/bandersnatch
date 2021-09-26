<?php

$savefile=0;

var_dump(isset($savefile));

/*
    include('db_conf.php');
    include('library.php');

    set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
        
        //include('Net/SSH2.php');

        include('Crypt/RSA.php');


        $rsa = new Crypt_RSA();

        $tName = 'secret_key';
        $csh = 'priv_key,pub_key';
        
        $result = selectf($connection, $tName, $csh);
        if ( mysql_check_result($connection, $result) ) {
            if ( mysqli_num_rows($result) > 0 ) {

                $row = mysqli_fetch_row($result);
                $privatekey = $row[0];
                $publickey = $row[1];

            }
        }

        $rsa->loadKey($publickey);

        $plaintext = 'To jest tajna wiadomosc do zaszyfrowania';

        $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
        $cipherText = $rsa->encrypt($plaintext);
        
        echo $cipherText . "<br />";
*/
        /*
        $privkey1 = $rsa->getPrivateKey();
        $pubkey1 = $rsa->getPublicKey();

        var_dump($privkey1);
        var_dump($pubkey1);
        */

        $rsa->setPassword('7kkdeodw');
        $rsa->loadKey($privatekey);
        echo $rsa->decrypt($cipherText);

        /*
        //if ( ! $ssh->login('kuba', $key) ) {
        //    echo('Login Failed');
        //}

        //echo "<pre>";
        //echo $ssh->exec($_POST['command']);
        //echo "</pre>";

        include('Net/SFTP.php');

        $sftp = new Net_SFTP('192.168.56.179');
        if (!$sftp->login('kuba', $key)) {
            exit('Login Failed');
        }

        $sftp->chdir($_POST['command']);
        $filelist = $sftp->nlist(); // == $sftp->nlist('.')
        //print_r($sftp->rawlist()); // == $sftp->rawlist('.')

        var_dump($filelist);
        */
        /*
        echo "<form action=\"test.php\" method=\"post\">
                <input type=\"text\" name=\"command\" />
                <input type=\"submit\" value=\"Wyślij\" />
            </form>";
        */
        //echo $ssh->exec('hostname');

        //echo $ssh->read('username@username:~$');
        //$ssh->write("ls -la\n"); // note the "\n"
        //echo $ssh->read('username@username:~$');
        
        /*
        include('modules/genRsaOpensshKeys.php');

        echo "<h3>Klucz prywatny: </h3>
        <textarea style=\"width: 480px; height: 240px;\">" . $privatekey . "</textarea><br />
        <h3>Klucz publiczny: </h3>
        <textarea style=\"width: 640px; height: 80px;\">" . $publickey . "</textarea>";
        */
        /*
        $config = array (
            'digest_alg' => $_POST['keys_digest_algo'],
            'private_key_bits' => (int)$_POST['keys_bits'],
            'private_key_type' => $_POST['keys_key_type']
        );

        $resource = openssl_pkey_new($config);

        if ( ! empty($_POST['keys_passphrase']) ) {
            openssl_pkey_export($resource, $privKey, $_POST['keys_passphrase']);
        } else {
            openssl_pkey_export($resource, $privKey);
        }

        file_put_contents($_POST['keys_priv_path'], $privKey);

        $pubKey = openssl_pkey_get_details($resource);
        $pubKey = $pubKey["key"];

        file_put_contents($_POST['keys_pub_path'], $pubKey);

        $out = exec("ssh-keygen -y -f /var/www/html/nextcloud-data/kuba/files/bandersnatch/test/privkey1.pem");

        var_dump($out);
        */
        /*
        if ( ! preg_match('/\D/', $_POST['tekst']) ) {
            echo "Jest liczbą.<br />";
        } else {
            echo "Nie jest liczbą<br />";
        }
        */
        /*
        if ( is_int($_POST['tekst']) ) {
            echo "Jest liczbą.<br />";
        } else {
            echo "Nie jest liczbą<br />";
        }
        */

