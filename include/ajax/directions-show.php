<?define('STOP_STATISTICS', true);
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$APPLICATION->RestartBuffer();
if(stripos($_SERVER['HTTP_REFERER'],'service')){
	/**
	 * Created by PhpStorm.
	 * User: william
	 * Date: 09.10.2022
	 * Time: 19:44
	 */

	$GLOBALS['sectionsFilter']=[
		'IBLOCK_ID'   =>24,
		'DEPTH_LEVEL' =>1,
		'UF_CATEGORY'=>false,																																		// популярнрое
	];

	$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "directions", [
		"ADD_SECTIONS_CHAIN"   =>"Y",
		"CACHE_FILTER"         =>"N",
		"CACHE_GROUPS"         =>"Y",
		"CACHE_TIME"           =>"36000000",
		"CACHE_TYPE"           =>"N",
		"COUNT_ELEMENTS_FILTER"=>"CNT_ACTIVE",
		"COUNT_ELEMENTS"       =>"Y",
		"FILTER_NAME"          =>"sectionsFilter",
		"IBLOCK_ID"            =>"24",
		"IBLOCK_TYPE"          =>"mgn_doctor_service",
		"SECTION_CODE"         =>"",
		"SECTION_FIELDS"       =>[
			0=>"",
			1=>"",
		],
		"SECTION_ID"           =>$_REQUEST["SECTION_ID"],
		"SECTION_URL"          =>"",
		"SECTION_USER_FIELDS"  =>[
			0=>"",
			1=>"",
		],
		"SHOW_PARENT_NAME"     =>"Y",
		"TOP_DEPTH"            =>"4",
		"VIEW_MODE"            =>"LIST",
		"COMPONENT_TEMPLATE"   =>"directions",
		'CUSTOM_SECTION_SORT'  =>[
			'sort' => 'acs',
	//		'name' => 'asc'
		]
	], false);

}else{
header('Location: '."/404.php/");
die();
}