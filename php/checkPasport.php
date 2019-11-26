<?php 
    $id = $_POST['id'];
    $result = true;
    if($id<=0){
        $dbh = new PDO('mysql:host=127.0.0.1;port=3307;dbname=test', 'root', '');
        $stmt = $dbh->prepare("SELECT id FROM clients WHERE pasportSeries = :pasportSeries AND pasportId =:pasportId");
        $stmt->bindParam(':pasportSeries', $_POST['pasportSeries']);
        $stmt->bindParam(':pasportId', $_POST['pasportId']);
        $stmt->execute();
        while($row = $stmt->fetch()){
            $result=false;
        }
    }
    echo $result;
?>