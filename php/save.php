<?php
    $dbh = new PDO('mysql:host=127.0.0.1;port=3307;dbname=test', 'root', '');
    $id = $_POST['id'];
    if ($id <=0){//вставка нового контакта

        $insertCl = $dbh->prepare("INSERT INTO clients (name, surname, patronymic, whenIssued, pasportSeries,pasportId, whereIssued) VALUES (:name, :surname, :patronymic, :whenIssued, :pasportSeries, :pasportId, :whereIssued)");
        $insertCl->bindParam(':name', $_POST['name']);
        $insertCl->bindParam(':surname', $_POST['surname']);
        $insertCl->bindParam(':patronymic', $_POST['patronymic']);
        $insertCl->bindParam(':pasportSeries', $_POST['pasportSeries']);
        $insertCl->bindParam(':pasportId', $_POST['pasportId']);
        $insertCl->bindParam(':whenIssued', $_POST['whenIssued']);
        $insertCl->bindParam(':whereIssued', $_POST['whereIssued']);
        $insertCl->execute();

        $insertad = $dbh->prepare("INSERT INTO adresses (city, street, house, apartment) VALUES (:city, :street, :house, :apartment)");
        $insertad->bindParam(':city', $_POST['city']);
        $insertad->bindParam(':street', $_POST['street']);
        $insertad->bindParam(':house', $_POST['house']);
        $insertad->bindParam(':apartment', $_POST['apartment']);
        $insertad->execute();

        $insertC = $dbh->prepare("INSERT INTO contacts (telephoneNumber, mail) VALUES (:telephoneNumber, :mail)");
        $insertC->bindParam(':telephoneNumber', $_POST['telephoneNumber']);
        $insertC->bindParam(':mail', $_POST['mail']);
        $insertC->execute();

    }else{//обновление старого
        $updateCl = $dbh->prepare("UPDATE clients SET created_changedDate = NOW() WHERE id = :id");
        $updateCl->bindParam(':id', $id);
        $updateCl->execute();

        $updateCl = $dbh->prepare("UPDATE adresses SET city = :city, street = :street, house = :house, apartment = :apartment WHERE ad_id = :id");
        $updateCl->bindParam(':city', $_POST['city']);
        $updateCl->bindParam(':street', $_POST['street']);
        $updateCl->bindParam(':house', $_POST['house']);
        $updateCl->bindParam(':apartment', $_POST['apartment']);
        $updateCl->bindParam(':id', $id);
        $updateCl->execute();

        $updateC = $dbh->prepare("UPDATE contacts SET telephoneNumber = :telephoneNumber, mail = :mail WHERE con_id = :id");
        $updateC->bindParam(':telephoneNumber', $_POST['telephoneNumber']);
        $updateC->bindParam(':mail', $_POST['mail']);
        $updateC->bindParam(':id', $id);
        $updateC->execute();
    }
    echo mysqli_connect_error();
    echo 'Контакт Сохранен';
?>