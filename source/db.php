<?php
// db.php

try {
    
    $pdo = new PDO("mysql:host=db;dbname=kirillwor3;port=3306", 'user', '73HotCat91');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ошибка подключения: ' . $e->getMessage(); 
    exit;
}
?>