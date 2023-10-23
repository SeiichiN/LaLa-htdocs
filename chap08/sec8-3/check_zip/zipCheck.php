<?php require_once('../../common/header.php'); ?>
<?php
require_once('../../lib/util.php');
cken_check($_POST);
?>
<?php
$errors = [];
$zip = '';
if (isset($_POST['zip'])) {
  $zip = trim(mb_convert_kana($_POST['zip'], "as"));
  $pattern = "/^[0-9]{3}-[0-9]{4}$/";
  if (preg_match($pattern, $zip)) {
    ;
  } else {
    $errors[] = "郵便番号を正しく入力してください。";
  }
} else {
  $errors[] = "郵便番号を正しく入力してください。";
}
$name = "";
if (isset($_POST['name'])) {
  $name = trim(mb_convert_kana($_POST['name']));
  $len = mb_strlen($name);
  if ($len < 20 || $len > 0) {
    ;
  } else {
    $errors[] = "名前が不正です。";
  }
} else {
  $errors[] = "名前が未入力です。";
}
?>

<?php
if (count($errors) > 0) {
  print_error($errors);
} else {
  echo h($name), "さんの郵便番号は", h($zip), "です。";
}
gotoUrl("zipCheckForm.php");
?>

<?php require_once('../../common/footer.php');
