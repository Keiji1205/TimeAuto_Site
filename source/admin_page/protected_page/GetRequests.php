<?
function getRequestsFromDatabase() {
  try {
    // Подключение к базе данных
    include __DIR__ . '/../../db.php';

    // Запрос к базе данных
    $sql = "SELECT * FROM requests";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Получение данных из результата запроса
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $requests;

  } catch(PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    return false;
  }
}
