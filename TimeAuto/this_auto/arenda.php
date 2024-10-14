<?php
// Подключение к базе данных
$pdo = new PDO("mysql:host=localhost;dbname=kirillwor3", 'kirillwor3', '73HotCat91');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Подготовка запроса
$stmt = $pdo->prepare('INSERT INTO arenda(name, phone, pasport_nomer, pasport_data, pasport_kod, pasport_issued, car, yeat_release, mileage, equipment, price) VALUES(:name, :phone, :pasport_nomer, :pasport_data, :pasport_kod, :pasport_issued, :car, :yeat_release, :mileage, :equipment, :price)');

// Привязка значений к параметрам запроса
$stmt->bindValue(':name', $_POST['name_arenda']);
$stmt->bindValue(':phone', $_POST['phone_arenda']);
$stmt->bindValue(':pasport_nomer', $_POST['pasport_nomer']);
$stmt->bindValue(':pasport_data', $_POST['pasport_data']);
$stmt->bindValue(':pasport_kod', $_POST['pasport_kod']);
$stmt->bindValue(':pasport_issued', $_POST['pasport_issued']);
$stmt->bindValue(':car', $_POST['car']);
$stmt->bindValue(':yeat_release', $_POST['yeat_release']);
$stmt->bindValue(':mileage', $_POST['mileage']);
$stmt->bindValue(':equipment', $_POST['equipment']);
$stmt->bindValue(':price', $_POST['carPrice']); 

// Выполнение запроса
if ($stmt->execute()) {
  echo '1'; 
}