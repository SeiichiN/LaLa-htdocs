<?php
session_start();
require_once('../../lib/util.php');
require_once('../../lib/db_functions.php');

function checked(string $value, array $checkedValues = ['男', '女'])
{
  $isChecked = in_array($value, $checkedValues);
  if ($isChecked) {
    echo "checked";
  }
}

$result = null;
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  if (ctype_digit($id)) {
    $id = (int)$id;
    $_SESSION['id'] = $id;
  }
} else if (!empty($_SESSION['id'])) {
  $id = $_SESSION['id'];
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
      <?php
      if (!empty($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        $_SESSION['errors'] = '';
        print_error($errors);
      }
      ?>
      <form method="post" action="update_done.php">
        <table>
          <tr>
            <th>ID</th>
            <td><?= h($row['id']) ?></td>
          </tr>
          <th>名前</th>
          <td><input type="text" name="name" value="<?= h($row['name']) ?>"></td>
          </tr>
          <tr>
            <th>年齢</th>
            <td><input type="number" name="age" value="<?= h($row['age']) ?>"></td>
          </tr>
          <tr>
            <th>性別</th>
            <td>
              <input type="radio" name="sex" value="男" <?= checked($row['sex']) ?>>男性
              <input type="radio" name="sex" value="女" <?= checked($row['sex']) ?>>女性
            </td>
          </tr>
        </table>
        <input type="submit" value="更新">
      </form>
    </article>
  <?php endif; ?>
  <?php require_once('aside.php'); ?>
</section>
<?php require_once('../../common/footer.php');
