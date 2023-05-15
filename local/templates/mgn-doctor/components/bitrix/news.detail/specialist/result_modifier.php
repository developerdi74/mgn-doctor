<?
    if ($arResult['PREVIEW_PICTURE']['SRC']) {
        $rez = makeWebp($arResult['PREVIEW_PICTURE']['SRC']);
        if($rez['WEBP']){
            $arResult['PREVIEW_PICTURE']['SRC_WEBP'] = $rez['WEBP'];
        }
        if($rez['AVIF']){
            $arResult['PREVIEW_PICTURE']['SRC_AVIF'] = $rez['AVIF'];
        }

    }
    // получение рейтинга врача

    $arSelect = Array("ID", "NAME", "IBLOCK_ID", "DATE_CREATE", "PREVIEW_TEXT","PROPERTY_RAITING");
    $arFilter = Array(
        "IBLOCK_ID"=>30, 
        "ACTIVE_DATE"=>"Y", 
        "ACTIVE"=>"Y",
        'PROPERTY_SPECIALIST'=>$arResult['ID']
    );
    $raiting = 0;
    $cntRew=0;
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>150), $arSelect);
    while($ob = $res->GetNextElement())
    {
        $rewievs[] = $ob->GetFields();
        $raiting += $ob->fields['PROPERTY_RAITING_VALUE'];
        $cntRew++;
    }
    if($cntRew>0){
        $arResult['REWIEVS'] = $rewievs;
        $arResult['RAITING'] = round($raiting/$cntRew,1);
    }
?>