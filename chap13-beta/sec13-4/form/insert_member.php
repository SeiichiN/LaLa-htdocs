<?php
session_start();
require_once('../../lib/util.php');
$gobackURL = "insertForm.php";

if (!cken($_POST)) {
  header("Location:{$gobackURL}");
  exit();
}

$errors = [];

$person = ['name' => '', 'age' => 0, 'sex' => ''];
if (isset($_POST['name']) && $_POST['name'] !== "") {
  $person['name'] = $_POST['name'];
} else {
  $errors[] = "名前が空です。";
}
if (isset($_POST['age']) && ctype_digit($_POST['age'])) {
  $person['age'] = (int)$_POST['age'];
  if ($person['age'] > 0 && $person['age'] < 100) {
  } else {
    $errors[] = "年齢の数字が不正です。";
  }
} else {
  $errors[] = "年齢には数字を入れてください。";
}
if (isset($_POST['sex']) && in_array($_POST['sex'], ['男', '女'])) {
  $person['sex'] = $_POST['sex'];
} else {
  $errors[] = "性別が不正です。";
}

if (count($errors) > 0) {
  $_SESSION['errors'] = $errors;
  $_SESSION['person'] = $person;
  header("Location: {$gobackURL}");
  exit();
}

$user = 'testuser';
$password = 'testuser';
$dbname = 'testdb';
$host = 'localhost:3306';
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

require_once('../../common/header.php');
?>
<?php
$result = false;
try {
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = <<< EOS
    INSERT INTO member (name, age, sex) 
    VALUES (:name, :age, :sex)
EOS;
  $stm = $pdo->prepare($sql);
  $stm->bindValue(':name', $person['name'], PDO::PARAM_STR);
  $stm->bindValue(':age', $person['age'], PDO::PARAM_INT);
  $stm->bindValue(':sex', $person['sex'], PDO::PARAM_STR);
  $result = $stm->execute();
} catch (Exception $e) {
  echo '<span class="error">エラーがありました。</span><br>';
  echo $e->getMessage();
  exit();
}
if ($result) {
  echo "<p>登録できました。</p>";
} else {
  echo "<p>登録に失敗しました。</p>";
}
?>
<div><a href="all.php">一覧</a></div>
<?php
require_once('../../common/footer.php');
