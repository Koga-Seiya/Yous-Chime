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
//$input_obs = $_COOKIE["obs"];



function convertTz($datetime_text)
{
  $datetime = new DateTime($datetime_text);
  $datetime->setTimezone(new DateTimeZone('Asia/Tokyo'));
  return $datetime->format('Y/m/d H:i:s');
}

if (isset($_POST['action_type']) && $_POST['action_type']) {
  if ($_POST['action_type'] === 'delete') {
    $input_WAIT = $_POST['id'];
    $stmt = $dbh->prepare('DELETE FROM Chime_board Where wait = :wait');
    $stmt ->bindValue(':wait', $input_WAIT, PDO::PARAM_INT);
    $stmt ->execute();
    header("Refresh:0.1");
  }
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
    <meta http-equiv="refresh" content="3">
</head>

<body>
  <script type="text/javascript" src="//code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript">
    let element = <?php echo $message_length;?>;
    //document.write(element);
    if (element != 0){
      // 変化が発生したときの処理を記述
      const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
      //オシレーターノードを生成
      const oscillator = audioCtx.createOscillator();
      //ゲインの生成
      const gainNode = audioCtx.createGain();
      //webオーディオAPIコンテキストと接続？(ここがよく分からない)
      oscillator.connect(gainNode);
      gainNode.connect(audioCtx.destination);
      //音量
      gainNode.gain.value = 0.2;
      //通知音のタイプ
      oscillator.type = 'sine';
      //通知音スタート
      oscillator.start();
      //通知音ストップ
      oscillator.stop(0.2);
    }

    

    </script>
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
      <form action="map2.html" method="post">
      <div id='map-button' ><button type ="submit" class="fas fa-map">map</button></div>
      </form>
    </div>
    
    

      <div class="message-list-cover">
        <div class="number" id="obs">
          <?php echo $message_length;?>件
        </div>
        
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

        <!--<a id="test">test<script>document.write(element);</script></a> -->
      </div>

    
</body>

</html>