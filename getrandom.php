<?php 
require "vendor/autoload.php";
use PHPHtmlParser\Dom;
$dom = new Dom;
include ('data/koneksi.php');
include ('model/Artikel.php');

    // $data = getRandom();
    // foreach ($data as $key => $value) {
    //     echo $value['title'];
    //     echo "<br>";
    // }
    $config = config();
    print_r($config['url_database']);
?>