<?
function getArendaFromDatabase() {
  try {
    // Подключение к базе данных
    include '../db.php';

    // Запрос к базе данных
    $sql = "SELECT * FROM arenda";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Получение данных из результата запроса
    $arenda = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $arenda;

  } catch(PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    return false;
  }
}
