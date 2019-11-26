<?php
    $id = $_POST['id'];
    $connection = mysqli_connect('127.0.0.1','root', '','test');
    $clientArr = mysqli_query($connection, 'SELECT * FROM clients cl JOIN adresses ad ON cl.id=ad.ad_id JOIN contacts con ON cl.id=con.con_id WHERE cl.id='.$id);
    $client = mysqli_fetch_assoc($clientArr);  
    echo json_encode((array)$client);
    mysqli_close($connection);
?>