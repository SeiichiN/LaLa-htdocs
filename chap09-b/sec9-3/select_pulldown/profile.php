<?php
require_once('../../lib/util.php');
require_once('../../common/header.php');

cken_check($_POST);
// pre_dump($_POST);
?>
<?php
$errors = [];
$isSex = false;
if (isset($_POST['sex'])) {
  $sexValue = ['男性', '女性'];
  $sex = $_POST['sex'];
  if (in_array($sex, $sexValue)) {
    $isSex = true;
  } else {
    $sex = "error";
    $errors[] = "性別入力エラー";
  }
} else {
  $sex = "";
  $errors[] = "性別未入力";
}
$isMarriage = false;
if (isset($_POST['marriage'])) {
  $marriageValue = ['独身', '既婚', '同棲中'];
  $marriage = $_POST['marriage'];
  if (in_array($marriage, $marriageValue)) {
    $isMarriage = true;
  } else {
    $marriage = "error";
    $errors[] = "結婚入力エラー";
  }
} else {
  $marriage = "";
  $errors[] = "結婚未入力";
}
// var_dump($sex);
// echo "<br>";
// var_dump($marriage);

function selected(string $str, string $value) {
  if ($str === $value) {
    echo "selected";
  }
}
?>
<form method="post" action="">
  <ul>
    <li>
      <span>性別：</span>
      <select name="sex">
        <option value="男性" <?php selected("男性", $sex) ?>>男性</option>
        <option value="女性" <?php selected("女性", $sex) ?>>女性</option>
        <option value="その他" <?php selected("その他", $sex) ?>>その他</option>
      </select>
    </li>
    <li>
      <span>結婚：</span>
      <select name="marriage">
        <option value="独身" <?php selected("独身", $marriage) ?>>独身</option>
        <option value="既婚" <?php selected("既婚", $marriage) ?>>既婚</option>
        <option value="同棲中" <?php selected("同棲中", $marriage) ?>>同棲中</option>
        <option value="その他" <?php selected("その他", $marriage) ?>>その他</option>
      </select>
    </li>
    <li><input type="submit" value="送信する"></li>
  </ul>
</form>

<hr>
<?php if ($isSex && $isMarriage) : ?>
  <p>あなたは<?= h($sex) ?>、<?= h($marriage) ?>です。</p>
<?php endif; ?>
<?php
if (count($errors) > 0) {
  print_error($errors);
}
?>

<?php require_once('../../common/footer.php');
