<?php
require_once('../../lib/util.php');

$user = "inventoryuser";
$password = "inventoryuser";
$dbname = "inventory";
$host = "localhost:3306";
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

?>
<?php
$h1 = "レコードをとりだす";
require_once('../../common/header.php');
?>
<?php
try {
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = <<< EOS
    SELECT
      g.id as goods_id,
      g.name as goods_name,
      g.size as size,
      b.name as brand_name
    FROM goods g
      JOIN brand b
      ON g.brand = b.id
    ORDER BY goods_id;
EOS;
  $stm = $pdo->prepare($sql);
  $stm->execute();
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>商品</th>
        <th>サイズ</th>
        <th>ブランド</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo h($row["goods_id"]); ?></td>
          <td><?php echo h($row['goods_name']); ?></td>
          <td><?php echo h($row['size']); ?></td>
          <td><?php echo h($row["brand_name"]); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php
} catch (Exception $e) {
  $errors[] = "エラーがありました。";
  $errors[] = $e->getMessage();
  print_error($errors);
} finally {
  $pdo = null;
}
?>
<?php require_once('../../common/footer.php');
