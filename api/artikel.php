<?php
include ('../data/koneksi.php');
include ('../model/Artikel.php');



    if($_GET['q']=='get-artikel'){
        header('Content-Type: application/json'); 
    $start = @($_GET['start'])?$_GET['start']:0;
    $end = @($_GET['end'])?$_GET['end']:5;
    
    echo getAll($start,$end);

    }else if($_GET['q'] == 'detail-artikel'){
        header('Content-Type: application/json'); 
        $id = $_GET['slug'];
        echo getDetail($id);
    }else if($_GET['q'] == 'get-url'){
       $data = getAlls();
        foreach($data as $value){
            echo $GLOBALS['base_url'].'/detail.php/'.$value['slug'];
            echo "<br>";
        }
    }
    else{
        header('Content-Type: application/json'); 
        echo "method tidak dikenali";
    }

?>