<?php
session_start();
require_once('../../lib/util.php');
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
<?php require_once('../../common/header.php'); ?>
<main>
  <?php
  if (count($errors) > 0) {
    print_error($errors);
  } else {
    echo "<p>(セッションID = ", h($session_id), ")<br>";
    echo "ログアウトしました</p>";
  }
  gotoUrl("index.php");
  ?>
</main>
<?php require_once('../../common/footer.php');
