<?php

    include('connection.php');
    $search = $_POST['search'];

    if(!empty($search)){
        $sql = "SELECT * FROM task WHERE name LIKE '$search%'";
        $resultset = mysqli_query($connect, $sql);
        $json = array();
        
        if(!$resultset) die('Error in query: ' . mysqli_error($connect));
        
        while($row = mysqli_fetch_array($resultset)){
            $json[] =  array(
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description']
            );
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

?>