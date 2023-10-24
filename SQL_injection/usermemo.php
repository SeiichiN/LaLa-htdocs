<?php
require_once('functions.php');
require_once('db_functions.php');

$data = null;
$name = get_name_from_post();

if ($name != null && $name != "") {
  $data = bad_find_by_name($name);
}
?>

<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title></title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php require_once('header.php'); ?>
  <main>
    <h1>アカウント情報</h1>
    <form action="" method="post" class="form">
      名前<input type="text" name="name" />
      <input type="submit" value="送信" />
    </form>
    <div class="himitsu-area clearfix">
      <div class="himitsu">
        <button id="btn">秘密のコード</button>
        <div id="code">
          <p>
          <pre>' OR 'a' = 'a</pre>
          </p>
        </div>
      </div>
    </div>

    <section class="under-area">
      <h1>アカウント</h1>
      <table>
        <tr>
          <th>名前</th>
          <th>パスワード</th>
        </tr>
        <?php if ($data != null) : ?>
          <?php foreach ($data as $row) : ?>
            <tr>
              <td><?= h($row['name']) ?></td>
              <td><?= h($row['password']) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </table>
    </section>
  </main>
  <script>
    'use strict';

    const btn = document.getElementById('btn');
    const code = document.getElementById('code');
    code.style.display = 'none';
    let onoff = false;

    btn.onclick = function() {
      if (onoff) {
        code.style.display = 'none';
        onoff = false;
      } else {
        code.style.display = 'block';
        onoff = true;
      }
    }
  </script>
</body>

</html>

<!-- 修正時刻: Sun 2023/10/08 13:15:47 -->