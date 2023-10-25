<?php
session_start();
require_once('../../lib/util.php');
require_once('../../lib/db_functions.php');

function checked(string $value, string $checkedValue)
{
  if ($value === $checkedValue) {
    echo "checked";
  }
}

// pre_dump($_SESSION);

$person = [];
$result = null;
$id = 0;
/*
if (isset($_SESSION['person']) && !empty($_SESSION['person'])) {
  $person = $_SESSION['person'];
  pre_dump($person);
} else {
  $id = get_last_id() + 1;
  $person = [
    'id' => $id,
    'name' => '',
    'age' => 0,
    'sex' => ''
  ];
}
*/
if (empty($_SESSION['person'])) {
  $id = get_last_id() + 1;
  $person = [
    'id' => $id,
    'name' => '',
    'age' => 0,
    'sex' => ''
  ];
  $_SESSION['person'] = $person;
} else {
  $person = $_SESSION['person'];
  $_SESSION['person'] = '';
}
?>
<?php require_once('../../common/header.php'); ?>
<section class="flex">
  <article class="main">
    <?php
    if (!empty($_SESSION['errors'])) {
      $errors = $_SESSION['errors'];
      $_SESSION['errors'] = '';
      print_error($errors);
    }
    ?>
    <form method="post" action="input_done.php">
      <table>
        <tr>
          <th>ID</th>
          <td><?= h($person['id']) ?></td>
        </tr>
        <th>名前</th>
        <td><input type="text" name="name" value="<?= h($person['name']) ?>"></td>
        </tr>
        <tr>
          <th>年齢</th>
          <td><input type="number" name="age" value="<?= h($person['age']) ?>"></td>
        </tr>
        <tr>
          <th>性別</th>
          <td>
            <input type="radio" name="sex" value="男" <?= ($person['sex'] === '男') ? 'checked' : '' ?>>男性
            <input type="radio" name="sex" value="女" <?= ($person['sex'] === '女') ? 'checked' : '' ?>>女性
          </td>
        </tr>
      </table>
      <input type="hidden" name="id" value="<?= $person['id'] ?>">
      <input type="submit" value="更新">
    </form>
  </article>
  <?php require_once('aside.php'); ?>
</section>
<?php require_once('../../common/footer.php');
