<?php
function getName(bool &$isError): string
{
  $name = "";
  if (isset($_POST['name'])) {
    $name = trim($_POST['name']);
    if ($name === "") {
      $isError = true;
    }
  } else {
    $isError = false;
  }
  return $name;
}
