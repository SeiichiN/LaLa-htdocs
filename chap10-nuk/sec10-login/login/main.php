<?php
session_start();
require_once('lib/util.php');

if (isset($_SESSION['id'])) {
  $id = $_SESSION['id'];
} else {
  header('Location: index.php');
}

require_once('common/header.php');
?>
<h2>メイン処理</h2>
<p class="notice"><?= h($id) ?>さん、ログイン中。</p>
<p>PHPSESSIDを確認してください。ログイン時に再発行されたものと同じはずです。<br>
  ログイン時のブラウザと同一だと認識されています。<br>
  <br>
  また、サーバーのメモリ領域から$_SESSION['id'](現在のユーザーID)を取得し、表示しています。
</p>
<div><a href="logout.php"><button>ログアウト</button></a></div>
<figure><img src="session-03.png" alt="セッション3"></figure>
<?php
$script = 'js/script.js';
require_once('common/footer.php');
