<?php
    header("contact.php")

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
    <div class="page-cover">
        <p class="page-title">呼び出しボタン<br>(カウンター)</p>
    </div>
    
    <form action="contact.php" method="post">
      <button type="button" name="call-button">呼び出す</button>
    </form>
    
    
</body>

</html>