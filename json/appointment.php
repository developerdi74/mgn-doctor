<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader; 
Loader::includeModule("highloadblock"); 

use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity;

$inputJSON = file_get_contents('php://input');
$input= json_decode( $inputJSON); //convert JSON into array
$filename='appointment.json';
$current = file_get_contents($filename);
file_put_contents($filename, $inputJSON);


$hlblockId = HL\HighloadBlockTable::getById(9)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblockId);

$entity_data_class = $entity->getDataClass();
$rsData = $entity_data_class::getList(array(
    "select" => array("ID"),
     "filter" => array()
));

while ($arItem = $rsData->Fetch()) {
    $entity_data_class::delete($arItem["ID"]);
}

foreach ($input as $key => $item) {

    $begin = date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), strtotime($item->begin));
    $end =  date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")),strtotime($item->end));

    $data = array(
        "UF_NAME"=> $item->doctor,
        "UF_CLINIC"=>$item->address,
        "UF_BEGIN"=>  $begin,
        "UF_END"=>   $end,
    );
   $result = $entity_data_class::add($data);
}

//var_dump($result);
?>