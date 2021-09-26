<?php

if ( ! empty($_POST) ) {

    $tName = 'users';
    $csh = 'uname,hash,role';
    $pKL = generatePKL($tName, $csh);

    $_POST['users_hash'] = password_hash($_POST['users_password'], PASSWORD_DEFAULT);

    $result = insertf($connection, $tName, $csh, $pKL);
    if ( mysql_check_result($connection, $result) ) {

        echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
        <strong>Pomyślnie</strong> dodano użytkownika.
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
    </div>";
    }

}

echo "<p>&nbsp</p>";

if ( ! empty($_GET['deluser']) ) {

    echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
    <strong>Pomyślnie</strong> usunięto użytkownika.
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">&times;</span>
    </button>
</div>";

}

include ('forms/adduser.php');

echo "<p>&nbsp;</p>
<p class=\"sectionLabel\">Lista użytkowników</p>
<hr class=\"horizonLine\" />";

$tName = 'users';
$csh = 'id,uname,role';

$result = selectf($connection, $tName, $csh);

if ( mysql_check_result($connection, $result) ) {
    if ( mysqli_num_rows($result) ) {

        echo "<table class=\"table\">
                <thead>
                <tr>
                    <th scope=\"col\">#</th>
                    <th scope=\"col\">Nazwa użytkownika</th>
                    <th scope=\"col\">Rola</th>
                    <th scope=\"col\" colspan=\"2\">Akcje</th>
                </tr>
                </thead>
                <tbody>";
        $j=1;
        while ( $row = mysqli_fetch_row($result) ) {

            if ( $row[3] === 'admin' ) {
                $row[3] = 'Administrator';
            } else {
                $row[3] = 'Użytkownik';
            }

            echo "<tr>
                    <th scope=\"row\">" . $j . "</th>
                    <td>" . $row[1] . "</td>
                    <td>" . $row[2] . "</td>
                    <td><a href=\"index.php?page=resetpassword&user_id=" . $row[0] . "\">Resetuj hasło</a></td>
                    <td><a href=\"index.php?page=deluser&user_id=" . $row[0] . "\" style=\"color: #dc3545;\">Usuń</a></td>
                </tr>";

            $j++;
        } 

        echo "</tbody>
        </table>";
    } else {
        echo "
        <div class=\"alert alert-primary\" role=\"alert\">
                Nie znaleziono żadnych użytkowników.
            </div>";
    }
}

?>