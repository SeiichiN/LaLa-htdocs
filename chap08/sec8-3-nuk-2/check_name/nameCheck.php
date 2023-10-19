<?php
require_once('../../lib-nuk/util.php');
require_once('nameCheck_util.php');
cken_check($_POST);
?>

<?php
$isError = false;
$name = getName($isError);
?>

<?php require_once('../../common/header.php'); ?>

<?php if ($isError) : ?>
  <span class="error">名前を入力してください。</span>
  <!--
  <form method="post" action="nameCheckForm.php">
    <input type="submit" value="もどる">
  </form>
-->
  <a href="nameCheckForm.php">もどる</a>
<?php else : ?>
  <span>
    こんにちは <?php echo $name; ?> さん
  </span>
<?php endif; ?>

<p><a href="nameCheckForm.php">TOP</a></p>

<?php require_once('../../common/footer.php');
