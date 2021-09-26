<?php

    if ( ! empty($_POST) ) {

        if ( file_put_contents($_POST['path'], $_POST['file_content']) !== FALSE ) {
            header("Location: index.php?page=files&savefile=1");
        } else {
            header("Location: index.php?page=files&savefile=0");
        }
    } else {

        if ( ! empty($_GET['path']) ) {

            $f = file($_GET['path']);
        

            echo "<form action=\"index.php?page=edit\" method=\"post\">
                <input type=\"hidden\" name=\"path\" value=\"" . $_GET['path'] . "\" />
                <div class=\"form-group\">
                <label for=\"fileContent\">Zawartość pliku:</label>
                <textarea id=\"fileContent\" class=\"form-control\" name=\"file_content\" aria-describedby=\"fileContentHelp\">";

                for ($i=0; $i < count($f); $i++) {

                    echo $f[$i];

                }

            echo "</textarea>
            <small id=\"fileContentHelp\" class=\"form-text text-muted\">Powyżej znajduje się zawartość pliku, którą można swobodnie edytować.</small>
            <button class=\"btn btn-success\" type=\"submit\">Zapisz</button>
            </form>";
        }
    }

?>