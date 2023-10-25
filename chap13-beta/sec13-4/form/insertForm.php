<?php
session_start();
require_once('../../lib/util.php');

function checked(string $value, array $checkedValue) {
  $isCheckd = in_array($value, $checkedValue);
  if ($isCheckd){
    echo 'checked';
  }
}

require_once('../../common/header.php'); ?>
<?php
$errors = [];
if (!empty($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
  $_SESSION['errors'] = [];
}
$person = ['name' => '', 'age' => 0, 'sex' => ''];
if (!empty($_SESSION['person'])) {
  $person = $_SESSION['person'];
  $_SESSION['person'] = [];
}
?>
<article>
<?php
if (count($errors) > 0) {
  print_error($errors);
}
?>
<form method="post" action="insert_member.php">
  <ul>
    <li>
      <label>
        名前：<input type="text" name="name" placeholder="名前" value="<?= $person['name'] ?>">
      </label>
    </li>
    <li>
      <label>
        年齢：<input type="number" name="age" placeholder="半角数字"
          value="<?= $person['age'] ?>">
      </label>
    </li>
    <li>
      性別：
      <label><input type="radio" name="sex" value="男"
        <?= checked($person['sex'], ['男']) ?>>男性</label>
      <label><input type="radio" name="sex" value="女"
        <?= checked($person['sex'], ['女']) ?>>女性</label>
    </li>
    <li><input type="submit" value="追加する"></li>
  </ul>
</form>
</article>
<?php require_once('../../common/footer.php');
