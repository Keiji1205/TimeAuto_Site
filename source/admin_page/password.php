<?php
  session_start();

  include '../db.php';

  $sql = "SELECT password FROM users WHERE username = :username";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':username', $_POST['username']);
  $password = $_POST['password']; // Получаем пароль без формы
  $stmt->execute();

  $hashedPassword = $stmt->fetch(PDO::FETCH_ASSOC);

  // Проверяем хэш
  if (isset($hashedPassword['password']) && $hashedPassword['password'] == hash('sha512', $password)) { 
      // пароль сходится, открываем сессию и передаем сообщение
      $_SESSION['username'] = $_POST['username']; // 
      echo json_encode(['success' => true]);
  } else {
      // пароль не сходится отправлем ошибку
      echo json_encode(['success' => false, 'message' => 'Неправильный пароль!']);
  }
