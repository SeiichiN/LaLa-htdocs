<?php
session_start();
require_once('../../lib/util.php');
$errors = [];
if (isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
  $_SESSION['errors'] = [];
}
require_once('../../common/header.php');
?>
<h1>ログイン</h1>
<?php
if (count($errors) > 0) {
  print_error($errors);
}
?>
<form method="post" action="login.php">
  ログインID：<input type="text" name="id"><br>
  パスワード：<input type="password" name="password"><br>
  <input type="submit" value="ログイン">
</form>
<?php
require_once('../../common/footer.php');
