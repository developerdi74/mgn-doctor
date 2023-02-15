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


<div class="news aside-news fixed-div">

<?if( $arResult["ITEMS"]['0']["IBLOCK_CODE"] == 'questions'):?>
  <h3 class="aside-title aside-news__title">Вопросы</h3>
<?else:?>
  <h3 class="aside-title aside-news__title">Новости</h3>
 <?endif;?> 
      <?foreach($arResult["ITEMS"] as $arItem):?>

              <div class="aside-news__item aside-news-item">
                <h4 class="aside-news-item__title"><?=$arItem["NAME"]?></h4>
                <div class="date aside-news-item__date"> <?= $arItem["DISPLAY_ACTIVE_FROM"] ?></div>
                <a href="<?= $arItem["DETAIL_PAGE_URL"];?>" class="aside-news-item__link"></a>
              </div>
              <?endforeach;?> 
      
              <!--               <div class="aside-news__btn">
                <a href="/news" class="btn btn-all-news">Все новости</a> 
              </div> -->
</div>




