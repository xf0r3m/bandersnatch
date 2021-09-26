<?php


echo "<p>&nbsp;</p><p class=\"sectionLabel\">Inwentaryzacja serwera</p>
<hr class=\"horizonLine\" />";

include('modules/ssh_connect.php');

if ( ! empty($ssh) && ( empty($_GET['loginerror']) ) ) {
    echo "<div class=\"border rounded overflow-auto\" style=\"height: 50vh;\">
        <pre style=\"padding-left: 5px;\">";
    echo $ssh->exec('inxi -c 0 -v 7');
    echo "<pre>
            </div>";
}



?>