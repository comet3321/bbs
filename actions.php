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
  $password = $_POST['password'];
  //挿入
  $stmt = $pdo->prepare('insert into posts(name, body, crypt, password) values(?, ?, ?, ?)');
  $stmt->execute([$name, $comments,$id, $password]);
}
header('location: index.php');
exit();
