<?php
echo "<form id=\"chpasswdForm\" actiom=\"index.php?page=chpasswd\" method=\"post\">
        <div class=\"form-group\">
            <label for=\"currentPassword\">Obecne hasło:</label>
            <input id=\"currentPassword\" class=\"form-control\" type=\"password\" name=\"current_passwd\" placeholder=\"Obecne hasło\" aria-describedby=\"currentPasswordHelp\" required />
            <small id=\"currentPasswordHelp\" class=\"form-text text-muted\">Podaj obecnie używane przez Ciebie hasło.</small>
        </div>
        <div class=\"form-group\">
            <label for=\"newPassword\">Nowe hasło: </label>
            <input id=\"newPassword\" class=\"form-control\" type=\"password\" name=\"new_password\" placeholder=\"Nowe hasło\" aria-describedby=\"newPasswordHelp\" required />
            <small id=\"newPasswordHelp\" class=\"form-text text-muted\">W powyższe pole wpisz nowe hasło.</small>
        </div>
        <div class=\"form-group\">
            <label for=\"confirmPassword\">Potwierdź nowe hasło</label>
            <input id=\"confirmPassword\" class=\"form-control\" type=\"password\" name=\"confirm_password\" placeholder=\"Potwierdź nowe hasło\" aria-describedby=\"confirmPasswordHelp\" required />
            <small id=\"confirmPasswordHelp\" class=\"form-text text-muted\">W celu weryfikacji wpisz ponownie nowe hasło w powyższe pole</small>
        </div>
        <button type=\"submit\" class=\"btn btn-success\">Zapisz</button>
    </form>";
?>