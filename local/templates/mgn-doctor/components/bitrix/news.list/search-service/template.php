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
<?if(count($arResult["ITEMS"])>0):?>
    <div class="title-res-search">Услуги</div>
    <section class="search-res-cnt" id="search-res">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
            <div class="search-res-item">
                <span class="search-item-name"><?=$arItem["NAME"]?></span>
                <span class="search-item-price"><?=$arItem["PROPERTIES"]['PRICE']["VALUE"]?> ₽</span>
                <?// dd($arItem);?>
            </div>
        <?endforeach;?>
    </section>
    <section id="load-next-page">
        <?=($arResult['NAV_STRING']);?>
    </section>

    <style>
        .search-res-item{
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: nowrap;
            padding: 5px 20px;
            border-bottom: 2px solid #7ca82b;
            margin-bottom: 10px;
        }
        .search-item-price{
            font-weight: 700;
            font-size: 14px;
            white-space: nowrap;
        }
        .search-res-item span{
        }
        .title-res-search{
            font-weight: 900;
            font-size: 16px;
            padding: 20px;
        }
    </style>
<?endif;?>