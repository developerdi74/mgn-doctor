<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $templateData
 * @var string $templateFolder
 * @var CatalogSectionComponent $component
 */
/*
global $APPLICATION;

if (isset($templateData['TEMPLATE_THEME']))
{
	$APPLICATION->SetAdditionalCSS($templateFolder.'/themes/'.$templateData['TEMPLATE_THEME'].'/style.css');
	$APPLICATION->SetAdditionalCSS('/bitrix/css/main/themes/'.$templateData['TEMPLATE_THEME'].'/style.css', true);
}

if (!empty($templateData['TEMPLATE_LIBRARY']))
{
	$loadCurrency = false;
	if (!empty($templateData['CURRENCIES']))
	{
		$loadCurrency = \Bitrix\Main\Loader::includeModule('currency');
	}

	CJSCore::Init($templateData['TEMPLATE_LIBRARY']);

	if ($loadCurrency)
	{
		?>
		<script>
			BX.Currency.setCurrencies(<?=$templateData['CURRENCIES']?>);
		</script>
		<?
	}
}

//	lazy load and big data json answers
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
if ($request->isAjaxRequest() && ($request->get('action') === 'showMore' || $request->get('action') === 'deferredLoad'))
{
	$content = ob_get_contents();
	ob_end_clean();

	list(, $itemsContainer) = explode('<!-- items-container -->', $content);
	list(, $paginationContainer) = explode('<!-- pagination-container -->', $content);
	list(, $epilogue) = explode('<!-- component-end -->', $content);

	if ($arParams['AJAX_MODE'] === 'Y')
	{
		$component->prepareLinks($paginationContainer);
	}

	$component::sendJsonAnswer(array(
		'items' => $itemsContainer,
		'pagination' => $paginationContainer,
		'epilogue' => $epilogue,
	));
}*/
//Получение SEO раздела
$rsSections = CIBlockSection::GetList(array(),array('IBLOCK_ID' => 25, '=CODE' => $arParams['SECT_CODE_PARAM']), false, Array("UF_DETI"));
if ($arSection = $rsSections->Fetch()){
    $sec_id = $arSection["ID"];
    $title_detskii=$arSection['UF_DETI'];
}

$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(25,$sec_id);
$IPROPERTY  = $ipropValues->getValues();
if(empty($IPROPERTY['SECTION_PAGE_TITLE'])){
    $header = $arSection["NAME"];
}else {
    $header =  $IPROPERTY['SECTION_PAGE_TITLE'];
}
//-----------------------------------------------------------------------------
//Проверка на какой мы странице если детская то установить детский заголовок
$uri = "/specialists";
$section_code = explode("/",$_SERVER['REQUEST_URI']);
$title = $IPROPERTY['SECTION_META_TITLE'];
if($title_detskii && $section_code[1] == 'detskie-vrachi'){
    $header = $title_detskii;
    $title = $title_detskii." в Магнитогорске | Семейный доктор";
}
//-----------------------------------------------------------------------------
$APPLICATION->SetPageProperty("title", $title);
$APPLICATION->SetPageProperty("description",$IPROPERTY['SECTION_META_DESCRIPTION']);
$APPLICATION->SetPageProperty("keywords", $IPROPERTY['SECTION_META_KEYWORDS']);
