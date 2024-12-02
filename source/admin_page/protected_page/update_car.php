<?php
try {
    // Подключение к базе данных
    include __DIR__ . '/../../db.php';

    // Получение данных из POST-запроса
    $data = json_decode($_POST['data'], true);

    // Подготовка запросов для обновления данных
    $updateAllCarQuery = "UPDATE all_car SET 
        car_brand = :car_brand,
        model = :model,
        yeat_release = :year_release,
        mileage = :mileage,
        equipment = :equipment,
        price = :price,
        status = :status
        WHERE id = :id";

    $updateThisAutoQuery = "UPDATE this_auto SET 
        type_body = :type_body,
        horsepower = :horsepower,
        racing = :racing,
        maximum_speed = :maximum_speed,
        description = :description,
        salon = :salon,
        difference = :difference,
        body_description = :body_description
        WHERE id_auto = :id_auto"; // Исправлено имя параметра

    // Подготовка запросов
    $stmt1 = $pdo->prepare($updateAllCarQuery);
    $stmt2 = $pdo->prepare($updateThisAutoQuery);

    foreach ($data as $row) {
        // Обновление таблицы all_car
        $stmt1->execute([
            ':car_brand' => $row['car_brand'],
            ':model' => $row['model'],
            ':year_release' => $row['year_release'],
            ':mileage' => $row['mileage'],
            ':equipment' => $row['equipment'],
            ':price' => $row['price'],
            ':status' => $row['status'],
            ':id' => $row['id']
        ]);

        // Обновление таблицы this_auto
        $stmt2->execute([
            ':type_body' => $row['type_body'],
            ':horsepower' => $row['horsepower'],
            ':racing' => $row['racing'],
            ':maximum_speed' => $row['maximum_speed'],
            ':description' => $row['description'],
            ':salon' => $row['salon'],
            ':difference' => $row['difference'],
            ':body_description' => $row['body_description'],
            ':id_auto' => $row['id']  // Используем тот же ID для связи между таблицами
        ]);
    }

    echo 1; // Успешное обновление
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>