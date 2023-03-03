<?
foreach ($arResult["ITEMS"] as $i => $arItem) {
	// resize image
	if ($arItem['PREVIEW_PICTURE']['SRC']) {
		//$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 200, 'height' => (400)), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		// $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 400, 'height' => 400), BX_RESIZE_IMAGE_PROPORTIONAL , true);
		// $arResult["ITEMS"][$i]['PREVIEW_PICTURE']['SRC'] = $file['src'];
		$arResult["ITEMS"][$i]['PREVIEW_PICTURE']['SRC'] = $arItem['PREVIEW_PICTURE']['SRC'];
		$rez = makeWebp($arItem['PREVIEW_PICTURE']['SRC']);
		if($rez['WEBP']){
			$arResult["ITEMS"][$i]['PREVIEW_PICTURE']['SRC_WEBP'] = $rez['WEBP'];
		}
		if($rez['AVIF']){
			$arResult["ITEMS"][$i]['PREVIEW_PICTURE']['SRC_AVIF'] = $rez['AVIF'];
		}

	}
}

?>