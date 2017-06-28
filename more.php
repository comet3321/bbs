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
    $sql_result = $pdo->query("select * from posts order by id desc limit 5, 100");
    $post = $pdo->query("select * from posts");
    $posts = $post->fetchAll();
    $post_num = count($posts);
    $i = 0;


  } catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }

 ?>

 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>load_more</title>
   </head>
   <body>
     <?php foreach ($sql_result as $row) : ?>
       <?php $i++ ?>
       <dt>
           <span><?= $post_num - ($i + 4); ?></span><span style="color: #e67e22;">名前：<?= h($row["name"]) ?></span>　<span style ="font-size: 15px; color: #a0a0a0;"><?= h($row["created"])?>　ID:<?= h($row["crypt"]) ?></span><br>
       </dt>
       <dd>
         <?=  h($row["body"]) ?>
         <a href="confirm.php?id=<?= h($row["id"]) ?>">削除</a>
       </dd>
      <?php endforeach; ?>
   </body>
 </html>
