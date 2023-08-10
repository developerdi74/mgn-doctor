<?php

//Получает расписание карточки врача
function getPlanning($medecins_id){
    $ver = $GLOBALS['API_VERSION'];
    if( $curl = curl_init() ) {

        curl_setopt($curl, CURLOPT_URL, 'http://109.195.215.58/api/'.$ver.'/planning/'.$medecins_id);
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
}

//Получает id врача из медиалога и пишет в инфоблок
function getMedecinsID($fam,$name1,$name2,$id){
    $ver = $GLOBALS['API_VERSION'];
    if( $curl = curl_init() ) {
        $data = [
            'family' => $fam,
            'name1' => $name1,
            'name2' => $name2,
        ];
        $url = "http://109.195.215.58/api'.$ver.'doctor/?" . http_build_query($data);
        //$url = "http://109.195.215.58/api/doctor/?family=%D0%90%D0%BD%D0%B4%D1%80%D0%BE%D0%BD%D0%BE%D0%B2%D0%B0&name=%D0%A2%D0%B0%D0%BC%D0%B0%D1%80%D0%B0&name2=%D0%98%D0%B2%D0%B0%D0%BD%D0%BE%D0%B2%D0%BD%D0%B0";
        curl_setopt($curl, CURLOPT_URL, $url . http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_PORT, '9595');

        $out = curl_exec($curl);
        $result = json_decode($out, true); // вывод результата

        if(curl_error($curl)) { // если возникла ошибка
            echo( 'error='.curl_error($curl));
        }
        curl_close($curl);
        if($result['medecins_id']){
            $ELEMENT_ID = $id;  // код элемента
            $IBLOCK_ID = 25;
            $PROPERTY_CODE = "MEDIALOG_ID";  // код свойства
            $PROPERTY_VALUE = $result['medecins_id'];  // значение свойства
            CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, $IBLOCK_ID, array($PROPERTY_CODE => $PROPERTY_VALUE));
        }
        return $result['medecins_id'];
    }
}

//Получает даты расписание в списке врачей категории
function getPlannings($medecins_ids){
    $ver = $GLOBALS['API_VERSION'];
    $get = http_build_query($medecins_ids);
    if( $curl = curl_init() ) {
        curl_setopt($curl, CURLOPT_URL, 'http://109.195.215.58/api/'.$ver.'/plannings/?'.$get);
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
}
?>