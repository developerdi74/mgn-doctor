<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$medecins_id = $_GET['medecins_id'];

$days = getPlanning($medecins_id);?>
<? if(is_array($days['days'])):?>
    <div class="label_date_access">
        Ближайшие даты для записи:
    </div>
    <div class="d-inline-block mr-2 push_date">
    <?foreach ($days['days'] as $i=>$day):?>
        <div class="date_access_list"><?=$day['date_rec']?></div>
        <? if($i==2) echo "</div><div class='d-inline-block'>";?>
        <? if($i==5) break;?>
    <? endforeach;?>
<? endif; ?>
    </div>
