<?
function getFeedbackFromDatabase() {
  try {
    // Подключение к базе данных
    include __DIR__ . '/../../db.php';

    // Запрос к базе данных
    $sql = "SELECT * FROM feedback";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Получение данных из результата запроса
    $feedback = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $feedback;

  } catch(PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    return false;
  }
}
