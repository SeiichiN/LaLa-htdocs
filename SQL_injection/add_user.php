<?php
require_once('functions.php');
require_once('db_functions.php');

$post_data = get_from_post();
if (count($post_data) > 0) {
  insert($post_data);
}

$data = findAll();
?>
<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>入力画面</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php require_once('header.php'); ?>
  <main>
    <section>
      <h1>アカウントの追加</h1>
      <form action="" method="post" class="form clearfix">
        <table>
          <tr>
            <th>名前</th>
            <td><input type="text" name="name" /></td>
          </tr>
          <tr>
            <th>パスワード</th>
            <td><input type="text" name="pass"></td>
          </tr>
        </table>
        <input class="button" type="submit" value="送信" />
      </form>
    </section>

    <section class="under-area">
      <h1>ユーザー一覧</h1>
      <?php if (count($data) > 0) : ?>
        <ul>
          <?php foreach ($data as $row) : ?>
            <li>
              <?php echo h($row['id']) ?> :
              <?php echo h($row['name']) ?>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </section>
  </main>
  <script>
    'use strict';
  </script>
</body>

</html>

<!-- 修正時刻: Sun 2023/10/08 13:15:47 -->