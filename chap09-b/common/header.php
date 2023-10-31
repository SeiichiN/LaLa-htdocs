<?php
// $h1に値が設定されていなかったら
if (!isset($h1)) {
  $h1 = "PHP";
}
$cssdir = "http://{$_SERVER['SERVER_NAME']}/chap13/css";

// $cssdir = "http://{$_SERVER['SERVER_NAME']}/~se-ichi/chap13/css";
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?= $cssdir ?>/style.css">
  <link rel="stylesheet" href="<?= $cssdir ?>/tablestyle2.css">
</head>

<body>
  <header>
    <div class="header-inn flex">
      <h1><?php echo $h1; ?></h1>
      <nav>
        <ul class="flex">
          <li><a href="index.php">一覧</a></li>
          <li><a href="input_data.php">新規</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <div>