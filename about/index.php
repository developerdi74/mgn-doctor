<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$APPLICATION->SetTitle("Семейный доктор в Магнитогорске");
//$element_code=$_REQUEST["ELEMENT_CODE"]?$_REQUEST["ELEMENT_CODE"]:'klinika-na-zhukova';
$el=explode("?", $_REQUEST["ELEMENT_CODE"]);

if($element_code=$el[0]){
	if(!($elementID=getElementIDByCode_($element_code))){
		if(!defined("ERROR_404")) define("ERROR_404", "Y");
		\CHTTP::setStatus("404 Not Found");
		require(\Bitrix\Main\Application::getDocumentRoot()."/404.php");
		die();
	}
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
		$APPLICATION->AddChainItem("О нас", "/about/");	
//$APPLICATION->SetPageProperty("title", "Семейный доктор в Магнитогорске - Адреса и телефоны медицинских центров");
?>
<div id="page" class="site page-dark-grey">
	 <!-- CONTACTS  -->
</div>

<?if($elementID){
	$arItem=\Bitrix\Iblock\ElementTable::getList(['select'=>['ID', 'NAME', 'DETAIL_TEXT'], 'filter'=>['IBLOCK_ID'=>28, 'ID'=>$elementID]])->fetch();
	if(empty($arItem['DETAIL_TEXT'])){?>
		<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
		<script>
			document.addEventListener('DOMContentLoaded', (event) => {

				// Плавный скролл
				$(".how-to-get__btn").on("click", function(event) {
					event.preventDefault(); 																													//опустошим стандартную обработку
					var id = $(this).attr('href'),																												//заберем айдишник блока с параметром URL
						top = $(id).offset().top;																												//определим высоту от начала страницы до якоря
					$('body,html').animate({
						scrollTop: top
					}, 1000);																																	//сделаем прокрутку за 1 с
				});

				// YANDEX MAPS FOR CONTACT PAGE
				if ($('#map').length > 0) {
					ymaps.ready(init);

					function init() {
						var myMap = new ymaps.Map("map", {
							center: [53.367, 58.97],
							zoom: 13,
							controls: ['zoomControl'],
							behaviors: ['drag']
						});

						var placemark = new ymaps.Placemark([53.35729307109895, 58.97059850000001], {
							hintContent: '<div class="map__hint">Семейный доктор, г. Магнитогорск, ул. Жукова, дом 11</div>',
							balloonContent: [
								'<div class="map__balloon">',
								' ',
								'Семейный доктор<br> г. Магнитогорск, ул. Жукова, дом 11',
								'</div">',
							].join('')
						}, {
							iconLayout: 'default#image',
							iconImageHref: '<?= SITE_TEMPLATE_PATH ?>/img/main_logo.svg',
							iconImageSize: [70, 31],
							iconImageOffset: [-23, -57]
						});

						var placemark2 = new ymaps.Placemark([53.376082, 58.965819], {
							hintContent: '<div class="map__hint">Семейный доктор, г. Магнитогорск, ул. Доменщиков, д.8А</div>',
							balloonContent: [
								'<div class="map__balloon">',
								' ',
								'Семейный доктор, г. Магнитогорск, ул. Доменщиков, д.8А',
								'</div">',
							].join('')
						}, {
							iconLayout: 'default#image',
							iconImageHref: '<?= SITE_TEMPLATE_PATH ?>/img/main_logo.svg',
							iconImageSize: [70, 31],
							iconImageOffset: [-23, -57]
						});

						var placemark3 = new ymaps.Placemark([53.357841, 58.971155], {
							hintContent: '<div class="map__hint">Семейный доктор, г. Магнитогорск, ул. 50 лет Магнитки, 35/1</div>',
							balloonContent: [
								'<div class="map__balloon">',
								' ',
								'Семейный доктор, г. Магнитогорск, ул. 50 лет Магнитки, 35/1',
								'</div">',
							].join('')
						}, {
							iconLayout: 'default#image',
							iconImageHref: '<?= SITE_TEMPLATE_PATH ?>/img/main_logo.svg',
							iconImageSize: [70, 31],
							iconImageOffset: [-23, -57]
						});
						myMap.geoObjects.add(placemark);
						myMap.geoObjects.add(placemark2);
						myMap.geoObjects.add(placemark3);
					}
				}

			});
		</script>

		<div id="page" class="site page-dark-grey">
			<!-- CONTACTS  -->
			<? $APPLICATION->IncludeComponent(
	"bitrix:news.detail", 
	"contact", 
	array(
		"COMPONENT_TEMPLATE" => "contact",
		"IBLOCK_TYPE" => "mgn_doctor_content",
		"IBLOCK_ID" => "28",
		"ELEMENT_ID" => $elementID,
		"ELEMENT_CODE" => "",
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "ADDRESS",
			1 => "DOCTOR",
			2 => "E_MAIL",
			3 => "PHONE",
			4 => "OPENING_HOURS",
			5 => "PHOTO",
			6 => "",
		),
		"IBLOCK_URL" => "",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_CANONICAL_URL" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
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
		"MESSAGE_404" => "",
		"FILE_404" => ""
	),
	false
);?>

			<section class="contacts how-to-get" id="how-to-get">
				<div class="container hget__container">
					<div class="row row-how-to-get">
						<h3 class="how-to-get__title">Как добраться:</h3>
					</div>
					<div class="row row-contacts-map">
						<div class="map map1 active--map" id="map">
						</div>
						<!-- <div class="map map2" id="map2"></div> -->
					</div>
				</div>
				<div class="container hget__container hget__container--white">
					<div class="row ">
						<div class="line line-green-full"></div>
					</div>
					<div class="row row-how-to-get row-contacts-how">
						<div class="col-md-4 col-sm-6 col-xs-12 col-how-to-get ">
							<h6 class="how-to-get__subtitle">До остановки «50 лет Магнитки»</h6>
							<ul class="how-to-get__list">
								<li>трамваем №: 10, 19, 24, 25, 27</li>
								<li>маршрутным такси №: 3, 7, 10, 13, 15, 17, 18, 31, 41, 42, 44, 56</li>
								<li>автобусом №: 9, 10, 17, 18, 42, 44</li>
							</ul>
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12 col-how-to-get ">
							<h6 class="how-to-get__subtitle">До остановки «145 микрорайон»</h6>
							<ul class="how-to-get__list">
								<li>автобусом №: 17, 42</li>
								<li>маршрутным такси №: 13, 17, 31, 37, 42, 45, 52</li>
							</ul>
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12 col-how-to-get ">
							<h6 class="how-to-get__subtitle">До остановки «50 лет Магнитки»</h6>
							<ul class="how-to-get__list">
								<li>автобусом №: 17, 42</li>
								<li>маршрутным такси №: 13, 17, 37, 42, 45, 52</li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!-- CONTACTS END -->
		</div>
	<?}
	else{
		echo $arItem['DETAIL_TEXT'];
		$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(28,$arItem['ID']);
		$IPROPERTY = $ipropValues->getValues();

		$APPLICATION->AddChainItem($arItem['NAME'], "/about");
		$APPLICATION->SetTitle($IPROPERTY['ELEMENT_META_TITLE']);
		$APPLICATION->SetPageProperty("keywords", $IPROPERTY['ELEMENT_META_KEYWORDS']);
		$APPLICATION->SetPageProperty("description", $IPROPERTY['ELEMENT_META_DESCRIPTION']);
	}
}
else{
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"contact", 
	array(
		"COMPONENT_TEMPLATE" => "contact",
		"IBLOCK_TYPE" => "mgn_doctor_content",
		"IBLOCK_ID" => "28",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "ADDRESS",
			1 => "DOCTOR",
			2 => "E_MAIL",
			3 => "PHONE",
			4 => "OPENING_HOURS",
			5 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"FILE_404" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?><br>
<?}?>

<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>