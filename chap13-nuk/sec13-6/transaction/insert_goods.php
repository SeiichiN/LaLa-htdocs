<?php
require_once('../../lib/util.php');
require_once('db_functions.php');

$gobackURL = "insertform.php";

if (!cken($_POST)) {
  header("Location: {$gobackURL}");
  exit();
}

require_once('../../common/header.php');
$errors = [];
if (!isset($_POST['id']) || $_POST['id'] === '') {
  $errors[] = "商品IDが空です。";
}
if (!isset($_POST['name']) || $_POST['name'] === '') {
  $errors[] = "商品名が空です。";
}
if (!isset($_POST['brand']) || $_POST['brand'] === '') {
  $errors[] = "ブランドが空です。";
}
if (!isset($_POST['quantity']) || !ctype_digit($_POST['quantity'])) {
  $errors[] = "個数の数値が整数ではありません";
}
if (count($errors) > 0) {
  print_error($errors);
  echo "<hr>";
  echo "<a href='", $gobackURL, "'>もどる</a>";
  exit();
}

$pdo = connect();

try {
  $pdo->beginTransaction();
  $sql1 = <<< EOS
    INSERT INTO goods (id, name, size, brand)
    VALUES (:id, :name, :size, :brand)
EOS;
  $sql2 = <<< EOD
    INSERT INTO stock (goods_id, quantity)
    VALUES (:goods_id, :quantity)
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
  echo "商品データ・在庫データを追加しました。";
} catch (Exception $e) {
  $pdo->rollBack();
  echo "登録エラー";
  echo $e->getMessage();
}
?>
<hr>
<p><a href="<?= $gobackURL ?>">もどる</a></p>
<?php require_once('../../common/footer.php');
