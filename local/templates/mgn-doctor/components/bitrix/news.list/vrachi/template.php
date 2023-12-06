<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

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

?>
	<div class="row">
		<h1 class="page-title specialists-inner__title all-our-specialists__title"><?=$header?></h1>
	</div>
	<div class='section_vrachi'>

		<!-- Сортировка сюда-->

	<?foreach($arResult['ITEMS'] as $item):?>
<?
		// получение свойств специализации
		$NAME_SPECIAL=null;
		$db_props = CIBlockElement::GetProperty($item['IBLOCK_ID'], $item['ID'], "sort", "asc", array("CODE" => "SPECIALIZATION"));
		while ($prop = $db_props->fetch()) {
			$XML_ID = $prop['VALUE'];
			if (CModule::IncludeModule('highloadblock')) {
				$arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(6)->fetch();
				$obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
				$strEntityDataClass = $obEntity->getDataClass();
				$resData = $strEntityDataClass::getList(array(
					'select' => array('ID', 'UF_NAME'),
					'filter' => array('UF_XML_ID' => $XML_ID),
					'order'  => array('ID' => 'ASC'),
					'limit'  => 100,
				));
				if ($arItem = $resData->Fetch()) {
					$NAME_SPECIAL[] = $arItem['UF_NAME'];
				}
			}
		 }
		 $chet = 0;

//-----------------------------------------------------------------------------

		 //Получаем цену первичного приема по ID услуги
		 //
if(empty($item['PROPERTIES']['ONE_PRIEM']['VALUE'])) {
    foreach ($item['PROPERTIES']['SERVICE']['VALUE'] as $value) {
        $serv = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 24, "ID" => $value), false, array());
        $ob2 = $serv->GetNextElement();
        $arFields2 = $ob2->GetFields();
        $arProps2 = $ob2->GetProperties();
        //Сравнение разделов врача и его услуг
        if ($arProps2['SPECIALIZATION']['VALUE'] == $sec_id) {
            if (mb_stripos($arFields2['NAME'], "первичный")) {
                $price = CPrice::GetBasePrice($arFields2['ID']);
                $min_price = $price['PRICE'];
            }
        }
    }
    $item['PROPERTIES']['ONE_PRIEM']['VALUE'] = round($min_price);
}
        $item['PROPERTIES']['ONE_PRIEM']['VALUE'] = str_replace("₽", "", $item['PROPERTIES']['ONE_PRIEM']['VALUE']);
//-----------------------------------------------------------------------------
?>
	<?
	$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

		<div class='row_vr'  id="<?=$this->GetEditAreaId($item['ID']);?>">
			<div class="cnt_vr">
				<div class="img_vr">
					<a href = "<?=$uri?>/<?=$item['CODE']?>/">
						<picture>
						   <?if($item["PREVIEW_PICTURE"]["SRC_AVIF"]):?>
						   		<source srcset="<?=$item["PREVIEW_PICTURE"]["SRC_AVIF"]?>" type="image/avif">
						   <?endif;?>
						   <?if($item["PREVIEW_PICTURE"]["SRC_WEBP"]):?>
						   		<source srcset="<?=$item["PREVIEW_PICTURE"]["SRC_WEBP"]?>" type="image/webp">
						   <?endif;?>
						   <img src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>" height = "<?=$item["PREVIEW_PICTURE"]["HEIGHT"]?>" width = "<?=$item["PREVIEW_PICTURE"]["WIDTH"]?>" alt="<?=$item["PREVIEW_PICTURE"]["ALT"]?>">
						</picture>
					</a>
				</div>
				<div class="descrip_vr">
                    <?
                    $medecins_id=NULL;
                    if($item['PROPERTIES']['ONLINE_PLANNING']['VALUE'] != 0):
                        if(empty($item['PROPERTIES']['MEDIALOG_ID']['VALUE'])){
                            $explodeName = explode(' ',$item['NAME']);
                            $medecins_id = getMedecinsID($explodeName[0], $explodeName[1],$explodeName[2], $item['ID']);
                        }else{
                            $medecins_id = $item['PROPERTIES']['MEDIALOG_ID']['VALUE'];
                        }
                        $medIDs[] = $medecins_id;
                    endif;
                    ?>
					<div class="name-vr"><h2><a href = "<?=$uri?>/<?=$item['CODE']?>/"><?=$item['NAME']?></a></h2></div>
					<div class="name-cherta-vr"></div>
					<div class="spec-vr"><? foreach($NAME_SPECIAL as $SPEC){ echo $SPEC;$chet++; if(count($NAME_SPECIAL)!=$chet) echo ", ";}?></div>
					<?if(!empty($item['PROPERTIES']['STAZH']['VALUE'])):?><div class="staz-vr">Стаж <?=$item['PROPERTIES']['STAZH']['VALUE']?></div><?endif;?>
					<?if(!empty($item['PROPERTIES']['CATEGORY']['VALUE'])):?><div class="category-vr"><?=$item['PROPERTIES']['CATEGORY']['VALUE']?></div><?endif;?>
					<?if(!empty($item['PROPERTIES']['ONE_PRIEM']['VALUE'])):?><div class="price_vr">Первичный прием <?=$item['PROPERTIES']['ONE_PRIEM']['VALUE']?> ₽</div><?endif;?>
                        <div class="access-date mt-2 position-relative" medecins-id="<?=$medecins_id?>">
                            <?if($item['PROPERTIES']['ONLINE_PLANNING']['VALUE'] != 0):?>
                                <div class="cnt_loader"><div class="loader_mini" style=""></div></div>
                            <?else:?>
                                <div class='label_date_access'> Запись по телефону.</div>
                                <div class='list_phone'><a href='tel:73519581111' class=''>+7(3519) 581-111</a></div>
                            <?endif;?>
                        </div>
				</div>
				<div class="save_vr">
					<div class='rating static_rating'>
						<?if($item['RAITING']>1):?>
						<div class='rating'>
								<div class="star_rew">
									<? 	$star = floor($item['RAITING']);
												$half=0;
										if(($item['RAITING']-$star)<=0.5 && ($item['RAITING']-$star)!=0){
												$half=1;
										}else{
											 if(($item['RAITING']-$star)!=0){
													$star++;
											 }
										}
									?>
									<label class='text-right mr-5'> Рейтинг врача: <b><?=$item['RAITING']?>/5</b>
										<div class='text-right'>
											<? for($i=1; $i<=5; $i++):?>
											<span class='mr-0 d-inline-block star <?
											if($i<=$star){
												echo "starfull";
											}elseif($half==1){
												echo "starhalf"; $half=0; 
											}?>' value = <?=$i?>>
											</span>
											<?endfor;?>
										</div>
									</label>
								</div>
						</div>
						<?endif;?>
					</div>
						<a class = "save-btn-vr" href="<?=$uri?>/<?=$item['CODE']?>/">Записаться</a> <? // Формируется ссылка на детальную страницу специалистов?>
				</div>
			</div>
		</div>
	<?endforeach;?>
	</div>
<?=$arResult["NAV_STRING"]?>
<?php
$section_url=explode('/', $_SERVER['REQUEST_URI'])[2];
if($_GET['PAGEN_1']){
    $section_url=$section_url.'_'.$_GET['PAGEN_1'];
}
?>
<script async>
    $(window).on('load', function (){
        $.ajax({
            url: '/include/api/loadListPlannings.php',
            method: 'get',
            dataType: 'json',
            async: true,
            data: {medecins_ids: <?=json_encode($medIDs)?>,
                    cache_code: "<?=$section_url?>"},
            success: function(data){
                if(data == false){
                    $('.access-date .cnt_loader').hide();
                }
                $.each(data, function (key, value){
                    if($('[medecins-id = "'+key+'"]').length){

                        html = "<div class='label_date_access'>Ближайшие даты для записи: </div>";
                        html += "<div class='d-inline-block mr-2 push_date align-top'>";
                        var days = value.days;
                        if(days){
                        days.forEach( function (day,index){
                            if(index<6){
                                if(index == 3){
                                    html += "</div><div class='d-inline-block align-top'>";
                                }
                                html += "<div class='date_access_list'>"+day.format_date+"</div>";
                            }
                        });
                        html += "</div>";
                        }else{
                            html = "<div class='label_date_access'>В ближайшие 3 недели свободных дат нет</div>";
                        }
                        $('[medecins-id = "'+key+'"]').html(html);
                        $('.access-date .cnt_loader').hide();

                    }
                });
                $('[medecins-id]').each(function (){
                    if($(this).find('.cnt_loader').length){
                        $(this).html("<div class='label_date_access'>В ближайшие 3 недели свободных дат нет</div>");
                    }
                });
            }
        });
    });
</script>
