<?php
session_start();
require_once('../../lib/util.php');
$couponList = ["ABC123", "XYZ999"];
require_once('../../common/header.php');
?>
<?php
if (isset($_SESSION['coupon'])) {
  pre_dump($couponList);
  $coupon = $_SESSION['coupon'];
  if (in_array($coupon, $couponList)) {
    echo h($coupon), "は、正しいクーポンコードです。";
  } else {
    echo h($coupon), "は、誤ったクーポンコードです。";
  }
} else {
  echo "セッションエラーです。";
}
?>

<?php require_once('../../common/footer.php');
