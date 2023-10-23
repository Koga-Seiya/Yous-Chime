<?php
$_SESSION["place"] = "";
    setcookie("place","カウンター",time()+60*60*24);
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
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
        <form action="index.php" method="post">
            <div id='home-button' ><button type="submit" class="fas fa-home">home</button></div>
        </form>
        <div id='map-button' ><a class="fas fa-map">map</a></div>

    </div>

    <section class=but>
      <form action="counter.php" method="post">
        <button type="submit" class="call-button">呼び出す</button>
      </form>
    </section>
    
</body>

</html>