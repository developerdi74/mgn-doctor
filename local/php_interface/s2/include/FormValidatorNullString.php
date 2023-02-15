<?

namespace wk00FF;
use \Bitrix\Main\EventManager;
class FormValidatorNullString{
	function getDescription(){
		return [
			'NAME'           =>'null_string',						// идентификатор
			'DESCRIPTION'    =>'Нулевая строка',					// наименование
			'TYPES'          =>['text'],							// типы полей
			'SETTINGS'       =>[__CLASS__, 'getSettings'],			// метод, возвращающий массив настроек
			'CONVERT_TO_DB'  =>[__CLASS__, 'toDB'],					// метод, конвертирующий массив настроек в строку
			'CONVERT_FROM_DB'=>[__CLASS__, 'fromDB'],				// метод, конвертирующий строку настроек в массив
			'HANDLER'        =>[__CLASS__, 'doValidate'],			// валидатор
		];
	}
	function getSettings(){
		return [];
	}
	function toDB($arParams){
		return serialize($arParams);
	}
	function fromDB($strParams){
		return unserialize($strParams);
	}
	function doValidate($arParams, $arQuestion, $arAnswers, $arValues){
		global $APPLICATION;
		foreach($arValues as $value){
			if(strlen(trim($value))>0){
				$APPLICATION->ThrowException('неверное значение');
				return false;
			}
		}
		return true;
	}
}
