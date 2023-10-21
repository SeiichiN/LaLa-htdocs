<?php
function getZipFromPost(&$errors)
{
  $zip = "";
  if (isset($_POST['zip'])) {
    $zip = trim($_POST['zip']);
    $pattern = "/^[0-9]{3}-[0-9]{4}$/";
    if (!preg_match($pattern, $zip)) {
      $errors[] = "郵便番号を正しく入力してください。";
    }
  } else {
    $errors[] = "郵便番号を正しく入力してください。";
  }
  return $zip;
}
?>
<?php require_once('../../common/header.php'); ?>
<?php
require_once('../../lib/util.php');
cken_check($_POST);
?>
<?php
$errors = [];
$zip = getZipFromPost($errors);

$name = "";
if (isset($_POST['name'])) {
  $name = $_POST['name'];
  if (preg_match("/^[A-Za-z]+$/", $name)) {;
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
  echo "郵便番号は", h($zip), "です。<br>";
  echo "名前は" . h($name) . "です。";
}
gotoUrl("zipCheckForm.php");
?>

<?php require_once('../../common/footer.php');
