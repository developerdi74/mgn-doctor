<?
$bAjaxMode = ($_REQUEST['is_ajax_mode'] == 'y') ? true : false;
if ($bAjaxMode)
{
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
}

$APPLICATION->IncludeComponent("nextype:magnet.catalog.delivery","main",Array(
    "PRODUCT_ID" => intval($_REQUEST['id']),
    "QUANTITY" => intval($_REQUEST['qty']) > 1 ? intval($_REQUEST['qty']) : 1,
    "INCLUDE_BASKET" => $_REQUEST['include_basket'] == 'y' ? 'Y' : 'N',
    "LOCATION" => intval($_REQUEST['location']) > 0 ? intval($_REQUEST['location']) : false,
    "LOCATION_CODE" => (string)$_REQUEST['loc_code'],
    "RETURN_PRICE_FROM" => $_REQUEST['return_price'] == 'y' ? 'Y' : 'N'
));

if ($bAjaxMode)
{
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
}