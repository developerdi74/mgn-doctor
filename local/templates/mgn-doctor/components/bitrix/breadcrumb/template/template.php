<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/**
 * @global CMain $APPLICATION
 */
global $APPLICATION;
//console($arResult);
//console($APPLICATION->GetCurPage());	// текущий путь
//console($APPLICATION->GetTitle());	//
foreach($arResult as $i=>$item){
	if(empty($item['LINK'])){
//		console($item);
		if($flag){
			array_splice($arResult, $i);
			break;
		}
		else{
			unset($arResult[$i]);
//			console($arResult);
		}
	}
//	elseif($item['LINK']!='/'){
//		$flag=1;
//	}
}

$i=0;
foreach($arResult as $item){
	$newRes[$i++]=$item;
}
$arResult=$newRes;
//console($arResult);

$path=explode('/', $APPLICATION->GetCurPage());
$sections=[
	'service'=>[
		'TITLE'=>'Услуги и цены',
		'LINK' =>'/service/'
	]
];
//console($path);
foreach($path as $i=>$item){
	if(empty($item) || !$arResult[$i]){
		continue;
	}
	if($item!=preg_replace('/\//', '', $arResult[$i]['LINK']) && $sections[$item]){
//		console($arResult[$i]['LINK']);
		array_splice($arResult, $i, 0, [$sections[$item]]);
		break;
		
	}
}

//delayed function must return a string
if(empty($arResult)) return "";
$strReturn='';
//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$css=$APPLICATION->GetCSSArray();
if(!is_array($css) || !in_array("/bitrix/css/main/font-awesome.css", $css)){
	$strReturn.='<link href="'.CUtil::GetAdditionalFileURL("/bitrix/css/main/font-awesome.css").'" type="text/css" rel="stylesheet" />'."\n";
}
$strReturn.='<div class="breadcrumb bx-breadcrumb" itemprop="http://schema.org/breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';

//console($arResult);
// в услугах убрать промежуточные разделы
$j=count($arResult)-2;
if($arResult[1]['LINK']=='/service/'){
	for($i=2; $i<=$j; $i++){
		unset($arResult[$i]);
	}
}

$i=0;
$newRes=[];
foreach($arResult as $item){
	$newRes[$i++]=$item;
}
$arResult=$newRes;

//console($arResult);

$itemSize=count($arResult);
for($index=0; $index<$itemSize; $index++){
	$title=htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow=($index>0?'<i class="fa fa-angle-right"></i>':'');
	if($arResult[$index]["LINK"]<>"" && $index!=$itemSize-1){
		$strReturn.='
			<div class="breadcrumbs bx-breadcrumb-item" id="bx_breadcrumb_'.$index.'" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				'.$arrow.'
				<a class="breadcrumbs__link" href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item">
					<span itemprop="name">'.$title.'</span>
				</a>
				<meta itemprop="position" content="'.($index+1).'" />
			</div>';
	}
	else{
		$strReturn.='
			<div class="bx-breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				'.$arrow.'
				<span itemprop="name">'.$title.'</span>
				<meta itemprop="position" content="'.($index+1).'" />
			</div>';
	}
}
$strReturn.='<div style="clear:both"></div></div>';
return $strReturn;
