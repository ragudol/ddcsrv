<?php
function convertArrayKeysToUtf8(array $array) {
    $convertedArray = array();
    foreach($array as $key => $value) {
      if(!mb_check_encoding($value, 'UTF-8')) $value =
utf8_encode($value);
      if(is_array($value)) $value = $this->convertArrayKeysToUtf8($value);
      $convertedArray[$key] = $value;
    }
    return $convertedArray;
  } 
?>