<?php
  require_once(__DIR__ . '/config.php');
  require_once(__DIR__ . '/functions.php');

  try {
    $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("create table if not exists posts(
      id int not null auto_increment primary key,
      name varchar(255),
      body varchar(255),
      crypt text,
      password varchar(255),
      created timestamp not null default current_timestamp
    )");
    $sql_result = $pdo->query("select * from posts order by id desc");

  } catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }

 ?>

 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>簡易掲示板</title>
     <link rel="stylesheet" href="styles.css">
   </head>

   <body>
     <h1>簡易掲示板</h1>
     <h2>新規投稿</h2>
     <form  action="actions.php" method="post" id="form">
       name:<input type="text" name="name" value="" id="name_form">
       comment:<input type="text" name="text" value="">
       delete_pass:<input type="text" name="password" value="">
       <button type="submit" name="submit" id="submit">送信</button>
     </form>
     <h2>現在の投稿()</h2>
     <ul id="post">
      <?php foreach ($sql_result as $row) : ?>
        <li id ="post_<?= h($row["id"]) ?>">
          <?=  h($row["body"]) ?>(<?= h($row["name"]) ?>[ID:<?= h($row["crypt"]) ?>]) --<?= h($row["created"])?>
          <a href="confirm.php?id=<?= h($row["id"]) ?>">×</a>
          <p><?= h($row["id"]) ?></p>
        </li>
      <?php endforeach; ?>
    </ul>
    <a href="#">prev</a>
    <a href="#">next</a>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="actions.js"></script>
   </body>
 </html>
