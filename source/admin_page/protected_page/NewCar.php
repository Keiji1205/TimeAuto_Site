<?php

    include __DIR__ . '/../../db.php';
try{
    if (!isset($_POST['carData'])) { 
        throw new Exception("Данные не переданы");
    }

    $data = json_decode($_POST['carData'], true);
    
    if ($data === null) {
        throw new Exception("Ошибка декодирования JSON");
    }
    
    $basePath = "../../this_auto/pic"; // Базовый путь
    $folderBrand = $data['brand']; // Имя папки
    $folderModel = $data['model']; // Имя папки

    // Полный путь
    $fullPath = $basePath . '/' . $folderBrand . '/' . $folderModel; 

    if (!file_exists($fullPath)) {
        mkdir($fullPath, 0777, true); // Создание папки
        echo "Папка '$fullPath' создана.";
    } else {
        echo "Папка '$fullPath' уже существует.";
    }


    // Подготовка запросов для обновления данных
    $InsertAllCarQuery = "INSERT INTO all_car(car_brand, model, yeat_release, mileage, equipment, price, photo_front, photo_back) VALUES(:car_brand, :model, :yeat_release, :mileage, :equipment, :price, :photo_front, :photo_back)";  

    $InsertThisAutoQuery = "INSERT INTO this_auto(id_auto, type_body, horsepower, racing, maximum_speed, description, salon, difference, body_description, cost, photo_preview, photo_salon, general_view, sport) VALUES(:id_auto, :type_body, :horsepower, :racing, :maximum_speed, :description, :salon, :difference, :body_description, :cost, :photo_preview, :photo_salon, :general_view, :sport)";  
   
    // Подготовка запросов
    $stmt1 = $pdo->prepare($InsertAllCarQuery);

    // Обновление таблицы all_car
    $stmt1->execute([
        ':car_brand' => $data['brand'],
        ':model' => $data['model'],
        ':yeat_release' => $data['year_release'],
        ':mileage' => $data['mileage'],
        ':equipment' => $data['equipment'],
        ':price' => $data['price'],
        ':photo_front' => $data['price'], 
        ':photo_back' => $data['price'], 
    ]);

    // Получаем последний вставленный ID из таблицы all_car
    $lastId = $pdo->lastInsertId();

    // Подготовка второго запроса
    $stmt2 = $pdo->prepare($InsertThisAutoQuery);

    // Обновление таблицы this_auto
    $stmt2->execute([
        ':id_auto' => $lastId,
        ':type_body' => $data['type_body'],
        ':horsepower' => $data['horsepower'],
        ':racing' => $data['racing'],
        ':maximum_speed' => $data['maximum_speed'],
        ':description' => $data['description'],
        ':salon' => $data['salon'],
        ':difference' => $data['difference'],
        ':body_description' => $data['body_description'],
        ':cost' => $data['price'],
        ':photo_preview' => $data['price'],
        ':photo_salon' => $data['price'],
        ':general_view' => $data['price'],
        ':sport' => $data['price']
    ]);

    echo 1; // Успешное обновление
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
} catch (PDOException $e) {
    echo "Ошибка базы данных: " . $e->getMessage();
}

?>