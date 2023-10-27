<?php
// $h1に値が設定されていなかったら
if (!isset($h1)) {
  $h1 = "PHP";
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/tablestyle2.css">
</head>

<body>
  <header>
    <div class="header-inn flex">
      <h1><?php echo $h1; ?></h1>
      <nav>
        <ul class="flex">
          <li><a href="index.php">一覧</a></li>
          <li><a href="insertform.php">新規</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <div>