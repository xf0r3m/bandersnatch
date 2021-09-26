<?php
        include('Crypt/RSA.php');

        $rsa = new Crypt_RSA();

        $rsa -> setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_OPENSSH);
        $rsa -> setComment($_SESSION['username'] . '@bandersnatch');

        extract($rsa->createKey(2048));

?>