<?php
session_start();
require_once('../../lib/util.php');
require_once('../../lib/db_functions.php');

$person = [];
$errors = [];
if (empty($_SESSION['id'])) {
  header('Location: index.php');
} else {
  $person['id'] = $_SESSION['id'];
}
if (isset($_POST['name'])) {
  $name = trim($_POST['name']);
  if (mb_strlen($name) < 20 && mb_strlen($name) > 0) {
    $person['name'] = $name;
  } else {
    $errors[] = "名前の文字列が不正です。";
  }
} else {
  $errors[] = "名前が未入力です。";
}
if (isset($_POST['age'])) {
  $age = $_POST['age'];
  if (ctype_digit($age)) {
    $person['age'] = (int) $age;
  } else {
    $errors[] = "年齢が不正です。";
  }
} else {
  $errors[] = "年齢が未入力です。";
}
if (isset($_POST['sex'])) {
  $sex = $_POST['sex'];
  if (in_array($sex, ['男', '女'])) {
    $person['sex'] = $sex;
  } else {
    $errors[] = "性別が不正です。";
  }
} else {
  $errors[] = "性別が未入力です。";
}

if (count($errors) > 0) {
  $_SESSION['errors'] = $errors;
  header("Location: update.php");
}

require_once('../../common/header.php');
if (update_done($person)) {
  echo "<p>更新しました。</p>";
} else {
  echo "<p>更新に失敗しました。</p>";
}
gotoUrl('index.php');
require_once('../../common/footer.php');
