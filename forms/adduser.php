<?php

echo "<form id=\"addUserForm\" action=\"index.php?page=adduser\" method=\"post\">
    <div class=\"form-group\">
        <label for=\"userName\">Nazwa użytkownika: </label>
        <input id=\"userName\" class=\"form-control\" type=\"text\" name=\"users_uname\" placeholder=\"Nazwa użytkownika\" aria-describedby=\"usersNameHelp\" />
        <small id=\"usersNameHelp\" class=\"form-text text-muted\">Podaj nazwę nowego użytkownika.</small>
    </div>
    <div class=\"form-group\">
        <label for=\"userPassword\">Hasło: </label>
        <div class=\"input-group\">
            <input id=\"usersPassword\" class=\"form-control\" type=\"password\" name=\"users_password\" placeholder=\"Hasło\" aria-describedby=\"usersPasswordHelp\" data-toggle=\"password\" required />
            <div class=\"input-group-append\">
                <span class=\"input-group-text\">
                    <i class=\"far fa-eye\"></i>
                </span>
            </div>
        </div>
        <small id=\"usersPasswordHelp\" class=\"form-text text-muted\">Wprowadź hasło nowego użytkownika.</small>
    </div>
    <div class=\"form-group\">
        <label for=\"userPassword\">Powtórz hasło: </label>
        <div class=\"input-group\">
            <input id=\"usersPassword\" class=\"form-control\" type=\"password\" name=\"confirm_password\" placeholder=\"Potwierdź hasło\" aria-describedby=\"confirmPasswordHelp\" data-toggle=\"password\" required />
            <div class=\"input-group-append\">
                <span class=\"input-group-text\">
                    <i class=\"far fa-eye\"></i>
                </span>
            </div>
        </div>
        <small id=\"confirmPasswordHelp\" class=\"form-text text-muted\">Powtórz hasło nowego użytkownika.</small>
    </div>
    <div class=\"form-group\">
        <label for=\"userRole\">Rola użytkownika</label>
        <select id=\"userRole\" class=\"form-control\" name=\"users_role\" aria-describedby=\"userRoleHelp\">
            <option></option>
            <option value=\"admin\">Administrator</option>
            <option value=\"user\">Użytkownik</option>
        </select>
        <small id=\"userRoleHelp\" class=\"form-text text-muted\">Wybierz rolę dla nowego użytkownika.</small>
    </div>
    <button type=\"submit\" class=\"btn btn-success\">Dodaj użytkownika</button>
    </form>";


?>