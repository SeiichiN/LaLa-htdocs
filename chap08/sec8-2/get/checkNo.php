<?php require_once('../../common/header.php'); ?>
<div>
  <?php
  $no = (int)$_GET['no'];
  var_dump($no);
  $nolist = [3, 5, 7, 8, 9];
  if (in_array($no, $nolist, true)) {
    echo "{$no}はありました。";
  } else {
    echo "{$no}は見つかりません";
  }
  ?>
</div>
<?php require_once('../../common/footer.php');
