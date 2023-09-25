<?php

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex" />
  <title>呼び出し内容</title>
  <link rel="stylesheet" href="css/reset.css"/>
  <link rel="stylesheet" href="./assets/main.css" />
</head>

<body>
    <!-- ヘッダー -->
    <header>
        <a class="yous">You's Chime</a>
    </header> 
    
    <div class="contact">呼び出し内容</div>
    
    <section>
        <form action="counter.php" method="post">
            <button type="button" class="contact-button" name=medal>メダルを登録したい</button>
        </form>
        <form action="counter.php" method="post">
            <button type="button" class="contact-button" name=pointcard>ポイントカードを押してほしい</button>
        </form>
        <form action="counter.php" method="post">
            <button type="button" class="contact-button" name=tenaosi>景品の手直しをしてほしい</button>
        </form>
        <form action="counter.php" method="post">
            <button type="button" class="contact-button" name=sonota>その他</button>
        </form>
    </section>
    
</body>

</html>