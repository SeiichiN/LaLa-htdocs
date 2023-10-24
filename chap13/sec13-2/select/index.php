<?php
require_once('../../lib/util.php');
require_once('db_functions.php');

require_once('../../common/header.php');
?>
<?php
  $result = find_all();
  if (!$result) {
     exit();
  }
  ?>
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
  <?php foreach ($result as $row): ?>
      <tr>
        <td><?= h($row['id']) ?></td>
        <td><?= h($row['name']) ?></td>
        <td><?= h($row['age']) ?></td>
        <td><?= h($row['sex']) ?></td>
      </tr>
  <?php endforeach; ?>
    </tbody>
  </table>
  <?php require_once('../../common/footer.php');


