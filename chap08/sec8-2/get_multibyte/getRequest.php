<?php require_once('../../common/header.php'); ?>
<?php
$data = "Tokyo Osaka";
$data = rawurlencode($data);
$url = "checkData.php";
echo "<a href={$url}?data={$data}>送信する</a>";
?>
<?php require_once('../../common/footer.php');
