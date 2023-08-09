<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');


use \Bitrix\Main\Data\Cache;

$cache = Cache::createInstance(); // Служба кеширования

$cachePath = 'sectionListDocs'; // папка, в которой лежит кеш
$cacheTtl = 2*60*60; // срок годности кеша (в секундах)
$cacheKey = 'cacheSpecialists-'.$_GET['cache_code'];  // имя кеша

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
    if ($cacheInvalid)
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

function getPlannings($medecins_ids){
    $get = http_build_query($medecins_ids);
    if( $curl = curl_init() ) {
        curl_setopt($curl, CURLOPT_URL, 'http://109.195.215.58/api/v1/plannings/?'.$get);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_PORT, '9595');
        $out = curl_exec($curl);
        $result = json_decode($out, true); // вывод результата

        if(curl_error($curl)) { // если возникла ошибка
            echo( 'error='.curl_error($curl));
        }
        curl_close($curl);
        if($result){
            return $result;
        }else{
            return false;
        }
    }
}*/
?>