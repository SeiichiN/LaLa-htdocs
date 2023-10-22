<?php
session_start();
require_once('../../lib/util.php');
require_once('../../common/header.php');
?>
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
<p>デベロッパーツールで PHPSESSIDを確認してください。</p>

<figure>
  <img src="session-01.png" alt="セッション1">
</figure>

<?php
$script = '../../js/script.js';
require_once('../../common/footer.php');
