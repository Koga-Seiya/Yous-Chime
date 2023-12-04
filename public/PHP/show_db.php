<?php
$errorMessage = "";
//'Chime_board'テーブルのレコード数（待ち件数）取得
try {
$stmt = $dbh->query('SELECT * from Chime_board');
$message_length = $stmt->rowCount();
} catch (RuntimeException $e) {
    $errorMessage = $e->getMessage();
 }

//時間の取得
function convertTz($datetime_text)
{
  $datetime = new DateTime($datetime_text);
  $datetime->setTimezone(new DateTimeZone('Asia/Tokyo'));
  return $datetime->format('Y/m/d H:i:s');
}

//レコード（待ち件数）削除とリフレッシュ
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