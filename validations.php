<?php

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