<?php

$kata['saya'] = "gua";
$kata["kamu"] = "luu";
print_r($kata);
// die;
echo "<br>";
$dataspin = file_get_contents('data/spinkata.json');
$dataspin = json_decode($dataspin);
// print_r($dataspin);
$kata = [];
foreach ($dataspin as $key => $value) {
    $kata[key($value)] = array_values((array)$value)[0];
}
print_r($kata);