<?php

    include ('modules/ssh_connect.php');

    echo "<p>&nbsp;</p>
            <p class=\"sectionLabel\">Konsola</p>
            <hr class=\"horizonLine\" />";


if ( ( ! empty($ssh) ) && ( ! isset($_GET['loginerror']) ) ) {

    echo "<div id=\"console\">
            <pre>";

            $hostname = $ssh->exec('hostname');
            $hostname = substr($hostname, 0, (strlen($hostname) - 1));

    if ( ! empty($_POST['command']) ) { 

        $command = $_POST['command'];
        if ( $uname !== 'root' ) {
                echo $uname . "@" . $hostname . ":~$ " . $command . "\n";
        } else {
                echo $uname . "@" . $hostname . ":~# " . $command . "\n";
        }
        echo $ssh->exec($command);
        echo ""; 
        echo "Polecenie zakończyło działanie zwracając: " . $ssh->getExitStatus();
    }

    echo "</pre>";
    echo "<form action=\"index.php?page=console&id=" . $_GET['id'] . "\" method=\"post\">
            <input type=\"hidden\" name=\"id\" value=\"" . $_GET['id'] . "\" />";
    if ( $uname !== 'root' ) {
        echo "<label for=\"cmd_input\">" . $uname . "@" . $hostname . ":~$&nbsp;</label>";
    } else {
        echo "<label for=\"cmd_input\">" . $uname . "@" . $hostname . ":~#&nbsp;</label>";
    }
    echo "<input id=\"cmd_input\" type=\"text\" name=\"command\" style=\"width: 800px; border: 0; background-color: inherit; font-familiy: monospace\"/>
            </form>
        </div>";
}

?>