<?php
    if (isset($_COOKIE["contents"])) {
        print "<p>";
        print "ログインID：".$_COOKIE["contents"];
        print "</p>";
    }
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex" />
  <title>呼び出しボタン</title>
  <link rel="stylesheet" href="css/reset.css"/>
  <link rel="stylesheet" href="./assets/main.css" />
</head>

<body>
    <!-- ヘッダー -->
    <header>
        <a class="yous">You's Chime</a>
    </header> 
    <form action="index.php" method="post">
      <button type="submit" class="contact-button" name="medal">戻る</button>

    </form>

    
    
    
</body>

</html>