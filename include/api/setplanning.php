<?
require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

use Bitrix\Main\Loader;
Loader::includeModule("highloadblock");
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;



if(!empty($_POST['namemyname'])){
    exit;
}

$url = 'http://109.195.215.58/api/planning/';

$post_data = [
    'medecins_id' => $_POST['medecins_id'],
    'date' => $_POST['date_rec'],
    'exam_id' => $_POST['exam_id_form'],
    'phone' => $_POST['phone'],
];

$check = checkOnCreateOnlineRecord($post_data);
if($check == false){
    echo json_encode(['code'=> 102, 'msg'=>'более 3 записей']);
    exit;
}
$headers = [];

$post_data = http_build_query($post_data);

$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_VERBOSE, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_PORT, '9595');
curl_setopt($curl, CURLOPT_POST, true); // true - означает, что отправляется POST запрос
$result = curl_exec($curl);
curl_close($curl);

echo $result;
return;

if($check){
    $array = json_decode($result, true);
    $array['id_record'] = $check;
    $result = json_encode($array);
}

echo $result;
return;
?>

<?php
function checkOnCreateOnlineRecord($post_data){
    $ip = $_SERVER['REMOTE_ADDR'];
        $hlbl = 10;

    $entity_data_class = GetEntityDataClass($hlbl);
    $rsData = $entity_data_class::getList(array(
        'order' => array('UF_DATE_RECORD'=>'ASC'),
        'select' => array('*'),
        'filter' => array(
            'UF_IP_ADRESS'=>$ip,
            'UF_DATE_CREATE' => date('Y-m-d')
        )
    ));
    $countRecordToday = 0;
    while($el = $rsData->fetch()){
        $countRecordToday++;
    }
    //количество записей в день = 3
    if($countRecordToday >= 3){
        return false;
    }
        $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
// Массив полей для добавления
    $data = array(
        "UF_DATE_RECORD"=> $post_data['date'],
        "UF_MEDECINS_ID"=> $post_data['medecins_id'],
        "UF_IP_ADRESS"=>$ip,
        "UF_PHONE" => $post_data['phone'],
        'UF_DATE_CREATE' => date( 'Y-m-d' ),
    );

    $result = $entity_data_class::add($data);
    return $result->getId();
}

function GetEntityDataClass($HlBlockId) {
    if (empty($HlBlockId) || $HlBlockId < 1)
    {
        return false;
    }
    $hlblock = HLBT::getById($HlBlockId)->fetch();
    $entity = HLBT::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    return $entity_data_class;
}
?>