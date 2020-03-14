<?php
include ('../data/koneksi.php');
include ('../model/Artikel.php');

header('Content-Type: application/json'); 

    if($_GET['q']=='get-artikel'){
    
    $start = @($_GET['start'])?$_GET['start']:0;
    $end = @($_GET['end'])?$_GET['end']:5;
    
    echo getAll($start,$end);

    }else if($_GET['q'] == 'detail-artikel'){
   
        $id = $_GET['slug'];
        echo getDetail($id);
    }
    else{
        echo "method tidak dikenali";
    }

?>