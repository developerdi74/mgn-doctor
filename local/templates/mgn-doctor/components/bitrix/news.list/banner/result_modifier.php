<?
foreach ($arResult["ITEMS"] as $i => $arItem) {
	if ($arItem['PREVIEW_PICTURE']['SRC']) {
		$arResult["ITEMS"][$i]['PREVIEW_PICTURE']['SRC'] = $arItem['PREVIEW_PICTURE']['SRC'];
		$rez = makeWebp($arItem['PREVIEW_PICTURE']['SRC']);
		if($rez['WEBP']){
			$arResult["ITEMS"][$i]['PREVIEW_PICTURE']['SRC_WEBP'] = $rez['WEBP'];
		}
		if($rez['AVIF']){
			$arResult["ITEMS"][$i]['PREVIEW_PICTURE']['SRC_AVIF'] = $rez['AVIF'];
		}

	}
	if ($arItem['DETAIL_PICTURE']['SRC']) {
		$arResult["ITEMS"][$i]['DETAIL_PICTURE']['SRC'] = $arItem['DETAIL_PICTURE']['SRC'];
		$rez = makeWebp($arItem['DETAIL_PICTURE']['SRC']);
		if($rez['WEBP']){
			$arResult["ITEMS"][$i]['DETAIL_PICTURE']['SRC_WEBP'] = $rez['WEBP'];
		}
		if($rez['AVIF']){
			$arResult["ITEMS"][$i]['DETAIL_PICTURE']['SRC_AVIF'] = $rez['AVIF'];
		}

	}
}?>