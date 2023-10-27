<?php
require_once('lib/util.php');
require_once('dblib/db_util.php');
$gobackURL = 'insertform.php';

$brand = get_brand_list();
if ($brand === null) {
  header("Location: index.php");
  exit();
}
?>
<?php require_once('common/header.php'); ?>
<form method="post" action="insert_goods.php">
  <li>
    <label>商品ID：
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
      <input type="text" name="size" placeholder="未入力OK">
    </label>
  </li>
  <li>
    <select name="brand">
      <?php
      foreach ($brand as $row) {
        echo '<option value="', $row['id'], '">', $row['name'], '</option>';
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
</form>
<?php require_once('common/footer.php');
