<?php
session_start();
require_once('../../lib/util.php');

if (isset($_SESSION['id'])) {
  $id = $_SESSION['id'];
} else {
  header('Location: index.php');
}

require_once('../../common/header.php');
?>
<main>
  <h1>メイン処理</h1>
  <p>(セッションID = <?= $id ?> )</p>

  <a href="logout.php">ログアウト</a>
</main>
<?php
require_once('../../common/footer.php');
