<?php
    echo "<form id=\"firstloginForm\" action=\"index.php\" method=\"post\">
                <div class=\"form-group\">
                    <label for=\"usersName\">Nazwa użytkownika:</label>
                    <input id=\"usersName\" class=\"form-control\" type=\"text\" name=\"users_uname\" placeholder=\"Nazwa użytkownika\" aria-describedby=\"usersNameHelp\" required />
                    <small id=\"usersNameHelp\" class=\"form-text text-muted\">Nazwa użytkownika dla Administratora systemu. Ze względów bezpieczeństwa nie wybieraj nazw takich jak: admin, administrator, adm czy root</small>
                </div>
                <div class=\"form-group\">
                    <label for=\"usersPassword\">Hasło:</label>
                    <div class=\"input-group\">
                        <input id=\"usersPassword\" class=\"form-control\" type=\"password\" name=\"password\" placeholder=\"Hasło\" aria-describedby=\"usersPasswordHelp\" required data-toggle=\"password\" />
                        <div class=\"input-group-append\">
                            <span class=\"input-group-text\">
                                <i class=\"far fa-eye\"></i>
                            </span>
                        </div>
                    </div>
                    <small id=\"usersPasswordHelp\" class=\"form-text text-muted\">Hasło dla Administratora systemu. Nie ma wymagań co do złożoności.</small>
                </div>
                <div class=\"form-group\">
                    <label for=\"usersPassword2\">Powtórz hasło: </label>
                    <div class=\"input-group\">
                        <input id=\"usersPassword2\" class=\"form-control\" type=\"password\" name=\"password2\" placeholder=\"Powtórz hasło\" aria-describedby=\"usersPasswordHelp2\" required data-toggle=\"password\" />
                        <div class=\"input-group-append\">
                            <span class=\"input-group-text\">
                                <i class=\"far fa-eye\"></i>
                            </span>
                        </div>
                    </div>
                    <small id=\"usersPasswordHelp2\" class=\"form-text text-muted\">Powtórz hasło w celu weryfikacji jego poprawności.</small>
                </div>
                <div class=\"form-group\">
                    <label for=\"usersRole\">Rola: </label>
                    <select id=\"userRole\" class=\"form-control\" name=\"users_role\" aria-describedBy=\"userRoleHelp\">
                        <option value=\"admin\">Administrator</option>
                    </select>
                    <small id=\"userRoleHelp\" class=\"form-text text-muted\">System potrzebuje administratora. Dlatego rola ta tutaj rola jest domyślna.</small>
                </div>
                <button type=\"submit\" class=\"btn btn-success\">Zapisz</button>
        </form>";
?>