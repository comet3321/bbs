<?php

require_once(__DIR__ . '/config.php');

$ip = $_SERVER["REMOTE_ADDR"];
$id = crypt($ip, 's2');

try {
  $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $name = $_POST['name'];
  $comments = $_POST['text'];
  $pass = $_POST['password'];

  //文字数確認
  if($name === "" || mb_strlen($name) > 15){
      echo "入力が不正です。";
      return false;
    }
  if($comments === "" || mb_strlen($comments) > 255){
      echo "入力が不正です。";
      return false;
  }
  if($pass === "" || mb_strlen($pass) < 8){
      echo "入力が不正です。";
      return false;
  }

  $password = hash_hmac('sha256', $pass, 'dheqeuiqwehfg');

  //挿入
  $stmt = $pdo->prepare('insert into posts(name, body, crypt, password) values(?, ?, ?, ?)');
  $stmt->execute([$name, $comments,$id, $password]);
}
header('location: index.php');
exit();
