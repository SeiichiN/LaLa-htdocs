<?php

if (!isset($_POST['tanka']) || !isset($_POST['kosu'])) {
  header('Location: calcForm.php');
}
$tanka = $_POST['tanka'];
$kosu = $_POST['kosu'];
$price = $tanka * $kosu;
$tanka = number_format($tanka);
$price = number_format($price);
?>
<?php require_once('../../common/header.php'); ?>
<?php
echo "<p class=\"price\">単価円{$tanka} ✕ {$kosu}個は {$price}円です。</p>";
?>
<?php require_once('../../common/footer.php'); ?>    

