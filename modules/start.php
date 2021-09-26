<?php

    if ( ! empty($_GET['login']) ) {

        echo "<p>&nbsp;</p>";

        echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                Logowanie <strong>powiodło</strong> się.
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>";

    }

    echo "<p>&nbsp;</p><h3>Lista serwerów: </h3>";

        $tName = 'servers';
        $csh = 'id,addr,uname,auth';

        $result = selectf($connection, $tName, $csh);
        if ( mysql_check_result($connection, $result) ) {
            if ( mysqli_num_rows($result) > 0 ) {

                echo "<table class=\"table\">
                        <thead>
                        <tr>
                            <th scope=\"col\">#</th>
                            <th scope=\"col\">Adres</th>
                            <th scope=\"col\">Nazwa użytkownika</th>
                            <th scope=\"col\">Typ uwierzytelnienia</th>
                            <th scope=\"col\" colspan=\"3\">Akcje</th>
                        </tr>
                        </thead>
                        <tbody>";
                $j=1;
                while ( $row = mysqli_fetch_row($result) ) {

                    if ( $row[3] === 'rsa' ) { $row[3] = 'Klucz publiczny'; }
                    else {
                        $row[3] = 'Hasło';
                    }

                    echo "<tr>
                            <th scope=\"row\"> " . $j . "</th>
                            <td>" . $row[1] . "</td>
                            <td>" . $row[2] . "</td>
                            <td>" . $row[3] . "</td>
                            <td><a href=\"index.php?page=inventory&id=" . $row[0] . "\">Inwentaryzacja</a></td>
                            <td><a href=\"index.php?page=console&id=" . $row[0] . "\">Połącz</a></td>
                            <td><a href=\"index.php?page=rfiles&id=" . $row[0] . "\">Przeglądaj pliki</a></td>
                        </tr>";

                    $j++;

                }

                echo "</tbody>
                </table>";
                
            } else {
                echo "<div class=\"alert alert-primary\" role=\"alert\">
                    Nie znaleziono żadnych serwerów.
                </div>";
            }
        }

?>