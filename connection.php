<?php 

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "windmann";

    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die("Datenbank nicht gefunden" . $conn->connect_error);
    }

?>