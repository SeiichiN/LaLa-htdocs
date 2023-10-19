<?php
require_once('lib/util.php');

$name = $_POST['name'];
?>
<?php require_once('../common/header.php'); ?>

<p>名前：<?php echo h($name); ?></p>

<p><a href="nameForm.php">もどる</a></p>
<?php require_once('../common/footer.php'); ?>