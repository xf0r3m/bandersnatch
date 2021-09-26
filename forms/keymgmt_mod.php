<?php
    echo "<form action=\"index.php?page=keymgmt\" method=\"post\" />
    <div class=\"form-group\">
        <label for=\"rsaKeysPrivateKey\">Klucz prywatny:</label>
        <textarea id=\"rsaKeysPrivateKey\" class=\"form-control\" rows=\"10\" name=\"rsa_keys_priv_key\" aria-describedby=\"rsaKeysPrivateKeyHelp\">" . $row[1] . "</textarea>
        <small id=\"rsaKeysPrivateKeyHelp\" class=\"form-text text-muted\">W powyższym polu znajduje się klucz prywatny, jest on częścią pary kluczy służacych do logowania się bez użycia hasłą</small>
    </div>
    <div class=\"form-group\">
        <label for=\"rsaKeysPublicKey\">Klucz publiczny: </label>
        <textarea id=\"rsaKeysPublicKey\" class=\"form-control\" rows=\"5\" name=\"rsa_keys_pub_key\" aria-describedby=\"rsaKeysPublicKeyHelp\">" . $row[2] . "</textarea>
        <small id=\"rsaKeysPublicKeyHelp\" class=\"form-text text-muted\">W powyższym polu znajduje się klucz publiczny, ten klucz należy umieścić na serwerze.</small>
    </div>
    <button type=\"submit\" class=\"btn btn-success\" >Zapisz klucze</button>
</form>";
?>