<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('data/koneksi.php');
include ('model/Artikel.php');

if($_POST){
$url = $_POST['url'];
$ngindex = ngindex2($url);
print_r($ngindex);
}