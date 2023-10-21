<?php require_once('../../lib/util.php'); ?>
<?php require_once('../../common/header.php'); ?>
<?php cken_check($_POST); ?>
<?php
$errors = [];
$mile = "";
$isNum = false;
if (isset($_POST['mile'])) {
  $mile = $_POST['mile'];
  if (is_numeric($mile)) {
    $isNum = true;
  } else {
    $errors[] = '数値を入力してください';
  }
} else {
  // 初めてこのページを開く
  $errors[] = '数値を入力してください';
}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
  <ul>
    <li>
      <label>マイルをキロに換算
        <input type="text" name="mile" value="<?= h($mile) ?>" />
      </label>
      <?php print_error($errors); ?>
    </li>
    <li><input type="submit" value="計算する" </li>
  </ul>
</form>
<?php
if ($isNum) {
  $kilometer = $mile * 1.609344;
  echo "<hr>";
  echo h($mile), "マイルは", h($kilometer), "kmです。";
}
?>
<?php require_once('../../common/footer.php');
