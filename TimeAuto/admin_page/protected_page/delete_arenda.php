<?
$pdo = new PDO("mysql:host=localhost;dbname=kirillwor3", 'kirillwor3', '73HotCat91');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = json_decode($_POST['data']);

if (is_array($data)) {
  // Перебираем массив ID
  foreach ($data as $id) {
    // Запрос на удаление строки из таблицы
    $sql = "DELETE FROM arenda WHERE id = $id";

    // Prepare the statement
    $stmt = $pdo->prepare($sql); 

    try {
        // Execute the statement
        $stmt->execute(); 
    } catch(PDOException $e) {
        // Log the error for debugging
        error_log("Database error: " . $e->getMessage());
        echo '0'; // Send error to the client
        exit; // Stop execution after an error
    }

    // Отправляем успешный ответ
    echo '1'; 
}} else {
    // Отправляем ошибку
    echo '0'; 
}