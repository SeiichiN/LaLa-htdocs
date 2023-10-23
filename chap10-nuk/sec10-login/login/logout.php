<?php
session_start();
require_once('lib/util.php');
?>
<?php
function killSession()
{
  $_SESSION = [];
  if (isset($_COOKIE[session_name()])) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 3600, $params['path']);
  }
  session_destroy();
}
?>
<?php
$errors = [];
?>
<?php
if (isset($_SESSION['id']) && $_SESSION['id'] !== null) {
  $session_id = $_SESSION['id'];
  killSession();
} else {
  $errors[] = "セッションエラーです";
}
?>
<?php require_once('common/header.php'); ?>

<?php if (count($errors) > 0) : ?>
  <?php print_error($errors); ?>
<?php else : ?>
  <div>ログアウトしました</div>
  <p>ログアウトにともない、サーバーのメモリ上に保存されているセッション情報を削除します。<br>
    また、クッキー情報として設定されているPHPSESSIDも破棄します。(p425参照)<br>
    デベロッパーツールでPHPSESSIDが無くなっていることを確認してください。</p>
<?php endif; ?>

<div><?php gotoUrl("index.php"); ?></div>

<figure><img src="session-04.png" alt="セッション4"></figure>
<?php
$script = 'js/script.js';
require_once('common/footer.php');
