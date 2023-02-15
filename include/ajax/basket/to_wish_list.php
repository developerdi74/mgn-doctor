<?php



require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$context = \Bitrix\Main\Context::getCurrent();
$request = $context->getRequest();

$itemId = intval($request->get("id"));
$bOnlySession = ($request->get("onlysession") == "Y");
$bInBasket = ($request->get("inbasket") == "Y");

if ($bOnlySession && $itemId)
{
    if (isset($_SESSION['WISH_LIST'][$itemId]))
        unset($_SESSION['WISH_LIST'][$itemId]);
    else
        $_SESSION['WISH_LIST'][$itemId] = array();
    die;
}

if(!\Bitrix\Main\Loader::includeModule("sale"))
    die('No install modules');

if ($itemId > 0)
{
    $arResult = Array (
        'STATUS' => 'ERROR',
        'MESSAGE' => 'Empty data'
    );
    $arBasketItem = \Bitrix\Sale\Internals\BasketTable::getList(array(
        "filter" => array(
            "FUSER_ID" => \Bitrix\Sale\Fuser::getId(),
            "ORDER_ID" => null,
            "LID" => $context->getSite(),
            "PRODUCT_ID" => $itemId
        ),
        "select" => array(
            "ID", "PRODUCT_ID", "DELAY", "SUBSCRIBE"
        ),
        "limit" => 1
    ))->fetch();
    if($arBasketItem && $arBasketItem["DELAY"] == "N" && !$bInBasket)
    {
        \Bitrix\Sale\Internals\BasketTable::update($arBasketItem["ID"], array("DELAY" => "Y"));
        $_SESSION['WISH_LIST'][$itemId] = $arBasketItem;
        $arResult = array('STATUS' => 'ADD_1');
    }
    elseif($arBasketItem && $arBasketItem["DELAY"] == "Y")
    {
        \Bitrix\Sale\Internals\BasketTable::delete($arBasketItem["ID"]);
        unset($_SESSION['WISH_LIST'][$itemId]);
        $arResult = array('STATUS' => 'REMOVE');
    }
    elseif($bInBasket)
    {
        unset($_SESSION['WISH_LIST'][$itemId]);
    }
    else
    {
        // no product in basket
        $id = Add2BasketByProductID($itemId, 1);
        if(empty($id))
        {
            if ($exError = $APPLICATION->GetException())
                $arResult = Array ('STATUS' => 'ERROR', 'MESSAGE' => $exError->GetString());
        }
        else
        {
            if (!$bInBasket)
                \Bitrix\Sale\Internals\BasketTable::update($id, array("DELAY" => "Y"));
            $_SESSION['WISH_LIST'][$itemId] = Array();
            $arResult = Array ('STATUS' => 'ADD_2');
        }
    }
    
    echo \Bitrix\Main\Web\Json::encode($arResult);
    CMain::FinalActions();
    die();
    
}

