<?php
    $_SESSION["contents"] = "";
    if (isset($_POST['medal'])) {
      setcookie("contents","メダル登録",time()+60*60*24);
      header('Location: wait.php');
    }
    elseif (isset($_POST['pointcard'])) {
      setcookie("contents","ポイントカード",time()+60*60*24);
      header('Location: wait.php');
    }
    elseif (isset($_POST['tenaosi'])) {
      setcookie("contents","手直し",time()+60*60*24);
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
  <header>
    <a class="yous">You's Chime</a>
  </header>

  <div class="page-title">呼び出し内容</div>

  <section>
    <form action="counter.php" method="post">
      <button type="submit" class="contact-button" name="medal">メダルを登録したい</button>
    </form>
    <form action="counter.php" method="post">
      <button type="submit" class="contact-button" name="pointcard">ポイントカードを押してほしい</button>
    </form>
    <form action="counter.php" method="post">
      <button type="submit" class="contact-button" name="tenaosi">景品の手直しをしてほしい</button>
    </form>
    <form action="counter.php" method="post">
      <button type="submit" class="contact-button" name="sonota">その他</button>
    </form>
  </section>

</body>

</html>
