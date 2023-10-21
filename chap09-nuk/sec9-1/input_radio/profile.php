<?php
require_once('../../lib/util.php');
$encError = "";
cken_check($_POST);
?>

<?php
$errors = [];
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
} else {
  $errors[] = "「性別」を選択してください。";
}

$marrigeValue = ["独身", "既婚", "同棲中"];
$marriage = "";
$isMarriage = false;
if (isset($_POST['marriage'])) {
  $marriage = $_POST['marriage'];
  if (in_array($marriage, $marrigeValue)) {
    $isMarriage = true;
  } else {
    $marriage = "error";
    $errors[] = "「結婚」に入力エラーがありました。";
  }
} else {
  $errors[] = "「結婚」を選択してください。";
}
?>

<?php
function checked(string $value, array|string $question): void
{
  if (is_array($question)) {
    $isChecked = in_array($value, $question);
  } else {
    $isChecked = ($value === $question);
  }
  if ($isChecked) {
    echo "checked";
  } else {
    echo "";
  }
}
?>
<?php require_once('../../common/header.php'); ?>
<form method="post" action="">
  <ul>
    <li>
      <span>性別: </span>
      <label><input type="radio" name="sex" value="男性" <?php checked("男性", $sex); ?>>男性 </label>
      <label><input type="radio" name="sex" value="女性" <?php checked("女性", $sex); ?>>女性 </label>
    </li>
    <li>
      <span>結婚: </span>
      <label><input type="radio" name="marriage" value="独身" <?php checked("独身", $marriage); ?>>独身 </label>
      <label><input type="radio" name="marriage" value="既婚" <?php checked("既婚", $marriage); ?>>既婚 </label>
      <label><input type="radio" name="marriage" value="同棲中" <?php checked("同棲中", $marriage); ?>>同棲中 </label>
    </li>
    <li><input type="submit" value="送信" /> </li>
  </ul>
  <button type="button" class="clear-radio">選択解除</button>
</form>
<?php
$isSubmited = $isSex && $isMarriage;
if ($isSubmited) {
  echo "<hr>";
  echo "あなたは「", h($sex), "、", h($marriage), "」です。";
}
?>
<?php
if (count($errors) > 0) {
  echo "<hr>";
  print_error($errors);
  // echo '<span class="error">', implode("<br>", $error), '</span>';
}
?>
<?php
$script = <<< EOS
document.querySelector('.clear-radio').onclick=function() {
  const radios=document.querySelectorAll('input[type="radio" ]');
  radios.forEach(function(ele) {
    ele.checked=false;
  })
} 
EOS; ?>
<?php require_once('../../common/footer.php');
