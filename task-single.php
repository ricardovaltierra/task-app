<?php

    include('connection.php');
    
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $sql = "SELECT * FROM task WHERE id = '$id'";
        $resultset = mysqli_query($connect,$sql);

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

            $jsonstring = json_encode($json[0]);
            echo $jsonstring;
        }
    }

?>