<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

<section class="main-slider">
	<div class="container-full">
		<div class="row main-slider__row">

			<div class="container  main-slider-container__nav">
				<div class="slider__nav navigation main-slider__nav">
					<div class="slider__nav-prev"><img src="<?= SITE_TEMPLATE_PATH ?>/img/arrow-prev.svg" alt="prev"></div>
					<div class="slider__nav-next"><img src="<?= SITE_TEMPLATE_PATH ?>/img/arrow-next.svg" alt="next"></div>
				</div>
			</div>

			<div class="owl-carousel owl-theme main-slider__owl" id="main-slider">
				<? foreach ($arResult["ITEMS"] as $arItem) : ?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
<?php
   $src = "SRC";
   $src2 = "SRC";
   $webp = false;
if( strpos( $_SERVER['HTTP_ACCEPT'], 'image/webp' )!== false || strpos( $_SERVER['HTTP_USER_AGENT'], ' Chrome/' )!== false ) {
   $webp = true;}
   if($arItem["PREVIEW_PICTURE"]["SRC_WEBP"] && $webp == true){
   	$src = "SRC_WEBP";
   }
   if($arItem["DETAIL_PICTURE"]["SRC_WEBP"] && $webp == true){
   	$src2 = "SRC_WEBP";
   }
   //prnt($arItem["PREVIEW_PICTURE"]);
?>
					<div class="item" style="background-image:url('<?=$arItem["PREVIEW_PICTURE"][$src] ?>');">
						<div class="main-slider__item--mobile" style="background-image:url('<?= $arItem["DETAIL_PICTURE"][$src2] ?>');">
							<div class="owl-text-overlay">
								<div class="main-slider__inner">
									<h2 class="main-slider__title title-slider">
										<? if ($arItem["DISPLAY_PROPERTIES"]["TITLE"]['DISPLAY_VALUE'] == "") : ?>
											<?= $arItem['NAME'] ?>
										<? else : ?>
											<?= $arItem["DISPLAY_PROPERTIES"]["TITLE"]['DISPLAY_VALUE']; ?>
										<? endif; ?>
									</h2>
									<p class="main-slider__text"><? echo $arItem["PREVIEW_TEXT"]; ?></p>
									<a href="<?= $arItem['PROPERTIES']['URL']['VALUE'] ?>" class="btn btn-green  main-slider__btn">Подробнее</a>
								</div>
							</div>
						</div>
					</div>
				<? endforeach; ?>
			</div>

		</div>
	</div>
</section>