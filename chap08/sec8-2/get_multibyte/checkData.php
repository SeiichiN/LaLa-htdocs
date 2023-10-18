<?php require_once('../../common/header.php'); ?>
<div>
  <?php
  $data = $_GET['data'];
  $data = rawurldecode($data);
  echo "「{$data}」を受取ました";
  ?>
  <p><a href="getRequest.php">もどる</a></p>
</div>