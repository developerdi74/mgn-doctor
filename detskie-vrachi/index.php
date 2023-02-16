<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Детские врачи");
?><section class="specialists-inner all-our-specialists">
<div class="container">
	<div class="row">
		<h1 class="page-title specialists-inner__title all-our-specialists__title"><?$APPLICATION->ShowTitle();?></h1>
	</div>
	<div class="row page-row-middle all-specialists">
 <a href="/specialists/"><button class="btn btn-spec-flt">Взрослые</button></a><button class="btn btn-spec-flt active">Детские</button>
	</div><?
			define("AGE",110);
			$arrFilterVrachi = array("PROPERTY" => array("AGE"=>AGE));
		?>
 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"doctors",
	array(
		"COMPONENT_TEMPLATE" => "doctors",
		"IBLOCK_TYPE" => "mgn_doctor_service",
		"IBLOCK_ID" => "25",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "Y",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
		"HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
		"TOP_DEPTH" => "2",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "UF_AGE",
			1 => "UF_MAIN",
			2 => "",
		),
		"FILTER_NAME" => "arrFilterVrachi",
		"VIEW_MODE" => "LINE",
		"SHOW_PARENT_NAME" => "Y",
		"SECTION_URL" => "/specialists/#CODE#?age=".AGE,
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"CACHE_FILTER" => "N",
		"ADD_SECTIONS_CHAIN" => "Y"
	),
	false
);?>

</div>
 </section>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>