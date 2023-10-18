<?php
require_once('../../common/header.php');
?>
<div>
  <form action="checkNo.php" method="get">
    <ul>
      <li><label>番号：<input type="number" name="no"></label></li>
      <li><input type="submit" value="調べる"></li>
    </ul>
  </form>

</div>
<?php
require_once('../../common/footer.php');
