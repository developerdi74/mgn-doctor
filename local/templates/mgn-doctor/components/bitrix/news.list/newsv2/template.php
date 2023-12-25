<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(true);?>

<div class="some-news__nav owl-slider-news owl-carousel owl-theme">
	<?foreach($arResult["ITEMS"] as $arItem){?>
		<div class="">
			<div class="item-news">
				<div class="item-news__img">
					<picture>
					     <?if($arItem["PREVIEW_PICTURE"]["SRC_AVIF"]):?>
					        <source srcset="<?=$arItem["PREVIEW_PICTURE"]["SRC_AVIF"]?>" type="image/avif">
					     <?endif;?>
					     <?if($arItem["PREVIEW_PICTURE"]["SRC_WEBP"]):?>
					        <source srcset="<?=$arItem["PREVIEW_PICTURE"]["SRC_WEBP"]?>" type="image/webp">
					     <?endif;?>
					        <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" loading="lazy" height = "<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" width = "<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
					</picture>
				</div>
				<div class="item-news__content">
					<h4 class="item-news__title"><?=$arItem['NAME']?></h4>
					<div class="line line-lred line-green"></div>
					<div class="item-news__text">
						<?=$arItem['PREVIEW_TEXT']?>
					</div>
				</div>
                <div class="item-news__more">
                    <div class="date item-news__date">
                        <?=$arItem["DISPLAY_ACTIVE_FROM"]?>
                    </div>
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="btn btn-grey-tr item-news__btn">Подробнее</a>
                </div>
			</div>
		</div>
	<?}?>
</div>







