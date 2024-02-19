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
?>
<? if(count($arResult['SECTIONS'])>0):?>
    <div class="title-res-search">Направления</div>
    <section class="search-res-cnt-section">
         <? foreach ($arResult['SECTIONS'] as $key => $arSection): ?>
        <? if ($arSection["ELEMENT_CNT"] > 0) { ?>
                 <div class="search-res-item-section">
                     <a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><?= $arSection["NAME"]; ?>
                         <span class="el_cnt"><?=$arSection["ELEMENT_CNT"] ?></span>
                     </a>
                 </div>
             <? } ?>
         <? endforeach; ?>
         </div>
    </section>
    <style>
        .search-res-cnt-section{
            display: flex;
            flex-wrap: wrap;
            align-content: center;
            align-items: center;
        }
        .search-res-item-section a{
            padding: 5px 15px;
            border-radius: 5px;
            border: 1px solid #8d8d8d;
            color: #000;
            font-weight: 600;
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 10px;
        }
    </style>
<? endif; ?>