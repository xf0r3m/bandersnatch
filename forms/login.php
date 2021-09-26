<?php

    echo "<div id=\"title\" class=\"d-flex p-2 justify-content-center align-content-center flex-wrap\">
        <h1>Bandersnatch</h1>
        </div>";

    echo "<div class=\"d-flex p-2 justify-content-center align-content-center flex-wrap\">";

    echo "<form action=\"index.php\" method=\"post\">
                <div class=\"form-group\">
                    <label for=\"loginUname\">Nazwa użytkownika:</label>
                    <input id=\"loginUname\" class=\"form-control\" type=\"text\" name=\"login_uname\" placeholder=\"Nazwa użytkownika\" aria-describedby=\"loginUnameHelp\" required/>
                    <small id=\"loginUnameHelp\" class=\"form-text text-muted\">Wpisz nazwę użytkownika nadaną przez administratora systemu</small> 
                </div>
                <div class=\"form-group\">
                    <label for=\"loginPasswd\">Hasło:</label>
                    <div class=\"input-group\">
                        <input id=\"loginPasswd\" class=\"form-control\" type=\"password\" name=\"login_passwd\" placeholder=\"Hasło\" aria-describedby=\"loginPasswdHelp\" required data-toggle=\"password\" />
                        <div class=\"input-group-append\">
                            <span class=\"input-group-text\">
                                <i class=\"far fa-eye\"></i>
                            </span>
                        </div>
                    </div>
                    <small id=\"loginPasswdHelp\" class=\"form-text text-muted\">Wpisz hasło. Pamiętaj! Hasło nadane przez administrator należy jak najszybciej zmienić</small>
                </div>
                <button type=\"submit\" class=\"btn btn-success\">Zaloguj!</button>
        </form>";

    echo "</div>";
?>