<?php
try {
    include __DIR__ . '/../../db.php';

    if (!$conn) {
        throw new Exception("Ошибка подключения к базе данных.");
    }

    if (isset($_POST['data'])) {
        $data = json_decode($_POST['data'], true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "Ошибка декодирования JSON: " . json_last_error_msg();
            exit;
        }

        if (!empty($data)) {
            foreach ($data as $row) {
                $id = $conn->real_escape_string($row['id']);
                
                // Создаем строку для обновления
                $updateFields = [];
                foreach ($row as $key => $value) {
                    if ($key !== 'id') { // Пропускаем ID
                        $value = $conn->real_escape_string($value);
                        $updateFields[] = "$key = '$value'";
                    }
                }
                
                // Формируем SQL-запрос для обновления
                $sql = "UPDATE this_auto SET " . implode(', ', $updateFields) . " WHERE id = '$id'";
                
                // Логируем запрос для отладки
                file_put_contents('log.txt', "SQL: $sql\n", FILE_APPEND);

                // Выполняем запрос
                if (!$conn->query($sql)) {
                    echo "Ошибка выполнения запроса: " . $conn->error;
                    exit;
                }
            }
            
            echo 1; // Успешное выполнение
        } else {
            echo 'Массив data пуст.';
            exit; // Нет данных для обновления
        }
    } else {
        echo 'Нет данных в POST-запросе.';
    }

} catch(Exception $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
?>