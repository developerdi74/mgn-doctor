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
<div class="review">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="review__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">


		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<h2 class="review__title"><?echo $arItem["NAME"]?></h2>
			<?else:?>
				<h2 class="review__title"><?echo $arItem["NAME"]?><h2>
			<?endif;?>
		<?endif;?>

		<span class="review__date">Отзыв от <?echo date("d.m.Y", strtotime($arItem["DATE_CREATE"]) ) ;?> </span>

		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<div class="review__text"><?echo $arItem["PREVIEW_TEXT"];?></div>
		<?endif;?>

		<div class="review__flex"> 
			<div class="review__clinic">Клиника: <span><?=$arItem["DISPLAY_PROPERTIES"]["CLINIC"]["VALUE"]?></span> </div>
			<div>Лечащий врач: <span><?=$arItem["DISPLAY_PROPERTIES"]["SPECIALIST"]["DISPLAY_VALUE"]?></span> </div>
		</div>

			
		<?if($arItem["DETAIL_TEXT"]):?>
			<div class="review__text-answer">
				<div class="review__img-box">
					<div class="review__img"></div>
					<div class="review__img-caption">Служба заботы о пациетах</div>
				</div>
				<div>
					<div class="review__caaption">Ответ клиники</div>
					<div class="review__text"><?echo $arItem["DETAIL_TEXT"];?></div>
				</div>
			</div>
		<?endif;?>
 
	</div>
<?endforeach;?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
