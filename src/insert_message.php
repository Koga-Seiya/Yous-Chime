<?php

if (isset($_POST['medal'])) {
    $呼び出し内容 = "メダルを登録したい";
} elseif (isset($_POST['pointcard'])) {
    $呼び出し内容 = "ポイントカードを押してほしい";
} elseif (isset($_POST['tenaosi'])) {
    $呼び出し内容 = "景品の手直しをしてほしい";
} elseif (isset($_POST['sonota'])) {
    $呼び出し内容 = "その他";
} else {
    $呼び出し内容 = "未選択";
}

$query = "INSERT INTO $table (呼び出し内容) VALUES (?)";
// プリペアドステートメントの作成
$stmt = $mysqli->prepare($query);

// パラメータをバインド
$stmt->bind_param("s", $呼び出し内容);

// クエリの実行
if ($stmt->execute()) {
    echo "データが正常に挿入されました。";
} else {
    echo "データの挿入中にエラーが発生しました。";
}

// 接続を閉じる
$stmt->close();
$mysqli->close();
?>