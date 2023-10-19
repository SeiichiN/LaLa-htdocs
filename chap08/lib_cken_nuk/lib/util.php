<?php
// phpversion() が 7.2.0よりも小さい場合
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
