<?php
require_once('../../lib/util.php');
$gobackURL = 'insertform.php';

$user = 'inventoryuser';
$password = 'inventoryuser';
$dbName = 'inventory';
$host = 'localhost:3306';
$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";

try {
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT id, name FROM brand";
  $stm = $pdo->prepare($sql);
  $stm->execute();
  $brand = $stm->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
  echo 'エラーがありました。';
  echo $e->getMessage();
  exit();
}
?>

<?php require_once('../../common/header.php'); ?>

<form action="insert_goods.php" method="post">
  <ul>
    <li>
      <label>商品：
        <input type="text" name="id" placeholder="商品ID">
      </label>
    </li>
    <li>
      <label>商品名：
        <input type="text" name="name" placeholder="商品名">
      </label>
    </li>
    <li>
      <label>サイズ：
        <input type="text" name="size" placeholder="（未入力でもOK）">
      </label>
    </li>
    <li>ブランド
      <select name="brand">
        <?php
        foreach ($brand as $row) {
          echo '<option value="', $row['id'], '">', $row['name'], "</option>";
        }
        ?>
      </select>
    </li>
    <li>
      <label>個数：
        <input type="number" name="quantity" placeholder="半角数字">
      </label>
    </li>
    <li><input type="submit" value="追加する"></li>
  </ul>
</form>

<?php require_once('../../common/footer.php'); ?>