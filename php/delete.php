<?php
    $connection = mysqli_connect('127.0.0.1','root', '','test');
    $id = $_POST['id'];
    $update = 'UPDATE clients SET status = 2 WHERE id = '.$id;
    mysqli_query($connection,$update);
    echo "Клиент удален";
    mysqli_close($connection);
?>