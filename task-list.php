<?php

    include('connection.php');
    $sql = "SELECT * FROM task";
    $resultset = mysqli_query($connect, $sql);

    if(!$resultset) die('Query failed' . mysqli_error($connect));
    else {

        $json = array();

        while($row = mysqli_fetch_array($resultset)){
            $json[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description']
            );
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

?>