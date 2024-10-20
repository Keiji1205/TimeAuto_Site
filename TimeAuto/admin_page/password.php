<?php
  session_start();

  $pdo = new PDO("mysql:host=localhost;dbname=kirillwor3", 'kirillwor3', '73HotCat91');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT password FROM users WHERE username = :username";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':username', $_POST['username']);
  $password = $_POST['password']; // Get password from the form
  $stmt->execute();

  $hashedPassword = $stmt->fetch(PDO::FETCH_ASSOC);

  // Compare hashes
  if (isset($hashedPassword['password']) && $hashedPassword['password'] == hash('sha512', $password)) { 
      // Passwords match, set session and send success response
      $_SESSION['username'] = $_POST['username']; // Store the username in the session
      echo json_encode(['success' => true]);
  } else {
      // Passwords don't match, send failure response
      echo json_encode(['success' => false, 'message' => 'Неправильный пароль!']);
  }
