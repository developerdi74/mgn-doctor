<?
require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
\Bitrix\Main\Loader::includeModule('iblock');
//vd($_GET);
if(!$USER->IsAdmin()){
    exit;
}
if(empty($_GET['servid']) || $_GET['price']<=0){
    echo "NOT PRICE";
    exit;
}
  
$el = new CIBlockElement;
$arFields = array(
    "NAME" => $_GET['title'],
    "CODE" => Cutil::translit($_GET['title'], "ru", array("replace_space" => "-", "replace_other" => "-", 'change_case'=>"L")),
    "IBLOCK_ID" => 24,
    "PROPERTY_VALUES" => [
        'FM_SERV_ID'=>$_GET['servid']
    ],
    "IBLOCK_SECTION_ID" => $_GET['sect'],
);

if($elem = $el->Add($arFields)){
    echo "add";
    $res = setPrice($elem,$_GET['price']);
}else{
    echo ($el->LAST_ERROR);
}
//https://dev2.mgn-doctor.ru/setprice/addservice.php?title=%D0%A2%D0%B5%D1%81%D1%82%D0%BE%D0%B2%D0%B0%D1%8F%20%D1%83%D1%81%D0%BB%D1%83%D0%B3%D0%B0&servid=19103&price=600.0000&sect=1427

?>