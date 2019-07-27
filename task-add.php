<?php

    include('connection.php');

    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $description = $_POST['description'];

        $sql = "INSERT INTO task(name, description) VALUES ('$name', '$description')";
        $resultset = mysqli_query($connect, $sql);

        if(!$resultset) die('Operation failed');
        else echo 'Operation Succeeded';
    }

?>