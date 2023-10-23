<?php
session_start();
require_once('../../lib/util.php');

cken_check($_POST);
?>
<?php
$errors = [];
$name = "";
if (isset($_POST['name'])) {
  $name = trim(mb_convert_kana($_POST['name'], "s"));
  $len = mb_strlen($name);
  if ($len > 20 || $len === 0) {
    $errors[] = "名前が不正です。";
  }
} else {
  $errors[] = "名前が未入力";
}
?>
<?php require_once('../../common/header.php'); ?>

<?php if (count($errors) > 0): ?>
  <?php 
  $_SESSION['errors'] = $errors;
  header('Location: nameCheckForm.php');
  exit(); 
  ?>
<?php else: ?>
  <span>こんにちは、<?php echo h($name); ?>さん</span>
<?php endif; ?>

<p><a href="nameCheckForm.php">戻る</a></p>



<?php require_once('../../common/footer.php');
