<?php
include './PHP/db_connect.php';
include './PHP/show_db.php';
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
    <link rel="stylesheet" href="./assets/reset.css"/>
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
      //webオーディオAPIコンテキストと接続
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