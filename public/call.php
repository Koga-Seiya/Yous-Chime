<?php
  session_start();

  $pointValue = isset($_GET['pointValue']) ? $_GET['pointValue'] : '';
  $_SESSION["place"] = "";
  setcookie("place", $pointValue, time() + 60 * 60 * 24);

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
    <header>
        <a class="yous">You's Chime</a>
    </header> 
    <div class="page-cover">
        <p class="page-title">呼び出しボタン<br><?php echo $pointValue;?></p>
    </div>
    
    <section class=but>
      <form action="counter.php" method="post">
        <button type="submit" class="call-button">呼び出す</button>
      </form>
    </section>
    
    
    
</body>

</html>