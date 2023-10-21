<?php
require_once('../../lib/util.php');
cken_check($_POST);
?>

<?php
$errors = [];

$errMsg = ['bad_data' => '割引率の数値が不正です', 'no_data' => '割引率が未入力'];
$myfunc = function ($s) {
  return is_numeric($s);
};
$discount = getFromPost('discount', $errors, $myfunc, $errMsg);

$errMsg = ['bad_data' => '単価は整数で入力してください', 'no_data' => '単価が未入力'];
$myfunc = function ($s) {
  return ctype_digit($s);
};
$tanka = getFromPost('tanka', $errors, $myfunc, $errMsg);


$errMsg = ['bad_data' => '個数は整数で入力してください', 'no_data' => '個数が未入力'];
$myfunc = function ($s) {
  return ctype_digit($s);
};
$kosu = getFromPost('kosu', $errors, $myfunc, $errMsg);
?>
<?php require_once('../../common/header.php'); ?>
<?php
if (count($errors) > 0) {
  print_error($errors);
} else {
  $price = $tanka * $kosu;
  $discount_price = floor($price * $discount);
  $off_price = $price - $discount_price;
  $off_per = (1 - $discount) * 100;
  $tanka_fmt = number_format($tanka);
  $discount_price_fmt = number_format($discount_price);
  $off_price_fmt = number_format($off_price);

  echo "単価：" . h($tanka_fmt) . "円、個数：" . h($kosu) . "個<br>";
  echo "金額：" . h($discount_price_fmt) . "円<br>";
  echo "(割引：" . h($off_price_fmt) . "円、" . h($off_per) . "%OFF)";
}
?>
<?php
gotoUrl("discountForm.php", ['kosu', $kosu]);
?>
<?php require_once('../../common/footer.php');
