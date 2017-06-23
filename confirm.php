<?php
  require_once(__DIR__ . '/functions.php');
  $user_id = $_GET["id"];
 ?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>確認画面</title>
  </head>
  <body>
    <form class="" action="delete.php" method="post">
      削除用パスワードを入力してください。:<input type="text" name="delete_pass" value="">
      <input type="hidden" name="user_id" value="<?= h($user_id) ?>">
      <button type="submit" name="submit">削除</button>
    </form>
  </body>
</html>
