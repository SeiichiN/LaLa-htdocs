<?php
require_once('../../common/header.php');
?>
<form method="post" action="search.php">
  <ul>
    <li>
      <label>名前を検索します（部分一致）<br>
        <input type="text" name="name" placeholder="名前">
      </label>
    </li> 
    <li><input type="submit" value="検索"></li>
  </ul>
</form>
<?php require_once('../../common/footer.php');
