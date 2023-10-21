<?php
require_once('../../lib/util.php');

cken_check($_POST);
?>

<?php
$errors = [];

$meals = ["朝食", "夕食"];
$mealChecked = [];
if (isset($_POST['meal'])) {
  pre_dump($_POST['meal']);
  $mealChecked = $_POST['meal'];
  $diffValue = array_diff($mealChecked, $meals);
  if (count($diffValue) === 0) {
  } else {
    $errors[] = "食事にエラーがありました。";
    $mealChecked = [];
  }
}

$tours = ["カヌー", "MTB", "トレラン"];
$tourChecked = [];
if (isset($_POST['tour'])) {
  pre_dump($_POST['tour']);
  $tourChecked = $_POST['tour'];
  $diffValue = array_diff($tourChecked, $tours);
  if (count($diffValue) === 0) {
  } else {
    $errors[] = "ツアー中にエラーがありました。";
    $tourChecked = [];
  }
}
?>
<?php
function checked(string $value, array $checkedValue)
{
  if (in_array($value, $checkedValue)) {
    echo "checked";
  }
}
?>
<?php require_once('../../common/header.php'); ?>
<form method="post" action="">
  <ul>
    <li>
      <span>食事: </span>
      <label>
        <input type="checkbox" name="meal[]" value="朝食" <?php checked("朝食", $mealChecked); ?>>朝食
      </label>
      <label>
        <input type="checkbox" name="meal[]" value="夕食" <?php checked("夕食", $mealChecked); ?>>夕食
      </label>
    </li>
    <li>
      <span>ツアー: </span>
      <label>
        <input type="checkbox" name="tour[]" value="カヌー" <?php checked("カヌー", $tourChecked); ?>>カヌー
      </label>
      <label>
        <input type="checkbox" name="tour[]" value="MTB" <?php checked("MTB", $tourChecked); ?>>MTB
      </label>
      <label>
        <input type="checkbox" name="tour[]" value="トレラン" <?php checked("トレラン", $tourChecked); ?>>トレラン
      </label>
    </li>
    <li><input type="submit" value="送信する" /> </li>
  </ul>
</form>
<?php
$isSelected = count($mealChecked) > 0 || count($tourChecked) > 0;
if ($isSelected) {
  echo "<hr>";
  echo "お食事：", h(implode(" と ", $mealChecked)), "<br>";
  echo "ツアー：", h(implode(" と ", $tourChecked)), "<br>";
} else {
  echo "<hr>";
  echo "選択されているものはありません。";
}
?>
<?php
if (count($errors) > 0) {
  print_error($errors);
}
?>
<?php require_once('../../common/footer.php');
