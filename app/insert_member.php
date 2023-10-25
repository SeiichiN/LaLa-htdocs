<?php
session_start();
require_once('lib/util.php');
require_once('db_functions.php');
$gotoURL = "insertForm.php";
if (!cken($_POST)) {
  header("Location: {$gotoURL}");
  exit();
}
$errors = [];

if (!isset($_POST['name']) || $_POST['name'] === "") {
  $errors[] = "名前が空です。";
}
if (!isset($_POST['age']) || !ctype_digit($_POST['age'])) {
  $errors[] = "数値を入れてください。";
}
if (!isset($_POST['sex']) || !in_array($_POST['sex'], ['男', '女'])) {
  $errors[] = "性別が不正です。";
}

$person = [
  'name' => $_POST['name'],
  'age' => (int) $_POST['age'],
  'sex' => $_POST['sex'],
];

if (count($errors) > 0) {
  $_SESSION['errors'] = $errors;
  $_SESSION['person'] = $person;
  header("Location: {$gotoURL}");
  exit();
}

require_once('common/header.php');
?>
<?php

$result = create_data($person); 

if ($result) {
  echo "<p>登録成功</p>";
  echo '<a href="all.php">一覧</a>';
} else {
  echo "<p>登録失敗</p>";
  echo '<a href="', $gotoURL, '">もどる</a>';
}
require_once('common/footer.php');
