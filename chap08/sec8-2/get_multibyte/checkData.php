<?php require_once('../../common/header.php'); ?>
<?php
$data = $_GET['data'];
$data = rawurldecode($data);
$data = htmlspecialchars($data, ENT_QUOTES, "UTF-8");
echo "「{$data}」を受け取りました";
?>
<p><a href="getRequest.php">もどる</a></p>
<?php require_once('../../common/footer.php');

