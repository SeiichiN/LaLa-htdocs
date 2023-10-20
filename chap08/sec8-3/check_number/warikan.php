<?php
require_once('../../lib/util.php');
require_once('warikan_util.php');
cken_check($_POST);
?>
<?php
$errors = [];
$goukei = getGoukeiFromPost($errors);
$ninzu = getNinzuFromPost($errors);
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