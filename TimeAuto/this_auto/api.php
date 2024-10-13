<?php
// Подключение к базе данных
$pdo = new PDO("mysql:host=localhost;dbname=kirillwor3", 'kirillwor3', '73HotCat91');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Подготовка запроса
$stmt = $pdo->prepare('INSERT INTO requests(name, phone) VALUES(:name, :phone)');

// Привязка значений к параметрам запроса
$stmt->bindValue(':name', $_POST['name']); // Без $ и кавычек
$stmt->bindValue(':phone', $_POST['phone']); // Без $ и кавычек

// Выполнение запроса
if ($stmt->execute()) {
  echo '1'; 
}
