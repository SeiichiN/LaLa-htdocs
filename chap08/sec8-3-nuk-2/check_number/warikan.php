<?php
require_once('../../lib-nuk/util.php');
require_once('warikan_util.php');
cken_check($_POST);
?>
<?php
$errors = [];
?>
<?php
$goukei = getGoukei($errors);
$ninzu = getNinzu($errors);

$h1 = "割り勘計算";
require_once('../../common/header.php');
?>
<?php
if (count($errors) > 0) {
  print_error($errors);
?>
  <form method="post" action="warikanForm.php">
    <ul>
      <li><input type="submit" value="戻る" </li>
    </ul>
  </form>
<?php
} else {
  $amari = $goukei % $ninzu;
  $price = ($goukei - $amari) / $ninzu;
  $goukei_fmt = number_format($goukei);
  $price_fmt = number_format($price);
  echo h($goukei_fmt), "円を", h($ninzu), "人で割り勘します。", "<br>";
  echo "一人あたり", h($price_fmt), "円を支払えば、不足分は", h($amari), "円です。<br>";
  echo '$ninzu:', gettype($amari), "<br>";
  echo 'h($ninzu):', gettype(h($amari));
}
?>
<?php require_once('../../common/footer.php'); ?>

<!-- 修正時刻: Tue 2023/02/21 06:12:58 -->