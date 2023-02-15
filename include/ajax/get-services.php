<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.11.2022
 * Time: 16:45
 */
$dbItems=\Bitrix\Iblock\ElementTable::getList([
	'order'        =>['NAME'=>'ASC'],
	'select'       =>['ID', 'NAME', 'IBLOCK_ID'],
	'filter'       =>['=IBLOCK_ID'=>25, '=IBLOCK_SECTION_ID'=>$_POST['sectionID']],
	'runtime'      =>[],
	'cache'        =>[
		'ttl'        =>3600,
		'cache_joins'=>true
	],
]);
$services=[];
while($arItem=$dbItems->fetch()){
	$arProperty=getPropertiesByID(25, $arItem['ID'], ['SERVICE']);
	foreach($arProperty['SERVICE']['VALUE'] as $value){
		$servicesID[]=$value;
	}
}

$dbItems=\Bitrix\Iblock\ElementTable::getList(['select'=>['NAME', 'ID'], 'filter'=>['=IBLOCK_ID'=>24, '=ID'=>$servicesID]]);
while($arItem=$dbItems->fetch()){
	$services[$arItem['ID']]=$arItem['NAME'];
}
//_vardump($services);
//foreach($services as $id=>$service){
//
//}
//echo 'Ok';
echo json_encode($services);