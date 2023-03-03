<?
require_once __DIR__."/include/chromephp-master/ChromePhp.php";
require_once __DIR__."/include/Mobile_Detect.php";
require_once __DIR__."/include/convertWebp.php"; //Конвертирование в webp
CModule::IncludeModule('iblock');
function console($data){
	echo "<script>console.log(" . json_encode($data, JSON_PARTIAL_OUTPUT_ON_ERROR) . ")</script>";
}
if(!function_exists('_vardump')){
	/**
	 * Custom vardump
	 *
	 * @param mixed   $var
	 * @param string  $output ('f' or 'd')
	 * @param boolean $checkAccess
	 */
	function _vardump($var='', $output='display', $checkAccess=true){
		global $USER;
		if($checkAccess && !$USER->IsAdmin()) return;
		$dump=print_r($var, true);
		$backtraceInfo=debug_backtrace(false);
		$source='File <b>'.$backtraceInfo[0]['file'].'</b> in line <b>'.$backtraceInfo[0]['line'].'</b>';
		switch($output){
			case 'f':
			case 'file':
				$logPath=$_SERVER['DOCUMENT_ROOT'].'/vardump_log.txt';
				$logFile=fopen($logPath, 'a');
				fwrite($logFile, "----- ".date('d.m.Y H:i:s')." | ".strip_tags($source)." ------------------------\n".$dump."\n\n");
				fclose($logFile);
				break;
			default:
				$dump='<div style="margin: 20px; background: #fdf5db; border-radius: 4px; padding: 5px; border: 1px solid #ffe69d; box-shadow: 0 0 10px 0px #ccc; font-family: Arial; max-width: 1400px;"><div style="margin-bottom: 5px; font-size: 11px; color: #848484; overflow:hidden;" title="'.strip_tags($source).'">'.$source.'</div><pre style="display: block; margin: 0; padding: 10px;  background: #fff; border: 1px solid #ccc; max-height: 400px; overflow: scroll; font-size: 13px; color: #000;">'.$dump.'</pre></div>';
				echo $dump;
				break;
		}
	}
}

//Возвращает id элемента символьному коду NEW.
//Параметры:
//$element_id - если передать id элемента, то он и вернётся
//$element_code - символьный код элемента
//$section_id - id секции, в которой лежит элемент (необязательный)
//$section_code - символьный код секции, в которой лежит элемент (необязательный)
//$arFilter - массив свойств для фильтрации (необязательный). Для ускорения процесса поиска можно передать id инфоблока, в котором лежит элемент: array("IBLOCK_ID" => №).
//use \CIBlockFindTools;
function getElementIDByCode_($element_code, $bRefreshCache=false, $element_id='', $section_id='', $section_code='', $arFilter=''){
	if($bRefreshCache){
		$obCache=new CPHPCache;
		$iReturnId=false;
		$CACHE_ID='getSectionIdByCode';
		$iCacheTime=10800; //3 часа
		if($obCache->InitCache($iCacheTime, $element_code, $CACHE_ID)){
			$vars=$obCache->GetVars();
			$iReturnId=$vars['result'];
		}
		elseif($obCache->StartDataCache($iCacheTime, $element_code, $CACHE_ID)){
			$iReturnId=CIBlockFindTools::GetElementID($element_id, $element_code, $section_id, $section_code, $arFilter);
			$obCache->EndDataCache(['result'=>$iReturnId]);
		}
		return $iReturnId;
	}
	else{
		return CIBlockFindTools::GetElementID($element_id, $element_code, $section_id, $section_code, $arFilter);
	}
}

//Возвращает ID секции по символьному коду NEW.
//Параметры:
//$section_id - id секции
//$section_code - символьный код секции
//$arFilter - массив свойств для фильтрации (необязательный). Но для ускорения процесса поиска можно передать id инфоблока, в котором лежит элемент: array("IBLOCK_ID" => №).
function getSectionIDByCode_($section_code, $bRefreshCache=false, $section_id='', $arFilter=''){
	if($bRefreshCache){
		$obCache=new CPHPCache;
		$iReturnId=false;
		$CACHE_ID='getSectionIdByCode';
		$iCacheTime=10800; //3 часа
		if($obCache->InitCache($iCacheTime, $section_code, $CACHE_ID)){
			$vars=$obCache->GetVars();
			$iReturnId=$vars['result'];
		}
		elseif($obCache->StartDataCache($iCacheTime, $section_code, $CACHE_ID)){
			$iReturnId=CIBlockFindTools::GetSectionID($section_id, $section_code, $arFilter);
			$obCache->EndDataCache(['result'=>$iReturnId]);
		}
		return $iReturnId;
	}
	else{
		return CIBlockFindTools::GetSectionID($section_id, $section_code, $arFilter);
	}
}

/**
 * Получить свойства элемента инфоблока
 * @param int   $iblockID
 * @param int   $elementID
 * @param array $selectCodes Необязательно, массив с символьными кодами свойств ['PROP1', 'PROP2', ...]
 *
 * @return array
 */
function getPropertiesByID(int $iblockID, int $elementID, array $selectCodes=[]){
	if(count($selectCodes)){
		foreach($selectCodes as $selectCode){
			$dbProperty=CIBlockElement::getProperty($iblockID, $elementID, false, false, ['CODE'=>$selectCode]);
			while($arProperty=$dbProperty->GetNext()){
				if(!$arPropertyes[$arProperty['CODE']]) $arPropertyes[$arProperty['CODE']]=$arProperty;
				if($arProperty['PROPERTY_TYPE']=='L'){																											// если свойство типа список
					if(is_string($arPropertyes[$arProperty['CODE']]['VALUE'])){
						$arPropertyes[$arProperty['CODE']]['VALUE']=str_split($arPropertyes[$arProperty['CODE']]['VALUE'], strlen($arPropertyes[$arProperty['CODE']]['VALUE'])+1);
						array_shift($arPropertyes[$arProperty['CODE']]['VALUE']);
					}
					$arPropertyes[$arProperty['CODE']]['VALUE'][]=$arProperty['VALUE_ENUM'];
					$arPropertyes[$arProperty['CODE']]['VALUE_ID'][]=$arProperty['VALUE'];
				}
				elseif($arProperty['MULTIPLE']=='Y'){																											// множественное
					if(is_string($arPropertyes[$arProperty['CODE']]['VALUE'])){
						$arPropertyes[$arProperty['CODE']]['VALUE']=str_split($arPropertyes[$arProperty['CODE']]['VALUE'], strlen($arPropertyes[$arProperty['CODE']]['VALUE'])+1);
						array_shift($arPropertyes[$arProperty['CODE']]['VALUE']);
					}
					$arPropertyes[$arProperty['CODE']]['VALUE'][]=$arProperty['VALUE'];
				}
			}
		}
	}
	else{
		$arPropertyes=[];
		$propertes=\Bitrix\Iblock\PropertyTable::getList([
			'filter'=>['IBLOCK_ID'=>$iblockID, 'ACTIVE'=>'Y'],
		])->fetchAll();
		foreach($propertes as $prop){
			$arPropertyes=array_merge($arPropertyes, getPropertiesByID($iblockID, $elementID, [$prop['CODE']]));
		}
	}
	return $arPropertyes;
}

use \Bitrix\Main\EventManager;
use \Bitrix\Main\Loader;

Loader::registerAutoLoadClasses(null, [
	'wk00FF\FormValidatorNullString' => '/local/php_interface/s2/include/FormValidatorNullString.php',
]);

EventManager::getInstance()->addEventHandlerCompatible('form', 'onFormValidatorBuildList', [
	'wk00FF\FormValidatorNullString',
	'getDescription',
]);

function removeDirectory($dir){
	console('зашли в функцию');
	if($objs=glob($dir."/*")){
		foreach($objs as $obj){
			is_dir($obj)?removeDirectory($obj):unlink($obj);
		}
	}
	rmdir($dir);
}

	function prnt($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
?>