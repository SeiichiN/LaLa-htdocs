<?php
function get_from_post() {
  $data = array();
  if (isset($_POST['name']) && !empty($_POST['name'])) {
    $data['name'] = $_POST['name'];
  }
  if (isset($_POST['pass']) && !empty($_POST['pass'])) {
    $data['pass'] = $_POST['pass'];
  }
  return $data;
}

function get_name_from_post() {
  $name = "";
  if (isset($_POST['name']) && !empty($_POST['name'])) {
    $name = $_POST['name'];
  }
  return $name;
}

function h(string $str) {
  return htmlspecialchars($str, ENT_QUOTES, 'utf-8');
}

function pre_dump($str) {
?>
  <pre><?php var_dump($str) ?></pre>
<?php 
}

// 修正時刻: Sun 2023/10/08 13:15:47

