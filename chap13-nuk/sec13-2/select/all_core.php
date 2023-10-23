<?php
require_once('../../lib/util.php');

require_once('../../lib/db_functions.php');
?>
<?php
$h1 = "レコードをとりだす";
require_once('../../common/header.php');
?>
<?php
$result = select_all("SELECT * FROM member");
?>
<?php if ($result !== null) : ?>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>名前</th>
        <th>年齢</th>
        <th>性別</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo h($row["id"]); ?></td>
          <td><?php echo h($row['name']); ?></td>
          <td><?php echo h($row['age']); ?></td>
          <td><?php echo h($row["sex"]); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
<?php require_once('../../common/footer.php');
