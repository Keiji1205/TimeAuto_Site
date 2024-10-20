<?
function getRequestsFromDatabase() {
  try {
    // Подключение к базе данных
    $pdo = new PDO("mysql:host=localhost;dbname=kirillwor3", 'kirillwor3', '73HotCat91');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
