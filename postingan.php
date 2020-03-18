<?php 
include 'data/koneksi.php';

if($_POST){
    
    $url = $_POST['url'];
    $type = $_POST['type'];
    
    if($type == "blogger"){
    
        $idblogger = @$_POST['idblog'];
        $data = getpostblogger($idblogger,100,$url);
        foreach ($data as $key => $value) {
            $base_url = $GLOBALS['base_url'];
            $response = curlpost($base_url."/savepostingan.php",$value);
          
            
        }
    }else if($type == "wordpress"){
        $data = getpostinganwordpress($url,10);
        foreach ($data as $key => $value) {
            $base_url = $GLOBALS['base_url'];
            $response = curlpost($base_url."/savepostingan.php",$value);
         

        }
    }

    
}