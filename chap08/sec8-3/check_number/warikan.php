<?php
require_once('../../lib/util.php');

cken_check($_POST);
?>
<?php
$errors = [];
$goukei = 0;
if (isset($_POST['goukei'])) {
  $goukei = $_POST['goukei'];
  if (ctype_digit($goukei)) {
    $goukei = (int) $goukei;
  } else {
    $errors[] = "合計金額を整数で入力してください。";
  }
} else {
  $errors[] = "合計金額が未設定";
}
$ninzu = 0;
if (isset($_POST['ninzu'])) {
  $ninzu = $_POST['ninzu'];
  if (ctype_digit($ninzu)) {
    $ninzu = (int) $ninzu;
    if ($ninzu === 0) {
      $errors[] = "0人では割れません。";
    }
  }
} else {
  $errors[] = "人数が未設定";
}
?>

<?php require_once('../../common/header.php'); ?>

<?php
if (count($errors) > 0) {
  print_error($errors);
  ?>
  <form method="post" action="warikanForm.php">
    <ul>
      <li><input type="submit" vlaue="戻る"></li>
    </ul>
  </form>
  <?php
} else {
  $amari = $goukei % $ninzu;
  $price = ($goukei - $amari) / $ninzu;
  $goukei_fmt = number_format($goukei);
  $price_fmt = number_format($price);
  echo h($goukei_fmt), "円を";
  echo h($ninzu), "人で割り勘します。<br>";
  echo "１人あたり", h($price_fmt);
  echo "円を支払えば、不足分は", h($amari), "円です。";
}