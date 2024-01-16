<?
require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
if(!$USER->IsAdmin()){
   // exit;
    /*array(4) {
            ["id"]=>
      string(4) "1958"
            ["servid"]=>
      string(5) "18452"
            ["price"]=>
      string(9) "1500.0000"
            ["data"]=>
      string(10) "Текст"
    }*/
}
if(empty($_GET['id'])){
    exit;
}
$res = CIBlockElement::SetPropertyValuesEx($_GET['id'], false, array("FM_SERV_ID" => $_GET['servid']));
dd($res);
/*
$cataloProductClass = new CCatalogProduct;
$cataloProductClass->Add(array(
    "ID" => $PRODUCT_ID,
    'QUANTITY' => 0,
));*/
?>