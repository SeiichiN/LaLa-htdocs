<?php
require_once('lib/util.php');
require_once('dblib/db_util.php');

$gobackURL = 'insertform.php';

if (!cken($_POST)) {
  header("Location: {$gobackURL}");
  exit();
}
require_once('common/header.php');
$errors = [];
if (!isset($_POST['id']) || $_POST['id'] === "") {
  $errors[] = "商品IDが空です。";
}
if (!isset($_POST['name']) || $_POST['name'] === "") {
  $errors[] = "商品名が空です。";
}
if (!isset($_POST['size']) || $_POST['size'] === "") {
  $errors[] = "サイズが空です。";
}
if (!isset($_POST['brand']) || $_POST['brand'] === "") {
  $errors[] = "ブランドが空です。";
}
if (!isset($_POST['quantity']) || !ctype_digit($_POST['quantity'])) {
  $errors[] = "個数が整数ではありません。";
}
if (count($errors) > 0) {
  print_error($errors);
  echo "<hr>";
  echo '<a href="', $gobackURL, '">もどる</a>';
  exit();
}

$goodsStockData['id'] = $_POST['id'];
$goodsStockData['name'] = $_POST['name'];
$goodsStockData['brand'] = $_POST['brand'];
$goodsStockData['size'] = $_POST['size'];
$goodsStockData['quantity'] = $_POST['quantity'];
$result = insert_goods_stock($goodsStockData);
if ($result) {
  echo "<p>商品データを登録しました。</p>";
} else {
  echo "<p>商品の登録に失敗しました。</p>";
}
?>
<hr>
<p><a href="<?= $gobackURL ?>">もどる</a></p>
<?php require_once('common/footer.php');
