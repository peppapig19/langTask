<?php

function detect_cyrillic($string)
{
    $positions = [];
    $len = mb_strlen($string);

    for ($i = 0; $i < $len; $i++) {
        $char = mb_substr($string, $i, 1);
        if (preg_match('/[А-Яа-яЁё]/u', $char)) array_push($positions, $i);
    }

    return $positions;
}

function detect_latin($string)
{
    $positions = [];
    $len = mb_strlen($string);

    for ($i = 0; $i < $len; $i++) {
        $char = mb_substr($string, $i, 1);
        if (preg_match('/[A-Za-z]/', $char)) array_push($positions, $i);
    }

    return $positions;
}

function foreign_positions($string)
{
    $cyr = detect_cyrillic($string);
    $lat = detect_latin($string);

    if (count($cyr) > count($lat) || count($cyr) == count($lat)) return $lat;
    if (count($cyr) < count($lat)) return $cyr;
}

function color_foreign($string)
{
    $positions = foreign_positions($string);
    $colored_string = '';
    $len = mb_strlen($string);

    for ($i = 0; $i < $len; $i++) {
        $char = mb_substr($string, $i, 1);
        
        if (in_array($i, $positions)) $colored_string .= "<span style='color:red'>$char</span>";
        else $colored_string .= $char;
    }

    return $colored_string;
}