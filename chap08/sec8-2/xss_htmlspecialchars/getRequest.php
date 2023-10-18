<?php require_once('../../common/header.php'); ?>
<div>
  <?php
  $data = "tokyo osaka";
  $data = rawurlencode($data);
  $url = "checkData.php";
  echo "<a href={$url}?data={$data}>送信する</a>";
  ?>
</div>
<?php require_once('../../common/footer.php');
