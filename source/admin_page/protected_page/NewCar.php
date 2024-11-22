<?php

include __DIR__ . '/../../db.php';
try {
    if (!isset($_POST['carData'])) { 
        throw new Exception("Данные не переданы");
    }

    $data = json_decode($_POST['carData'], true);
    
    if ($data === null) {
        throw new Exception("Ошибка декодирования JSON");
    }
    
    $basePathFront = "../../auto/pic"; // Базовый путь
    $basePathBack = "../../this_auto/pic"; // Базовый путь
    $folderBrand = $data['brand']; // Имя папки
    $folderModel = $data['model']; // Имя папки

    // Полный путь к папке для загрузки
    $fullPathBack = $basePathBack . '/' . $folderBrand . '/' . $folderModel; 

    if (!file_exists($fullPathBack)) {
         mkdir($fullPathBack, 0777, true); // Создание папки для задних изображений
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
         ':photo_front' => $data['brand'].'_'.$data['model'].'_front.webp',
         ':photo_back' => $data['brand'].'_'.$data['model'].'_back.webp'
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
         ':photo_preview' => 'preview.webp',
         ':photo_salon' => 'salon.webp',
         ':general_view' => 'general_view.webp',
         ':sport' => 'sport.webp'
     ]);
     
     // Загрузка передних изображений
     if (isset($_FILES['fileToUploadFront'])) {
         foreach ($_FILES['fileToUploadFront']['tmp_name'] as $key => $tmpName) {
             if ($_FILES['fileToUploadFront']['error'][$key] == UPLOAD_ERR_OK) {
                 $targetFilePath = $basePathFront . '/' . basename($_FILES["fileToUploadFront"]["name"][$key]);
                 
                 if (!move_uploaded_file($tmpName, $targetFilePath)) {
                     echo "Ошибка при загрузке переднего изображения " . $_FILES["fileToUploadFront"]["name"][$key] . ".";
                 }
             } else {
                 echo "Ошибка при загрузке переднего изображения " . $_FILES["fileToUploadFront"]["name"][$key] . ".";
             }
         }
     }

     // Загрузка задних изображений
     if (isset($_FILES['fileToUploadBack'])) {
         foreach ($_FILES['fileToUploadBack']['tmp_name'] as $key => $tmpName) {
             if ($_FILES['fileToUploadBack']['error'][$key] == UPLOAD_ERR_OK) {
                 $targetFilePath = $fullPathBack . '/' . basename($_FILES["fileToUploadBack"]["name"][$key]);
                 
                 if (!move_uploaded_file($tmpName, $targetFilePath)) {
                     echo "Ошибка при загрузке заднего изображения " . $_FILES["fileToUploadBack"]["name"][$key] . ".";
                 }
             } else {
                 echo "Ошибка при загрузке заднего изображения " . $_FILES["fileToUploadBack"]["name"][$key] . ".";
             }
         }
     }

     echo 1; // Успешное обновление и загрузка файлов

} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
} catch (PDOException $e) {
    echo "Ошибка базы данных: " . $e->getMessage();
}

?>