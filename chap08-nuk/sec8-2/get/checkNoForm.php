<?php require_once('../../common/header.php'); ?>

<form method="get" action="checkNo.php">
  <ul>
    <li>
      <label>番号：
        <input type="number" name="no">
      </label>
    </li>
    <li><input type="submit" value="調べる"></li>
  </ul>
</form>

<?php require_once('../../common/footer.php');
