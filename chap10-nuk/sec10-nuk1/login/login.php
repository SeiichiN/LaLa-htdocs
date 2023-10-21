<?php session_start(); ?>
<?php require_once('../../lib/util.php'); ?>
<?php require_once('user_db.php'); ?>
<?php

$isLogin = false;
$isError = false;
$errors = [];
?>

<?php
$id = "";
$pass = "";
if (isset($_POST['id']) && isset($_POST['pass'])) {
  $id = $_POST['id'];
  $pass = $_POST['pass'];

  if (isValidUser($id, $pass)) {
    session_regenerate_id(true);
    $isLogin = true;
    $_SESSION['id'] = $id;
  }
}
?>
<?php
if (!$isLogin) {
  $errors[] = "IDもしくはパスワードが違います";
  $isError = true;
}
?>
<?php require_once('../../common/header.php'); ?>
<main>
  <?php
  if ($isError) {
    print_error($errors);
  }
  ?>
  <?php if ($isLogin) : ?>
    <p>ようこそ、<?= h($id) ?>さん<br>
      (セッションID = <?= h($_SESSION['id']) ?> )</p>
    <a href="main.php">メインページへ</a>
  <?php endif; ?>
  <?php
  gotoUrl("index.php");
  ?>
</main>
<?php
require_once('../../common/footer.php');
