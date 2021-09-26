<?php

echo "<p>&nbsp;</p>
        <p class=\"sectionLabel\">Klucz bezpieczeństwa haseł</p>
        <hr class=\"horizonLine\">";

        if ( ! empty($_POST) && isset($_POST['secret']) ) {

            include('modules/genRsaPkcs1Keys.php');
            
            $_POST['secret_key_priv_key'] = $privatekey;
            $_POST['secret_key_pub_key'] = $publickey;

            $tName = 'secret_key';
            $csh = 'priv_key,pub_key';

            $query = "INSERT INTO secret_key (" . $csh . ") VALUES ('" . $_POST['secret_key_priv_key'] . "','" . $_POST['secret_key_pub_key'] ."');";
            
            $result = mysqli_query($connection, $query);
            if ( mysql_check_result($connection, $result) ) {

                echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                <strong>Pomyślnie</strong> utworzono klucz bezpieczeństwa.
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>";

            }


        } else {
            
            echo "<form action=\"index.php?page=settings\" method=\"post\">
                        <div class=\"form-group\">
                            <label for=\"secretPassword\">Hasło klucza prywatnego:</label>";
            echo "<div class=\"input-group\">
                            <input id=\"secretPassword\" class=\"form-control\" type=\"password\" name=\"secret\" placeholder=\"Hasło\" aria-describedby=\"secretPasswordHelp\" data-toggle=\"password\" required />
                            <div class=\"input-group-append\">
                                <span class=\"input-group-text\">
                                <i class=\"far fa-eye\"></i>
                                </span>
                            </div>
                </div>
                            <small id=\"secretPasswordHelp\" class=\"form-text text-muted\">W powyższe pole wpisz hasło dla klucza bezpieczeństwa haseł. Zapmiętaj je! Będzie potrzebne przy pierwszym logowaniu do maszyny, której metodą uwierzytelniania jest hasło.</small>
                        </div>
                        <button type=\"submit\" class=\"btn btn-success\">Utwórz klucz</button>
                    </form>";
        }

    


?>