<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader; 
Loader::includeModule("highloadblock"); 

use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity;

$inputJSON = file_get_contents('php://input');
$input= json_decode( $inputJSON); //convert JSON into array
$filename='appnew.json';
$current = file_get_contents($filename);
file_put_contents($filename, $inputJSON);

$hlblockId = HL\HighloadBlockTable::getById(9)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblockId);

$entity_data_class = $entity->getDataClass();
$rsData = $entity_data_class::getList(array(
    "select" => array("ID"),
     "filter" => array()
));

foreach ($input as $key => $item) {

    $begin = date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), strtotime($item->begin));
    $end =  date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")),strtotime($item->end));
    
    $data = array(
        "UF_NAME"=> $item->doctor,
        "UF_CLINIC"=>$item->address,
        "UF_BEGIN"=>  $begin,
        "UF_END"=>   $end,
    );
    
 
    if ($item->action == 'new'){ 
         $result = $entity_data_class::add($data);
    }else{
        
        $hlblockId_del = HL\HighloadBlockTable::getById(9)->fetch();
        $entity_del = HL\HighloadBlockTable::compileEntity($hlblockId_del);

        $entity_data_class_del = $entity_del->getDataClass();
        $rsData_del = $entity_data_class_del::getList(array(
            "select" => array("*"),
            "filter" => $data
        ));

        while ($arData_del = $rsData_del->Fetch()) {
            $entity_data_class_del::Delete($arData_del['ID']);
        }
    }
        
    
}
