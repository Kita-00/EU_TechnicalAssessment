<?php
//LOCALHOST
    /*
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "dbtech";

        $con = mysqli_connect($servername, $username, $password, $db);

        if (!$con)
            die("Connection failed: " .mysqli_connect_error());

    */

    $servername = getenv('CLOUDSQL_DSN');
    $username = getenv('CLOUSSQL_USER');
    $password = getenv('CLOUDSQL_PASSWORD');
    $db = getenv('CLOUDSQL_DB');
    
    $con = mysqli_connect($servername, $username, $password, $db);
    
    if (!$con)
        die("Connection failed: " .mysqli_connect_error());




?>