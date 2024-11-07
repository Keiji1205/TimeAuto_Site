<?
function getCarInfoFromDatabase() {
  try {
    // Подключение к базе данных
    include __DIR__ . '/../../db.php';

    // Запрос к базе данных
    $sql = "SELECT * FROM this_auto JOIN all_car ON this_auto.id_auto = all_car.id";
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
