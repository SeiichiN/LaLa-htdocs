<?php
session_start();
require_once('../../lib/util.php');
$id = "";
if (isset($_SESSION['id'])) {
  $id = $_SESSION['id'];
}
require_once('../../common/header.php');
?>
<h2>メイン処理</h2>
<p class="notice">
  <?= h($id) ?>さん、ログイン中
</p>
<div>
  <a href="logout.php">
    <button>ログアウト</button>
  </a>
</div>
<?php
require_once('../../common/footer.php');
