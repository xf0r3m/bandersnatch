<?php

echo "<div class=\"output\">";
include('modules/ssh_connect.php');

if ( ( ! empty($ssh) ) && ( empty($_GET['loginerror']) ) ) { 

    $pwd = $ssh->exec('pwd');

    if ( isset($_GET['rdir']) ) {

        $list = $ssh->exec('ls -p ' . $_GET['rdir']);

    } else {
        $list = $ssh->exec('ls -p');
    }

    //var_dump(urlencode($list));
    echo "<div class=\"dirContainer\">";
    echo "<h3 class=\"dirLabel\">Katalog zdalny</h3>";
    echo "<div class=\"dirOutput border rounded overflow-auto\">";
    $listTab = explode('%0A', urlencode($list));
    echo "<br /><code>-------------------------------------</code><br />";
    if ( ! isset($_GET['rdir']) ) {  
        echo "<code><a class=\"dir_link\" href=\"index.php?page=" . $_GET['page'] . "&id=" . $_GET['id'] . "&rdir=" . substr($pwd, 0, strrpos($pwd, '/')) . "\">FOLDER NADRZĘDNY</a></code><br />";
    } else if ( strrpos($_GET['rdir'], '/') === 0 ) {
        echo "<code><a class=\"dir_link\" href=\"index.php?page=" . $_GET['page'] . "&id=" . $_GET['id'] . "&rdir=" . substr($pwd, 0, ( strrpos($_GET['rdir'], '/') + 1)) . "\">FOLDER NADRZĘDNY</a></code><br />";
    } else {
        echo "<code><a class=\"dir_link\" href=\"index.php?page=" . $_GET['page'] . "&id=" . $_GET['id'] . "&rdir=" . substr($_GET['rdir'], 0, strrpos($_GET['rdir'], '/')) . "\">FOLDER NADRZĘDNY</a></code><br />";
    }

    echo "<code>-------------------------------------</code><br />";

    for( $i=0; $i < count($listTab); $i++ ) {
        $listTab[$i] = urldecode($listTab[$i]);

        if ( stripos($listTab[$i], '/') !== FALSE ) {
            if ( ! empty($_GET['rdir'])) {
                echo "<code><a class=\"dir_link\" href=\"index.php?page=" . $_GET['page'] . "&id=" . $_GET['id'] . "&rdir=" . $_GET['rdir'] . '/' . substr($listTab[$i], 0, -1) . "\">" . $listTab[$i] . "</a></code><br />";
            } else {
                echo "<code><a class=\"dir_link\" href=\"index.php?page=" . $_GET['page'] . "&id=" . $_GET['id'] . "&rdir=" . substr($listTab[$i], 0, -1) . "\">" . $listTab[$i] . "</a></code><br />";
            }
        } else {
            if ( ! empty($_GET['rdir']) ) {
                echo "<code><a class=\"file_link\" href=\"index.php?page=sftp&id=" . $_GET['id'] . "&action=get&path=" . $_GET['rdir'] . "/" . $listTab[$i] . "\">" . $listTab[$i] . "</a></code><br />";
            } else {
                echo "<code><a class=\"file_link\" href=\"index.php?page=sftp&id=" . $_GET['id'] . "&action=get&path=" . $pwd . "/" . $listTab[$i] . "\">" . $listTab[$i] . "</a></code><br />";
            }
        }
    }
    echo "</div>
    </div>";
    echo "<div class=\"dirContainer\" style=\"margin-left: 10%;\">
    <h3 class=\"dirLabel\">Katalog lokalny</h3>";
    echo "<div class=\"dirOutput border rounded overflow-auto\">";
    
        if (  empty($_GET['sdir']) ) {
            $_GET['sdir'] = 'files';
        }

        $filelist = scandir($_GET['sdir']);
        
        echo "<br /><code>-------------------------------------</code><br />";

        if ( ( empty($_GET['sdir']) ) || ( $_GET['sdir'] === 'files' ) ) {
            echo "<code><a class=\"dir_link\" href=\"index.php?page=" . $_GET['page'] . "&id=" . $_GET['id'] . "&sdir=files\">FOLDER NADRZĘDNY</a></code><br />";
        } else if ( $_GET['sdir'] === 'files' ) {
            echo "<code>
            <a class=\"dir_link\" href=\"index.php?page=" . $_GET['page'] . "&id=" . $_GET['id'] . "&sdir=" . substr($_GET['sdir'], 0, strrpos($_GET['sdir'], '/')) . "\">FOLDER NADRZĘDNY</a></code><br />";
        }

        echo "<code>-------------------------------------</code><br />";

        for ( $i=2; $i < count($filelist); $i++ ) {
            if ( filetype( $_GET['sdir'] . "/" . $filelist[$i] ) === 'dir' ) {
                echo "<code><a class=\"file_link\" href=\"index.php?page=" . $_GET['page'] . "&id=" . $_GET['id'] . "&sdir=" . $_GET['sdir'] . "/" . $filelist[$i] . "\">" . $filelist[$i] . "</a></code><br />";
            } else if ( empty($_GET['rdir']) ) {
                echo "<code><a class=\"file_link\" href=\"index.php?page=sftp&id=" . $_GET['id'] . "&action=put&lpath=" . $_GET['sdir'] . "/" . $filelist[$i] . "&rpath=" . $pwd . "\">" . $filelist[$i] . "</a></code><br />";
            } else {
                echo "<code><a class=\"file_link\" href=\"index.php?page=sftp&id=" . $_GET['id'] . "&action=put&lpath=" . $_GET['sdir'] . "/" . $filelist[$i] . "&rpath=" . $pwd . "/" . $_GET['rdir'] . "\">" . $filelist[$i] . "</a></code><br />";
            }
        }


    echo "</div>
    </div>";
    echo "</div>";
}
?>