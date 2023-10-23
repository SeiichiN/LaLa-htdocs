<?php
session_start();
require_once('../../lib/util.php');

$errors = [];
if (isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
  $_SESSION['errors'] = [];
}

require_once('../../common/header.php'); ?>
<?php
if (count($errors) > 0) {
  print_error($errors);
}
?>
<form method="post" action="nameCheck.php">
  <ul>
    <li>
      <label>名前：
        <input type="text" name="name">
      </label>
    </li>
    <li><input type="submit" value="送信する"></li>
  </ul>
</form>

<?php require_once('../../common/footer.php');
