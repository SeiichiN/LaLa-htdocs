<?php
function es(array|string $data, string $charset='UTF-8'):mixed {
  if (is_array($data)) {
    return array_map(__METHOD__, $data);
  } else {
    return htmlspecialchars($data, ENT_QUOTES|ENT_HTML5, $charset);
  }
}

function h(string $data) {
  return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}