<?php
  session_start();

  $pointValue = isset($_GET['pointValue']) ? $_GET['pointValue'] : '';
  $_SESSION["place"] = "";
  

  if (isset($_POST['call'])){
    if($_POST['pointValue'] == "北海道"){//（仮カウンター）
      setcookie("place", $_POST['pointValue'], time() + 60 * 60 * 24);
      header('Location: counter.php');
    }
    elseif($_POST['pointValue'] == "関東"){//(仮メダル)
      setcookie("place", $_POST['pointValue'], time() + 60 * 60 * 24);
      header('Location: medal.php');
    }
    else{
      setcookie("place", $_POST['pointValue'], time() + 60 * 60 * 24);
      header('Location: counter.php');
    }
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
  <link rel="stylesheet" href="./assets/reset.css"/>
  <link rel="stylesheet" href="./assets/main.css" />
</head>

<body>
    <!-- ヘッダー -->
    <?php include "./assets/header.html" ?>

    <div class="page-cover">
        <p class="page-title">呼び出しボタン<br><?php echo $pointValue;?></p>
    </div>
    
    <section class=but>
      <form action="call.php" method="post">
        <input type="hidden" name="pointValue" value="<?php echo $pointValue; ?>">
        <button type="submit" class="call-button" name="call">呼び出す</button>
      </form>
    </section>
    
    
    
</body>

</html>