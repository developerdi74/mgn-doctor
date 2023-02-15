<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.11.2022
 * Time: 14:03
 */

$dbItems=CIBlockElement::GetList([], [
	"IBLOCK_ID"=>25,
	'PROPERTY_SERVICE'=>$_REQUEST['sectionID']
], false, false, ['ID', 'NAME', 'PROPERTY_CLINIC']);
while($item=$dbItems->fetch()){
	$clinic=getPropertiesByID(25, $item['ID'], ['CLINIC']);
	foreach($clinic['CLINIC']['VALUE'] as $i=>$val){
		$arClinic[$clinic['CLINIC']['VALUE_ID'][$i]]=$val;
	}
	$res[$item['ID']]=[
		'NAME'=>$item['NAME'],
		'CLINIC'=>$arClinic
	];
}
echo json_encode($res);