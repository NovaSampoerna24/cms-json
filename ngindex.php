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
}else{
    $url = "http://patekan.ngroot.site/detail.php/diamond-shop-vip-dapatkan-diamond";
    $ngindex = ngindex3($url);
    print_r($ngindex);
}