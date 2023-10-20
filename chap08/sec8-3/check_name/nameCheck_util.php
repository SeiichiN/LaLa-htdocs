<?php
function getNameFromPost(&$isError):string {
  $name = "";
  if (isset($_POST['name'])) {
    $name = trim($_POST['name']);
    if ($name === "") {
      $isError = true;
    }
  } else {
    $isError = true;
  }  
  return $name;
}