<?php session_start(); 

function parseString($param) {
    if ($param === null) {
        return '';
    } {
        return "'" . $param . "'";
    }
}

function createMsg($msg, $type, $title){
   return array(
       "message"=>$msg,
       "type"=>$type,
       "title"=>$title
   );
}

function parseIntOrNull($num){
  if (is_numeric($num)) {
    return $num;
  } else {
    return null;
  }
}