<?php
// $h1に値が設定されていなかったら
if (!isset($h1)) {
  $h1 = "PHP";
}
$cssdir = "http://{$_SERVER['SERVER_NAME']}/~se-ichi/chap08/css";
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?= $cssdir ?>/style.css">
</head>

<body>
  <header>
    <h1><?php echo $h1; ?></h1>
  </header>
  <div>