<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty("title", "Семейный доктор в Магнитогорске. Загрузить анкету");
$APPLICATION->SetTitle("Семейный доктор в Магнитогорске. Загрузить анкету");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"loadankets", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "N",
		"WEB_FORM_ID" => "8",
		"COMPONENT_TEMPLATE" => "loadankets",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);
 require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');?><br>