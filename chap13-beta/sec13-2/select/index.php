<?php
require_once('../../lib/util.php');
require_once('db_functions.php');

cken_check($_POST);

$errors = [];
$age = [];
$isAge = false;
if (isset($_POST['min_age']) && isset($_POST['max_age'])) {
  $min_age = $_POST['min_age'];
  $max_age = $_POST['max_age'];
  if (ctype_digit($min_age) && ctype_digit($max_age)) {
    $age['min'] = (int)$min_age;
    $age['max'] = (int)$max_age;
    $isAge = true;
  } else {
    $errors[] = "年齢が不正";
  }
} else {
  $errors[] = "年齢が未入力";
}

$sex = "";
$isSex = false;
if (isset($_POST['sex'])) {
  $sex = $_POST['sex'];
  if ($sex === 'm' || $sex === 'f') {
    $isSex = true;
  } else {
    $errors[] = "性別が不正";
  }
} else {
  $errors[] = "性別が未入力";
}

if ($isAge && $isSex) {
  $result = find_by_age_sex($age, $sex);
} else if ($isAge) {
  $result = find_by_age($age);
} else if ($isSex) {
  $result = find_by_sex($sex);
} else {
  $result = find_all();
}
if (!$result) {
  exit();
}

require_once('../../common/header.php');
?>
<article>
  <h2>一覧</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>名前</th>
        <th>年齢</th>
        <th>性別</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?= h($row['id']) ?></td>
          <td><?= h($row['name']) ?></td>
          <td><?= h($row['age']) ?></td>
          <td><?= h($row['sex']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</article>
<aside>
  <h2>サブメニュー</h2>
  <form method="post" action="">
    <input type="number" name="min_age">歳〜
    <input type="number" name="max_age">歳
    <?php if ($isSex) : ?>
      <input type="hidden" name="sex" value="<?= h($sex) ?>">
    <?php endif; ?>
    <input type="submit" value="選択">
  </form>
  <form method="post" action="">
    <label><input type="radio" name="sex" value="m">男性</label>
    <label><input type="radio" name="sex" value="f">女性</label>
    <?php if ($isAge) : ?>
      <input type="hidden" name="min_age" value="<?= h($age['min']) ?>">
      <input type="hidden" name="min_age" value="<?= h($age['max']) ?>">
    <?php endif; ?>
    <input type="submit" value="選択">
  </form>
  <form method="post" action="search.php">
    <input type="text" name="search" placeholder="文字">
    <input type="submit" value="検索">
  </form>
</aside>
<?php require_once('../../common/footer.php');
