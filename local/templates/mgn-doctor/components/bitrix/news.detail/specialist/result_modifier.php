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
?>