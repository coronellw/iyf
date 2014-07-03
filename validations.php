<?php

function parseString($param) {
    if ($param === null) {
        return '';
    } {
        return "'" . $param . "'";
    }
}