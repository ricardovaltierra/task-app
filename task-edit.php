<?php

    include('connection.php');
    
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description =  $_POST['description'];

        $sql = "UPDATE task SET name = '$name' , description = '$description' WHERE id = '$id'";
        $resultset = mysqli_query($connect, $sql);

        if(!$resultset) die('Operation failed');
        else echo 'Operation Succeeded';
    }

?>