<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$id = $_POST['id'];

if (CModule::IncludeModule("iblock")) {
    
    $arSelect = array("ID", "NAME", 'IBLOCK_SECTION_ID', );
    $arFilter = array("IBLOCK_ID" => '25', 'SECTION_ID' => $id, "ACTIVE" => "Y");

    $res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);

    echo '<option value="">Выберите специалиста</option>';

    while ($ob = $res->GetNext()) {
        echo '<option value="' . $ob['ID'] . '">' . $ob['NAME'] . '</option>';
    }
}
?>