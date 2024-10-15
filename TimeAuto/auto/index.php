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

    <title>TimeAuto</title>
</head>
<body>
  <!-- Загрузка страницы -->
  <div id="preloader">
        <div class="loader">
            <div class="inner one"></div>
            <div class="inner two"></div>
            <div class="inner three"></div>
          </div>
      </div>
    <script>
        window.addEventListener('load', function() {
        document.getElementById('preloader').remove();
      });
      </script>
       <!-- Загрузка страницы -->
        
    <header>
        <div class="header-content">
            <div class="header-icon" >
                <a href="../index.html">
                    <img src="../pic/icon_auto.png">
                    <h1>TimeAuto</h1>
                </a>
            </div>
            <div class="nav-header">
                <div class="auto-a">
                    <a href="index.php" style="color: #ff4b4b;">Машины</a>
                </div>
                <a href="../company/index.html">О нас</a>
                <a href="../feedback/index.php">Отзывы</a>
                <div class="btn-question-cont">
                    <div class="btn-question" id="myBtn">
                        <span>Задай вопрос</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container" id="cardContainer">
    <?php
      require_once 'auto-card.php'; // Подключение к файлу с PHP кодом
      $car = getAutosFromDatabase(); // Получение данных из базы данных
      // Вывод карточек
      if ($car){
          foreach ($car as $card) {
              echo "<div class='card' id='" . $card["id"] . "' data-title='" . $card["car_brand"] . "'>";
              echo "<img src=pic/". $card["photo_back"] . ">";
              echo "<img class='photo_front' src=pic/". $card["photo_front"] . ">";
              echo "<div class='tag'>";
                echo "<div class='tag_hp'>";
                  echo "<div class='h2_cont'>";
                  echo "<h2>" . $card["car_brand"] . "</h2>";
                  echo "<h2>" . $card["model"] . "</h2>";
                  echo "</div>";
                echo "</div>";
              echo "</div>";
              echo "</div>";
          }
      }
      else {
        echo "0 results";
      }
    ?>
  </div>
    <form id="cardForm" action="../this_auto/index.php" method="POST">
      <input type="hidden" name="id" id="cardId">
    </form>
    <!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Заполните форму<br>и&nbsp;мы&nbsp;вам перезвоним</h2>
      <div class="input-modal">
        <form method="post" name="checkout"  autocomplete="on">
          <div class="input-name"><input name="name"  type="text" placeholder="ФИО" id="name" maxlength="40">
            <div class="false-name" id="false-name">Пустое поле</div>
          </div>
          <div class="input-name"><input name="phone" type="tel" placeholder="Номер телефона" id="phone" minlength="10">
            <div class="false-phone" id="false-phone">Некорректный номер телефона</div>
          </div>
        </form>
        <div><button id="send">Отправить</button></div>
      </div>
    </div>
</div>
  
  <div id="myModal-2" class="modal-2">
    <!-- Modal content -->
    <div class="modal-content-2">
      <span class="close-2">&times;</span>
      <h2>Ваша заявка принята.<br>Мы позвоним в ближайшее время.</h2>
    </div>
  </div>
  
  <script src="scripts.js"></script>
</body>
</html>