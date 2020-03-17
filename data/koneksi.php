<?php 


function database(){
    $base_url =  "http://" . $_SERVER['SERVER_NAME']."";
    $data = file_get_contents("$base_url/data/database.json",true);
    $json = json_decode($data, true);
    return $json;
}
function artikel(){
    $base_url =  "http://" . $_SERVER['SERVER_NAME']."";
    $url =  $base_url."/".config()['url_database'];
    $data = file_get_contents($url,true);
    $json = json_decode($data, true);
    return $json;
}
function config(){
    $base_url =  "http://" . $_SERVER['SERVER_NAME']."";
    $data = file_get_contents("$base_url/data/config.json",true);
    $json = json_decode($data, true);
    return $json;
}


function curlpost($url,$data){
    
   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
   
   // execute!
   $response = curl_exec($ch);

   // close the connection, release resources used
   curl_close($ch);
   print_r($response);	

}
function curlget($url){
     
    $client = curl_init();
    curl_setopt_array($client, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
    ]);
    $response = curl_exec($client);
    curl_close($client);
    $result = json_decode($response, true);
    return $result;
     // print_r($result);
    // print_r($result);
}
function getdata(){
    $base_url =  "http://" . $_SERVER['SERVER_NAME']."";
    $sumber = file_get_contents('data/sumberan.json');
    $sumber = json_decode($sumber);
    foreach ($sumber as $key => $value) {
         $data = [
             'url'=>$value->url,
             'type'=>$value->type,
             'idblog'=>@$value->idblog
         ];
     
        $response = curlpost($base_url."/postingan.php",$data);
     
    }
    return 'berhasil';
 }

 function aktifkan($tanggal){
     $data = [
         'tanggal'=>$tanggal,
         'status'=>'aktif'
     ];
     $json_data = json_encode($data);
     file_put_contents('data/crontime.json', $json_data);
 }
 function matikan($tanggal){
     $data = [
         'tanggal'=>$tanggal,
         'status'=>'nonaktif'
     ];
     
     $json_data = json_encode($data);
     file_put_contents('data/crontime.json', $json_data);
 }
 function ampify($html='') {

    # Replace img, audio, and video elements with amp custom elements
    $html = str_ireplace(
        ['<img','<video','/video>','<audio','/audio>'],
        ['<amp-img','<amp-video','/amp-video>','<amp-audio','/amp-audio>'],
        $html
    );

    # Add closing tags to amp-img custom element
    $html = preg_replace('/<amp-img(.*?)>/', '<amp-img$1></amp-img>',$html);

    # Whitelist of HTML tags allowed by AMP
    $html = strip_tags($html,'<h1><h2><h3><h4><h5><h6><a><p><ul><ol><li><blockquote><q><cite><ins><del><strong><em><code><pre><svg><table><thead><tbody><tfoot><th><tr><td><dl><dt><dd><article><section><header><footer><aside><figure><time><abbr><div><span><hr><small><br><amp-img><amp-audio><amp-video><amp-ad><amp-anim><amp-carousel><amp-fit-rext><amp-image-lightbox><amp-instagram><amp-lightbox><amp-twitter><amp-youtube>');

    return $html;

}
function ngindex($url){
    require "vendor/autoload.php";
    $client = new Google_Client();
    // service_account_file.json is the private key that you created for your service account.
    $akunlayanan = config()['akun_layanan']; 
    $client->setAuthConfig($akunlayanan);
    $client->addScope('https://www.googleapis.com/auth/indexing');

    // Get a Guzzle HTTP Client
    $httpClient = $client->authorize();
    $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

    // Define contents here. The structure of the content is described in the next step.
    $content = "{
      'url': '$url',
      'type': 'URL_UPDATED'
    }";
    $response = $httpClient->post($endpoint, [ 'body' => $content ]);
    $status_code = $response->getStatusCode();
    if($status_code == 200){
        $message = "Berhasil";
    }else{
        $message = "gagal";
    }
    $res = [
        "code"=>$status_code,
        "message"=>$message,
        "url"=>$url
    ];
    $fileindex = file_get_contents('data/filengindex.json');
    $filengin = [];
    $fileindex = json_decode($fileindex);
    foreach ($fileindex as $key => $value) {
        $filengin[] = $value;
    }
    $fileindex[] = $res;
     $json_data = json_encode($fileindex);
    file_put_contents('data/filengindex.json', $json_data);
    // $dataindex = file_get_contents('data/filengindex.json');
    return null;
    
}
function ngindex2($url){
    require "vendor/autoload.php";
    $client = new Google_Client();
    // service_account_file.json is the private key that you created for your service account.
    $akunlayanan = config()['akun_layanan']; 
    $client->setAuthConfig($akunlayanan);
    $client->addScope('https://www.googleapis.com/auth/indexing');

    // Get a Guzzle HTTP Client
    $httpClient = $client->authorize();
    $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

    // Define contents here. The structure of the content is described in the next step.
    $content = "{
      'url': '$url',
      'type': 'URL_UPDATED'
    }";
    $response = $httpClient->post($endpoint, [ 'body' => $content ]);
    $status_code = $response->getStatusCode();
    if($status_code == 200){
        $message = "Berhasil";
    }else{
        $message = "gagal";
    }
    $res = [
        "code"=>$status_code,
        "message"=>$message,
        "url"=>$url
    ];
    $fileindex = file_get_contents('data/filengindex.json');
    $filengin = [];
    $fileindex = json_decode($fileindex);
    foreach ($fileindex as $key => $value) {
        $filengin[] = $value;
    }
    $fileindex[] = $res;
     $json_data = json_encode($fileindex);
    file_put_contents('data/filengindex.json', $json_data);
    // $dataindex = file_get_contents('data/filengindex.json');
    return json_encode($res);
    
}
function aduk($content){

    $dataspin = file_get_contents('data/spinkata.json');
    $dataspin = json_decode($dataspin);
    // print_r($dataspin);
    $kata = [];
    foreach ($dataspin as $key => $value) {
        $kata[key($value)] = array_values((array)$value)[0];
    }
    $data = spin($content,$kata);
    return $data;
}
function spin($content,$replaceThis){
    $originalText = $content;

    $replacedText = str_replace(array_keys($replaceThis), $replaceThis,$originalText);
  
    return $replacedText;
}

?>