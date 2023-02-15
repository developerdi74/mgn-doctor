<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
?>

<div class="all-news__tabs">
	<ul class="nav nav-tabs nav-tabs-news">
		<?
		foreach ($arResult['SECTIONS'] as &$arSection) {
		?>
			<li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>"  class="nav-item active"> <a class="nav-link" href="<? echo $arSection['SECTION_PAGE_URL']; ?>"> <? echo $arSection['NAME']; ?> (<? echo $arSection['ELEMENT_CNT']; ?>)</a> </li>
		<?}?>
	</ul>
</div>


