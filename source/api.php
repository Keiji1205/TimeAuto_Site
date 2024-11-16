<?php
// Подключение к базе данных с указанием порта
include 'db.php';

// Подготовка запроса
$stmt = $pdo->prepare('INSERT INTO requests(name, phone) VALUES(:name, :phone)');

// Привязка значений к параметрам запроса
$stmt->bindValue(':name', $_POST['name']); // Без $ и кавычек
$stmt->bindValue(':phone', $_POST['phone']); // Без $ и кавычек

// Выполнение запроса
if ($stmt->execute()) {
  echo '1'; 
}