<?
function getAutosFromDatabase() {
  try {
    // Подключение к базе данных
    $pdo = new PDO("mysql:host=localhost;dbname=kirillwor3", 'kirillwor3', '73HotCat91');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
