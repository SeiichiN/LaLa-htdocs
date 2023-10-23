
<?php
require_once('../../lib/util.php');
require_once('nameCheck_util.php');

cken_check($_POST);
?>
<?php
$isError = false;
$name = getNameFromPost($isError);
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
