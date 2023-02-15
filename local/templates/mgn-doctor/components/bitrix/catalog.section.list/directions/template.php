<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

//$this->setFrameMode(true);
//$arViewModeList=$arResult['VIEW_MODE_LIST'];

//console($arResult);

?>

<!--	<div class="row">-->
<!--		<h6 class="services-prices__subtitle">Направления</h6>-->
<!--		<div class="line-green-full-small"></div>-->
<!--	</div>-->

<?foreach($arResult['SECTIONS'] as $i=>$arSection){
	if($arSection['DEPTH_LEVEL']==1){
		if($arParams['ONLY_FIRST'] && $i>=$arParams['ONLY_FIRST']) break;
		if($arSection['RIGHT_MARGIN']-$arSection['RIGHT_MARGIN']>1){?>
		<?}else{?>
			<div class="row">
				<a href="<?=$arSection["SECTION_PAGE_URL"];?>" class="services-item"><?=$arSection["NAME"];?></a>
			</div>
		<?}
	}
}
