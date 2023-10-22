<?php
session_start();
require_once('../../lib/util.php');

$errors = [];
$name = '';

if (isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
  $_SESSION['errors'] = '';
}
if (isset($_SESSION['name'])) {
  $name = $_SESSION['name'];
  $_SESSION['name'] = '';
}
require_once('../../common/header.php');
if (count($errors) > 0) {
  print_error($errors);
}
?>
<form method="post" action="input_done.php">
  名前：<input type="text" name="name" value="<?= $name ?>"><br>
  <input type="submit" value="送信">
</form>
<?php
require_once('../../common/footer.php');
