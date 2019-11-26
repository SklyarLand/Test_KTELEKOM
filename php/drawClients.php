<?php
    echo "<option value='-1'>Новый клиент</option>";
    $connection = mysqli_connect('127.0.0.1','root', '','test');
    if ($connection ==false){
        echo 'Не удалось подключиться к базе данных';
        echo mysqli_connect_error();
        exit();
    }
    $result = mysqli_query($connection, 'SELECT id, name, surname, patronymic FROM clients WHERE status=1');
    while($record = mysqli_fetch_assoc($result)){
        $fullname = $record['surname'].' '.$record['name'].' '.$record['patronymic'];
        $id = $record['id'];
        echo "<option value='$id'>$fullname</option>";
    }
    mysqli_close($connection);
?>