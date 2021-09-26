<?php
    echo "<form action=\"index.php?page=modserver\" method=\"post\">
            <input type=\"hidden\" name=\"servers_id\" value=\"" . $row[0] . "\" />
            <div class=\"form-group\">
                <label for=\"serversAddr\">Adres serwera: </label>
                <input id=\"serversAddr\" class=\"form-control\" type=\"text\" name=\"servers_addr\" value=\"" . $row[1] . "\" aria-describedby=\"serversAddrHelp\" />
                <small id=\"serversAddrHelp\" class=\"form-text text-muted\">Wpisz adres serwera w postacji adresu IP lub FQDN.</small>
            </div>
            <div class=\"form-group\">
                <label for=\"serversUname\">Nazwa użytkownika: </label>
                <input id=\"serversUname\" class=\"form-control\" type=\"text\" name=\"servers_uname\" value=\"" . $row[2] . "\" aria-describedby=\"serversUname\" />
                <small id=\"serversUnameHelp\" class=\"form-text text-muted\">Podaj nazwę użytkownika zdalnego, na którego konto będzie się logować na serwerze.</small>
            </div>
            <div class=\"form-group\">
                <label for=\"serversAuth\">Typ uwierzytelnienia: </label>
                <select id=\"serversAuth\" class=\"form-control\" name=\"servers_auth\" aria-describedby=\"serversAuthHelp\">";

                    if ( $row[3] === 'rsa' ) {
                        echo "<option value=\"rsa\">Klucz publiczny</option>
                                <option value=\"pass\">Hasło</option>";
                    } else {
                        echo "<option value=\"pass\">Hasło</option>
                                <option value=\"rsa\">Klucz publiczny</option>";
                    }

            echo "</select>
                <small id=\"serversAuthHelp\" class=\"form-text text-muted\">Wybierz metodę uwierzytelnienia. Do wyboru są Hasło oraz Klucz publiczny</small>
            </div>
            <div class=\"form-group\">
                <label for=\"serverPass\">Hasło</label>";
            if ( ! empty($row[4]) ) {
                echo "<div class=\"input-group\">";
                echo "<input id=\"serverPass\" class=\"form-control\" type=\"password\" name=\"servers_pass\" value=\"" . $plainPassword . "\" aria-describedby=\"serverPassHelp\" data-toggle=\"password\" />";
                echo "<div class=\"input-group-append\">
                        <span class=\"input-group-text\">
                            <i class=\"far fa-eye\"></i>
                        </span>
                    </div>
                </div>";
            } else {
                echo "<input id=\"serverPass\" class=\"form-control\" type=\"password\" name=\"servers_pass\" disabled=\"disabled\" aria-describedby=\"serverPassHelp\" /></td>";
            }
            echo "<small id=\"serverPassHelp\" class=\"form-text text-muted\">Podaj hasło użytkownika zdalnego, na którego konto będziemy się logować na serwerze. Pole będzie dostępne po wyborze hasła jako sposobu uwierzytelnienia.</small>";
            echo "</div>
                <button class=\"btn btn-success\" type=\"submit\" />Zapisz!</button>
        </form>";
                    

        

?>