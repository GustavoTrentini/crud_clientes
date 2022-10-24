<?php

function sanitizeSringData($str){
    $str = preg_replace("/[^a-zA-Z0-9]/", "", $str);
    return (string) $str;
}

function currencyToFloat($str){
    $str = str_replace(',', '.', str_replace('.', '', $str));
    return (float) $str;
}

function floatToCurrency($number){
    $str = number_format($number, 2, ',', '.');
    return $str;
}

function cepFormatter($str){
    return str_pad($str, 8, '0', STR_PAD_LEFT);
}
