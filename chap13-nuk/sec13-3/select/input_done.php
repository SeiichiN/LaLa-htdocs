<?php
session_start();
require_once('../../lib/util.php');
require_once('../../lib/db_functions.php');

// pre_dump($_SESSION['person']);

$person = [
  'id' => 0,
  'name' => "",
  'age' => 0,
  'sex' => ""
];
$result = null;
$errors = [];

// if (isset($_SESSION['person']) && !empty($_SESSION['person'])) {
//   $person = $_SESSION['person'];
// }
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  if (ctype_digit($id)) {
    $person['id'] = (int)$id;
  } else {
    $errors[] = "IDの形式が不正です。";
  }
} else {
  $errors[] = "IDが未入力です。";
}
if (isset($_POST['name'])) {
  $name = trim(mb_convert_kana($_POST['name'], "s"));
  if (mb_strlen($name) < 20 && mb_strlen($name) > 0) {
    $person['name'] = $name;
  } else {
    $errors[] = "名前の文字数が不正です。";
  }
} else {
  $errors[] = "名前が未入力です。";
}
if (isset($_POST['age'])) {
  $age = $_POST['age'];
  if (ctype_digit($age) && intval($age) > 0) {
    $person['age'] = (int)$age;
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
?>
<?php
if (count($errors) > 0) {
  $_SESSION['errors'] = $errors;
  $_SESSION['person'] = $person;
  header('Location: input.php');
  exit();
}
?>
<?php require_once('../../common/header.php'); ?>
<section class="flex">
  <article class="main">
    <?php
    if (insert_data($person)) {
      echo "<p>登録しました。</p>";
    } else {
      echo "<p>登録に失敗しました。</p[>";
    }
    ?>
  </article>
  <?php require_once('aside.php'); ?>
</section>
<?php require_once('../../common/footer.php');
