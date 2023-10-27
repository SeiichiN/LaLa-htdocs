<?php
require_once('../../lib/util.php');
$gobackURL = "insertform.php";

if (!cken($_POST)) {
  header("Location:{$gobackURL}");
  exit();
}
require_once('../../common/header.php'); ?>

<?php
$errors = [];
pre_dump($_POST);
if (!isset($_POST['id']) || ($_POST['id'] === "")) {
  $errors[] = "商品IDが空です。";
}
if (!isset($_POST['name']) || ($_POST['name'] === "")) {
  $errors[] = "商品名が空です。";
}
if (!isset($_POST['brand']) || ($_POST['brand'] === "")) {
  $errors[] = "ブランドが空です。";
}
if (!isset($_POST['quantity']) || !ctype_digit($_POST['quantity'])) {
  $errors[] = "個数が整数値ではありません。";
}
if (count($errors) > 0) {
  print_error($errors);
  echo "<hr>";
  echo '<a href="', $gobackURL, '">戻る</a>';
  exit();
}

$user = 'inventoryuser';
$password = 'inventoryuser';
$dbName = 'inventory';
$host = 'localhost:3306';
$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";

// $pdoインスタンスを作る 接続情報
try {
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
  echo '接続エラー';
  echo $e->getMessage();
  exit();
}
try {
  $pdo->beginTransaction();
  $sql1 = <<< EOS
INSERT INTO goods (id, name, size, brand)
VALUES (:id, :name, :size, :brand)
EOS;
  $sql2 = <<< EOD
INSERT INTO stock (goods_id, quantity)
VALUES (:good_id, :quantity)
EOD;
  $insertGoods = $pdo->prepare($sql1);
  $insertStock = $pdo->prepare($sql2);
  $insertGoods->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
  $insertGoods->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
  $insertGoods->bindValue(':size', $_POST['size'], PDO::PARAM_STR);
  $insertGoods->bindValue(':brand', $_POST['brand'], PDO::PARAM_STR);
  $insertStock->bindValue(':goods_id', $_POST['id'], PDO::PARAM_STR);
  $insertStock->bindValue(':quantity', $_POST['quantity'], PDO::PARAM_INT);
  $insertGoods->execute();
  $insertStock->execute();
  $pdo->commit();
} catch (Exception $e) {
  $pdo->rollBack();
  echo '登録処理エラー';
  echo $e->getMessage();
}
?>
<hr>
<p><a href="<?php echo $gobackURL ?>">戻る</a></p>