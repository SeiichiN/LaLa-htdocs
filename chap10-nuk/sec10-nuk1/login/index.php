<?php
session_start();
require_once('../../lib/util.php');
require_once('../../common/header.php');
?>
<main>
  <h1>ログイン</h1>
  <form action="login.php" method="post">
    <p>
      <label>ログインID:
        <input type="text" name="id" />
      </label><br />
      <label>パスワード:
        <input type="password" name="pass" />
      </label><br />
      <input type="submit" value="ログイン" />
    </p>

  </form>
</main>

<?php require_once('../../common/footer.php');
