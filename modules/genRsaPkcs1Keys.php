<?php

include('Crypt/RSA.php');

$rsa = new Crypt_RSA();
 
$rsa->setPassword($_POST['secret']);

extract($rsa->createKey()); 

?>