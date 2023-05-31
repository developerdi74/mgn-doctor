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
?>


<section class="">
   <div class="container">
        <div class="row justify-content-between row-vmiddle">
            <h1 class="serviceit-description__title title-wborder"><?=$arResult["NAME"]?></h1>
        </div>
        <?
        if($arResult['CODE']=="calc-water"){
             include "calcs/".$arResult['CODE'].".php";
        }        
        if($arResult['CODE']=="calc-index"){
             include "calcs/".$arResult['CODE'].".php";
        }        
        if($arResult['CODE']=="calc-bar"){
             include "calcs/".$arResult['CODE'].".php";
        }
        
        ?>
		</div>
</section>


