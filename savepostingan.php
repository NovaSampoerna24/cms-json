<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('data/koneksi.php');
include ('model/Artikel.php');

$slug = $_POST['slug'];
 $data = getDetailSlug($slug);
$data = json_decode($data)->data;

if(@$data->title == ""){
    save($_POST);
}

function save($data){   
    $database = file_get_contents('data/tb_artikel.json');
    $database = json_decode($database);
    $artikel = [];
    foreach ($database as $key => $value) {
        $artikel[] = $value;
    }
    $artikel[]=$data;

    $json_data = json_encode($artikel);
    file_put_contents('data/tb_artikel.json', $json_data);
    
    $base_url =  "http://" . $_SERVER['SERVER_NAME']."/gamengroot";
    $ngindex = ngindex($base_url."/detail.php/".$data['slug']);
    print_r($ngindex);
}