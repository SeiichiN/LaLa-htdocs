<?php session_start(); ?>
<?php require_once('lib/util.php'); ?>
<?php require_once('user_db.php'); ?>
<?php
cken_check($_POST);

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
<?php require_once('common/header.php'); ?>
<?php
if ($isError) {
  print_error($errors);
  echo "<p>PHPSESSIDを確認してください。同じはずです。<br>";
  echo "IDパスワードは違うけれども、同じブラウザからのアクセスだと<br>";
  echo "サーバーは認識しています。";
}
?>
<?php if ($isLogin) : ?>
  <p>ようこそ、<?= h($id) ?>さん</p>
  <div><a href="main.php"><button>メインページへ</button></a></div>
  <p>PHPSESSIDを確認してください。<br>新しいPHPSESSIDになっているはずです。<br>
    IDとパスワードがOKだったので、正規ユーザーだと認識されました。<br>
    <br>
    $_SESSION['id'] にあなたのIDが保存されました。<br>
    現在ログインしているユーザーだということです。<br>
    これはサーバーのメモリ領域に保存され、ブラウザには送信されません。<br>
    <br>
    この時点で新しいPHPSESSIDが発行されています。<br>
    これはセッションIDへの不正行為を防ぐためです。<br>
    今後のブラウザとサーバーでのやり取りでは、<br>
    このPHPSESSIDが同一セッション(同一ブラウザ)の証となります。
  </p>
<?php endif; ?>
<div><?php gotoUrl("index.php"); ?></div>
<figure><img src="session-02.png" alt="セッション2"></figure>
<?php
$script = 'js/script.js';
require_once('common/footer.php');
