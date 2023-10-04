<?
require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
use Bitrix\Main\Loader;
Loader::includeModule("highloadblock");
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

$ver = $GLOBALS['API_VERSION'];


if(!empty($_POST['namemyname'])){
    exit;
}

$url = 'http://109.195.215.58/api/'.$ver.'/planning/';

$dateValidate=date('Y-m-d H:i', strtotime($_POST['date_rec']));
$post_data = [
    'medecins_id' => $_POST['medecins_id'],
    'date' => $dateValidate,
    'exam_id' => $_POST['exam_id_form'],
    'comment' => $_POST['comment'],
    'phone' => $_POST['phone'],
    'NOM' => $_POST['NOM'],
    'PRENOM' => $_POST['PRENOM'],
    'PATRONYME' => $_POST['PATRONYME'],
    'GOD_ROGDENIQ' => $_POST['GOD_ROGDENIQ'],
    'childReg' => $_POST['childReg'],
];


$fio = (isset($_POST['doc_name'])) ? $_POST['doc_name'] : NULL;
$spec = (isset($_POST['doc_spec'])) ? $_POST['doc_spec'] : NULL;


$check = checkOnlineRecord($_POST['medecins_id']);
if($check == false && $USER->GetID()!=6){
    echo json_encode(['code'=> 102, 'msg'=>'более 3 записей']);
    exit;
}
$headers = [];

$post_data_url = http_build_query($post_data);

$curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_VERBOSE, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data_url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_PORT, '9595');
    curl_setopt($curl, CURLOPT_POST, true); // true - означает, что отправляется POST запрос
    $result = curl_exec($curl);
curl_close($curl);

//print_r($result);
$arrayResult = json_decode($result, true);

$months = array( 1 => 'января' , 'февраля' , 'марта' , 'апреля' , 'мая' , 'июня' , 'июля' , 'августа' , 'сентября' , 'октября' , 'ноября' , 'декабря' );
if(isset($arrayResult['info']['DATE_START'])){
    $monthRus = $months[date('n', strtotime($arrayResult['info']['DATE_START']))];
    $arrayResult['info']['DATE_START'] = date('d '.$monthRus.' Y - H:i', strtotime($arrayResult['info']['DATE_START']));
}

if($arrayResult['code'] == 001){
    createOnlineRecord($post_data, $fio, $spec);
}else{
    $post_data['fio'] = $fio;
    $post_data['spec'] = $spec;
    //logPlanning($post_data); неработает
}
$result = json_encode($arrayResult);

echo $result;
return;

?>

<?php
function checkOnlineRecord($medecins_id){
    $ip = $_SERVER['REMOTE_ADDR'];
    $hlbl = 10;
    $entity_data_class = GetEntityDataClass($hlbl);

    $rsData = $entity_data_class::getList(array(
        'order' => array('UF_DATE_RECORD'=>'ASC'),
        'select' => array('*'),
        'filter' => array(
            'UF_MEDECINS_ID'=> $medecins_id,
            'UF_IP_ADRESS'=>$ip,
            'UF_DATE_CREATE' => date('Y-m-d')
        )
    ));
    $countRecordToday = 0;
    while($el = $rsData->fetch()){
        $countRecordToday++;
    }
    //количество записей в день = 3
    if($countRecordToday >= 1){
        return false;
    }else{
        return true;
    }
}
function createOnlineRecord($post_data=[], $fio=NULL, $spec=NULL){
    $ip = $_SERVER['REMOTE_ADDR'];
    $hlbl = 10;
    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();
    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
// Массив полей для добавления
    $data = [
        "UF_DATE_RECORD"=> $post_data['date'],
        "UF_MEDECINS_ID"=> $post_data['medecins_id'],
        "UF_IP_ADRESS"=>$ip,
        "UF_PHONE" => $post_data['phone'],
        'UF_DATE_CREATE' => date( 'Y-m-d' ),
    ];
    if($fio != null){
        $data["UF_FIO"] = $fio;
    }
    if($spec != null){
        $data["UF_SPEC"] = $spec;
    }

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