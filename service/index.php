<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>

<?$URI_LENGTH=count(explode("/",$_SERVER['REQUEST_URI'])); //Длина УРЛА больше 5 элементов уход на 404?>
<?
	if($URI_LENGTH>4){
		\CHTTP::setStatus("404 Not Found");
		require(\Bitrix\Main\Application::getDocumentRoot()."/404.php");
		die();
	}

if(isset($_REQUEST['SECTION_CODE']) || isset($_REQUEST['SECTION_ID'])){
	$sectionID=$_REQUEST["SECTION_ID"]?$_REQUEST["SECTION_ID"]:getSectionIDByCode_($_REQUEST["SECTION_CODE"]);
	if(!$sectionID){
		if(!defined("ERROR_404")) define("ERROR_404", "Y");
		\CHTTP::setStatus("404 Not Found");
		require(\Bitrix\Main\Application::getDocumentRoot()."/404.php");
		die();
	}
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Услуги и цены");
$APPLICATION->AddChainItem('Услуги и цены', '/service/');?>
<link rel="stylesheet" href="/service/styles.css">
<script src="/service/script.js"></script>

<?if($sectionID){
	$activeElements=CIBlockSection::GetSectionElementsCount($sectionID, ["CNT_ACTIVE"=>"Y", 'GLOBAL_ACTIVE'=>'Y', 'ACTIVE'=>'Y']);
	$activeSections=CIBlockSection::GetCount(["IBLOCK_ID"=>24, "SECTION_ID"=>$sectionID, 'ACTIVE'=>'Y']);
	if($activeElements>10 && $activeSections){?>
		<?
		$arFilter=['IBLOCK_ID'=>'24', "ID"=>$sectionID];
		$db_list=CIBlockSection::GetList([$by=>$order], $arFilter, false, $arSelect=["UF_*"]);
		$ar_result=$db_list->GetNext();
		?>

		<!-- SERVICE ITEM BANNER  -->
		<section class="serviceit-banner">
			<div class="container-full">
				<div class="row">
					<div class="serviceit-banner__inner" style="background-image:url('<?=CFile::GetPath($ar_result["PICTURE"]);?>');">
						<div class="container">
							<div class="serviceit-banner__overlay">
								<h1 class="page-title serviceit-banner__title title-slider"><?=$ar_result["NAME"]?></h1>
								<div class="serviceit-banner__text">
									<?=$ar_result["DESCRIPTION"]?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- SERVICE ITEM BANNER END -->

		<!-- SERVICE ITEM PRICE AND TEAM  -->
		<section class="serviceit-price" id="serviceit-price">
			<div class="container">
				<div class="row justify-content-between row-vmiddle">
					<h2 class="section-title serviceit-price__title" <?if($_SESSION['isMobile']===true){?>style="text-align: left;"<?}?>>Услуги и цены</h2>
				</div>
				<div class="row serviceit-price__row">
					<div class="serviceit-price__item serviceit-price__item--left">
						<div class="serviceit-price__item--top row-center">
							<div class="line line-green serviceit-line"></div>
							<div class="services-prices__text">
								<p class="page-desc">
									Если у Вас появились вопросы, наш специалист вам обязательно
									<a href="#order-call" data-fancybox="" data-src="#order-call">поможет
										<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12.9 16.2571H16C17.7526 16.2571 18.9 14.59 18.9 12.9286V4.42857C18.9 2.76716 17.7526 1.1 16 1.1H4C2.24611 1.1 1.1 2.76747 1.1 4.42857V12.9286C1.1 14.5897 2.24611 16.2571 4 16.2571H7.65159L11.394 19.6654L12.9 21.0369V19V16.2571Z" stroke="#75A72D" stroke-width="1.8"/>
										</svg>
									</a>
								</p>
							</div>
						</div>
						<div class="faq-acc page-faq__acc">
							<?$arFilter=[
								'ACTIVE'       =>'Y',
								'IBLOCK_ID'    =>24,
								'GLOBAL_ACTIVE'=>'Y',
							];
							$arSelect=['IBLOCK_ID', 'ID', 'NAME', 'CODE', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID', 'IBLOCK_CODE'];
							$arOrder=['DEPTH_LEVEL'=>'ASC', 'NAME'=>'ASC'];
							$rsSections=CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
							$startSection=false;
							$sectionLinc=[];
							$arResult['ROOT']=[];
							$sectionLinc[0]=&$arResult['ROOT'];
							while($arSection=$rsSections->GetNext()){
//								console($arSection);
								if(!CIBlockSection::GetSectionElementsCount($arSection['ID'], ["CNT_ACTIVE"=>"Y", 'GLOBAL_ACTIVE'=>'Y', 'ACTIVE'=>'Y'])){
									continue;
								}
								$sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']]=$arSection;
								$sectionLinc[$arSection['ID']]=&$sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']];
								if($arSection['ID']==$sectionID){
									$startSection=&$sectionLinc[$arSection['ID']];
								}
							}
							unset($sectionLinc);
							$APPLICATION->AddChainItem($startSection['NAME'], '/service/'.$startSection['CODE']);
							$level=0;
							foreach($startSection['CHILD'] as $id=>$item){
								showDir($item);
							}?>
						</div>
					</div>
					<?//вывод слайда врачей?>
					<?$GLOBALS['arrFilter']=["PROPERTY_SECTION"=>$sectionID];
					$arrFilter = array("SECTION_ID" => $sectionID);?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"doctor-slide",
						array(
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"ADD_SECTIONS_CHAIN" => "Y",
							"AJAX_MODE" => "N",
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
							"DISPLAY_BOTTOM_PAGER" => "Y",
							"DISPLAY_DATE" => "Y",
							"DISPLAY_NAME" => "Y",
							"DISPLAY_PICTURE" => "Y",
							"DISPLAY_PREVIEW_TEXT" => "Y",
							"DISPLAY_TOP_PAGER" => "N",
							"FIELD_CODE" => array(
								0 => "PREVIEW_PICTURE",
								1 => "DETAIL_TEXT",
								2 => "",
							),
							"FILTER_NAME" => "arrFilter",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"IBLOCK_ID" => "25",
							"IBLOCK_TYPE" => "mgn_doctor_service",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
							"PARENT_SECTION" => "",
							"INCLUDE_SUBSECTIONS" => "Y",
							"MESSAGE_404" => "",
							"NEWS_COUNT" => "",
							"PAGER_BASE_LINK_ENABLE" => "N",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_TEMPLATE" => ".default",
							"PAGER_TITLE" => "",
							"PREVIEW_TRUNCATE_LEN" => "",
							"PROPERTY_CODE" => array(
								0 => "DATE",
								1 => "CLINIC",
								2 => "AGE",
								3 => "SPECIALIZATION",
								4 => "",
							),
							"SET_BROWSER_TITLE" => "Y",
							"SET_LAST_MODIFIED" => "N",
							"SET_META_DESCRIPTION" => "Y",
							"SET_META_KEYWORDS" => "Y",
							"SET_STATUS_404" => "N",
							"SET_TITLE" => "Y",
							"SHOW_404" => "N",
							"SORT_BY1" => "ACTIVE_FROM",
							"SORT_BY2" => "SORT",
							"SORT_ORDER1" => "DESC",
							"SORT_ORDER2" => "ASC",
							"STRICT_SECTION_CHECK" => "N",
							"COMPONENT_TEMPLATE" => "doctor-slide",
							"PARENT_SECTION_CODE" => ""
						),
						false
					);?>
				</div>
			</div>
		</section>
		
		<!-- SERVICE ITEM DESCRIPTION  -->
		<section class="serviceit-description mt-60">
			<div class="container">
				<?if(count($ar_result["UF_QUESTION"])){?>
					<div class="row">
						<h2 class="serviceit-description__title title-wborder">Частые вопросы</h2>
					</div>
				<?}?>
				<div class="row">
					<article class="arcticle servdesc__item serviceit__arcticle serviceit-arcticle">
						<div id="accordion" class="faq-acc page-faq__acc">
							<?foreach($ar_result["UF_QUESTION"] as $key=>$UFItems){?>
								<div class="card">
									<div class="card-header faq <?if($key==0) echo "card__item--active"?>" id="heading<?=$key?>">
										<h5 class="mb-0">
											<button class="btn btn-faq  " data-toggle="collapse" data-target="#collapse<?=$key?>" aria-expanded="false" aria-controls="collapse<?=$key?>">
												<?=$UFItems?>
												<span class="faq-figure" <?if($key==0){?>style="transform: rotate(180deg)"<?}?>>
													<svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.327898 0.35799C0.778951 -0.101145 1.40691 -0.137175 1.95831 0.35799L6.00123 4.21534L10.0441 0.35799C10.5955 -0.137175 11.2245 -0.101145 11.6725 0.35799C12.1235 0.816095 12.0946 1.59024 11.6725 2.02055C11.2525 2.45086 6.8154 6.65513 6.8154 6.65513C6.5909 6.8847 6.29606 7 6.00123 7C5.70639 7 5.41155 6.8847 5.18499 6.65513C5.18499 6.65513 0.749984 2.45086 0.327898 2.02055C-0.0952218 1.59024 -0.123154 0.816095 0.327898 0.35799Z"></path></svg>
												</span>
											</button>
										</h5>
									</div>
									<div id="collapse<?=$key?>" class="collapse <? if($key==0) echo "show" ?>" aria-labelledby="heading1" data-parent="#accordion" style="">
										<div class="card-body">
											<?=htmlspecialcharsBack($ar_result["UF_ANSWER"][$key])?>
										</div>
									</div>
								</div>
							<?}?>
						</div>
						<div class="serviceit__form green-form contacts-form">
							<div class="green-form__item green-form__item--left">
								<h5>Позвоните сейчас</h5>
								<div class="green-form__phones">
									<a href="tel:+7 (3519) 581-111" class="phone green-form__phone">
										<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" clip-rule="evenodd" d="M7.69858 11.0989C9.49981 12.8986 11.5866 14.621 12.4116 13.7962C13.5915 12.6165 14.3198 11.5881 16.9232 13.6802C19.5255 15.7712 17.5263 17.1659 16.3827 18.3081C15.0628 19.6277 10.1427 18.3786 5.27949 13.5175C0.417412 8.65528 -0.828545 3.73616 0.49251 2.41651C1.63606 1.27206 3.02425 -0.725621 5.11563 1.87614C7.20816 4.4779 6.18067 5.20598 4.99843 6.38684C4.1769 7.21162 5.89848 9.29804 7.69858 11.0989Z" fill="#274023"/>
										</svg>
										+7(3519)581-111
									</a>
									<a href="tel:+7 (3519) 581-400" class="phone green-form__phone">
										<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" clip-rule="evenodd" d="M7.69858 11.0989C9.49981 12.8986 11.5866 14.621 12.4116 13.7962C13.5915 12.6165 14.3198 11.5881 16.9232 13.6802C19.5255 15.7712 17.5263 17.1659 16.3827 18.3081C15.0628 19.6277 10.1427 18.3786 5.27949 13.5175C0.417412 8.65528 -0.828545 3.73616 0.49251 2.41651C1.63606 1.27206 3.02425 -0.725621 5.11563 1.87614C7.20816 4.4779 6.18067 5.20598 4.99843 6.38684C4.1769 7.21162 5.89848 9.29804 7.69858 11.0989Z" fill="#274023"/>
										</svg>
										+7(3519)581-400
									</a>
								</div>
							</div>
							<div class="green-form__item green-form__item--right">
								<h5>Оставьте заявку</h5>
								<form action="" method="post" class="form acceptance-as-validation" novalidate="novalidate">
									<div class="wrap">
										<div class="contacts__form">
											<div class="contacts__form__field field">
												<input type="tel" name="contact-tel" value="" size="40" class="contact-tel contact-input" placeholder="Ваш телефон" required>
											</div>
											<div class="contacts__form__field contacts__form__button">
												<input type="submit" value="Заказать звонок" class="button js-form-contacts-submit">
											</div>
											<div class="contacts__form__field contacts__form__accept form-accept">
												<input type="checkbox" id="licenses_popup" name="licenses_popup" required="" value="Y" aria-required="true" required>
												<label for="licenses_popup">
													Согласен на обработку
													<noindex><a href="/privacy_policy.pdf" target="_blank">персональных данных</a>.</noindex>
												</label>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</article>
					<aside class="aside servdesc__item serviceit__aside">
						<?$APPLICATION->IncludeComponent("bitrix:news.list", "top-news", [
							"ACTIVE_DATE_FORMAT"             =>"d.m.Y",
							"ADD_SECTIONS_CHAIN"             =>"Y",
							"AJAX_MODE"                      =>"N",
							"AJAX_OPTION_ADDITIONAL"         =>"",
							"AJAX_OPTION_HISTORY"            =>"N",
							"AJAX_OPTION_JUMP"               =>"N",
							"AJAX_OPTION_STYLE"              =>"Y",
							"CACHE_FILTER"                   =>"N",
							"CACHE_GROUPS"                   =>"Y",
							"CACHE_TIME"                     =>"36000000",
							"CACHE_TYPE"                     =>"A",
							"CHECK_DATES"                    =>"Y",
							"DETAIL_URL"                     =>"",
							"DISPLAY_BOTTOM_PAGER"           =>"Y",
							"DISPLAY_DATE"                   =>"Y",
							"DISPLAY_NAME"                   =>"Y",
							"DISPLAY_PICTURE"                =>"Y",
							"DISPLAY_PREVIEW_TEXT"           =>"Y",
							"DISPLAY_TOP_PAGER"              =>"N",
							"FIELD_CODE"                     =>["", ""],
							"FILTER_NAME"                    =>"",
							"HIDE_LINK_WHEN_NO_DETAIL"       =>"N",
							"IBLOCK_ID"                      =>"27",
							"IBLOCK_TYPE"                    =>"mgn_doctor_content",
							"INCLUDE_IBLOCK_INTO_CHAIN"      =>"Y",
							"INCLUDE_SUBSECTIONS"            =>"Y",
							"MESSAGE_404"                    =>"",
							"NEWS_COUNT"                     =>"10",
							"PAGER_BASE_LINK_ENABLE"         =>"N",
							"PAGER_DESC_NUMBERING"           =>"N",
							"PAGER_DESC_NUMBERING_CACHE_TIME"=>"36000",
							"PAGER_SHOW_ALL"                 =>"N",
							"PAGER_SHOW_ALWAYS"              =>"N",
							"PAGER_TEMPLATE"                 =>".default",
							"PAGER_TITLE"                    =>"",
							"PARENT_SECTION"                 =>"",
							"PARENT_SECTION_CODE"            =>"",
							"PREVIEW_TRUNCATE_LEN"           =>"",
							"PROPERTY_CODE"                  =>["", ""],
							"SET_BROWSER_TITLE"              =>"Y",
							"SET_LAST_MODIFIED"              =>"N",
							"SET_META_DESCRIPTION"           =>"Y",
							"SET_META_KEYWORDS"              =>"Y",
							"SET_STATUS_404"                 =>"N",
							"SET_TITLE"                      =>"N",
							"SHOW_404"                       =>"N",
							"SORT_BY1"                       =>"ACTIVE_FROM",
							"SORT_BY2"                       =>"SORT",
							"SORT_ORDER1"                    =>"DESC",
							"SORT_ORDER2"                    =>"ASC",
							"STRICT_SECTION_CHECK"           =>"N"
						]); ?>
					</aside>
				</div>
			</div>
		</section>
		<!-- SERVICE ITEM DESCRIPTION END -->
		
		<? //console($arResult); ?>
		<? //console($sectionID); ?>
		<?
		$arFilter=[
			'ACTIVE'       =>'Y',
			'IBLOCK_ID'    =>24,
			'GLOBAL_ACTIVE'=>'Y',
			'ID'           =>$sectionID
		];
		$arSelect=['ID', 'NAME'];
		$arOrder=['DEPTH_LEVEL'=>'ASC', 'NAME'=>'ASC'];
		$rsSections=CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
		$arSection=$rsSections->fetch();
//		console($arSection);
		
		$APPLICATION->SetTitle($arSection['NAME'].'. Цены на услуги | Семейный Доктор в Магнитогорске');?>
	<?}else{
		//prnt('@@@'.$sectionID);
		$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"service_detail", 
	array(
		"COMPONENT_TEMPLATE" => "service_detail",
		"IBLOCK_TYPE" => "mgn_doctor_service",
		"IBLOCK_ID" => "24",
		"SECTION_ID" => $sectionID,
		"SECTION_USER_FIELDS" => array(
			0 => "UF_SRV_AGE",
			1 => "UF_CLINIC",
			2 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
		"ELEMENT_SORT_FIELD" => "left_margin",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"PAGE_ELEMENT_COUNT" => "6",
		"LINE_ELEMENT_COUNT" => "3",
		"OFFERS_LIMIT" => "5",
		"BACKGROUND_IMAGE" => "-",
		"TEMPLATE_THEME" => "blue",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'6','BIG_DATA':false}]",
		"ENLARGE_PRODUCT" => "STRICT",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => array(
		),
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"RCM_TYPE" => "personal",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"SHOW_FROM_SECTION" => "N",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_CODE",
		"SEF_MODE" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"DISPLAY_COMPARE" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"LAZY_LOAD" => "Y",
		"LOAD_ON_SCROLL" => "N",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"COMPATIBLE_MODE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"SEF_RULE" => "/service/#SECTION_CODE#/",
		"SECTION_CODE_PATH" => "",
		"MESS_BTN_LAZY_LOAD" => "Показать ещё",
		"SECTION_CODE" => "",
		"FILE_404" => ""
	),
	false
);
	}
}else{?>
	<!-- SERVICES AND PRICES  -->
	<section class="services-prices-inner all-services">
		<div class="container">

<!--			<div class="row  row-services-prices ">-->
<!--				<h1 class="page-title services-prices__title">Услуги и цены</h1>-->
<!--				<div class="services-prices__text">-->
<!--					<p class="page-desc">Если вы не можете выбрать услугу, наш-->
<!--						<a href="#ask-question-modal" data-fancybox="" data-src="#ask-question-modal">специалист</a> вам поможет!</p>-->
<!--				</div>-->
<!--			</div>-->

			<?if($_SESSION['isMobile']===false){?>
				<!-- DESKTOP BLOCK -->
				<div class="services-prices row-white services-prices--desktop" style="margin-left: -15px; margin-right: -15px;">
<!--					<div class="container services">-->
						<div class="services">
								<h1 class="page-title services-prices__title">Услуги и цены</h1>
							<div class="row">
								<div class="col-4">
									<div class="row top-static" style="margin: 0;">
										<h2 class="services-prices__subtitle">Популярные услуги</h2>
									</div>
									<div class="container services services-static">
										<div class="line-green-full-small line-green-static"></div>
										<?$GLOBALS['sectionsFilter']=[
											'IBLOCK_ID'   =>24,
											'DEPTH_LEVEL' =>1,
											'=UF_CATEGORY'=>10,																									// популярное
										];
										$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "directions", [
											"ADD_SECTIONS_CHAIN"   =>"Y",
											"CACHE_FILTER"         =>"N",
											"CACHE_GROUPS"         =>"Y",
											"CACHE_TIME"           =>"36000000",
											"CACHE_TYPE"           =>"N",
											"COUNT_ELEMENTS_FILTER"=>"CNT_ACTIVE",
											"COUNT_ELEMENTS"       =>"Y",
											"FILTER_NAME"          =>"sectionsFilter",
											"IBLOCK_ID"            =>"24",
											"IBLOCK_TYPE"          =>"mgn_doctor_service",
											"SECTION_CODE"         =>"",
											"SECTION_FIELDS"       =>[
												0=>"",
												1=>"",
											],
											"SECTION_ID"           =>$_REQUEST["SECTION_ID"],
											"SECTION_URL"          =>"",
											"SECTION_USER_FIELDS"  =>[
												0=>"",
												1=>"",
											],
											"SHOW_PARENT_NAME"     =>"Y",
											"TOP_DEPTH"            =>"4",
											"VIEW_MODE"            =>"LIST",
											"COMPONENT_TEMPLATE"   =>"directions",
											'CUSTOM_SECTION_SORT'  =>[
												'sort' => 'acs',
												'name' => 'asc'
											]
										], false);
										?>
									</div>
									<div class="container services">
										<div class="row">
											<h2 class="services-prices__subtitle">Справки и комиссии</h2>
											<div class="line-green-full-small"></div>
										</div>
										<div class="row">
											<a href="/service/spravka-dlya-otezzhayushchikh-v-lager" class="services-item">Справка для отъезжающих в лагерь</a>
										</div>
										<div class="row">
											<a href="/service/spravka-dlya-vykupa-putyevki" class="services-item">Справка для выкупа путёвки</a>
										</div>
										<div class="row">
											<a href="/service/spravka-v-basseyn" class="services-item">Справка в бассейн</a>
										</div>
										<div class="row">
											<a href="/service/meditsinskaya-karta-d-detskogo-sada-shkoly" class="services-item">Медицинская карта д/детского сада, школы</a>
										</div>
										<div class="row">
											<a href="/service/medkomissiya-na-rabotu" class="services-item">Медкомиссия на работу</a>
										</div>
										<div class="row">
											<a href="/service/spravki-abiturientam" class="services-item">Справка абитуриентам</a>
										</div>
										<div class="row">
											<a href="/service/voditelskaya-komissiya" class="services-item">Водительская комиссия</a>
										</div>
										<div class="row">
											<a href="/service/drugoe" class="services-all" style="border: none;">Другое</a>
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="top-static"></div>
									<div class="container services services-static">
										<div class="row">
											<a href="https://mgn-doctor.ru/news/stati/ok-terapiya-chtoby-zrenie-bylo-ok/"><div class="service-img"><img src="/images-sd/night_lenses.jpg"></div></a>
										</div>
									</div>
									<div class="container services">
										<div class="row">
											<h2 class="services-prices__subtitle">Диагностика</h2>
											<div class="line-green-full-small"></div>
										</div>
										<div class="row">
											<a href="/service/uzi/" class="services-item">УЗИ</a>
										</div>
										<div class="row">
											<a href="/service/rentgen/" class="services-item">Рентгенологические исследования</a>
										</div>
										<div class="row">
											<a href="/service/funkcionalnaya-diagnostika/" class="services-item">Функциональная диагностика</a>
										</div>
										<div class="row">
											<a href="/service/endoskopiya/" class="services-item">Эндоскопия</a>
										</div>
										<div class="row">
											<a href="/service/elektrokardiografiya/" class="services-item">Электрокардиография (ЭКГ)</a>
										</div>
										<div class="row">
											<a href="/service/elektroentsefalografiya/" class="services-item">Электроэнцефалография (ЭЭГ)</a>
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="top-static"></div>
									<div class="container services services-static">
										<div class="row">
											<div class="service-detail" style="border-top: 1px solid #BAC0C5; width: 100%;">
												<div class="row" style="margin: 0;">
													<div class="service-detail-name">УЗИ мочевого пузыря и почек</div>
												</div>
												<div class="row justify-content-between service-detail-line">
													<div class="service-detail-price" data-price="750" style="line-height: 2.5em;">750 руб.</div>
													<button data-fancybox="" type="button" data-src="#order-appointment" class="btn btn-outline-dark btn__ ">Записаться</button>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="service-detail" style="width: 100%; background-color: #dbe2e7;">
												<div class="row" style="margin: 0;">
													<div class="service-detail-name">Оформление справки в бассейн</div>
												</div>
												<div class="row justify-content-between service-detail-line">
													<div class="service-detail-price" data-price="350" style="line-height: 2.5em;">350 руб.</div>
													<button type="button" data-src="#order-appointment" data-fancybox="" class="btn btn-outline-dark btn__">Записаться</button>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="service-detail" style="border-bottom: 1px solid #BAC0C5; width: 100%;">
												<div class="row" style="margin: 0;">
													<div class="service-detail-name">Коктейль Иммунный</div>
												</div>
												<div class="row justify-content-between service-detail-line">
													<div class="service-detail-price" data-price="3500" style="line-height: 2.5em;">3 500 руб.</div>
													<button type="button" data-src="#order-appointment" data-fancybox="" class="btn btn-outline-dark btn__">Записаться</button>
												</div>
											</div>
										</div>
									</div>
									<div class="container services">
										<div class="row">
											<h2 class="services-prices__subtitle">Направления</h2>
											<div class="line-green-full-small"></div>
										</div>
										<div id="directions">
											<?$GLOBALS['sectionsFilter']=[
												'IBLOCK_ID'    =>24,
												'DEPTH_LEVEL'  =>1,
												'=UF_CATEGORY' =>false,																							// популярнрое
											];
											$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "directions", [
												"ADD_SECTIONS_CHAIN"   =>"Y",
												"CACHE_FILTER"         =>"N",
												"CACHE_GROUPS"         =>"Y",
												"CACHE_TIME"           =>"36000000",
												"CACHE_TYPE"           =>"N",
												"COUNT_ELEMENTS_FILTER"=>"CNT_ACTIVE",
												"COUNT_ELEMENTS"       =>"Y",
												"FILTER_NAME"          =>"sectionsFilter",
												"IBLOCK_ID"            =>"24",
												"IBLOCK_TYPE"          =>"mgn_doctor_service",
												"SECTION_CODE"         =>"",
												"SECTION_FIELDS"       =>[
													0=>"",
													1=>"",
												],
												"SECTION_ID"           =>$_REQUEST["SECTION_ID"],
												"SECTION_URL"          =>"",
												"SECTION_USER_FIELDS"  =>[
													0=>"",
													1=>"",
												],
												"SHOW_PARENT_NAME"     =>"Y",
												"TOP_DEPTH"            =>"4",
												"VIEW_MODE"            =>"LIST",
												"COMPONENT_TEMPLATE"   =>"directions",
												'CUSTOM_SECTION_SORT'  =>[
													'sort' => 'acs',
//													'name' => 'asc'
												],
												'ONLY_FIRST'          =>7
											], false);
											?>
											<div class="row">
												<div class="services-all" id="directions-click">Показать все услуги</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


				</div>
				<!-- DESKTOP BLOCK END -->
			<?}else{?>
				<!-- MOBILE BLOCK -->
				<div class="services-prices row-white services-prices--mobile" style="margin-left: -30px; margin-right: -30px;">

					<div class="container services">

									<h1 class="page-title row services-prices__title">Услуги и цены</h1>
						<div class="row">
							<h2 class="services-prices__subtitle">Популярные услуги</h2>
							<div class="line-green-full-small"></div>
						</div>
						<?$GLOBALS['sectionsFilter']=[
							'IBLOCK_ID'   =>24,
							'DEPTH_LEVEL' =>1,
							'=UF_CATEGORY'=>10,																													// популярное
						];
						$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "directions", [
							"ADD_SECTIONS_CHAIN"   =>"Y",
							"CACHE_FILTER"         =>"N",
							"CACHE_GROUPS"         =>"Y",
							"CACHE_TIME"           =>"36000000",
							"CACHE_TYPE"           =>"N",
							"COUNT_ELEMENTS_FILTER"=>"CNT_ACTIVE",
							"COUNT_ELEMENTS"       =>"Y",
							"FILTER_NAME"          =>"sectionsFilter",
							"IBLOCK_ID"            =>"24",
							"IBLOCK_TYPE"          =>"mgn_doctor_service",
							"SECTION_CODE"         =>"",
							"SECTION_FIELDS"       =>[
								0=>"",
								1=>"",
							],
							"SECTION_ID"           =>$_REQUEST["SECTION_ID"],
							"SECTION_URL"          =>"",
							"SECTION_USER_FIELDS"  =>[
								0=>"",
								1=>"",
							],
							"SHOW_PARENT_NAME"     =>"Y",
							"TOP_DEPTH"            =>"4",
							"VIEW_MODE"            =>"LIST",
							"COMPONENT_TEMPLATE"   =>"directions",
							'CUSTOM_SECTION_SORT'  =>[
								'sort' => 'acs',
								'name' => 'asc'
							]
						], false);
						?>
					</div>
					<div class="container services">
						<div class="row">
							<h2 class="services-prices__subtitle">Диагностика</h2>
							<div class="line-green-full-small"></div>
						</div>
						<div class="row">
							<a href="/service/uzi/" class="services-item">УЗИ</a>
						</div>
						<div class="row">
							<a href="/service/rentgen/" class="services-item">Рентгенологические исследования</a>
						</div>
						<div class="row">
							<a href="/service/funkcionalnaya-diagnostika/" class="services-item">Функциональная диагностика</a>
						</div>
						<div class="row">
							<a href="/service/endoskopiya/" class="services-item">Эндоскопия</a>
						</div>
						<div class="row">
							<a href="/service/elektrokardiografiya/" class="services-item">Электрокардиография (ЭКГ)</a>
						</div>
						<div class="row">
							<a href="/service/elektroentsefalografiya/" class="services-item">Электроэнцефалография (ЭЭГ)</a>
						</div>
					</div>
					<div class="container services">
						<div class="row">
							<h2 class="services-prices__subtitle">Справки и комиссии</h2>
							<div class="line-green-full-small"></div>
						</div>
						<div class="row">
							<a href="/service/spravka-dlya-otezzhayushchikh-v-lager" class="services-item">Справка для отъезжающих в лагерь</a>
						</div>
						<div class="row">
							<a href="/service/spravka-dlya-vykupa-putyevki" class="services-item">Справка для выкупа путёвки</a>
						</div>
						<div class="row">
							<a href="/service/spravka-v-basseyn" class="services-item">Справка в бассейн</a>
						</div>
						<div class="row">
							<a href="/service/meditsinskaya-karta-d-detskogo-sada-shkoly" class="services-item">Медицинская карта д/детского сада, школы</a>
						</div>
						<div class="row">
							<a href="/service/medkomissiya-na-rabotu" class="services-item">Медкомиссия на работу</a>
						</div>
						<div class="row">
							<a href="/service/spravki-abiturientam" class="services-item">Справка абитуриентам</a>
						</div>
						<div class="row">
							<a href="/service/voditelskaya-komissiya" class="services-item">Водительская комиссия</a>
						</div>
						<div class="row">
							<a href="/service/drugoe" class="services-all" style="border: none;">Другое</a>
						</div>
					</div>
					<div class="container services">
						<div class="row">
							<h2 class="services-prices__subtitle">Направления</h2>
							<div class="line-green-full-small"></div>
						</div>
						<div id="directions">
							<?$GLOBALS['sectionsFilter']=[
								'IBLOCK_ID'   =>24,
								'DEPTH_LEVEL' =>1,
								'=UF_CATEGORY' =>false,																										// популярнрое
							];
							$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "directions", [
								"ADD_SECTIONS_CHAIN"   =>"Y",
								"CACHE_FILTER"         =>"N",
								"CACHE_GROUPS"         =>"Y",
								"CACHE_TIME"           =>"36000000",
								"CACHE_TYPE"           =>"N",
								"COUNT_ELEMENTS_FILTER"=>"CNT_ACTIVE",
								"COUNT_ELEMENTS"       =>"Y",
								"FILTER_NAME"          =>"sectionsFilter",
								"IBLOCK_ID"            =>"24",
								"IBLOCK_TYPE"          =>"mgn_doctor_service",
								"SECTION_CODE"         =>"",
								"SECTION_FIELDS"       =>[
									0=>"",
									1=>"",
								],
								"SECTION_ID"           =>$_REQUEST["SECTION_ID"],
								"SECTION_URL"          =>"",
								"SECTION_USER_FIELDS"  =>[
									0=>"",
									1=>"",
								],
								"SHOW_PARENT_NAME"     =>"Y",
								"TOP_DEPTH"            =>"4",
								"VIEW_MODE"            =>"LIST",
								"COMPONENT_TEMPLATE"   =>"directions",
								'CUSTOM_SECTION_SORT'  =>[
									'sort' => 'acs',
								],
								'ONLY_FIRST'          =>7
							], false);?>
							<div class="row">
								<div class="services-all" id="directions-click">Показать все услуги</div>
							</div>
						</div>
					</div>
				</div>
				<!-- MOBILE BLOCK END -->
			<?}?>
		</div>
	</section>
	<!-- SERVICES AND PRICES END -->
<?}?>

<?function showDir(&$dir, $fromID=false, $bigin=false, $level=0){?>
	<?if($bigin){
		if($_SESSION['isMobile']==true && mb_strlen($dir['NAME'])>50){
			$dir['SHORT_NAME']=mb_strimwidth($dir['NAME'], 0, 50, '...');
		}
		?>
		<?//console('bigin 1')?>
		<div class="card" style="margin-left: <?=$level*5?>px;">
			<div class="card-header" id="heading<?=$dir['ID']?>">
				<h5 class="mb-0">
					<button class="btn btn-faq <?if(!isset($dir['CHILD'])){?>services-directory<?}?>" data-toggle="collapse" data-target="#collapse<?=$dir['ID']?>" aria-expanded="false"
						aria-controls="collapse<?=$dir['ID']?>" data-id="<?=$dir['ID']?>"<?if(!empty($dir['SHORT_NAME'])){?> data-fullName="<?=$dir['NAME']?>"<?}?>>
						<span class="group-name"><?=$dir['SHORT_NAME']?$dir['SHORT_NAME']:$dir['NAME']?></span>
						<span class="faq-figure">
							<svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.327898 0.35799C0.778951 -0.101145 1.40691 -0.137175 1.95831 0.35799L6.00123 4.21534L10.0441 0.35799C10.5955 -0.137175 11.2245 -0.101145 11.6725 0.35799C12.1235 0.816095 12.0946 1.59024 11.6725 2.02055C11.2525 2.45086 6.8154 6.65513 6.8154 6.65513C6.5909 6.8847 6.29606 7 6.00123 7C5.70639 7 5.41155 6.8847 5.18499 6.65513C5.18499 6.65513 0.749984 2.45086 0.327898 2.02055C-0.0952218 1.59024 -0.123154 0.816095 0.327898 0.35799Z"></path></svg>
						</span>
					</button>
				</h5>
			</div>
			<?if(isset($dir['CHILD'])){?>
				<?$level++;?>
				<div id="collapse<?=$dir['ID']?>" class="collapse" aria-labelledby="heading1" data-parent="#accordion" style="">
					<div class="card-body" style="padding: 0; margin-left: <?=$level*5?>">
						<?foreach($dir['CHILD'] as $id=>$item){
							showDir($item, $fromID, $bigin,$level);
						}?>
					</div>
				</div>
				</div>
				<?$level--;?>
			<?}else{?>
				<div id="collapse<?=$dir['ID']?>" class="collapse" aria-labelledby="heading1" data-parent="#accordion" style="">
					<div class="card-body">
						Загружается список услуг ...
					</div>
				</div>
				</div>
			<?}?>
	<?}else{
		if($fromID){
			//console('fromID 1');
			if($dir['ID']==$fromID){
				//console('fromID ==');
				$bigin=true;
			}
		}
		else{
			//console('fromID 0');
			$bigin=true;
		}
		if($bigin){
			showDir($dir, $fromID, $bigin, $level);
		}
	}
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
