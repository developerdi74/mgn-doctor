<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

//Получение SEO раздела
$rsSections = CIBlockSection::GetList(array(),array('IBLOCK_ID' => 25, '=CODE' => SECTION_CODE), false, Array("UF_DETI"));
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
//
		$uri = "/specialists";
		// $section_code = explode("/",$_SERVER['REQUEST_URI']);
		// $title = $IPROPERTY['SECTION_META_TITLE'];
		// if($title_detskii && $section_code[1] == 'detskie-vrachi'){
		// 	$header = $title_detskii;
		// 	$title = $title_detskii." | Семейный доктор в Магнитогорске";
		// }
		// if($section_code[1]=="detskie-vrachi"){
		// 	$uri = "/detskie-vrachi";
		// }else{
		// 	$uri = "/specialists";
		// }
//-----------------------------------------------------------------------------


	$APPLICATION->SetPageProperty("title", $title);
	$APPLICATION->SetPageProperty("description",$IPROPERTY['SECTION_META_DESCRIPTION']);
	$APPLICATION->SetPageProperty("keywords", $IPROPERTY['SECTION_META_KEYWORDS']);
	//prnt($IPROPERTY);
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
?>

<?
//-----------------------------------------------------------------------------

		 //Получаем цену первичного приема по ID услуги
		 //

		 foreach ($item['PROPERTIES']['SERVICE']['VALUE'] as $value) {
		 		$serv = CIBlockElement::GetList(Array(), array("IBLOCK_ID"=>24,"ID"=>$value), false, Array());
		 		$ob2 = $serv->GetNextElement();
		 		$arFields2 = $ob2->GetFields();
		 		$arProps2 = $ob2->GetProperties();
		 		//Сравнение разделов врача и его услуг
		 		if($arProps2['SPECIALIZATION']['VALUE'] == $sec_id){
			 		if(mb_stripos($arFields2['NAME'],"первичный")){
			 			$price = CPrice::GetBasePrice($arFields2['ID']);
			 			$min_price = $price['PRICE'];
			 		}
		 		}
		 }
		 $item['PROPERTIES']['ONE_PRIEM']['VALUE'] = round($min_price);

//-----------------------------------------------------------------------------
?>

	<?
	$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

		<div class='row_vr'  id="<?=$this->GetEditAreaId($item['ID']);?>">
			<div class="cnt_vr">
				<div class="img_vr">
					<a href = "<?=$uri?>/<?=$item['CODE']?>/"><img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt=""></a>
				</div>
				<div class="descrip_vr">
					<div class="name-vr"><h2><a href = "<?=$uri?>/<?=$item['CODE']?>/"><?=$item['NAME']?></a></h2></div>
					<div class="name-cherta-vr"></div>
					<div class="spec-vr"><? foreach($NAME_SPECIAL as $SPEC){ echo $SPEC;$chet++; if(count($NAME_SPECIAL)!=$chet) echo ", ";}?></div>
					<?if(!empty($item['PROPERTIES']['STAZH']['VALUE'])):?><div class="staz-vr">Стаж <?=$item['PROPERTIES']['STAZH']['VALUE']?></div><?endif;?>
					<?if(!empty($item['PROPERTIES']['CATEGORY']['VALUE'])):?><div class="category-vr"><?=$item['PROPERTIES']['CATEGORY']['VALUE']?></div><?endif;?>
					<?if(!empty($item['PROPERTIES']['ONE_PRIEM']['VALUE'])):?><div class="price_vr">Первичный прием <?=$item['PROPERTIES']['ONE_PRIEM']['VALUE']?> ₽</div><?endif;?>
				</div>
				<div class="save_vr">
						<a class = "save-btn-vr" href="<?=$uri?>/<?=$item['CODE']?>/">Записаться</a> <? // Формируется ссылка на детальную страницу специалистов?>
				</div>
			</div>
		</div>

	<?endforeach;?>
	</div>
<?

	//prnt($IPROPERTY);
?>