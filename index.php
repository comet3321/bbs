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
    $post_num = count($posts);
    $i = -1;

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
             <h2>現在の投稿(<span><?= $post_num; ?></span>件)</h2>
           </div>
           <div id = "title">
             <h1>掲示板</h1>
           </div>
       </div><!-- container -->
       </header>
       <div id="main">
         <div class="container">
           <div id="modal"  class="hidden">
             <form  action="actions.php" method="post">
               <label for="name">名前</label>
               <input type="text" name="name" value="" id="name"><br>
               <label for="password">削除用パスワード</label>
               <input type="password" name="password" value=""><br>
               <textarea name="text" rows="8" cols="40" placeholder="ここにコメントを記入してください。"></textarea><br>
               <button type="submit" name="submit" id="submit">書き込む</button>
             </form>
             <div id="modal-close">
               Close
             </div>
           </div><!-- modal -->
           <div id="mask" class="hidden"></div>
           <div id="modal-open">
            <h2>投稿する</h2>
           </div><!-- modal-open -->
          <div id="post-row">
            <dl>
             <?php foreach ($sql_result as $row) : ?>
               <?php $i++ ?>
               <dt>
                   <span style="color: #e67e22; margin-right:10px;"><?= $post_num - $i; ?></span><span style="color: #e67e22;">名前：<?= h($row["name"]) ?></span>　<span style ="font-size: 15px; color: #a0a0a0;"><?= h($row["created"])?>　ID:<?= h($row["crypt"]) ?></span><br>
               </dt>
               <dd>
                 <?=  nl2br(h($row["body"])) ?>
                 <a href="confirm.php?id=<?= h($row["id"]) ?>">削除</a>
               </dd>
              <?php endforeach; ?>
            </dl>
            <div id="load_result"></div>
            <button id="load_more">全件表示</button>
          </div><!-- post-row -->
         </div><!--container -->
       </div><!-- main -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="actions.js"></script>
   </body>
 </html>
