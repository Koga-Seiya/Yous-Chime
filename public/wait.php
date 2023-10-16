<?php
try {
  $dbHost = getenv('DB_HOST');
  $dbPort = getenv('DB_PORT');
  $dbName = getenv('DB_NAME');
  $dbUser = getenv('DB_USER');
  $dbPass = getenv('DB_PASS');
  $dsn = "mysql:dbname=$dbName;host=$dbHost:$dbPort";
  $dbh = new PDO($dsn, $dbUser, $dbPass);
  //print 'データベース接続成功';
} catch (PDOException $e) {
  //echo 'データベース接続失敗:';
  print $dbName;
  echo $e->getMessage();
}

$input_PLACE = $_COOKIE["place"];
$input_CONTENTS = $_COOKIE["contents"];

$errorMessage = "";
try {
  //PCTOP画像カウント
  $stmt = $dbh->prepare("SELECT COUNT(*) from Chime_board");
  $stmt->execute();
  $wait = $stmt->fetchColumn();

} catch (RuntimeException $e) {
   $errorMessage = $e->getMessage();
}




try {
  //SQLを作成
  $sql = 'INSERT INTO Chime_board (place,contents,wait) VALUES (:place,:contents,:wait)';
  $error = "エラー2";

  //$pdoにあるqueryメソッドを呼び出してSQLを実行
  $stmt = $dbh->prepare($sql);
  $error = "エラー3";

  $stmt->bindValue(':place', $input_PLACE, PDO::PARAM_STR);
  $stmt->bindValue(':contents', $input_CONTENTS, PDO::PARAM_STR);
  $stmt->bindValue(':wait', $wait, PDO::PARAM_STR);

  $stmt->execute();

  //print "データベース接続成功";

} catch (PDOException $e) {
  $errorMessage = 'データベースエラー';
  //print $errorMessage;
  //echo $e->getMessage();
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
    <div>
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
    </div>
    <section>
      <form action="index.php" method="post">
        <button type="submit" class="contact-button" name="medal">戻る</button>
      </form>
    </section>
    

    
    
    
</body>

</html>