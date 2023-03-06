<? 
$getiblock = CIBlockSection::GetList(
   Array("name"=>"ASC"),
   Array("IBLOCK_ID"=>$arParams['IBLOCK_ID']),
   true,
   $arSelect=Array("UF_*")
);
 
while($sectionwhile = $getiblock->GetNext())
{


	if($sectionwhile['UF_MAIN'] == 1 ){
		$arS[] = $sectionwhile;
	}
}

foreach($arS as $arSec){  
	
	foreach($arResult["ITEMS"] as $key=>$arItem){
		 if($arItem['IBLOCK_SECTION_ID'] == $arSec['ID']){
			$arSec['ELEMENTS'][] =  $arItem;
		 }
	}
	
	$arElementGroups[] = $arSec;
	
}
 
$arResult["ITEMS"] = $arElementGroups;

foreach ($arResult["ITEMS"] as $i => $arItem) {
//	prnt($i);
	foreach($arItem["ELEMENTS"] as $j => $arElements){

		//prnt($arElements['NAME']);
		if ($arElements['PREVIEW_PICTURE']['SRC']) {
			$arResult["ITEMS"][$i]["ELEMENTS"][$j]['PREVIEW_PICTURE']['SRC'] = $arElements['PREVIEW_PICTURE']['SRC'];

			$rez = makeWebp($arElements['PREVIEW_PICTURE']['SRC']);
			if($rez['WEBP']){
				$arResult["ITEMS"][$i]["ELEMENTS"][$j]['PREVIEW_PICTURE']['SRC_WEBP'] = $rez['WEBP'];
			}
			if($rez['AVIF']){
				$arResult["ITEMS"][$i]["ELEMENTS"][$j]['PREVIEW_PICTURE']['SRC_AVIF'] = $rez['AVIF'];
			}
		}

	}
}
?>