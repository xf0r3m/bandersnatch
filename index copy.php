<!DOCYTPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>BANDERSNATCH</title>
        <link rel="stylesheet" href="style.css" />
        <!--BOOTSTRAP-->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!--KONIEC BOOTSTRAP-->
    </head>
    <body>
        <div class="container-fluid">
    <?php

        set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');

        include('db_conf.php');
        include('library.php');

        if ( session_status() !== 2 ) { session_start(); }
        if ( isset($_SESSION['username']) ) {

            if ( empty($_GET['page']) ) { $_GET['page']='start'; }

            include('menu.php');

            echo "<div id=\"content\">
                <div id=\"logo\">
                <nav class=\"navbar navbar-light bg-light\">
                    <a class=\"navbar-brand\" href=\"index.php?page=start\">Bandersnatch</a>
                </nav>
                </div>";

            include('modules/' . $_GET['page'] . ".php");

            echo "</div>";

        } else {
            $tName = 'users';
            $csh = "*";
            $result = selectf($connection, $tName, $csh);
            if ( mysql_check_result($connection, $result) ) {

                if ( mysqli_num_rows($result) > 0 ) {
                    include('modules/login.php');
                } else {
                    include('modules/firstlogin.php');
                }

            }
        }
    ?>
    </div>
    <!--BOOTSTRAP-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!--KONIEC BOOTSTRAP-->
    <script src="resources/jquery-3.4.1.min.js"></script>
    <script src="code.js"></script>
    </body>
</html>