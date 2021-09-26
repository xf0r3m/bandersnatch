<?php
    echo "<form action=\"index.php?page=addservers\" method=\"post\">
            <div class=\"form-group\"
                <label for=\"serversAddr\">Adres serwera:</label>
                <input id=\"serversAddr\" class=\"form-control\" type=\"text\" name=\"servers_addr\" aria-describedby=\"serversAddrHelp\" placeholder=\"Adres serwera\" /></td>
                <small id=\"serversAddrHelp\" class=\"form-text text-muted\">Wpisz adres serwera w postacji adresu IP lub FQDN.</small>
            </div>
            <div class=\"form-group\">
                <label for=\"serversUname\">Nazwa użytkownika:</label>
                <input id=\"serversUname\" class=\"form-control\" type=\"text\" name=\"servers_uname\" aria-describedby=\"serversUnameHelp\" placeholder=\"Nazwa użytkownika\" />
                <small id=\"serversUnameHelp\" class=\"form-text text-muted\">Podaj nazwę użytkownika zdalnego, na którego konto będzie się logować na serwerze.</small>
            </div>
            <div class=\"form-group\">
                <label for=\"serversAuth\">Sposób uwierzytelnienia:</label>
                <select id=\"serversAuth\" class=\"form-control\" name=\"servers_auth\" placeholder=\"Sposób uwierzytelnienia\" aria-describeby=\"serverAuthHelp\">
                    <option></option>
                    <option value=\"pass\">Hasło</option>
                    <option value=\"rsa\">Klucz publiczny</option>
                </select>
                <small id=\"serversAuthHelp\" class=\"form-text text-muted\">Wybierz metodę uwierzytelnienia. Do wyboru są Hasło oraz Klucz publiczny</small>
            </div>
            <div class=\"form-group\">
                <label for=\"serversPass\">Hasło:</label>
                <div class=\"input-group\">
                    <input id=\"serverPass\" class=\"form-control\" type=\"password\" name=\"servers_pass\" aria-describedby=\"serverPassHelp\" placeholder=\"Hasło\" disabled=\"disabled\" data-toggle=\"password\" />
                    <div class=\"input-group-append\">
                        <span class=\"input-group-text\">
                            <i class=\"far fa-eye\"></i>
                        </span>
                    </div>
                </div>
                <small id=\"serverPassHelp\" class=\"form-text text-muted\">Podaj hasło użytkownika zdalnego, na którego konto będziemy się logować na serwerze. Pole będzie dostępne po wyborze hasła jako sposobu uwierzytelnienia.</small>
            </div>
                <button type=\"submit\" class=\"btn btn-success\">Dodaj serwer</button>
            </table>
        </form>";
?>