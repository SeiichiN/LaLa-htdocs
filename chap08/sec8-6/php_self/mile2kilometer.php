<?php
require_once('../../lib/util.php');
require_once('../../common/header.php');
cken_check($_POST);
?>
<?php
$errors = [];
$isNum = false;
$mile = "";
if (isset($_POST['mile'])) {
  $mile = $_POST['mile'];  // 文字列
  if (is_numeric($mile)) {
    $isNum = true;
  } else {
    $mile = "";
    $errors[] = "数値を入力してください。";
  }
}
?>
<?php
if (count($errors) > 0) {
  print_error($errors);
}
?>
<form method="post" action="">
  <ul>
    <li>
      <label>マイルをkmに換算：
        <input type="text" name="mile" value="<?= $mile; ?>">
      </label>
      <li><input type="submit" value="計算する"></li>
    </li>
  </ul>
</form>
<?php
if ($isNum) {
  echo "<hr>";
  $kilometer = $mile * 1.609366;
  echo "<p>{$mile}マイルは{$kilometer}kmです。</p>";
}
require_once('../../common/footer.php');

