<?php


$datasinonim = file_get_contents('data/sinonim.json');
$datasinonim = json_decode($datasinonim);
// print_r($dataspin);
$data = [];
foreach ($datasinonim as $key => $value) {
    $data[$value->kata] = $value->sinonim;
}

print_r(json_encode($data));