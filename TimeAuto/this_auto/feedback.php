<?php
// Подключение к базе данных
$pdo = new PDO("mysql:host=localhost;dbname=kirillwor3", 'kirillwor3', '73HotCat91');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Подготовка запроса
$stmt = $pdo->prepare('INSERT INTO feedback(name, phone, feedback, car, yeat_release, mileage, equipment, price, id_auto) VALUES(:name, :phone, :feedback, :car, :yeat_release, :mileage, :equipment, :price, :id_auto)');

// Привязка значений к параметрам запроса
$stmt->bindValue(':name', $_POST['name_feedback']);
$stmt->bindValue(':phone', $_POST['phone_feedback']);
$stmt->bindValue(':feedback', $_POST['feedback_input']);
$stmt->bindValue(':car', $_POST['car']);
$stmt->bindValue(':yeat_release', $_POST['yeat_release']);
$stmt->bindValue(':mileage', $_POST['mileage']);
$stmt->bindValue(':equipment', $_POST['equipment']);
$stmt->bindValue(':price', $_POST['carPrice']); 
$stmt->bindValue(':id_auto', $_POST['id_auto']); 

// Выполнение запроса
if ($stmt->execute()) {
  echo '1'; 
}