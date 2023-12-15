<?php
include './PHP/db_connect.php';
include './PHP/add_db.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex" />
  <title>呼び出しボタン</title>
  <link rel="stylesheet" href="./assets/reset.css"/>
  <link rel="stylesheet" href="./assets/main.css" />
</head>

<body>
    <!-- ヘッダー -->
    <?php include "./assets/header.html" ?>
    
    <section>
      <div id="wait_scr">
        <p>
          <?php
          if (isset($_COOKIE["contents"])) {
            print "<p>";
            print "場所：".$_COOKIE["place"];
            print "</p>";
            print "<p>";
            print "呼び出し内容：".$_COOKIE["contents"];
            print "</p>";
            print "<p>";
            print "待ち組数：$wait";
            print "</p>";
          }
          ?>
          しばらくお待ちください。
          </p>
        </div>
    </section>
    <section>
      <form action="index.php" method="post">
        <button type="submit" class="contact-button" name="medal">戻る</button>
      </form>
    </section>
    

    
    
    
</body>

</html>