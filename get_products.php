<?php 

    require_once ("connection.php");

    $q = "SELECT * FROM produkte";

    $result = $conn->query($q);

    $holder_array = Array();

    while ($row=$result->fetch_assoc()){
        //echo "$row[produktID] $row[modell] $row[nettopreis] $row[details] $row[blaskraft] <img src='$row[produktbild]'/> <br>";
        $holder_array[] = $row;
    }

    $json_array = json_encode($holder_array);
    //var_dump($json_array);   String JSON Array von Objekte, diese Objekte sind assoziative Arrays

    file_put_contents("products.json", $json_array);

?>