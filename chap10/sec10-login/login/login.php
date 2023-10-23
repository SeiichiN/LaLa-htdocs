<?php
session_start();
require_once('../../lib/util.php');
require_once('user_db.php');

cken_check($_POST);
?>
<?php
$errors = [];
$id = "";
$pass = "";
$isLogin = false;
if (isset($_POST['id'])) {
  $id = trim(mb_convert_kana($_POST['id'], "as"));
}
if (isset($_POST['password'])) {
  $pass = $_POST['password'];
}
if (isValidUser($id, $pass)) {
  session_regenerate_id();
  $isLogin = true;
  $_SESSION['id'] = $id;
}
if (!$isLogin) {
  $errors[] = "IDもしくはパスワードがちがいます。";
}
?>
<?php require_once('../../common/header.php'); ?>
<?php
if (count($errors) > 0) {
  $_SESSION['errors'] = $errors;
  header('Location: index.php');
  exit();
}
?>
<?php if ($isLogin): ?>
  <p>ようこそ、<?= h($id); ?>さん</p>
  <div>
    <a href="main.php">
      <button>メインページ</button>
    </a>
  </div>
<?php endif; ?>
<?php require_once('../../common/footer.php');

