<?php
echo "<form id=\"resetPasswordForm\" action=\"index.php?page=resetpassword&user_id=" . $id . "\" method=\"post\">
<div class=\"form-group\">
<label for=\"userPassword\">Nowe hasło: </label>
<div class=\"input-group\">
    <input id=\"usersPassword\" class=\"form-control\" type=\"password\" name=\"reset_password\" placeholder=\"Nowe hasło\" aria-describedby=\"usersPasswordHelp\" data-toggle=\"password\" required />
    <div class=\"input-group-append\">
        <span class=\"input-group-text\">
            <i class=\"far fa-eye\"></i>
        </span>
    </div>
</div>
<small id=\"usersPasswordHelp\" class=\"form-text text-muted\">Wprowadź nowe hasło.</small>
</div>
<div class=\"form-group\">
<label for=\"userPassword\">Powtórz hasło: </label>
<div class=\"input-group\">
    <input id=\"usersPassword\" class=\"form-control\" type=\"password\" name=\"confirm_password\" placeholder=\"Potwierdź nowe hasło\" aria-describedby=\"confirmPasswordHelp\" data-toggle=\"password\" required />
    <div class=\"input-group-append\">
        <span class=\"input-group-text\">
            <i class=\"far fa-eye\"></i>
        </span>
    </div>
</div>
<small id=\"confirmPasswordHelp\" class=\"form-text text-muted\">Powtórz nowe hasło.</small>
</div>
<button type=\"submit\" class=\"btn btn-success\">Resetuj hasło</button>
</form>";

?>