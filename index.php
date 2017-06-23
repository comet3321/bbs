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
    $sql_result = $pdo->query("select * from posts order by id desc limit 5");
    $post = $pdo->query("select * from posts");
    $posts = $post->fetchAll();

  } catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }

 ?>

 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>BBS</title>
     <link rel="stylesheet" href="normalize.css">
     <link rel="stylesheet" href="styles.css">
   </head>
   <body>
       <header>
         <div class="container">
           <div id="posted_number">
             <h2>現在の投稿(<span><?php echo count($posts); ?></span>件)</h2>
           </div>
           <h1>掲示板</h1>
       </div><!-- container -->
       </header>
       <div id="main">
         <div class="container">
          <div id="post-row">
            <dl>
             <?php foreach ($sql_result as $row) : ?>
               <dt>
                   <span style="color: green;">名前：<?= h($row["name"]) ?></span>　<?= h($row["created"])?>　ID:<?= h($row["crypt"]) ?><br>
               </dt>
               <dd>
                 <?=  h($row["body"]) ?>
                 <a href="confirm.php?id=<?= h($row["id"]) ?>">削除</a>
               </dd>
              <?php endforeach; ?>
            </dl>
            <div id="load_result"></div>
            <button id="load_more">全件表示</button>
          </div><!-- post-row -->
          <div id="form">
           <form  action="actions.php" method="post">
             名前:<input type="text" name="name" value="" id="name_form">
             削除用パスワード:<input type="password" name="password" value=""><br>
             <textarea name="text" rows="8" cols="80" placeholder="ここにコメントを記入してください。"></textarea><br>
             <button type="submit" name="submit" id="submit">書き込む</button>
           </form>
          </div><!-- form -->
         </div><!--container -->
       </div><!-- main -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="actions.js"></script>
   </body>
 </html>
