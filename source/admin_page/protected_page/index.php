<?php
session_start();
if (isset($_SESSION['username'])) {
    // Сессия активна, выводим приветствие
    $username = $_SESSION['username']; // Retrieve the username from the session
    echo "<script>alert('Добро пожаловать, " . $username . "!');</script>";
} else {
    // Сессия не активна, перенаправляем на страницу входа
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&family=Raleway&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@800&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="styles.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <title>TimeAuto_Admin</title>
</head>
<body>
<div class="modal_back" style="display:none;" id="modal_back"></div>
<div class="modal_alert" style="display:none;" id="modal_alert">
  <h1 style="color:red;">Внимание</h1>
  <h3>Перед отправкой файлов на сервер, убедитесь что наименование и формат фотографий правильный. Это важно для работы сайта.</h3>
  <button class="btn_modal" style="background-color: #00d300;" id="modal_confirm">Подтвердить</button>
  <button class="btn_modal"  id="modal_back_btn">Отмена</button>
</div>

<div class="nav_btn">
  <button class="btn" type="submit" id="requests">Заявки</button>
  <button class="btn" type="submit" id="arenda">Аренда</button>
  <button class="btn" type="submit" id="feedback">Отзывы</button>
  <button class="btn" type="submit" id="car">Машины</button>
  <button class="btn" type="submit" id="newCar">Добавить авто</button>
</div>
<div class="container">
  <div id="requests_div" style="display: none;">
    <button type="submit" id="delete_requests">Удаление заявки</button>
    <table id="requestTable">
      <tr>
        <th>№ заявки</th>
        <th>ФИО</th>
        <th>Номер телефона</th>
        <th>Удаление заявки</th>
      </tr>
      <?php
        require_once 'GetRequests.php'; // Подключение к файлу с PHP кодом
        $requests = getRequestsFromDatabase(); // Получение данных из базы данных
        // Вывод карточек
        if ($requests){
            foreach ($requests as $row_requests) {
            echo "<tr>";
              echo "<td>".$row_requests["id"]."</td>";
              echo "<td>".$row_requests["name"]."</td>";
              echo "<td>".$row_requests["phone"]."</td>";
              echo "<td><input type='checkbox'></td>";
            echo "</tr>";      
            }
        }
      ?>
    </table>
  </div>
  <div id="feedback_div" style="display: none;"> 
    <button type="submit" id="delete_feedback">Удаление заявки</button>
    <table id="feedbackTable">
      <tr>
        <th>№ заявки</th>
        <th>№ машины</th>
        <th>ФИО</th>
        <th>Номер телефона</th>
        <th>Отзыв</th>
        <th>Удаление заявки</th>
      </tr>
      <?php
        require_once 'GetFeedback.php'; // Подключение к файлу с PHP кодом
        $feedback = getFeedbackFromDatabase(); // Получение данных из базы данных
        // Вывод карточек
        if ($feedback){
            foreach ($feedback as $row_feedback) {
            echo "<tr>";
              echo "<td>".$row_feedback["id"]."</td>";
              echo "<td>".$row_feedback["id_auto"]."</td>";
              echo "<td>".$row_feedback["name"]."</td>";
              echo "<td>".$row_feedback["phone"]."</td>";
              echo "<td>".$row_feedback["feedback"]."</td>";
              echo "<td><input type='checkbox' name='selected_rows[]'></td>";
            echo "</tr>";      
            }
        }
      ?>
    </table>
  </div>

<div id="arenda_div" style="display: none;"> 
    <button type="submit" id="delete_arenda">Удаление заявки</button>
    <table id="arendaTable">
      <tr>
        <th>№ заявки</th>
        <th>ФИО</th>
        <th>Номер телефона</th>
        <th>Номер паспорта</th>
        <th>Дата выдачи паспорта</th>
        <th>Код паспорта</th>
        <th>Паспорт выдан</th>
        <th>Машина</th>
        <th>Год выпуска</th>
        <th>Пробег</th>
        <th>Комплектация</th>
        <th>Цена</th>
        <th>Удаление заявки</th>
      </tr>
      <?php
        require_once 'GetArenda.php'; // Подключение к файлу с PHP кодом
        $arenda = getArendaFromDatabase(); // Получение данных из базы данных
        // Вывод карточек
        if ($arenda){
            foreach ($arenda as $row_arenda) {
            echo "<tr>";
              echo "<td>".$row_arenda["id"]."</td>";
              echo "<td>".$row_arenda["name"]."</td>";
              echo "<td>".$row_arenda["phone"]."</td>";
              echo "<td>".$row_arenda["pasport_nomer"]."</td>";
              echo "<td>".$row_arenda["pasport_data"]."</td>";
              echo "<td>".$row_arenda["pasport_kod"]."</td>";
              echo "<td>".$row_arenda["pasport_issued"]."</td>";
              echo "<td>".$row_arenda["car"]."</td>";
              echo "<td>".$row_arenda["yeat_release"]."</td>";
              echo "<td>".$row_arenda["mileage"]."</td>";
              echo "<td>".$row_arenda["equipment"]."</td>";
              echo "<td>".$row_arenda["price"]."</td>";
              echo "<td><input type='checkbox' name='selected_rows[]'></td>";
            echo "</tr>";      
            }
        }
      ?>
    </table>
  </div>

  <div id="car_div" style="display: none;"> 
  <button type="button" id="delete_car">Редактировать заявку</button>
  <button type="button" id="confirm_edit" style="display: none;">Подтвердить изменения</button>
  <button id="cancel_edit" style="display: none;">Отмена</button>
    <table id="carTable">
      <tr>
        <th>id</th>
        <th>Модель</th>
        <th>Брэнд</th>
        <th>Тип кузова</th>
        <th>Лошадинных сил</th>
        <th>Разгод до 100  с.</th>
        <th>Максимальная скорость</th>
        <th>Год выпуска</th>
        <th>Пробег</th>
        <th>Комплектация</th>
        <th>Цена</th>
        <th>Описание</th>
        <th>Салон</th>
        <th>Отличия</th>
        <th>Описание кузова</th>
        <th>Выбор заявки</th>
      </tr>
      <?php
        require_once 'GetCarInfo.php'; // Подключение к файлу с PHP кодом
        $car = getCarInfoFromDatabase(); // Получение данных из базы данных
        // Вывод карточек
        if ($car){
            foreach ($car as $row_car) {
            echo "<tr>";
              echo "<td>".$row_car["id"]."</td>";
              echo "<td>".$row_car["model"]."</td>";
              echo "<td>".$row_car["car_brand"]."</td>";
              echo "<td>".$row_car["type_body"]."</td>";
              echo "<td>".$row_car["horsepower"]."</td>";
              echo "<td>".$row_car["racing"]."</td>";
              echo "<td>".$row_car["maximum_speed"]."</td>";
              echo "<td>".$row_car["yeat_release"]."</td>";
              echo "<td>".$row_car["mileage"]."</td>";
              echo "<td>".$row_car["equipment"]."</td>";
              echo "<td>".$row_car["price"]."</td>";
              echo "<td>".$row_car["description"]."</td>";
              echo "<td>".$row_car["salon"]."</td>";
              echo "<td>".$row_car["difference"]."</td>";
              echo "<td>".$row_car["body_description"]."</td>";
              echo "<td><input type='radio' name='selected_rows[]'></td>";
            echo "</tr>";      
            }
        }
      ?>
    </table>
  </div>

  <div id="newCar_div" class="newCar_div" style="display: none;"> 
        <textarea placeholder="марка" class="input_newCar" id="car_brand" rows="1"></textarea>
        <textarea placeholder="модель" class="input_newCar" id="model" rows="1"></textarea>
        <textarea placeholder="тип кузов" class="input_newCar" id="type_body" rows="1"></textarea>
        <textarea placeholder="лошадинных сил" class="input_newCar" id="horsepower" rows="1"></textarea>
        <textarea placeholder="разгон до 100км/ч" class="input_newCar" id="racing" rows="1"></textarea>
        <textarea placeholder="максимальная скорость" class="input_newCar" id="maximum_speed" rows="1"></textarea>
        <textarea placeholder="год производства" class="input_newCar" id="year_release" rows="1"></textarea>
        <textarea placeholder="пробег" class="input_newCar" id="mileage" rows="1"></textarea>
        <textarea placeholder="комплектация" class="input_newCar" id="equipment" rows="1"></textarea>
        <textarea placeholder="цена" class="input_newCar" id="price" rows="1"></textarea>
        <textarea placeholder="описание машины" class="input_newCar" id="description" rows="3"></textarea>
        <textarea placeholder="описание салона" class="input_newCar" id="salon" rows="3"></textarea>
        <textarea placeholder="отличия" class="input_newCar" id="difference" rows="3"></textarea>
        <textarea placeholder="описание кузова" class="input_newCar" id="body_description" rows="3"></textarea>
        <!-- Первые 2 изображения -->
        <input class="file_newCar" type="file" name="fileToUploadFront[]" id="fileToUploadFront" accept="image/*" multiple required>
        <!-- Остальные 4 изображения -->
        <input class="file_newCar" type="file" name="fileToUploadBack[]" id="fileToUploadBack" accept="image/*" multiple required>
        <button type="button" id="NewCar">Добавить машину</button>
    </div>
</div>

  <script src="scripts.js"></script>
</body>
</html>