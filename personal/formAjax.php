<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$id = $_POST['id'];

if (CModule::IncludeModule("iblock")) {

    $arSelect = array("IBLOCK_ID", "ID", "NAME", 'IBLOCK_SECTION_ID', "PROPERTY_*");
    $arFilter = array("IBLOCK_ID" => '25', 'ID' =>  $id, "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);

    $ob = $res->GetNextElement();
    $arProps = $ob->GetProperties();

    foreach ($arProps['SERVICE']['VALUE'] as $arValue) {
        $arSelect = array("ID", "NAME", "IBLOCK_ID", "CATALOG_PRICE_1");
        $arFilter = array("IBLOCK_ID" => "24", "ID" => $arValue, "ACTIVE" => "Y");

        $res1 = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, $arPages, $arSelect);
        while ($ob1 = $res1->GetNextElement()) {
            $arFields = $ob1->GetFields();
            echo '<option value="' . $arFields['ID'] . '">' . $arFields['NAME'] . '</option>';
        }
    }

}

?>