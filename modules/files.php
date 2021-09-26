<?php
echo "<p>&nbsp;</p><p class=\"sectionLabel\">Pliki</p>
        <hr class=\"horizonLine\" />";

//Użyto funkcji "human_filesize" z : https://www.php.net/manual/en/function.filesize#Hcom106569
//autorstwa:  rommel@rommelsantor.com

function human_filesize($bytes, $decimals = 2) {
    $sz = 'BKMGTP';
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

if ( isset($_GET['savefile']) ) {

    if ( $_GET['savefile'] === "1" ) {
        echo "<p>&nbsp;</p>";

        echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                <strong>Pomyślnie</strong> zapisano plik.
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>";
    } else {
        echo "<p>&nbsp;</p>";

        echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
        Zapisanie pliku <strong>nie powiodło</strong> się.
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
    </div>";
    }
}
    
$files = scandir('files');
if ( count($files) >=  3 ) {
    echo "<table class=\"table\">
        <thead>
        <tr>
            <th scope=\"col\">#</th>
            <th scope=\"col\">Nazwa</th>
            <th scope=\"col\">Rozmiar</th>
            <th scope=\"col\">Data modyfikacji</th>
            <th scope=\"col\">Usuń</th>
        </tr>
        </thead>
        <tbody>";
    $j=1;
    for($i=2; $i < count($files); $i++) {

        echo "<tr>
                <th scoope=\"row\">" . $j . "</th>
                <td><a href=\"index.php?page=edit&path=files/" . $files[$i] . "\">" . $files[$i] . "</a></td>
                <td>" . human_filesize(filesize('files/' . $files[$i])) . "</td>
                <td>" . date('d-m-Y H:i:s', filemtime('files/' . $files[$i])) . "</td>
                <td><a href=\"index.php?page=deletefile&path=files/" . $files[$i] . "\" style=\"color: #dc3545;\">Usuń</a></td>
            </tr>";

        $j++; 
    }
    echo "</tbody>
    </table>";
}
?>