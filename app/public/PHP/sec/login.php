<?php
// フォームが送信されたかどうかを確認
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ユーザーが入力したユーザー名とパスワードを取得
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $inputPassword = isset($_POST['password']) ? $_POST['password'] : '';

    // データベースからハッシュとソルトを取得
    $stmt = $dbh->prepare("SELECT password, salt FROM users WHERE username = ?");
    $stmt->execute([$username]);

    // 結果が正常でない場合はエラーを表示して終了
    if ($stmt->rowCount() === 0) {

    }else{
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // データベースから取得したハッシュとソルト
        $hashedPasswordFromDB = $row['password'];
        $saltFromDB = $row['salt'];
    
        // ハッシュの検証
        if (password_verify($inputPassword.$saltFromDB, $hashedPasswordFromDB)) {
            // ログイン成功後にhome.phpにリダイレクト
            header("Location: home.php");
            exit; // リダイレクト後にはプログラムの実行を終了する
        } else {
            // ログイン失敗
            echo "Invalid credentials";
        } 
    }
}

// PDO 接続を閉じる
$dbh = null;
?>