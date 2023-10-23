<?php
session_start();

require_once('../../common/header.php');
?>
このページから購入するとクーポン割引が適用されます。<br>
<?php
$_SESSION['coupon'] = 'ABC124';
?>
<a href="goal_page.php">次のページへ</a>
<?php
require_once('../../common/footer.php');

