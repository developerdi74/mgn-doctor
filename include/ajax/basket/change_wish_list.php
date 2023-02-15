<?php
define('NO_KEEP_STATISTIC', true);
define('NO_AGENT_CHECK', true);

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


$context = \Bitrix\Main\Context::getCurrent();
$request = $context->getRequest();

$itemId = intval($request->get("id"));
$result = false;
if(isset($_SESSION['WISH_LIST'][$itemId]))
{
    unset($_SESSION['WISH_LIST'][$itemId]);
    $result = true;
}

//require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
echo \Bitrix\Main\Web\Json::encode($result);
CMain::finalActions();
die;
