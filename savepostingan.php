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
    $artikel[]=[
        'content_id' => $data['content_id'],
        'title' => $data['title'],
        'content'=> $data['content'],
        'thumb'=>$data['thumb'],
        'tag'=> @$data['tag'],
        'id'=> $data['id'],
        'sumber'=>$data['sumber'],
        'slug'=>format_uri($data['title'],'-'),
        'waktu'=>date('Y-m-d h:m:s')
    ];

    $json_data = json_encode($artikel);
    file_put_contents('data/tb_artikel.json', $json_data);
    
    $base_url = $GLOBALS['base_url'];
    $ngindex = ngindex($base_url."/detail.php/".$data['slug']);
    print_r($ngindex);
}

