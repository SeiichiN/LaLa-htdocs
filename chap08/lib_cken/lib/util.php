<?php
// phpversion() が 7.1.33よりも小さい場合
function cken_old(array $data): bool {
  $result = true;
  foreach ($data as $key => $value) {
    if (is_array($data)) {
      $value = implode("", $value);
    }
    if (!mb_check_encoding($value)){
      $result = false;
      break;
    }
  }
  return $result;
}

function cken_new(array $data): bool {
  return mb_check_encoding($data);
}

function php_ver_check() {
  $ver = phpversion();
  return $ver >= "7.1.33";
}

function cken(array $data) {
  if (php_ver_check()) {
    cken_new($data);
  } else {
    cken_old($data);
  }
}
