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
	<div class='row'>
		<div class="owl-carousel owl-theme" id="popular_slider_owl">
			<?foreach($arResult['ITEMS'] as $item):?>
				 <div class="slide" style="background-image: url('<?if($item["PREVIEW_PICTURE"]["SRC_AVIF"]){
				 		echo $item["PREVIEW_PICTURE"]["SRC_AVIF"];
				 	}else if($item["PREVIEW_PICTURE"]["SRC_WEBP"]){
						echo $item["PREVIEW_PICTURE"]["SRC_WEBP"];
				 	}?>')">
				 	<h5 class="popular_slider_title"><?=$item['NAME']?></h5>
				 	<a href="<?=$item['PROPERTIES']['LINK_ITEM']['VALUE']?>" class=""><div class="dark_fone"></div></a>
 		  	</div>
			<?endforeach;?>
		</div>	
	</div>