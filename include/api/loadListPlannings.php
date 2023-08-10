<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

use \Bitrix\Main\Data\Cache;

$cache = Cache::createInstance(); // Служба кеширования

$cachePath = 'sectionListDocs'; // папка, в которой лежит кеш
$cacheTtl = 2*60*60; // срок годности кеша (в секундах)
$cacheKey = 'cacheSpecialists-'.$_GET['cache_code']; // имя кеша

if ($cache->initCache($cacheTtl, $cacheKey, $cachePath))
{
    $vars = $cache->getVars(); // Получаем переменные
    $cache->output(); // Выводим HTML пользователю в браузер
}
elseif ($cache->startDataCache())
{
    $vars = json_encode(getPlannings($_GET));
    // Если что-то пошло не так и решили кеш не записывать
    $cacheInvalid = false;
    if ($cacheInvalid or empty($vars))
    {
        $cache->abortDataCache();
    }
    // Всё хорошо, записываем кеш
    $cache->endDataCache($vars);
}

// Данные будут обновляться раз в час
//print_r($vars);
echo $vars;
return;
/*
echo json_encode(getPlannings($_GET));
*/

?>