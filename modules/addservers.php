<?php

    if ( ! empty($_POST) ) {

        $tName = 'servers';
        if ( $_POST['servers_auth'] === 'pass' ) {
            $csh = 'addr,uname,auth,pass';
            $_POST['servers_pass'] = encryptRSAPassword($connection, $_POST['servers_pass']);

            

        } else {
            $csh = 'addr,uname,auth';
        }

        $pKL = generatePKL($tName, $csh);

        $result = insertf($connection, $tName, $csh, $pKL);

        if ( mysql_check_result($connection, $result) ) {

            echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
            <strong>Pomyślnie</strong> dodano serwer do listy.
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>";

        }
        
    }

    if ( ! empty($_GET['keynotfound']) ) {

        echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
        <strong>Nie odnaleziono</strong> klucza bezpieczeństwa haseł.
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
    </div>";

    }

    if ( ! empty($_GET['modserver']) ) {
        echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
            <strong>Pomyślnie</strong> zaktualizowano dane serwera.
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>";
    }

    if ( ! empty($_GET['delserver']) ) {
        echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
        <strong>Pomyślnie</strong> usunięto serwer z bazy.
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
    </div>";
    }

    echo "<p>&nbsp;</p>
        <p class=\"sectionLabel\">Dodaj serwer</p>";
    echo "<hr class=\"horizonLine\" />";

    include('forms/addserver.php');

    echo "<p>&nbsp;</p>
            <p class=\"sectionLabel\">Lista serwerów</p>
            <hr class=\"horizonLine\" />";

    $tName = 'servers';
    $csh = 'id,addr,uname,auth';
    
    $result = selectf($connection, $tName, $csh);

    if ( mysql_check_result($connection, $result) ) {
        if ( mysqli_num_rows($result) ) {

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

                if ( $row[3] === 'rsa' ) {
                    $row[3] = 'Klucz publiczny';
                } else {
                    $row[3] = 'Hasło';
                }

                echo "<tr>
                        <th scope=\"row\">" . $j . "</th>
                        <td>" . $row[1] . "</td>
                        <td>" . $row[2] . "</td>
                        <td>" . $row[3] . "</td>
                        <td><a href=\"index.php?page=console&id=" . $row[0] . "\" style=\"color: #28a745;\">Połącz</a></td>
                        <td><a href=\"index.php?page=modserver&mod_id=" . $row[0] . "\" style=\"color: #ffc107;\">Modyfikuj</a></td>
                        <td><a href=\"index.php?page=delserver&del_id=" . $row[0] . "\" style=\"color: #dc3545;\">Usuń</a></td>
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