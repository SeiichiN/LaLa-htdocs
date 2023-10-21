<?php require_once('../../common/header.php'); ?>

<form method="post" action="zipCheck.php">
  <ul>
    <input type="hidden" name="name" value="Taro">
    <li>
      <label>郵便番号：
        <input type="text" name="zip">
      </label>
    </li>
    <li><input type="submit" value="送信する"></li>
  </ul>
</form>

<?php require_once('../../common/footer.php');
