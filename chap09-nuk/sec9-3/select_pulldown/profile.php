<?php
require_once('../../lib/util.php');

cken_check($_POST);

$errors = [];

// $_POST['sex'] = "性";
$sexValue = ["男性", "女性"];
$sex = "";
$isSex = false;
if (isset($_POST['sex'])) {
  $sex = $_POST['sex'];
  if (in_array($sex, $sexValue)) {
    $isSex = true;
  } else {
    $sex = "error";
    $errors[] = "「性別」に入力エラーがありました。";
  }
}
// echo $isSex;

// $_POST['marriage'] = "わん";
$marrigeValue = ["独身", "既婚", "同棲中"];
$isMarriage = false;
$marriage = "";
if (isset($_POST['marriage'])) {
  $marriage = $_POST['marriage'];
  if (in_array($marriage, $marrigeValue)) {
    $isMarriage = true;
  } else {
    $marriage = "error";
    $errors[] = "「結婚」に入力エラーがありました。";
  }
}
// echo $marriage;
?>

<?php
function selected(string $value, string $question)
{
  if ($value === $question) {
    echo "selected";
  } else {
    echo "";
  }
}
?>

<?php require_once('../../common/header.php'); ?>

<form method="post" action="">
  <ul>
    <li>
      <span>性別:</span>
      <select name="sex">
        <option value="男性" <?php selected("男性", $sex); ?>>男性</option>
        <option value="女性" <?php selected("女性", $sex); ?>>女性</option>
      </select>
    </li>
    <li>
      <span>結婚:</span>
      <select name="marriage">
        <option value="独身" <?php selected("独身", $marriage); ?>>独身</option>
        <option value="既婚" <?php selected("既婚", $marriage); ?>>既婚</option>
        <option value="同棲中" <?php selected("同棲中", $marriage); ?>>同棲中</option>
      </select>
    </li>
    <li><input type="submit" value="送信" /> </li>
  </ul>
</form>
<?php
if ($isSex && $isMarriage) {
  echo "<hr>";
  echo "あなたは「" . h($sex) . "、" . h($marriage) . "」です。";
}
?>
<?php
if (count($errors) > 0) {
  print_error($errors);
}
?>
<?php require_once('../../common/footer.php');
