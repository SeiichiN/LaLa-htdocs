<?php
require_once('../../lib/util.php');
require_once('../../common/header.php');
?>
<?php
$user = 'testuser';
$password = 'testuser';
$dbname = 'testdb';
$host = 'localhost:3306';
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

try {
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "データベース{$dbname}に接続しました。";
  $pdo = NULL;  // 接続解除
} catch (Exception $e) {
  echo '<span class="error">エラーがありました。</span><br>';
  echo $e->getMessage();
  exit();
}