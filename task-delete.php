<?php

    include('connection.php');
    
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $sql = "DELETE FROM task WHERE id = '$id'";
        $resultset = mysqli_query($connect,$sql);

        if(!$resultset) die('Operation failed.');
        else echo "Operation succeeded";
    }
    

?>