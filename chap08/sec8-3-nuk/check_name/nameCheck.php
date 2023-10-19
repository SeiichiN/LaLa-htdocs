<?php require_once('../../common/header.php'); ?>
<?php
require_once('../../lib-nuk/util.php');
if (!cken($_POST)) {
  $err = "Encoding Error! The expected encoding is UTF-8";
  exit($err);
}
$_POST = es($_POST);
var_dump($_POST);
?>

<?php
$isError = false;
if (isset($_POST['name'])) {
  $name = trim($_POST['name']);
  if ($name === "") {
    $isError = true;
  }
} else {
  $isError = false;
}
?>

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
