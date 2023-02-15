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
//\Bitrix\Main\UI\Extension::load("ui.vue");
//\Bitrix\Main\UI\Extension::load("ui.vue.directives.lazyload");
$this->setFrameMode(true);
?>

<div class="tab-content news-tab-content">
	<div class="tab-pane fade show active  " id="news-item-1">
		<div class="tab-news-wrapper">
			<div class="row row-all-news" id="portfolio_loader">
				<?foreach($arResult["ITEMS"] as $arItem){?>
					<?//$renderImg=CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], ["width"=>50, "height"=>50], BX_RESIZE_IMAGE_PROPORTIONAL, false);?>
					<?if($arItem["DISPLAY_PROPERTIES"]["VIDEO"]["VALUE"]==""){?>
						<div class="col-md-3 item-news all-news__item allnews-item">
							<div class="item-news__img allnews-item__img">
								<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"];?>" alt="" width="765" height="574">
							</div>
							<div class="item-news__content allnews-item__content">
								<h4 class="item-news__title allnews-item__title"><?=$arItem["NAME"]?></h4>
								<div class="line line-lred"></div>
								<div class="item-news__text allnews-item__text"><?=$arItem["PREVIEW_TEXT"]?></div>
								<div class="item-news__more">
									<div class="date item-news__date allnews-item__date">
										<?=$arItem["DISPLAY_ACTIVE_FROM"]?>
									</div>
								</div>
								<a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="allnews-item__link"></a>
							</div>
						</div>
					<?}else{?>
						<div class="col-md-3 item-news all-news__item allnews-item allnews-item__video ">
							<div class="item-news__img allnews-item__img item__video" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"];?>); ">
								<a class="various fancybox  fancybox-video item__video--frame" href="<?=$arItem["DISPLAY_PROPERTIES"]["VIDEO"]["VALUE"];?>">
									<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"];?>" alt="">
								</a>
							</div>
							<div class="item-news__content allnews-item__content">
								<h4 class="item-news__title allnews-item__title"><?=$arItem["NAME"]?></h4>
							</div>
						</div>
					<?}?>
				<?}?>
			</div>
		</div>
	</div>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]){?>
		<?=$arResult["NAV_STRING"]?>
	<?}?>
</div>
