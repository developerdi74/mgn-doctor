<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Все врачи аллергологи в Семейном докторе. Первичный прием аллерголога от 1100 рублей.  Высококвалифицированные врачи. Удобная онлайн-запись. Большой выбор услуг");
$APPLICATION->SetPageProperty("keywords", "аллерголог, аллерголог магнитогорск");
$APPLICATION->SetPageProperty("title", "Врачи в Магнитогорске | Семейный доктор");
?>
<?
	$section_code = explode("/",$_SERVER['REQUEST_URI']);

	define("AGE",111);
	$arrFilterVrachi = array("SECTION_CODE" => $section_code[2], "PROPERTY" => array("AGE"=>AGE)); //Фильтр для отображения только врачей в выбранном разделе

	if(isset($section_code[4])){ LocalRedirect("/404.php", "404 Not Found");}

	$code = $section_code[2];

	$APPLICATION->AddChainItem("Специалисты", "/specialists/");

?>
<section class="specialists-inner all-our-specialists">
	<div class="container">
<?
		//Проверка существует ли раздел
	if($code):
		$arFilter = array('IBLOCK_ID' => 25, "CODE" =>  $code);
		$rsSections = CIBlockSection::GetList(array(), $arFilter);

		if($arSction = $rsSections->Fetch()):

		$APPLICATION->AddChainItem($arSction['NAME'], $arSction['CODE']);
		$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"vrachi",
		array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"CACHE_FILTER" => "Y",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "N",
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"FILTER_NAME" => "arrFilterVrachi",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "25",
			"IBLOCK_TYPE" => "mgn_doctor_service",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
			"INCLUDE_SUBSECTIONS" => "Y",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "5",
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
				4 => "SKILL",
				5 => "",
			),
			"SET_BROWSER_TITLE" => "Y",
			"SET_LAST_MODIFIED" => "Y",
			"SET_META_DESCRIPTION" => "Y",
			"SET_META_KEYWORDS" => "Y",
			"SET_STATUS_404" => "Y",
			"SET_TITLE" => "Y",
			"SHOW_404" => "Y",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC",
			"STRICT_SECTION_CHECK" => "N",
			"COMPONENT_TEMPLATE" => "vrachi",
			"COMPOSITE_FRAME_MODE" => "A",
			"COMPOSITE_FRAME_TYPE" => "AUTO",
			"SECT_CODE_PARAM" => $code,
		),
		false
	);

	else: // вызов деталки если раздела не существует
 
		$APPLICATION->IncludeComponent(
			"bitrix:news.detail", 
			"specialist",
			array(
				"COMPONENT_TEMPLATE" => "specialist",
				"IBLOCK_TYPE" => "mgn_doctor_service",
				"IBLOCK_ID" => "25",
				"ELEMENT_ID" => "",
				"ELEMENT_CODE" => $code,
				"CHECK_DATES" => "Y",
				"FIELD_CODE" => array(
					0 => "PREVIEW_PICTURE",
					1 => "",
				),
				"PROPERTY_CODE" => array(
					0 => "DATE",
					1 => "CLINIC",
					2 => "AGE",
					3 => "SPECIALIZATION",
					4 => "PHOTO",
					5 => "REVIEWS",
					6 => "ONDOC_KEY",
					7 => "",
				),
				"IBLOCK_URL" => "",
				"DETAIL_URL" => "",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"CACHE_TYPE" => "N",
				"CACHE_TIME" => "36000000",
				"CACHE_GROUPS" => "N",
				"SET_TITLE" => "Y",
				"SET_CANONICAL_URL" => "N",
				"SET_BROWSER_TITLE" => "Y",
				"BROWSER_TITLE" => "-",
				"SET_META_KEYWORDS" => "Y",
				"META_KEYWORDS" => "-",
				"SET_META_DESCRIPTION" => "Y",
				"META_DESCRIPTION" => "-",
				"SET_LAST_MODIFIED" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "Y",
				"ADD_ELEMENT_CHAIN" => "Y",
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"USE_PERMISSIONS" => "N",
				"STRICT_SECTION_CHECK" => "N",
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"USE_SHARE" => "N",
				"PAGER_TEMPLATE" => ".default",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"PAGER_TITLE" => "Страница",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"SET_STATUS_404" => "Y",
				"SHOW_404" => "Y",
				"MESSAGE_404" => ""
			),
			false
		);
	endif;
endif;
?>
</div>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>