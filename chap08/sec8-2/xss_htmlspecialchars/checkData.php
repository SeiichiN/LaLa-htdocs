<?php require_once('../../common/header.php'); ?>
<div>
  <?php
  $data = $_GET['data'];
  $data = rawurldecode($data);
  // $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
  echo "「{$data}」を受取ました";
  ?>
  <p><a href="getRequest.php">もどる</a></p>
</div>