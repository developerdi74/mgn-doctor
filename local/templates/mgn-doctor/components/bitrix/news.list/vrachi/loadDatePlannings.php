<?php
/*
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

echo json_encode(getPlannings($_GET));
/*
function getPlannings($medecins_ids){
    $get = http_build_query($medecins_ids);
    if( $curl = curl_init() ) {
        curl_setopt($curl, CURLOPT_URL, 'http://109.195.215.58/api/plannings/?'.$get);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_PORT, '9595');
        $out = curl_exec($curl);
        $result = json_decode($out, true); // вывод результата

        if(curl_error($curl)) { // если возникла ошибка
            echo( 'error='.curl_error($curl));
        }
        curl_close($curl);
        if($result){
            return $result;
        }else{
            return false;
        }
    }
}*/
?>