<?php
//場面の取得
$input_PLACE = $_COOKIE["place"];
//呼び出し内容の取得
$input_CONTENTS = $_COOKIE["contents"];

$errorMessage = "";

//'Chime_board'テーブルのレコード数（待ち件数）取得
try {
  $stmt = $dbh->prepare("SELECT COUNT(*) from Chime_board");
  $stmt->execute();
  $wait = $stmt->fetchColumn();

} catch (RuntimeException $e) {
   $errorMessage = $e->getMessage();
}


//データベースに追加
try {
  //SQLを作成
  $sql = 'INSERT INTO Chime_board (place,contents) VALUES (:place,:contents)';
  $sql2 = 'INSERT INTO management_board (place,contents) VALUES (:place,:contents)';
  $error = "エラー2";

  //$pdoにあるqueryメソッドを呼び出してSQLを実行
  $stmt = $dbh->prepare($sql);
  $stmt2 = $dbh->prepare($sql2);
  $error = "エラー3";

  $stmt->bindValue(':place', $input_PLACE, PDO::PARAM_STR);
  $stmt->bindValue(':contents', $input_CONTENTS, PDO::PARAM_STR);

  $stmt2->bindValue(':place', $input_PLACE, PDO::PARAM_STR);
  $stmt2->bindValue(':contents', $input_CONTENTS, PDO::PARAM_STR);


  $stmt->execute();
  $stmt2->execute();

} catch (PDOException $e) {
  $errorMessage = 'データベースエラー';
  //print $errorMessage;
  echo $e->getMessage();
}
?>