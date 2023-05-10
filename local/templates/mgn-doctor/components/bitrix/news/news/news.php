<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<?if($arParams["USE_RSS"]=="Y"):?>
	<?
	if(method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" href="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" />');
	?>
<?endif?>

<?if($arParams["USE_SEARCH"]=="Y"):?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:search.form",
		"",
		Array(
			"PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"],
			"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"]
		),
		$component
	);?>
<?endif?>

<? /* if($arParams["USE_FILTER"]=="Y"):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.filter",
	"bootstrap_v4",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"]
	),
	$component
);
?>
<?endif*/?>

<? $res = CIBlock::GetByID($arParams["IBLOCK_ID"]);
   $ar_res = $res->GetNext()
?>

<section class="all-news page-news">
		<div class="container">
			<div class="row justify-content-between page-row-middle">
				<h1 class="page-title all-news__title"><?=$ar_res["NAME"]?></h1>
				<div class="all-news__search search-news">
					<div class="search-wrapper">
						<div id="title-search">
							<form action="/search/" class="search">
								<div class="search-input-div">
									<input class="search-input" id="title-search-input" type="text" name="q" value="" placeholder="Поиск" size="20" maxlength="50" autocomplete="off">
								</div>
								<div class="search-button-div">
									<button class="btn btn-search btn-default btn-lg has-ripple" type="submit" name="s" value="Найти">Найти</button> <span class="close-block inline-search-hide"><span class="svg svg-close close-icons"></span></span>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row all-news__row--tabs">


				<? $APPLICATION->IncludeComponent(
					"bitrix:catalog.section.list",
					"news",
					array(
						"ADD_SECTIONS_CHAIN" => "Y",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "Y",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"COUNT_ELEMENTS" => "Y",
						"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
						"FILTER_NAME" => "sectionsFilter",
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"IBLOCK_TYPE" => "mgn_doctor_content",
						"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
						"SECTION_FIELDS" => array(
							0 => "",
							1 => "",
						),
						"SECTION_ID" => "",
						"SECTION_URL" => "",
						"SECTION_USER_FIELDS" => array(
							0 => "",
							1 => "",
						),
						"SHOW_PARENT_NAME" => "Y",
						"TOP_DEPTH" => "2",
						"VIEW_MODE" => "LINE",
						"COMPONENT_TEMPLATE" => "news"
					),
					false
				); ?>




				<div class="all-news__filter">
					<form id="formNews" action="">
						<select id="filterNews" name="DATE" id="">
							<option value="">Весь период</option>
							<option <? if( $_GET["DATE"] == "7") echo "selected"; ?> value="7">За последние 7 дней</option>
							<option <? if( $_GET["DATE"] == "14") echo "selected"; ?> value="14">За последние 14 дней</option>
							<option <? if( $_GET["DATE"] == "30") echo "selected"; ?> value="30">За последний месяц</option>
							<option <? if( $_GET["DATE"] == "180") echo "selected"; ?> value="180">За последние 6 месяцев</option>
							<option <? if( $_GET["DATE"] == "360") echo "selected"; ?> value="360">За последний год</option>
						</select>
					</form>
				</div>

							<? 
							if ( $_GET["DATE"] == 7){
								$from = date('d.m.Y', time() - 86400 * 7); 
								$to = date("d.m.Y"); 
							}

							if ($_GET["DATE"] == 14) {
								$from = date('d.m.Y', time() - 86400 * 14);
								$to = date("d.m.Y");
							}

							if ($_GET["DATE"] == 30) {
								$from = date('d.m.Y', time() - 86400 * 30);
								$to = date("d.m.Y");
							}

							if ($_GET["DATE"] == 180) {
								$from = date('d.m.Y', time() - 86400 * 180);
								$to = date("d.m.Y");
							}

							if ($_GET["DATE"] == 360) {
								$from = date('d.m.Y', time() - 86400 * 180);
								$to = date("d.m.Y");
							}
							
							$GLOBALS['arrFilter'] = array(
								array(
									"LOGIC" => "AND",
									">=DATE_ACTIVE_FROM" => ConvertTimeStamp(strtotime($from), "FULL"),
									"<=DATE_ACTIVE_FROM" => ConvertTimeStamp(strtotime($to), "FULL"),
								)
							);

							if ($_GET["DATE"] == "") {
								$GLOBALS['arrFilter'] = array();
							}

							?>


			</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"all-news",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NEWS_COUNT" => $arParams["NEWS_COUNT"],

		"SORT_BY1" => $arParams["SORT_BY1"],
		"SORT_ORDER1" => $arParams["SORT_ORDER1"],
		"SORT_BY2" => $arParams["SORT_BY2"],
		"SORT_ORDER2" => $arParams["SORT_ORDER2"],

		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SEARCH_PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"],

		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],

		"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],

		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",

		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"MEDIA_PROPERTY" => $arParams["MEDIA_PROPERTY"],
		"SLIDER_PROPERTY" => $arParams["SLIDER_PROPERTY"],

		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
		"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

		"USE_RATING" => $arParams["USE_RATING"],
		"DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
		"MAX_VOTE" => $arParams["MAX_VOTE"],
		"VOTE_NAMES" => $arParams["VOTE_NAMES"],

		"USE_SHARE" => $arParams["LIST_USE_SHARE"],
		"SHARE_HIDE" => $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],

		"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
	),
	$component
);?>

</div>
	</section>