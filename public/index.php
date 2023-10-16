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

$stmt = $dbh->query('SELECT * from Chime_board');
$message_length = $stmt->rowCount();

function convertTz($datetime_text)
{
  $datetime = new DateTime($datetime_text);
  $datetime->setTimezone(new DateTimeZone('Asia/Tokyo'));
  return $datetime->format('Y/m/d H:i:s');
}

?>



<!DOCTYPE html>
<html>

<head>
    <link href='https://use.fontawesome.com/releases/v5.6.4/css/all.css' rel='stylesheet'/>
    <link href='//netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.css' rel='stylesheet'/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex" />
    <title>ホーム画面</title>
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="./assets/main.css" />
</head>

<body>
    <!-- ヘッダー -->
    <header>
        <a class="yous">You's Chime</a>
    </header> 

    <!-- 縦型ナビゲーションバー -->
    <div id='button-list'>
      <div id='home-button'><a ref='example'>Home</a></div>
      <form action="map.php" method="post">
        <div id='map-button' ><button type ="submit" class="fas fa-map">map</button></div>
      </form>
    </div>
    
    <hr class="page-divider" />

      <div class="message-list-cover">
        <small>
          <?php echo $message_length;?>件
        </small>
        
        <?php while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {?>
          <?php $lines = explode("\n",$row['contents']);?>
          <div class="message-item">
            <div class="message-title">
              <div><?php echo htmlspecialchars($row['place'], ENT_QUOTES); ?></div>
              <small><?php echo convertTz($row['created_at']); ?></small>
              <div class="spacer"></div>
              <form action="/" method="post" style="text-align:right">
                <input type="hidden" name="id" value="<?php echo $row['wait']; ?>" />
                <input type="hidden" name="action_type" value="delete" />
                <button type="submit" class="message-delete-button">削除</button>
              </form>
            </div>
            <?php foreach ($lines as $line) { ?>
              <p class="message-line"><?php echo htmlspecialchars($line, ENT_QUOTES); ?></p>
            <?php } ?>
          </div>
        <?php } ?>
      </div>

    
    
</body>

</html>