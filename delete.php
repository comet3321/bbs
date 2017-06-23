<?php
  require_once(__DIR__ . '/config.php');
  require_once(__DIR__ . '/functions.php');

  try {
    $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT password FROM posts where id = :id");
    $stmt->bindParam(':id', $_POST['user_id'], PDO::PARAM_INT);
    $stmt->execute();

    $user_password = $stmt->fetchAll();

  } catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }

  $request_pass = $_POST['delete_pass'];

  if ($user_password === $request_pass) {
    echo "success!!!";
  }else{
    echo "password is incorrect!!";
  }

  var_dump($user_password[0]);
  echo $request_pass;
