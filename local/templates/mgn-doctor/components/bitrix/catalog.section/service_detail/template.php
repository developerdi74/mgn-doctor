<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
use \Bitrix\Main\Localization\Loc;
/**
 * @global CMain                 $APPLICATION
 * @var array                    $arParams
 * @var array                    $arResult
 * @var CatalogSectionComponent  $component
 * @var CBitrixComponentTemplate $this
 * @var string                   $templateName
 * @var string                   $componentPath
 *
 *  _________________________________________________________________________
 * |    Attention!
 * |    The following comments are for system use
 * |    and are required for the component to work correctly in ajax mode:
 * |    <!-- items-container -->
 * |    <!-- pagination-container -->
 * |    <!-- component-end -->
 */
$this->setFrameMode(true);
//$this->addExternalCss('/bitrix/css/main/bootstrap.css');
if(!empty($arResult['NAV_RESULT'])){
	$navParams=[
		'NavPageCount'=>$arResult['NAV_RESULT']->NavPageCount,
		'NavPageNomer'=>$arResult['NAV_RESULT']->NavPageNomer,
		'NavNum'      =>$arResult['NAV_RESULT']->NavNum
	];
}
else{
	$navParams=[
		'NavPageCount'=>1,
		'NavPageNomer'=>1,
		'NavNum'      =>$this->randString()
	];
}
$showTopPager=false;
$showBottomPager=false;
$showLazyLoad=false;
if($arParams['PAGE_ELEMENT_COUNT']>0 && $navParams['NavPageCount']>1){
	$showTopPager=$arParams['DISPLAY_TOP_PAGER'];
	$showBottomPager=$arParams['DISPLAY_BOTTOM_PAGER'];
	$showLazyLoad=$arParams['LAZY_LOAD']==='Y' && $navParams['NavPageNomer']!=$navParams['NavPageCount'];
}
$templateLibrary=['popup', 'ajax', 'fx'];
$currencyList='';
if(!empty($arResult['CURRENCIES'])){
	$templateLibrary[]='currency';
	$currencyList=CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData=[
	'TEMPLATE_THEME'  =>$arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY'=>$templateLibrary,
	'CURRENCIES'      =>$currencyList
];
unset($currencyList, $templateLibrary);
$elementEdit=CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete=CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams=['CONFIRM'=>GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM')];
$positionClassMap=[
	'left'  =>'product-item-label-left',
	'center'=>'product-item-label-center',
	'right' =>'product-item-label-right',
	'bottom'=>'product-item-label-bottom',
	'middle'=>'product-item-label-middle',
	'top'   =>'product-item-label-top'
];
$discountPositionClass='';
if($arParams['SHOW_DISCOUNT_PERCENT']==='Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])){
	foreach(explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos){
		$discountPositionClass.=isset($positionClassMap[$pos])?' '.$positionClassMap[$pos]:'';
	}
}
$labelPositionClass='';
if(!empty($arParams['LABEL_PROP_POSITION'])){
	foreach(explode('-', $arParams['LABEL_PROP_POSITION']) as $pos){
		$labelPositionClass.=isset($positionClassMap[$pos])?' '.$positionClassMap[$pos]:'';
	}
}
$arParams['~MESS_BTN_BUY']=$arParams['~MESS_BTN_BUY']?:Loc::getMessage('CT_BCS_TPL_MESS_BTN_BUY');
$arParams['~MESS_BTN_DETAIL']=$arParams['~MESS_BTN_DETAIL']?:Loc::getMessage('CT_BCS_TPL_MESS_BTN_DETAIL');
$arParams['~MESS_BTN_COMPARE']=$arParams['~MESS_BTN_COMPARE']?:Loc::getMessage('CT_BCS_TPL_MESS_BTN_COMPARE');
$arParams['~MESS_BTN_SUBSCRIBE']=$arParams['~MESS_BTN_SUBSCRIBE']?:Loc::getMessage('CT_BCS_TPL_MESS_BTN_SUBSCRIBE');
$arParams['~MESS_BTN_ADD_TO_BASKET']=$arParams['~MESS_BTN_ADD_TO_BASKET']?:Loc::getMessage('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET');
$arParams['~MESS_NOT_AVAILABLE']=$arParams['~MESS_NOT_AVAILABLE']?:Loc::getMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE');
$arParams['~MESS_SHOW_MAX_QUANTITY']=$arParams['~MESS_SHOW_MAX_QUANTITY']?:Loc::getMessage('CT_BCS_CATALOG_SHOW_MAX_QUANTITY');
$arParams['~MESS_RELATIVE_QUANTITY_MANY']=$arParams['~MESS_RELATIVE_QUANTITY_MANY']?:Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['~MESS_RELATIVE_QUANTITY_FEW']=$arParams['~MESS_RELATIVE_QUANTITY_FEW']?:Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_FEW');
$arParams['MESS_BTN_LAZY_LOAD']=$arParams['MESS_BTN_LAZY_LOAD']?:Loc::getMessage('CT_BCS_CATALOG_MESS_BTN_LAZY_LOAD');
$generalParams=[
	'SHOW_DISCOUNT_PERCENT'       =>$arParams['SHOW_DISCOUNT_PERCENT'],
	'PRODUCT_DISPLAY_MODE'        =>$arParams['PRODUCT_DISPLAY_MODE'],
	'SHOW_MAX_QUANTITY'           =>$arParams['SHOW_MAX_QUANTITY'],
	'RELATIVE_QUANTITY_FACTOR'    =>$arParams['RELATIVE_QUANTITY_FACTOR'],
	'MESS_SHOW_MAX_QUANTITY'      =>$arParams['~MESS_SHOW_MAX_QUANTITY'],
	'MESS_RELATIVE_QUANTITY_MANY' =>$arParams['~MESS_RELATIVE_QUANTITY_MANY'],
	'MESS_RELATIVE_QUANTITY_FEW'  =>$arParams['~MESS_RELATIVE_QUANTITY_FEW'],
	'SHOW_OLD_PRICE'              =>$arParams['SHOW_OLD_PRICE'],
	'USE_PRODUCT_QUANTITY'        =>$arParams['USE_PRODUCT_QUANTITY'],
	'PRODUCT_QUANTITY_VARIABLE'   =>$arParams['PRODUCT_QUANTITY_VARIABLE'],
	'ADD_TO_BASKET_ACTION'        =>$arParams['ADD_TO_BASKET_ACTION'],
	'ADD_PROPERTIES_TO_BASKET'    =>$arParams['ADD_PROPERTIES_TO_BASKET'],
	'PRODUCT_PROPS_VARIABLE'      =>$arParams['PRODUCT_PROPS_VARIABLE'],
	'SHOW_CLOSE_POPUP'            =>$arParams['SHOW_CLOSE_POPUP'],
	'DISPLAY_COMPARE'             =>$arParams['DISPLAY_COMPARE'],
	'COMPARE_PATH'                =>$arParams['COMPARE_PATH'],
	'COMPARE_NAME'                =>$arParams['COMPARE_NAME'],
	'PRODUCT_SUBSCRIPTION'        =>$arParams['PRODUCT_SUBSCRIPTION'],
	'PRODUCT_BLOCKS_ORDER'        =>$arParams['PRODUCT_BLOCKS_ORDER'],
	'LABEL_POSITION_CLASS'        =>$labelPositionClass,
	'DISCOUNT_POSITION_CLASS'     =>$discountPositionClass,
	'SLIDER_INTERVAL'             =>$arParams['SLIDER_INTERVAL'],
	'SLIDER_PROGRESS'             =>$arParams['SLIDER_PROGRESS'],
	'~BASKET_URL'                 =>$arParams['~BASKET_URL'],
	'~ADD_URL_TEMPLATE'           =>$arResult['~ADD_URL_TEMPLATE'],
	'~BUY_URL_TEMPLATE'           =>$arResult['~BUY_URL_TEMPLATE'],
	'~COMPARE_URL_TEMPLATE'       =>$arResult['~COMPARE_URL_TEMPLATE'],
	'~COMPARE_DELETE_URL_TEMPLATE'=>$arResult['~COMPARE_DELETE_URL_TEMPLATE'],
	'TEMPLATE_THEME'              =>$arParams['TEMPLATE_THEME'],
	'USE_ENHANCED_ECOMMERCE'      =>$arParams['USE_ENHANCED_ECOMMERCE'],
	'DATA_LAYER_NAME'             =>$arParams['DATA_LAYER_NAME'],
	'BRAND_PROPERTY'              =>$arParams['BRAND_PROPERTY'],
	'MESS_BTN_BUY'                =>$arParams['~MESS_BTN_BUY'],
	'MESS_BTN_DETAIL'             =>$arParams['~MESS_BTN_DETAIL'],
	'MESS_BTN_COMPARE'            =>$arParams['~MESS_BTN_COMPARE'],
	'MESS_BTN_SUBSCRIBE'          =>$arParams['~MESS_BTN_SUBSCRIBE'],
	'MESS_BTN_ADD_TO_BASKET'      =>$arParams['~MESS_BTN_ADD_TO_BASKET'],
	'MESS_NOT_AVAILABLE'          =>$arParams['~MESS_NOT_AVAILABLE']
];
$obName='ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName='container-'.$navParams['NavNum'];
if($showTopPager){
	?>
	<div data-pagination-num="<?=$navParams['NavNum']?>">
		<!-- pagination-container -->
		<?=$arResult['NAV_STRING']?>
		<!-- pagination-container -->
	</div>
<?}?>

<?
$arFilter=['IBLOCK_ID'=>'24', "CODE"=>$_REQUEST["SECTION_CODE"]];
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
			<h2 class="section-title serviceit-price__title  ">Услуги и цены</h2>
		</div>
		<div class="row serviceit-price__row">
			<div class="serviceit-price__item serviceit-price__item--left">
				<div class="serviceit-price__item--top row-center">
					<div class="line line-green serviceit-line"></div>
					<div class="services-prices__text">
						<p class="page-desc">
							Если у Вас появились вопросы, наш специалист вам обязательно
<!-- 							<a href="#order-call" data-fancybox="" data-src="#order-call">поможет
								<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M12.9 16.2571H16C17.7526 16.2571 18.9 14.59 18.9 12.9286V4.42857C18.9 2.76716 17.7526 1.1 16 1.1H4C2.24611 1.1 1.1 2.76747 1.1 4.42857V12.9286C1.1 14.5897 2.24611 16.2571 4 16.2571H7.65159L11.394 19.6654L12.9 21.0369V19V16.2571Z" stroke="#75A72D" stroke-width="1.8"/>
								</svg>
							</a> -->
							<a href="tel:+7 (3519) 581-111">поможет
								<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M12.9 16.2571H16C17.7526 16.2571 18.9 14.59 18.9 12.9286V4.42857C18.9 2.76716 17.7526 1.1 16 1.1H4C2.24611 1.1 1.1 2.76747 1.1 4.42857V12.9286C1.1 14.5897 2.24611 16.2571 4 16.2571H7.65159L11.394 19.6654L12.9 21.0369V19V16.2571Z" stroke="#75A72D" stroke-width="1.8"/>
								</svg>
							</a>
						</p>
					</div>
				</div>
				<?//console($arResult);?>
				<div data-entity="<?=$containerName?>">
					<?if(!empty($arResult['ITEMS']) && !empty($arResult['ITEM_ROWS'])){
						$areaIds=[];
						foreach($arResult['ITEMS'] as $item){
							$uniqueId=$item['ID'].'_'.md5($this->randString().$component->getAction());
							$areaIds[$item['ID']]=$this->GetEditAreaId($uniqueId);
							$this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
							$this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
						}?>
						<!-- items-container -->
						<?$key=0;
						$preSection='';
						foreach($arResult['ITEM_ROWS'] as $rowData){
							$rowItems=array_splice($arResult['ITEMS'], 0, $rowData['COUNT']);?>
							<div class="all-services" data-entity="items-row">
								<?foreach($rowItems as $item){?>
									<?$res=CIBlockSection::GetByID($item["~IBLOCK_SECTION_ID"]);
									if($ar_res=$res->GetNext()){
										if($preSection!=$ar_res['NAME']){?>
											<h3 class="services-prices__subtitle"><?=$ar_res['NAME']?></h3>
											<div class="line line-green-full"></div>
											<?$preSection=$ar_res['NAME'];
										}
									}
									//console($item);
									$APPLICATION->IncludeComponent('bitrix:catalog.item', '', [
											'RESULT'=>[
												'ITEM'                =>$item,
												'AREA_ID'             =>$areaIds[$item['ID']],
												'TYPE'                =>$rowData['TYPE'],
												'BIG_LABEL'           =>'N',
												'BIG_DISCOUNT_PERCENT'=>'N',
												'BIG_BUTTONS'         =>'Y',
												'SCALABLE'            =>'N'
											],
											'PARAMS'=>$generalParams+['SKU_PROPS'=>$arResult['SKU_PROPS'][$item['IBLOCK_ID']]]
										], $component, ['HIDE_ICONS'=>'Y']);?>
								<?}?>
							</div>
						<?}
						unset($generalParams, $rowItems);?>
						<!-- items-container -->
					<?}else{
						// load css for bigData/deferred load
						$APPLICATION->IncludeComponent('bitrix:catalog.item', '', [], $component, ['HIDE_ICONS'=>'Y']);
					}?>
				</div>
<!--				<div class="serviceit-price__subitem justify-content-end">-->
<!--					<div data-use="show-more---><?//=$navParams['NavNum']?><!--" class="btn btn-grey-tr btn-serviceit-price__show">Показать ещё</div>-->
<!--				</div>-->
			</div>
			<?$GLOBALS['arrFilter']=["PROPERTY_SECTION"=>$arResult["ID"]];
			$arrFilter = array('SECTION_ID'=>$arResult["ID"]);
			//prnt($GLOBALS['sectionID']);
			//prnt($arResult['ID']);
			?>
			<?$APPLICATION->IncludeComponent(																													// слайдер с докторами
				"bitrix:news.list", "doctor-slide", [
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
					"CACHE_TYPE"                     =>"N",
					"CHECK_DATES"                    =>"Y",
					"DETAIL_URL"                     =>"",
					"DISPLAY_BOTTOM_PAGER"           =>"Y",
					"DISPLAY_DATE"                   =>"Y",
					"DISPLAY_NAME"                   =>"Y",
					"DISPLAY_PICTURE"                =>"Y",
					"DISPLAY_PREVIEW_TEXT"           =>"Y",
					"DISPLAY_TOP_PAGER"              =>"N",
					"FIELD_CODE"                     =>[
						0=>"PREVIEW_PICTURE",
						1=>"DETAIL_TEXT",
						2=>"",
					],
					"FILTER_NAME"                    =>"arrFilter",
					"HIDE_LINK_WHEN_NO_DETAIL"       =>"N",
					"IBLOCK_ID"                      =>"25",
					"IBLOCK_TYPE"                    =>"mgn_doctor_service",
					"INCLUDE_IBLOCK_INTO_CHAIN"      =>"Y",
					"INCLUDE_SUBSECTIONS"            =>"Y",
					"MESSAGE_404"                    =>"",
					"NEWS_COUNT"                     =>"",
					"PAGER_BASE_LINK_ENABLE"         =>"N",
					"PAGER_DESC_NUMBERING"           =>"N",
					"PAGER_DESC_NUMBERING_CACHE_TIME"=>"36000",
					"PAGER_SHOW_ALL"                 =>"N",
					"PAGER_SHOW_ALWAYS"              =>"N",
					"PAGER_TEMPLATE"                 =>".default",
					"PAGER_TITLE"                    =>"Новости",
					"PARENT_SECTION"                 =>"",
					"PARENT_SECTION_CODE"            =>$arResult["CODE"],
					"PREVIEW_TRUNCATE_LEN"           =>"",
					"PROPERTY_CODE"                  =>[
						0=>"DATE",
						1=>"CLINIC",
						2=>"AGE",
						3=>"SPECIALIZATION",
						4=>"",
					],
					"SET_BROWSER_TITLE"              =>"Y",
					"SET_LAST_MODIFIED"              =>"N",
					"SET_META_DESCRIPTION"           =>"Y",
					"SET_META_KEYWORDS"              =>"Y",
					"SET_STATUS_404"                 =>"N",
					"SET_TITLE"                      =>"Y",
					"SHOW_404"                       =>"N",
					"SORT_BY1"                       =>"ACTIVE_FROM",
					"SORT_BY2"                       =>"SORT",
					"SORT_ORDER1"                    =>"DESC",
					"SORT_ORDER2"                    =>"ASC",
					"STRICT_SECTION_CHECK"           =>"N",
					"COMPONENT_TEMPLATE"             =>"doctor-slide"
				], false);?>
		</div>
	</div>
</section>

<!-- SERVICE ITEM DESCRIPTION  -->
<section class="serviceit-description mt-60">
	<div class="container">
		<?if(count($ar_result["UF_QUESTION"])){?>
			<div class="row">
				<h2 class="serviceit-description__title title-wborder"><?=$ar_result["NAME"]?></h2>
			</div>
		<?}?>
		<div class="row">
			<article class="arcticle servdesc__item serviceit__arcticle serviceit-arcticle">
				<div id="accordion" class="faq-acc page-faq__acc">
					<?foreach($ar_result["UF_QUESTION"] as $key=>$UFItems){?>
						<div class="card">
							<div class="card-header faq <? if($key==0) echo "card__item--active" ?>" id="heading<?=$key?>">
								<h5 class="mb-0">
									<button class="btn btn-faq  " data-toggle="collapse" data-target="#collapse<?=$key?>" aria-expanded="false" aria-controls="collapse<?=$key?>">
										<?=$UFItems?>
										<span class="faq-figure">
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
			<!-- 	<div class="serviceit__form green-form contacts-form">
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
				</div> -->
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
						"PAGER_TITLE"                    =>"Новости",
						"PARENT_SECTION"                 =>"",
						"PARENT_SECTION_CODE"            =>"",
						"PREVIEW_TRUNCATE_LEN"           =>"",
						"PROPERTY_CODE"                  =>["", ""],
						"SET_BROWSER_TITLE"              =>"Y",
						"SET_LAST_MODIFIED"              =>"N",
						"SET_META_DESCRIPTION"           =>"Y",
						"SET_META_KEYWORDS"              =>"Y",
						"SET_STATUS_404"                 =>"N",
						"SET_TITLE"                      =>"Y",
						"SHOW_404"                       =>"N",
						"SORT_BY1"                       =>"ACTIVE_FROM",
						"SORT_BY2"                       =>"SORT",
						"SORT_ORDER1"                    =>"DESC",
						"SORT_ORDER2"                    =>"ASC",
						"STRICT_SECTION_CHECK"           =>"N"
					]);?>
			</aside>
		</div>
	</div>
</section>
<!-- SERVICE ITEM DESCRIPTION END -->

<?if($showBottomPager){?>
	<div data-pagination-num="<?=$navParams['NavNum']?>">
		<!-- pagination-container -->
		<?=$arResult['NAV_STRING']?>
		<!-- pagination-container -->
	</div>
<?}
$signer=new \Bitrix\Main\Security\Sign\Signer;
$signedTemplate=$signer->sign($templateName, 'catalog.section');
$signedParams=$signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.section');
?>
<script>
	BX.message({
		BTN_MESSAGE_BASKET_REDIRECT:'<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
		BASKET_URL:'<?= $arParams['BASKET_URL'] ?>',
		ADD_TO_BASKET_OK:'<?= GetMessageJS('ADD_TO_BASKET_OK') ?>',
		TITLE_ERROR:'<?= GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
		TITLE_BASKET_PROPS:'<?= GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
		TITLE_SUCCESSFUL:'<?= GetMessageJS('ADD_TO_BASKET_OK') ?>',
		BASKET_UNKNOWN_ERROR:'<?= GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
		BTN_MESSAGE_SEND_PROPS:'<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS') ?>',
		BTN_MESSAGE_CLOSE:'<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>',
		BTN_MESSAGE_CLOSE_POPUP:'<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP') ?>',
		COMPARE_MESSAGE_OK:'<?= GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK') ?>',
		COMPARE_UNKNOWN_ERROR:'<?= GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
		COMPARE_TITLE:'<?= GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE') ?>',
		PRICE_TOTAL_PREFIX:'<?= GetMessageJS('CT_BCS_CATALOG_PRICE_TOTAL_PREFIX') ?>',
		RELATIVE_QUANTITY_MANY:'<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY']) ?>',
		RELATIVE_QUANTITY_FEW:'<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW']) ?>',
		BTN_MESSAGE_COMPARE_REDIRECT:'<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
		BTN_MESSAGE_LAZY_LOAD:'<?= CUtil::JSEscape($arParams['MESS_BTN_LAZY_LOAD']) ?>',
		BTN_MESSAGE_LAZY_LOAD_WAITER:'<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_LAZY_LOAD_WAITER') ?>',
		SITE_ID:'<?= CUtil::JSEscape($component->getSiteId()) ?>'
	});
	var <?= $obName ?> =new JCCatalogSectionComponent({
		siteId:'<?= CUtil::JSEscape($component->getSiteId()) ?>',
		componentPath:'<?= CUtil::JSEscape($componentPath) ?>',
		navParams:<?= CUtil::PhpToJSObject($navParams) ?>,
		deferredLoad:false, // enable it for deferred load
		initiallyShowHeader:'<?= !empty($arResult['ITEM_ROWS']) ?>',
		bigData:<?= CUtil::PhpToJSObject($arResult['BIG_DATA']) ?>,
		lazyLoad:!!'<?= $showLazyLoad ?>',
		loadOnScroll:!!'<?= ($arParams['LOAD_ON_SCROLL']==='Y') ?>',
		template:'<?= CUtil::JSEscape($signedTemplate) ?>',
		ajaxId:'<?= CUtil::JSEscape($arParams['AJAX_ID']) ?>',
		parameters:'<?= CUtil::JSEscape($signedParams) ?>',
		container:'<?= $containerName ?>'
	});
</script>
<!-- component-end -->