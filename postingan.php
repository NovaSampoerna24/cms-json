<?php 
include ('data/koneksi.php');

if($_POST){
    
    $url = $_POST['url'];
    $type = $_POST['type'];
    
    if($type == "blogger"){
    
        $idblogger = @$_POST['idblog'];
        $data = getpostblogger($idblogger,10,$url);
        foreach ($data as $key => $value) {
            $base_url =  "http://" . $_SERVER['SERVER_NAME']."/gamengroot";
            $response = curlpost($base_url."/savepostingan.php",$value);
          
            
        }
    }else if($type == "wordpress"){
        $data = getpostinganwordpress($url,10);
        foreach ($data as $key => $value) {
            $base_url =  "http://" . $_SERVER['SERVER_NAME']."/gamengroot";
            $response = curlpost($base_url."/savepostingan.php",$value);
         

        }
    }

    
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
					'content'=>$param['content'],
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
            'content'=>$param['content']['rendered'],
            'thumb'=>$thum,
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

