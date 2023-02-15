<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$arViewModeList=$arResult['VIEW_MODE_LIST'];

use Bitrix\Main\Page\Asset;
Asset::getInstance()->addCss('/service/styles.css');

if(CModule::IncludeModule("iblock")){
	$res=CIBlockSection::GetList([], ['IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'CODE'=>$_REQUEST["SECTION_CODE"]]);
	$section=$res->Fetch();
	$res=CIBlockSection::GetByID($section['IBLOCK_SECTION_ID']);
	if($ar_res=$res->GetNext()) $SectionID=$ar_res['CODE'];
}?>
	<nav class="all-services__nav">
	<ul class="all-services__list">
<?$intCurrentDepth=1;
$boolFirst=true;
foreach($arResult['SECTIONS'] as &$arSection){
	if($previous_сode==$_REQUEST["SECTION_CODE"] || $SectionID==$previous_сode){
		$showSubmenu='style="display:block"';
	}
	else{
		$showSubmenu='style=""';
	}
	
	if($intCurrentDepth<$arSection['RELATIVE_DEPTH_LEVEL']){
		continue;
		if(0<$intCurrentDepth){
			echo "\n", str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']), '<ul '.$showSubmenu.' class="all-services-item__submenu">';
		}
	}
	elseif($intCurrentDepth==$arSection['RELATIVE_DEPTH_LEVEL']){
		if(!$boolFirst) echo '</li>';
	}
	else{
		while($intCurrentDepth>$arSection['RELATIVE_DEPTH_LEVEL']){
			echo '</li>', "\n", str_repeat("\t", $intCurrentDepth), '</ul>', "\n", str_repeat("\t", $intCurrentDepth-1);
			$intCurrentDepth--;
		}
		echo str_repeat("\t", $intCurrentDepth-1), '</li>';
	}
	
	echo(!$boolFirst?"\n":''), str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']);
if($arSection['DEPTH_LEVEL']>=1){

if($arSection['RIGHT_MARGIN']-$arSection['LEFT_MARGIN']>1){?>
	<li class="all-services__item all-services__item--has-submenu <?if($arSection['CODE']==$_REQUEST["SECTION_CODE"] || $SectionID==$arSection['CODE']) echo "all-services__item--active" ?>" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
		<span href="<?=$arSection["SECTION_PAGE_URL"];?>">
			<?=$arSection["NAME"];?>
			<span>
				<svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0.327898 0.35799C0.778951 -0.101145 1.40691 -0.137175 1.95831 0.35799L6.00123 4.21534L10.0441 0.35799C10.5955 -0.137175 11.2245 -0.101145 11.6725 0.35799C12.1235 0.816095 12.0946 1.59024 11.6725 2.02055C11.2525 2.45086 6.8154 6.65513 6.8154 6.65513C6.5909 6.8847 6.29606 7 6.00123 7C5.70639 7 5.41155 6.8847 5.18499 6.65513C5.18499 6.65513 0.749984 2.45086 0.327898 2.02055C-0.0952218 1.59024 -0.123154 0.816095 0.327898 0.35799Z"/>
				</svg>
			</span>
		</span>
		<?}else{?>
	<li class="all-services__item" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
		<span href="<? echo $arSection["SECTION_PAGE_URL"]; ?>"><? echo $arSection["NAME"]; ?></span>
		<?}
		
		}else{?>
	<li id="<?=$this->GetEditAreaId($arSection['ID']);?>"><a href="<? echo $arSection["SECTION_PAGE_URL"]; ?>"><? echo $arSection["NAME"]; ?></a>
	<?}?>
	<?$intCurrentDepth=$arSection['RELATIVE_DEPTH_LEVEL'];
	$boolFirst=false;
	$previous_сode=$arSection["CODE"];
}
unset($arSection);
while($intCurrentDepth>1){
	echo '</li>', "\n", str_repeat("\t", $intCurrentDepth), '</ul>', "\n", str_repeat("\t", $intCurrentDepth-1);
	$intCurrentDepth--;
}
if($intCurrentDepth>0){
	echo '</li>', "\n";
}?>


<? /*

	  <li class="all-services__item all-services-item">
			<a href="#">Приём врачей</a>
			</li>



  <li class="all-services__item all-services__item--has-submenu">
	<a href="#">
	  Диагностика
	  <span>
		<svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M0.327898 0.35799C0.778951 -0.101145 1.40691 -0.137175 1.95831 0.35799L6.00123 4.21534L10.0441 0.35799C10.5955 -0.137175 11.2245 -0.101145 11.6725 0.35799C12.1235 0.816095 12.0946 1.59024 11.6725 2.02055C11.2525 2.45086 6.8154 6.65513 6.8154 6.65513C6.5909 6.8847 6.29606 7 6.00123 7C5.70639 7 5.41155 6.8847 5.18499 6.65513C5.18499 6.65513 0.749984 2.45086 0.327898 2.02055C-0.0952218 1.59024 -0.123154 0.816095 0.327898 0.35799Z" />
		</svg>
	  </span>
	</a>
	<ul class="all-services-item__submenu">
	  <li><a href="#">Узи</a></li>
	  <li><a href="#">Рентген</a></li>
	  <li><a href="#">Лабораторные анализы</a></li>
	  <li><a href="#">Эндоскопическая диагностика</a></li>
	  <li><a href="#">Функциональная диагностика</a></li>
	</ul>
  </li>

  <li class="all-services__item all-services__item--has-submenu">
	<a href="#">
	  Лечение
	  <span>
		<svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M0.327898 0.35799C0.778951 -0.101145 1.40691 -0.137175 1.95831 0.35799L6.00123 4.21534L10.0441 0.35799C10.5955 -0.137175 11.2245 -0.101145 11.6725 0.35799C12.1235 0.816095 12.0946 1.59024 11.6725 2.02055C11.2525 2.45086 6.8154 6.65513 6.8154 6.65513C6.5909 6.8847 6.29606 7 6.00123 7C5.70639 7 5.41155 6.8847 5.18499 6.65513C5.18499 6.65513 0.749984 2.45086 0.327898 2.02055C-0.0952218 1.59024 -0.123154 0.816095 0.327898 0.35799Z" />
		</svg>
	  </span>
	</a>
	<ul class="all-services-item__submenu">
	  <li><a href="#">Аллергология-иммунология</a></li>
	  <li><a href="#">Гастроэнтерология</a></li>
	  <li><a href="#">Гематология</a></li>
	  <li><a href="#">Гинекология</a></li>
	  <li><a href="#">Дерматовенерология</a></li>
	</ul>
  </li>

  <li class="all-services__item all-services__item--has-submenu">
	<a href="#">
	  Оздоровление и реабилитация
	  <span>
		<svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M0.327898 0.35799C0.778951 -0.101145 1.40691 -0.137175 1.95831 0.35799L6.00123 4.21534L10.0441 0.35799C10.5955 -0.137175 11.2245 -0.101145 11.6725 0.35799C12.1235 0.816095 12.0946 1.59024 11.6725 2.02055C11.2525 2.45086 6.8154 6.65513 6.8154 6.65513C6.5909 6.8847 6.29606 7 6.00123 7C5.70639 7 5.41155 6.8847 5.18499 6.65513C5.18499 6.65513 0.749984 2.45086 0.327898 2.02055C-0.0952218 1.59024 -0.123154 0.816095 0.327898 0.35799Z" />
		</svg>
	  </span>
	</a>
	<ul class="all-services-item__submenu">
	  <li><a href="">Аллергология-иммунология</a></li>
	  <li><a href="">Гастроэнтерология</a></li>
	  <li><a href="">Гематология</a></li>
	  <li><a href="">Гинекология</a></li>
	  <li><a href="">Дерматовенерология</a></li>
	</ul>
  </li>

  <li class="all-services__item">
	<a href="#">Профилактика</a>
  </li>

  <li class="all-services__item all-services__item--has-submenu">
	<a href="#">
	Выдача справок
	  <span>
		<svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M0.327898 0.35799C0.778951 -0.101145 1.40691 -0.137175 1.95831 0.35799L6.00123 4.21534L10.0441 0.35799C10.5955 -0.137175 11.2245 -0.101145 11.6725 0.35799C12.1235 0.816095 12.0946 1.59024 11.6725 2.02055C11.2525 2.45086 6.8154 6.65513 6.8154 6.65513C6.5909 6.8847 6.29606 7 6.00123 7C5.70639 7 5.41155 6.8847 5.18499 6.65513C5.18499 6.65513 0.749984 2.45086 0.327898 2.02055C-0.0952218 1.59024 -0.123154 0.816095 0.327898 0.35799Z" />
		</svg>
	  </span>
	</a>
	<ul class="all-services-item__submenu">
	  <li><a href="#">Выдача справок для</a></li>
	  <li><a href="#">Выдача справок для</a></li>
	</ul>
  </li>

</ul>
</nav>



<? /*
$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?><div class="<? echo $arCurView['CONT']; ?>"><?
if ('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID'])
{
	$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
	$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

	?><h1
		class="<? echo $arCurView['TITLE']; ?>"
		id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>"
	><a href="<? echo $arResult['SECTION']['SECTION_PAGE_URL']; ?>"><?
		echo (
			isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
			? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
			: $arResult['SECTION']['NAME']
		);
	?></a></h1><?
}
if (0 < $arResult["SECTIONS_COUNT"])
{
?>
<ul class="<? echo $arCurView['LIST']; ?>">
<?
	switch ($arParams['VIEW_MODE'])
	{
		case 'LINE':
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if (false === $arSection['PICTURE'])
					$arSection['PICTURE'] = array(
						'SRC' => $arCurView['EMPTY_IMG'],
						'ALT' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							: $arSection["NAME"]
						),
						'TITLE' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							: $arSection["NAME"]
						)
					);
				?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
				<a
					href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
					class="bx_catalog_line_img"
					style="background-image: url('<? echo $arSection['PICTURE']['SRC']; ?>');"
					title="<? echo $arSection['PICTURE']['TITLE']; ?>"
				></a>
				<h2 class="bx_catalog_line_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
				if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null)
				{
					?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
				}
				?></h2><?
				if ('' != $arSection['DESCRIPTION'])
				{
					?><p class="bx_catalog_line_description"><? echo $arSection['DESCRIPTION']; ?></p><?
				}
				?><div style="clear: both;"></div>
				</li><?
			}
			unset($arSection);
			break;
		case 'TEXT':
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>"><h2 class="bx_catalog_text_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
				if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null)
				{
					?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
				}
				?></h2></li><?
			}
			unset($arSection);
			break;
		case 'TILE':
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if (false === $arSection['PICTURE'])
					$arSection['PICTURE'] = array(
						'SRC' => $arCurView['EMPTY_IMG'],
						'ALT' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							: $arSection["NAME"]
						),
						'TITLE' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							: $arSection["NAME"]
						)
					);
				?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
				<a
					href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
					class="bx_catalog_tile_img"
					style="background-image:url('<? echo $arSection['PICTURE']['SRC']; ?>');"
					title="<? echo $arSection['PICTURE']['TITLE']; ?>"
					> </a><?
				if ('Y' != $arParams['HIDE_SECTION_NAME'])
				{
					?><h2 class="bx_catalog_tile_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
					if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null)
					{
						?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
					}
				?></h2><?
				}
				?></li><?
			}
			unset($arSection);
			break;
		case 'LIST':
			$intCurrentDepth = 1;
			$boolFirst = true;
			foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if ($intCurrentDepth < $arSection['RELATIVE_DEPTH_LEVEL'])
				{
					if (0 < $intCurrentDepth)
						echo "\n",str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']),'<ul>';
				}
				elseif ($intCurrentDepth == $arSection['RELATIVE_DEPTH_LEVEL'])
				{
					if (!$boolFirst)
						echo '</li>';
				}
				else
				{
					while ($intCurrentDepth > $arSection['RELATIVE_DEPTH_LEVEL'])
					{
						echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
						$intCurrentDepth--;
					}
					echo str_repeat("\t", $intCurrentDepth-1),'</li>';
				}

				echo (!$boolFirst ? "\n" : ''),str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']);
				?><li id="<?=$this->GetEditAreaId($arSection['ID']);?>"><h2 class="bx_sitemap_li_title"><a href="<? echo $arSection["SECTION_PAGE_URL"]; ?>"><? echo $arSection["NAME"];?><?
				if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null)
				{
					?> <span>(<? echo $arSection["ELEMENT_CNT"]; ?>)</span><?
				}
				?></a></h2><?

				$intCurrentDepth = $arSection['RELATIVE_DEPTH_LEVEL'];
				$boolFirst = false;
			}
			unset($arSection);
			while ($intCurrentDepth > 1)
			{
				echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
				$intCurrentDepth--;
			}
			if ($intCurrentDepth > 0)
			{
				echo '</li>',"\n";
			}
			break;
	}
?>
</ul>
<?
	echo ('LINE' != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');
}
?></div>
*/ ?>