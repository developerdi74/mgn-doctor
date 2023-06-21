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






<div class="container">
  <div class="row justify-content-between row-vmiddle your-questions__top">
    <h2 class="section-title popular-services__title">ВАШИ ВОПРОСЫ</h2>
    <div class="your-questions__right your-questions__right--desktop">
      <a href="#ask-question-modal" data-fancybox="" data-src="#ask-question-modal" class="btn btn-grey-tr btn-ask-question">Задать вопрос</a>
      <div class="slider__nav your-questions__nav popular-services__nav navigation">
        <div class="slider__nav-prev"><img src="<?= SITE_TEMPLATE_PATH ?>/img/arrow-prev.svg" height = "20" width = "11" alt="prev"></div>
        <div class="slider__nav-next"><img src="<?= SITE_TEMPLATE_PATH ?>/img/arrow-next.svg" height = "20" width = "11"  alt="next"></div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="owl-carousel owl-theme popular-services__owl" id="popular-services__owl">

      <? foreach ($arResult["ITEMS"] as $arItem) : ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

        $arItem["DISPLAY_PROPERTIES"]["TITLE"]['DISPLAY_VALUE'];
        ?>

        <div class="item popular-services__item">
          <div class="services__item services-item">
            <?if($arItem['PREVIEW_PICTURE']['SRC']):?>
            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt=""  >
            <?endif;?>
          </div>
          <h4 class="services-item__title"><?= $arItem['NAME'] ?></h4>
          <div class="line line-lred"></div>
          <div class="services-item__text">
            <p><?= $arItem['PREVIEW_TEXT'] ?></p>
            <a href="<?=$arItem["DETAIL_PAGE_URL"] ?>" class="btn btn-lred btn-read-more">Читать</a>
          </div>
        </div>

      <? endforeach; ?>



    </div>
  </div>
	
	<?if($_SESSION['isMobile']===true){?>
		<div class="row mobile-row">
			<div class="your-questions__right your-questions__right--mobile">
				<a href="#ask-question-modal" data-fancybox="" data-src="#ask-question-modal" class="btn btn-grey-tr btn-ask-question">Задать вопрос</a>
				<div class="slider__nav your-questions__nav popular-services__nav navigation">
					<div class="slider__nav-prev"><img src="<?=SITE_TEMPLATE_PATH?>/img/arrow-prev.svg" height = "11" width = "20" alt="prev"></div>
					<div class="slider__nav-next"><img src="<?=SITE_TEMPLATE_PATH?>/img/arrow-next.svg" height = "11" width = "20" alt="next"></div>
				</div>
			</div>
		</div>
	<?}?>
	
</div>