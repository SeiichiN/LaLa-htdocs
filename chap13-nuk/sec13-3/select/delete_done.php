<?php
session_start();
require_once('../../lib/util.php');
require_once('../../dblib/db_functions.php');

$errors = [];

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  if (ctype_digit($id)) {
    $id = (int) $id;
  } else {
    $errors[] = "idが不正です。";
  }
} else {
  $errors[] = "IDが未入力です。";
}

if (count($errors) > 0) {
  $_SESSION['errors'] = $errors;
  header("Location: delete.php");
}

require_once('../../common/header.php');
if (delete_data($id)) {
  echo "<p>削除しました。</p>";
} else {
  echo "<p>削除に失敗しました。</p>";
}
gotoUrl('index.php');
require_once('../../common/footer.php');
