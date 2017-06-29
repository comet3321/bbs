<?php
  require_once(__DIR__ . '/config.php');
  require_once(__DIR__ . '/functions.php');

  if (is_int($_POST['user_id']) || is_string($_POST['delete_pass'])) {
    $user_id = $_POST['user_id'];
    $pass = $_POST['delete_pass'];
    $request_pass = hash_hmac('sha256', $pass, 'dheqeuiqwehfg');

  }else{
    echo '入力された値が不正です。';
  }

  try {
    $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT password FROM posts where id = :id");
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    $user_password = $stmt->fetchColumn();

  } catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }

  if ($user_password === $request_pass) {

    try {
      $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
      $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
      $stmt->execute();

      header('location: index.php');
      exit();
    } catch (Exception $e) {
      echo $e->getMessage() . PHP_EOL;
    }
  }else{
    echo "パスワードが違います。";
    exit();
  }

  //$pass = array_column($user_password, 'password');
