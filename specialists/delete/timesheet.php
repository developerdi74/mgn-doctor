<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Расписание врачей и график работы кабинетов");?>

<?
use Bitrix\Main\Loader;
Loader::includeModule("highloadblock");
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$clinic = $_POST["CLINIC"];

if($clinic == '')
	$clinic = $arResult['PROPERTIES']['CLINIC']["VALUE_XML_ID"][0];

$months = array(1 => 'Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря');
$arWeek = array("1" => "ПН", "2" => "ВТ", "3" => "СР", "4" => "ЧТ", "5" => "ПТ", "6" => "СБ", "0" => "ВС");

$curentDate =  date("d.m.Y", strtotime('now'));
$lastday =  date("d.m.Y", strtotime('now +13 days'));
$dateNow = date("d.m.Y", strtotime('now'));
$dayNow = date("d", strtotime('now'));

$strFirst = date('d ', strtotime($curentDate)) . $months[(date('n', strtotime($curentDate)))];
$strLastday = date('d ', strtotime($lastday)) . $months[(date('n', strtotime($lastday)))];

$hlblockId = HL\HighloadBlockTable::getById(8)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblockId);
$entity_data_class = $entity->getDataClass();

$rsData = $entity_data_class::getList(array(
	"select" => array("*"),
	"order" => array("ID" => "ASC"),
	"filter" => array()
));

while ($arData = $rsData->Fetch()) {
	$day = $arData['UF_BEGIN']->format("d");
	$week = $arData['UF_BEGIN']->format("w");
	$date =  $arData['UF_BEGIN']->format("d.m.Y");
}

$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"timesheet",
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "25",
		"IBLOCK_TYPE" => "mgn_doctor_service",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "300",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "DATE",
			1 => "CLINIC",
			2 => "AGE",
			3 => "SPECIALIZATION",
			4 => "TITLE",
			5 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "NAME",
		"SORT_BY2" => "NAME",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "timesheet"
	),
	false
);?>
<br>
<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");