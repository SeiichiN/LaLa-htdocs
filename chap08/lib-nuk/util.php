<?php
function es(array|string $data, string $charset = 'UTF-8'): mixed
{
  if (is_array($data)) {
    return array_map(__METHOD__, $data);
  } else {
    return htmlspecialchars($data, ENT_QUOTES, $charset);
  }
}

function h(string $data)
{
  return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

function cken_old(array $data): bool
{
  $result = true;
  foreach ($data as $key => $value) {
    if (is_array($data)) {
      $value = implode("", $value);
    }
    if (!mb_check_encoding($value)) {
      $result = false;
      break;
    }
  }
  return $result;
}


function cken(array|string $data): bool
{
  if (phpversion() >= "7.2.0") {
    return mb_check_encoding($data);
  } else {
    if (is_array($data)) {
      return cken_old($data);
    } else {
      return mb_check_encoding($data);
    }
  }
}

function cken_check(array $arr): void
{
  $arr['name'] = '名無し';
  var_dump($arr);
  if (!cken($arr)) {
    $err = "Encoding Error! The expected encoding is UTF-8";
    // exit($err);
  }
}

function print_error(array $errors): void
{
  echo '<ol class="error">';
  foreach ($errors as $value) {
    echo "<li>", $value, "</li>";
  }
  echo '</ol>';
}
