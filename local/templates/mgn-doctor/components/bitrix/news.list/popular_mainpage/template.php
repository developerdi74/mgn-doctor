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
?><?
//prnt($arResult["ITEMS"]);?>
  <div class="row justify-content-between row-vmiddle">
      <h2 class="section-title main-directions__title">Популярные направления</h2>
   </div>

<?//if($_SESSION['isMobile']===true):?>
	  <div class="row">
		  <div class="owl-carousel owl-theme main-directions__owl" id="main-directions__owl">
			<?foreach($arResult['ITEMS'] as $item):?>
				<div class="item main-directions__item" >
					<div class="direction-item-img">
								<picture>
								   <?if($item["PREVIEW_PICTURE"]["SRC_AVIF"]):?>
								   		<source srcset="<?=$item["PREVIEW_PICTURE"]["SRC_AVIF"]?>" type="image/avif">
								   <?endif;?>
								   <?if($item["PREVIEW_PICTURE"]["SRC_WEBP"]):?>
								   		<source srcset="<?=$item["PREVIEW_PICTURE"]["SRC_WEBP"]?>" type="image/webp">
								   <?endif;?>
								   <img src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>" height = "<?=$item["PREVIEW_PICTURE"]["HEIGHT"]?>" width = "<?=$item["PREVIEW_PICTURE"]["WIDTH"]?>" alt="<?=$item["PREVIEW_PICTURE"]["ALT"]?>">
								</picture>
						<h5 class="direction-item__title"><?=$item['NAME']?></h5>
						<a href="<?=$item['PROPERTIES']['LINK_ITEM']['VALUE']?>" class="direction-item__link--hidden"></a>
					</div>
				</div>
			<?endforeach;?>
		  </div>
	  </div>
<?/*else:
	  <div class="row_pop">
			<?foreach($arResult['ITEMS'] as $item):?>
				<div class="item_pop" >
						<img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$item["PREVIEW_PICTURE"]["ALT"]?>">
						<h5 class="direction_pop"><?=$item['NAME']?></h5>
						<a href="<?=$item['PROPERTIES']['LINK_ITEM']['VALUE']?>" class=""></a>
				</div>
			<?endforeach;?>
	  </div>
endif;*/?>