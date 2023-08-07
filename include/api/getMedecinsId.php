<?php
//Пока не используется и не подключено для получения id доктора из медаилога можно удалить
function getMedecinsID($fam,$name1,$name2){
    if( $curl = curl_init() ) {
        $data = [
            'family' => $fam,
            'name1' => $name1,
            'name2' => $name2,
        ];

        curl_setopt($curl, CURLOPT_URL, 'http://109.195.215.58/api/doctor/' . http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_PORT, '9595');

        $out = curl_exec($curl);
        $result = json_decode($out, true); // вывод результата

        if(curl_error($curl)) { // если возникла ошибка
            echo( 'error='.curl_error($curl));
        }
        curl_close($curl);

        return $result['medecins_id'];
    }
}
?>