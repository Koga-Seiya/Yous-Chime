<?php
    $_SESSION["contents"] = "";
    if (isset($_POST['outmedal'])) {
      setcookie("contents","メダル切れ",time()+60*60*24);
      header('Location: wait.php');
    }
    elseif (isset($_POST['medaljam'])) {
      setcookie("contents","メダルが詰まった",time()+60*60*24);
      header('Location: wait.php');
    }
    elseif (isset($_POST['error'])) {
      setcookie("contents","エラーが発生",time()+60*60*24);
      header('Location: wait.php');
    }
    elseif (isset($_POST['sonota'])) {
      setcookie("contents","その他",time()+60*60*24);
      header('Location: wait.php');
    }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex" />
  <title>呼び出し内容</title>
  <link rel="stylesheet" href="./assets/reset.css" />
  <link rel="stylesheet" href="./assets/main.css" />
</head>

<body>
  <!-- ヘッダー -->
  <?php include "./assets/header.html" ?>

  <div class="page-title">呼び出し内容</div>

  <section>
    <form action="medal.php" method="post">
      <button type="submit" class="contact-button" name="outmedal">メダル切れ</button>
    </form>
    <form action="medal.php" method="post">
      <button type="submit" class="contact-button" name="medaljam">メダルが詰まった</button>
    </form>
    <form action="medal.php" method="post">
      <button type="submit" class="contact-button" name="error">エラーが発生</button>
    </form>
    <form action="medal.php" method="post">
      <button type="submit" class="contact-button" name="sonota">その他</button>
    </form>
  </section>

</body>

</html>
