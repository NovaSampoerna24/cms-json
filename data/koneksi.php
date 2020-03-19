<?php 
$base_url =  "http://" . $_SERVER['SERVER_NAME']."/clonerblog";

function database(){
    $base_url = $GLOBALS['base_url'];
    $data = file_get_contents("$base_url/data/database.json",true);
    $json = json_decode($data, true);
    return $json;
}
function artikel(){
    $base_url = $GLOBALS['base_url'];
    $url =  $base_url."/".config()['url_database'];
    $data = file_get_contents($url,true);
    $json = json_decode($data, true);
    return $json;
}
function config(){
    $base_url = $GLOBALS['base_url'];
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
    $base_url = $GLOBALS['base_url'];
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
 function ampify($html='',$title,$sumber) {
    $html = imgseo($html,$title);
    $html = aduk($html,$sumber);
    
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

function ngindex3($url){
    require "vendor/autoload.php";
    $client = new Google_Client();
    // service_account_file.json is the private key that you created for your service account.
    $akunlayanan = config()['akun_layanan']; 
    $client->setAuthConfig('data/ternakpungli.json');
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
        $message = $response;
    }else{
        $message = $response;
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

function aduk($content,$sumber){
    
    
    $dataspin = file_get_contents('data/sinonim.json');
    $dataspin = json_decode($dataspin);
    // print_r($dataspin);
    $kata = [];
    foreach ($dataspin as $key => $value) {
        $kata[$value->kata] = $value->sinonim;
    }

    $sumbere = hapusurl($sumber);
    $kata[$sumber] = '#';
    $kata[$sumbere] = hapusurl($GLOBALS['base_url']);
    $kata[strtoupper($sumbere)] = hapusurl($GLOBALS['base_url']);
    $kata[strtolower($sumbere)] = hapusurl($GLOBALS['base_url']);
    $kata[ucfirst($sumbere)] = hapusurl($GLOBALS['base_url']);
    
    
    $data = spin($content,$kata);
    return $data;
}
function spin($content,$replaceThis){
    $originalText = $content;

    $replacedText = str_replace(array_keys($replaceThis), $replaceThis,$originalText);
  
    return $replacedText;
}
function imgseo($content,$title){
   
    // $content='<a href="something.com"><img src="blah.jpg" alt=""></a>';
    // output: <a href="something.com"><img src="blah.jpg" alt="Game"></a>
    
    // $content='<a href="something.com"><img src="blah.jpg" alt="Not Empty"></a>'; 
    // output: <a href="something.com"><img src="blah.jpg" alt="Not Empty"></a

    $html = preg_replace('/alt=".*?"/', '', $content);
    $pattern ='~(<img.*?)~';
    $replacement = '<img alt="'.$title.'"';
    $result = preg_replace($pattern, $replacement, $html);
    return $result;

}
 function hapusurl($url){
    $uri = remove_http3(remove_http2(remove_http($url)));
    return $uri;
   }
 function remove_http($url) {
   $disallowed = ['http://', 'https://'];
       foreach($disallowed as $d) {
       if(strpos($url, $d) !== false) {  
           return str_replace($d, '', $url);
       }
       }
   return $url;
 }
function remove_http2($url){
   $disallowed = ['www.'];
   foreach($disallowed as $d) {
      if(strpos($url, $d) !== false) {
         return str_replace($d, '', $url);
      }
   }
}
function remove_http3($url){
   $disallowed = ['.blogspot.com','.com','.xyz','.id'];
   foreach($disallowed as $d) {
      if(strpos($url, $d) !== false) {
         return str_replace($d, '', $url);
      }
   }
}
function remove_http4($url){
   $disallowed = ['/'];
   foreach($disallowed as $d) {
      if(strpos($url, $d) !== false) {
         return str_replace($d, '', $url);
      }
   }
}
function format_uri($sluge, $separator = '-' )
{
    $array = explode(' ', $sluge);
    $slug = "";
    foreach ($array as $key => $value) {
        if($key < 5){
            $slug .= $value." ";
        }
    }
    $string = $slug;
    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = array( '&' => 'and', "'" => '');
    $string = mb_strtolower( trim( $string ), 'UTF-8' );
    $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
    $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
    $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
    $string = preg_replace("/[$separator]+/u", "$separator", $string);
    return $string;
}

function getpostblogger($idblogger,$max,$sumbere){
    @$keyword = $_GET['q'];
	@$maxresult = $max;
	@$blogIdscrap = $idblogger;
	@$blogurlku = $_GET['blogurlku'];
	@$bidku = 0;#$id;
	@$insert = $_GET['insert'];
	@$nextToken = $_GET['nexttoken'];
	$id_user = 1;

	@$token = $_GET['token'];
	// https://www.googleapis.com/blogger/v3/blogs/2139929877740231586/posts?maxResults=500&key=AIzaSyACS-KkzVqTEYooCQX__HrND8m6ucgPHSA&fetchImages=true
	
	$key = "AIzaSyACS-KkzVqTEYooCQX__HrND8m6ucgPHSA";
	if($keyword != ""){
		$url = "https://www.googleapis.com/blogger/v3/blogs/$blogIdscrap/posts/search?q=$keyword&maxResults=$maxresult&key=$key&fetchImages=true";
	}else{
		$url = "https://www.googleapis.com/blogger/v3/blogs/$blogIdscrap/posts?maxResults=$maxresult&key=$key&fetchImages=true";
	}
		if($nextToken != ""){
		$url .= "&pageToken=".$nextToken;
	}
	// echo $url;
    $data = get($url);
	
	$p = $data['items'];

	$urltoken = "&pageToken=".@$data['nextPageToken'];
            $datapostingan = [];
			foreach ($p as $param):
				if(@$param['labels'] != ""){
					$label = implode(" ,",@$param['labels']);
				}else{
					$label = "";
				}
				$thum = $param['images'][0]['url'];
				$datapostingan[] = [
					'content_id' => $param['id'],
					'title' => $param['title'],
					'content'=> $param['content'],
					'thumb'=>$thum,
					'tag'=> @$label,
					'id'=> $id_user,
                    'sumber'=>$sumbere,
                    'slug'=>format_uri($param['title'],'-'),
                    'waktu'=>date('Y-m-d h:m:s')
				];
				
                endforeach;
              return $datapostingan;  
}
function getpostinganwordpress($id,$max){
    $q = @$_GET['q']; //keyword
    $maxresult = $max;
    $urle = $id;
    $page = 1;
    if($maxresult == ""){
        $url = $urle."/wp-json/wp/v2/posts?per_page=10";
    }else{
        $url = $urle."/wp-json/wp/v2/posts?per_page=".$maxresult;
    }
      //   echo $url;
      if(@$page != ""){
          $url = $url."&page=".$page;
      }
      if(@$q != ""){
          $url = $url."&search=".$q;
          }
      $url .= "&_embed";
      //   echo $url;
	  $p = get($url);
	
      $datapostingan = [];
      foreach ($p as $param):
          $thumb = @$param['_embedded']["wp:featuredmedia"][0]['media_details']['file'];
          $link = @$param['_embedded']['author'][0]['url'];
          if(empty($link)){
              $thum = @$param['_embedded']["wp:featuredmedia"][0]['source_url'];
          }else{
           $thum = @$link.'/wp-content/uploads/'.$thumb;
           }
          $datapostingan[] = [
            'content_id' => $param['id'],
            'title' =>  $param['title']['rendered'],
            'content'=> $param['content']['rendered'],
            'thumb'=> $thum,
            'tag'=> $param['categories'][0],
            'id'=> 1,
            'sumber'=>$id,
            'slug'=>format_uri($param['title']['rendered'],'-'),
            'waktu'=>date('Y-m-d h:m:s')
        ];		
      endforeach;
      return $datapostingan; 
}
function get($url){
     
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



?>