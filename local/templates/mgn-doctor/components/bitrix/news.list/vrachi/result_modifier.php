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

    $arSelect = Array("ID", "NAME", "IBLOCK_ID", "DATE_CREATE", "PREVIEW_TEXT","PROPERTY_RAITING");
    $arFilter = Array(
        "IBLOCK_ID"=>30, 
        "ACTIVE_DATE"=>"Y", 
        "ACTIVE"=>"Y",
        'PROPERTY_SPECIALIST'=>$arItem['ID']
    );
    $raiting = 0;
    $cntRew=0;
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>150), $arSelect);
    while($ob = $res->GetNextElement())
    {
        $rewievs[] = $ob->GetFields();
        if($ob->fields['PROPERTY_RAITING_VALUE']>0 && $ob->fields['PROPERTY_RAITING_VALUE']<6){
	        $raiting += $ob->fields['PROPERTY_RAITING_VALUE'];
	        $cntRew++;
	    }
    }
    if($cntRew>0){
	    $arResult["ITEMS"][$i]['REWIEVS'] = $rewievs;
	    $arResult["ITEMS"][$i]['RAITING'] = round($raiting/$cntRew,1);
	}
}
?>