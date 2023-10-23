
<?php
require_once('../../lib/util.php');

cken_check($_POST);
?>
<?php
$isError = false;
$name = "";
if (isset($_POST['name'])) {
  $name = trim(mb_convert_kana($_POST['name'], "s"));
  $len = mb_strlen($name);
  if ($len > 20 || $len === 0) {
    $isError = true;
  }
} else {
  $isError = true;
}
?>
<?php require_once('../../common/header.php'); ?>

<?php if ($isError): ?>
  <span class="error">名前を入力してください</span>
  <form method="post" action="nameCheckForm.php">
    <input type="submit" value="戻る">
  </form>
<?php else: ?>
  <span>こんにちは、<?php echo h($name); ?>さん</span>
<?php endif; ?>

<p><a href="nameCheckForm.php">戻る</a></p>



<?php require_once('../../common/footer.php');
