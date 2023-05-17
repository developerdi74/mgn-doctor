<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="container">
	<div class="row">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="col-sm-12 col-md-6 col-lg-4 p-0" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="rew-box mr-2 mb-2">
			<h5 class='text-center'>Карта отзыва №<?=$arItem["ID"];?></h2>
			<div class=''>Дата отзыва: <b><?=date("d-M-Y H:i:s", strtotime($arItem['DATE_CREATE']));?></b></div>	
			<div class=''>Номер телефона клиента: <a href="tel:<?echo $arItem["NAME"]?>"><b><?echo $arItem["NAME"]?></b></a></div>
			<div class=''>Вопрос клиента: <b><?=($arItem["PREVIEW_TEXT"])? $arItem["PREVIEW_TEXT"] : "Пусто";?></b></div>
			<?//prnt($arItem["DISPLAY_PROPERTIES"]['SERVICE'])?>
			<div class=''>Оценки:</div>
			<div class=''> - <?=$arItem["DISPLAY_PROPERTIES"]['SERVICE']["NAME"]?> - <b><?=$arItem["DISPLAY_PROPERTIES"]['SERVICE']["DISPLAY_VALUE"]?></b>/5;</div>
			<div class=''> - <?=$arItem["DISPLAY_PROPERTIES"]['DOC']["NAME"]?> - <b><?=$arItem["DISPLAY_PROPERTIES"]['DOC']["DISPLAY_VALUE"]?></b>/5;</div>
			<div class=''> - <?=$arItem["DISPLAY_PROPERTIES"]['ALL']["NAME"]?> - <b><?=$arItem["DISPLAY_PROPERTIES"]['ALL']["DISPLAY_VALUE"]?></b>/5;</div>			
			<div class=''>Метка: <b><?=($arItem["DETAIL_TEXT"])? $arItem["DETAIL_TEXT"] : "Без метки";?></b></div>
		</div>
	</div>
<?endforeach;?>
	<div class='col-12 mb-2'>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?>
		<?endif;?>
	</div>
</div>
</div>
