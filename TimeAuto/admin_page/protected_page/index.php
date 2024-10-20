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
<?php

session_start();
if (isset($_SESSION['username'])) {
    // Сессия активна, выводим приветствие
    echo "<script>alert('Добро пожаловать, " . $username . "!');</script>";
} else {
    // Сессия не активна, перенаправляем на страницу входа
    header('Location: ../index.php');
    exit;
}
?>

<div class="nav_btn">
  <button class="btn" type="submit" id="requests">Заявки</button>
  <button class="btn" type="submit" id="arenda">Аренда</button>
  <button class="btn" type="submit" id="feedback">Отзывы</button>
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
</div>
  <script src="scripts.js"></script>
</body>
</html>