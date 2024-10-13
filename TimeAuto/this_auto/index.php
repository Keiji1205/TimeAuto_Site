<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&family=Raleway&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@800&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@100..900&display=swap" rel="stylesheet">

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
                    <a href="../auto/index.php" style="color: #ff4b4b;">Машины</a>
                </div>
                <a href="../company/index.html">О нас</a>
                <a href="#">Отзывы</a>
                <div class="btn-question-cont">
                    <div class="btn-question" id="myBtn">
                        <span>Задай вопрос</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <?php
      // Подключение к базе данных
      $pdo = new PDO("mysql:host=localhost;dbname=kirillwor3", 'kirillwor3', '73HotCat91');
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
      // Запрос к базе данных
      $id = $_POST['id'];
      $sql = "SELECT * FROM this_auto JOIN all_car ON this_auto.id_auto = all_car.id WHERE this_auto.id_auto = $id";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
  
      // Получение данных из результата запроса
      $car = $stmt->fetch(PDO::FETCH_ASSOC);
     
      if ($car){
        $carModelWithoutSpaces = str_replace(" ", "_", $car["model"]);
        echo "<div class='preview'>";
          echo "<img class='photo_preview' src=pic/". $car["car_brand"] . "/". $carModelWithoutSpaces. "/". $car["photo_preview"] . ">";
          echo "<div class='welcome'>";
            echo "<span>Ваш новый ".$car["type_body"].":<br></span><h2>" . $car["car_brand"] ." ". $car["model"] .   "</h2>";
          echo "</div>";
        echo "</div>";
        echo "<div class='key_info'>";
          echo "<h2>" . $car["horsepower"] . "<br><span>Лошадиных сил</span></h2>";
          echo "<h2>" . $car["racing"] . "<br><span>0-100 км/ч</span></h2>";
          echo "<h2>" . $car["maximum_speed"] . "<br><span>Максимальная скорость</span></h2>";
        echo "</div>";
        echo "<div class='description'>";
          echo "<h1>" . $car["description"] . "</h2>";
        echo "</div>";
        echo "<div class='photo_cont'>";
          echo "<img class='photo' src=pic/". $car["car_brand"] . "/". $carModelWithoutSpaces. "/". $car["photo_salon"] . ">";
          echo "<h2>" . $car["salon"] . "</h2>";
          echo "<div class='stroke'>";
            echo "<div class='photo_disc'>";
              echo "<img class='photo_2' src=pic/". $car["car_brand"] . "/". $carModelWithoutSpaces. "/". $car["general_view"] . ">";
              echo "<h2>" . $car["difference"] . "</h2>";
            echo "</div>";
            echo "<div class='photo_disc'>";
              echo "<img class='photo_2' src=pic/". $car["car_brand"] . "/". $carModelWithoutSpaces. "/". $car["sport"] . ">";
              echo "<h2>" . $car["body_description"] . "</h2>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
        echo "<div class='arenda_content'>";
        echo "<div class='input_arenda'>";
        echo "<form method='post' name='checkout'  autocomplete='on'>";
        echo "<div class='input-arenda-name'>";
        echo " <input name='name'  type='text' placeholder='ФИО' id='name' maxlength='40'>";
        echo "<div class='false-name' id='false-name'>Пустое поле</div>";
        echo "</div>";
        echo "<div class='input-name'>";
        echo "<input name='phone' type='tel' placeholder='Номер телефона' id='phone' minlength='10'>";
        echo "<div class='false-phone' id='false-phone'>Некорректный номер телефона</div>";
        echo "</div>";
        echo "<div class='input-arenda-name'>";
        echo " <input name='name'  type='text' placeholder='Серия и номер паспорта' id='name' maxlength='40'>";
        echo "<div class='false-name' id='false-name'>Пустое поле</div>";
        echo "</div>";
        echo "<div class='input-arenda-name'>";
        echo " <input name='name'  type='text' placeholder='Кем выдан' id='name' maxlength='40'>";
        echo "<div class='false-name' id='false-name'>Пустое поле</div>";
        echo "</div>";
        echo "<div class='input-arenda-name'>";
        echo " <input name='name'  type='text' placeholder='Год получения' id='name' maxlength='40'>";
        echo "<div class='false-name' id='false-name'>Пустое поле</div>";
        echo "</div>";
        echo "<div class='input-info'>";
        echo "<div class='auto_info'>" . $car["car_brand"] ." ". $car["model"] . "</div>";
        echo "<div class='auto_info'>Год выпуска: " . $car["yeat_release"] . "</div>";
        echo "<div class='auto_info'>Пробег: " . $car["mileage"] . "</div>";
        echo "<div class='auto_info'>Комплектация: " . $car["equipment"] . "</div>";
        echo "<div class='auto_info'>Цена в сутки: " . $car["price"] . "</div>";
        echo "</div>";
        echo "</form>";   
        echo "<div><button id='send_arenda'>Отправить</button></div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
      }
      else {
        echo "0 results";
      }
    ?>

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