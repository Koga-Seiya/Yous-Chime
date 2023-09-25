<?php
try {
  if (getenv('JAWSDB_URL')) {
    // Heorku (JawsDB)
    $_url = parse_url(getenv('JAWSDB_URL'));
    $dbHost = $_url['host'];
    $dbPort = $_url['port'];
    $dbName = ltrim($_url['path'], '/');
    $dbUser = $_url['user'];
    $dbPass = $_url['pass'];
  } else {
    // Other (Local development)
    $dbHost = getenv('DB_HOST');
    $dbPort = getenv('DB_PORT');
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPass = getenv('DB_PASS');
  }
  $dsn = "mysql:dbname=$dbName;host=$dbHost:$dbPort";
  $dbh = new PDO($dsn, $dbUser, $dbPass);
} catch (PDOException $e) {
  echo 'データベース接続失敗:';
  echo $e->getMessage();
  exit();
}