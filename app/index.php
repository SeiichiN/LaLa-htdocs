<?php
session_start();
require_once('lib/util.php');
require_once('db_functions.php');

require_once('common/header.php');
?>
<?php
  $result = find_all();
  if (!$result) {
     exit();
  }
  ?>
  <article>
    <h2>一覧</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>名前</th>
          <th>年齢</th>
          <th>性別</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row): ?>
        <tr>
          <td><?= h($row['id']) ?></td>
          <td><?= h($row['name']) ?></td>
          <td><?= h($row['age']) ?></td>
          <td><?= h($row['sex']) ?></td>
          <td>
            <form method="post" action="updateForm.php">
              <input type="hidden" name="id"
                    value="<?= $row['id'] ?>">
              <input type="submit" value="編集">
            </form>
          </td>
          <td>
            <form method="post" action="deleteConfirm.php">
              <input type="hidden" name="id"
                    value="<?= $row['id'] ?>">
              <input type="submit" value="削除">
            </form>
          </td>        
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </article>
  <?php require_once('common/aside.php'); ?>
<?php require_once('common/footer.php');


