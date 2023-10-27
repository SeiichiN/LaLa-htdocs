<?php
require_once('lib/util.php');
require_once('dblib/db_util.php');

require_once('common/header.php');

$result = find_goods_brand_stock();
if ($result === null ){
  exit();
}  
?>
  <table>
  <thead><tr>
  <th>ID</th>
  <th>商品</th>
  <th>サイズ</th>
  <th>ブランド</th>
  <th>在庫</th>
  </tr></thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
    <td><?= h($row['goods_id']) ?></td>
    <td><?= h($row['goods_name']) ?></td>
    <td><?= h($row['size']) ?></td>
    <td><?= h($row['brand_name']) ?></td>
    <td><?= h($row['quantity']) ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  </table>
<?php
require_once('common/footer.php');

  