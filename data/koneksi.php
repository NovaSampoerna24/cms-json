<?php 


function database(){
    $base_url =  "https://" . $_SERVER['SERVER_NAME']."";
    $data = file_get_contents("$base_url/data/database.json",true);
    $json = json_decode($data, true);
    return $json;
}
function artikel(){
    $url =  config()['url_database'];
    $data = file_get_contents($url,true);
    $json = json_decode($data, true);
    return $json;
}
function config(){
    $data = file_get_contents("http://game.ngroot.site/data/config.json",true);
    $json = json_decode($data, true);
    return $json;
}
?>