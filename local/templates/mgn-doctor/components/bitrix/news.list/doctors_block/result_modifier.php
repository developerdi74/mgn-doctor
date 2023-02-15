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

?>