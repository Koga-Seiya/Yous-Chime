<!DOCTYPE html>
<html lang="ja">

<head>
    <link href='https://use.fontawesome.com/releases/v5.6.4/css/all.css' rel='stylesheet' />
    <link href='//netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.css' rel='stylesheet' />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex" />
    <title>ホーム画面</title>
    <link rel="stylesheet" href="./assets/reset.css" />
    <link rel="stylesheet" href="./assets/main.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <!-- QRコード生成ライブラリ qrcode.js の読み込み -->
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    
</head>

<body>
    <!-- ヘッダー -->
    <?php include "./assets/header.html" ?>

    <!-- 縦型ナビゲーションバー -->
    <div id='button-list'>
        <form action="home.php" method="post">
            <div id='home-button'><button type="submit" class="fas fa-home">home</button></div>
        </form>
        <div id='map-button' ><a class="fas fa-map">map</a></div>
    </div>

    <div class="container">
        <h1>店内マップ</h1>

        <div id="imageContainer">
            <!-- 画像が表示される要素 -->
        </div>
        <div id="dropZone" style="display: block;">
            <p>ドラッグ＆ドロップで画像ファイルをアップロード</p>
        </div>

        <!-- ボタンを押して表示/非表示を切り替えるトグルボタン -->
        <button id="toggleDropZoneButton">画像を変更する</button>

        <!-- ポイント設定ボタン -->
        <button id="setPointButton">ポイント設定</button>

        

        <!-- ポイントの表 -->
        <table id="pointsTable">
            <thead>
                <tr>
                    <th>場所</th>
                    <th>QRコード</th>
                    <th id="delete">削除</th>
                </tr>
            </thead>
            <tbody id="pointsTableBody"></tbody>
        </table>
    </div>
    
</div>
<script src="./JavaScript/map.js"></script>
</body>

</html>
