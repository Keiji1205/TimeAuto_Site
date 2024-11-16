<?
function getAutosFromDatabase() {
  try {
    // Подключение к базе данных
    include '../db.php';

    // Запрос к базе данных
    $sql = "SELECT * FROM all_car";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Получение данных из результата запроса
    $car = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $car;

  } catch(PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    return false;
  }
}
