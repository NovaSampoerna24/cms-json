<?php 


function getAll($start, $end){
    $data = artikel();
    $artikel = [];
    foreach($data as $d){
        $artikel[] = $d;
    }
    $data = array_slice($artikel,$start,$end);
   
    $response = [
        'jumlah_semua'=>sizeof($artikel),
        'start'=>$start,
        'end'=>$end,
        'data'=>$data
    ];
    return json_encode($response);
}
function getDetail($id){
    $idne = ($id == 1)?1:$id-1;
    $data = artikel();
    $artikel = [];
    foreach($data as $d){
        $artikel[] = $d;
    }
    $data = $artikel[$idne];
    $response = [
        'sukses'=>true,
        'message'=>'Detail content from id = '.$id,
        'data'=>$data
    ];
    return json_encode($response);
}
function getRandom(){
    $data = artikel();
    $artikel = [];
    foreach($data as $d){
        $artikel[] = $d;
    }
    $datane = array_rand($data, 5); 
    $datap = [];
    // return the first five elements
    foreach ($datane as $key => $value) {
        $datap[] = $artikel[$value];
    }
    return $datap;
}
function getDetailSlug($slug){
    $slug = trim($slug);
    $data = artikel();
    $artikel = [];
    foreach($data as $d){
        $artikel[] = $d;    
    }

    $data = @searchForId($slug, $artikel); 

    // $data = $artikel[$slug];
    $response = [
        'sukses'=>true,
        'message'=>'Detail content from slug = '.$slug,
        'data'=>$data
    ];
    return json_encode($response);
}

// PHP function to illustrate the use of array_search() 
function searchForId($id, $array) {
    foreach ($array as $key => $val) {
        if ($val['slug'] === $id) {
            return $val;
        }
    }
    return null;
 }
?>