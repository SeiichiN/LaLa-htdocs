<?php
require_once('../../lib/util.php');
$user = 'inventoryuser';
$password = 'inventoryuser';
$dbname = 'inventory';
$host = 'localhost:3306';
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

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
    ORDER BY goods_id
EOS;
  $stm = $pdo->prepare($sql);
  $stm->execute();
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  
  echo "<table>";
  echo "<thead><tr>";
  echo "<th>ID</th>";
  echo "<th>商品</th>";
  echo "<th>サイズ</th>";
  echo "<th>ブランド</th>";
  echo "</tr></thead>";
  echo "<tbody>";
  foreach ($result as $row) {
    echo "<tr>";
    echo "<td>", h($row['goods_id']), "</td>";
    echo "<td>", h($row['goods_name']), "</td>";
    echo "<td>", h($row['size']), "</td>";
    echo "<td>", h($row['brand_name']), "</td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
} catch (Exception $e) {
  echo '<span class="error">エラーがありました。</span><br>';
  echo $e->getMessage();
  exit();
}
require_once('../../common/footer.php');

  