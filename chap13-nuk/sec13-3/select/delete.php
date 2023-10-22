<?php
session_start();
require_once('../../lib/util.php');
require_once('../../dblib/db_functions.php');

$errors = [];
if (empty($_SESSION['errors'])) {
} else {
  $errors = $_SESSION['errors'];
}
$result = null;
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  if (ctype_digit($id)) {
    $id = (int)$id;
  }
} else {
  header('Location: index.php');
  exit();
}
$result = find_by_id($id);
$row = $result[0];
?>
<?php require_once('../../common/header.php'); ?>
<section class="flex">
  <?php if ($result !== null) : ?>
    <article class="main">
      <?php if (count($errors) > 0) : ?>
        <?php print_error($errors); ?>
      <?php endif; ?>
      <p>以下のデータを削除します。</p>
      <table>
        <tr>
          <th>ID</th>
          <td><?= h($row['id']) ?></td>
        </tr>
        <th>名前</th>
        <td><?= h($row['name']) ?></td>
        </tr>
        <tr>
          <th>年齢</th>
          <td><?= h($row['age']) ?></td>
        </tr>
        <tr>
          <th>性別</th>
          <td><?= h($row['sex']) ?></td>
        </tr>
      </table>
      <p>よろしいですか？</p>
      <form method="post" action="delete_done.php">
        <input type="hidden" name="delete" value="yes">
        <input type="submit" formaction="index.php" value="取消">
        <input type="submit" value="削除">
      </form>
    </article>
  <?php endif; ?>
  <?php require_once('aside.php'); ?>
</section>
<?php require_once('../../common/footer.php');
