<?php
session_start();
require_once('../../lib/util.php');
?>
<?php
function killSession() {
  $_SESSION = [];
  if (isset($_COOKIE[session_name()])) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time()-36000, $params['path']);
  }
  session_destroy();
}
?>
<?php
$errors = [];
if (!empty($_SESSION['id'])) {
  $id = $_SESSION['id'];
} else {
  $errors[] = "セッションエラーです。";
}
killSession();
?>
<?php require_once('../../common/header.php');?>
<?php if (count($errors) > 0): ?>
  <?php print_error($errors); ?>
<?php else: ?>
  <div>ログアウトしました。</div>
<?php endif; ?>
<div>
  <a href="index.php">
    <button>トップへ</button>
  </a>
</div>
<?php require_once('../../common/footer.php');
