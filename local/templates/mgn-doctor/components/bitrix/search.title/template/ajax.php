<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"]) && $arResult['CATEGORIES_ITEMS_EXISTS']):?>
	<table class="title-search-result">
		<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory): ?>
			<?foreach($arCategory["ITEMS"] as $i => $arItem): ?>
			<tr>
				<?/*if($i == 0):?>
					<th><?//echo $arCategory["TITLE"]?></th>
				<?else:?>
					<th></th>
				<?endif;*/?>

				<?if($category_id === "all"):?>
					<td class="title-search-all"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></td>
				<?elseif(isset($arItem["ICON"])):?>
					<td class="title-search-item"><a href="<?echo $arItem["URL"]?>"><!--<img src="<?//=$arItem["ICON"]?>">--><?echo $arItem["NAME"]?></a></td>
				<?else:?>
					<td class="title-search-more"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></td>
				<?endif;?>
			</tr>
			<?endforeach;?>
		<?endforeach;?>
	</table><div class="title-search-fader"></div>
<?endif;
?>