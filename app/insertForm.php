<?php
session_start();
require_once('lib/util.php'); 

function checked($v, $sex) {
  if ($v === $sex) {
    echo 'checked';
  }
}
$person = ['name' => '', 'age' => '', 'sex' => ''];
$errors = [];
if (!empty($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
  $_SESSION['errors'] = '';
  $person = $_SESSION['person'];
  $_SESSION['person'] = '';
}

require_once('common/header.php'); 
?>
<article>
  <h2>新規登録</h2>
  <?php
  if (count($errors) > 0) {
    print_error($errors);
  }
  ?>
  <form method="post" action="insert_member.php">
    <ul>
      <li>
        <label>名前：
          <input type="text" name="name" placeholder="名前"
                  value="<?= $person['name'] ?>">
        </label>
      </li>
      <li>
        <label>年齢：
          <input type="number" name="age" placeholder="半角数字"
                  value="<?= $person['age'] ?>">
        </label>
      </li>
      <li>
        <label><input type="radio" name="sex"
              value="男" <?php checked("男", $person['sex']); ?>>男性</label>
        <label><input type="radio" name="sex" 
              value="女" <?php checked("女", $person['sex']); ?>>女性</label>
      </li>
      <li><input type="submit" value="追加"></li>
    </ul>
  </form>
</article>
<?php require_once('common/aside.php'); ?>
<?php require_once('common/footer.php');
