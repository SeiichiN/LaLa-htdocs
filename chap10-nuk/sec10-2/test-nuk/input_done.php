<?php
session_start();
require_once('../../lib/util.php');

$errors = [];

if (isset($_POST['name'])) {
  $name = trim(mb_convert_kana($_POST['name'], "s"));
  $len = mb_strlen($name);
  if ($len < 20 && $len > 0) {
  } else {
    $name = '';
    $errors[] = "名前が不正です。";
  }
} else {
  $errors[] = "名前が未入力です。";
}

if (count($errors) > 0) {
  $_SESSION['errors'] = $errors;
  $_SESSION['name'] = $name;
  header('Location: input_data.php');
  exit();
}
require_once('../../common/header.php');
echo "<p>{$name}さんを受け取りました。</p>";
require_once('../../common/footer.php');
