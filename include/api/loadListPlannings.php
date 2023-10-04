<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$reset = 0;
echo (dataCache('cacheSpecialists-'.$_GET['cache_code'], function (){
    return json_encode(getPlannings($_GET));
}, 12*60*60, 'sectionListDocs', $reset));

return;

?>