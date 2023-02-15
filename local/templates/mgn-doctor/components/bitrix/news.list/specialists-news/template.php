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


<div class="row justify-content-between   row-gallery-slider">
                  <h6 class="tab-gallery__title">Статьи</h6>
                  <div class="slider__nav gallery-slider__nav navigation">
                    <div class="slider__nav-prev"><img src="<?= SITE_TEMPLATE_PATH ?>/img/arrow-prev.svg" alt="prev"></div>
                    <div class="slider__nav-next"><img src="<?= SITE_TEMPLATE_PATH ?>/img/arrow-next.svg" alt="next"></div>
                  </div>
                </div>
                <div class="owl-carousel owl-theme tab-gallery__slider gallery-slider" id="tab-gallery__slider-3">

                <? foreach ($arResult["ITEMS"] as $arItem) : ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

        ?>
        
        <div class="item tab-gallery__item gallery-item item-news">
                    <div class="item-news__img">
                      <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="">
                    </div>
                    <div class="item-news__content">
                      <h4 class="item-news__title"><?= $arItem['NAME'] ?></h4>
                      <div class="line line-lred"></div>
                      <div class="item-news__text"><?= $arItem['PREVIEW_TEXT'] ?></div>
                      <div class="item-news__more">
                        <div class="date item-news__date">
                        <?= $arItem["DISPLAY_ACTIVE_FROM"] ?>
                        </div>
                      </div>
                    </div>
                    <a href="/single-news.html" class="item-news__link--hidden"></a>
                  </div>
                  <? endforeach; ?>
      
                  </div>
                  </div>
