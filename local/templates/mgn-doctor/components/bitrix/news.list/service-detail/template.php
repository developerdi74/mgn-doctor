<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
//dd($arParams);
?>


<?
	$arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], "CODE"=> $_REQUEST["SECTION_CODE"]);
	$db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, false, $arSelect = array("UF_*"));
	$ar_result = $db_list->GetNext();
?>

  <!-- SERVICE ITEM BANNER  -->
  <section class="serviceit-banner" >
    <div class="container-full">
      <div class="row">
        <div class="serviceit-banner__inner" style="background-image:url('<?=CFile::GetPath($ar_result["PICTURE"])? CFile::GetPath($ar_result["PICTURE"]) : "/upload/bg-serv.png";?>');">
          <div class="container">
            <div class="serviceit-banner__overlay">
              <h1 class="page-title serviceit-banner__title title-slider"><?=$ar_result["NAME"]?></h1>
              <div class="serviceit-banner__text">
			  	<?=$ar_result["DESCRIPTION"]?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- SERVICE ITEM BANNER END -->




   <!-- SERVICE ITEM PRICE AND TEAM  -->
   <section class="serviceit-price service-list-item" id="serviceit-price">
    <div class="container">

      <div class="row justify-content-between row-vmiddle">
        <h2 class="section-title serviceit-price__title  ">Услуги и цены</h2>
      </div>
      <div class="row serviceit-price__row">
        <div class="serviceit-price__item serviceit-price__item--left">

			<?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="all-services__subitem serviceit-price__subitem">
                  <h6><?=$arItem["NAME"]?></h6>
                    <?// dd($arItem);?>
                  <div>
                    <span class="price"><?=$arItem["PROPERTIES"]['PRICE']["VALUE"]?>₽</span>
                  </div>
                </div>
  			<?endforeach;?>
        </div>
      </div>
    </div>
  </section>
  <!-- SERVICE ITEM PRICE AND TEAM END -->
<section>
    <?=($arResult['NAV_STRING']);?>
</section>

   <!-- SERVICE ITEM DESCRIPTION  -->
   <section class="serviceit-description mt-60" >
    <div class="container">
      <div class="row">
          <h2 class="serviceit-description__title title-wborder"><?=$ar_result["NAME"]?></h2>
      </div>
    </div>
  </section>
  <!-- SERVICE ITEM DESCRIPTION END -->