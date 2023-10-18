<?php
 require_once('../../common/header.php'); 
 ?>
  <div>
    <form action="calc.php" method="post">
      <ul>
        <li>
          <label>単価: 
            <input type="number" name="tanka">
          </label>
        </li>
        <li>
          <label>個数: 
            <input type="number" name="kosu">
          </label>
        </li>
        <li><input type="submit" value="計算する"</li>
      </ul>
    </form>
  </div>
<?php require_once('../../common/footer.php');
