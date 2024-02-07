<?php
include './PHP/db_connect.php';

// パスワードをハッシュ化してデータベースに保存する例

$username = "sisyamo";
$password = "password246";
$randomBytes = random_bytes(32); // 32バイトのランダムなデータを生成
$salt = bin2hex($randomBytes); // バイナリデータを16進数に変換


// パスワードをハッシュ化
$hashedPassword = password_hash($password.$salt, PASSWORD_DEFAULT);



// ハッシュ化されたパスワードとユーザー名をデータベースに挿入
$stmt = $dbh->prepare("INSERT INTO users (username, password,salt) VALUES (:username,:password,:salt)");
$stmt->bindValue(":username", $username,PDO::PARAM_STR);
$stmt->bindValue(":password", $hashedPassword,PDO::PARAM_STR);
$stmt->bindValue(":salt", $salt,PDO::PARAM_STR);

$stmt->execute();
?>

<?php
try {
    $dbHost = getenv('DB_HOST');
    $dbPort = getenv('DB_PORT');
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPass = getenv('DB_PASS');
    $dsn = "mysql:dbname=$dbName;host=$dbHost:$dbPort";
    $dbh = new PDO($dsn, $dbUser, $dbPass);
} catch (PDOException $e) {
    print $dbName;
    echo $e->getMessage();
    exit;
}

$username = "sisyamo";
$inputPassword = "password246";

// データベースからハッシュとソルトを取得
$stmt = $dbh->prepare("SELECT password, salt FROM users WHERE username = ?");
$stmt->execute([$username]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$hashedPasswordFromDB = $row['password'];
$saltFromDB = $row['salt'];

// データベースから取得したソルトを使用してハッシュを生成
$hashedPasswordToCheck = password_hash($inputPassword . $saltFromDB, PASSWORD_DEFAULT);

// ハッシュの検証
if (password_verify($inputPassword.$saltFromDB, $hashedPasswordFromDB)) {
    // パスワードが一致する場合
    echo "Password is correct!";
} else {
    // ログイン失敗
    echo "Invalid credentials";
    echo "<br>Error: " . implode(", ", $stmt->errorInfo());
    echo "<br>入力";
    echo $inputPassword;
    echo "<br>データベース";
    echo $hashedPasswordFromDB;
}

// PDO 接続を閉じる
$dbh = null;
?>