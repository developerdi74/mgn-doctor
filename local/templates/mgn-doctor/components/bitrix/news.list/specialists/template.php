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

use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$this->setFrameMode(true);
?>




<div class="all-specialists specialist__all" id="all-specialists">
  <div class="row row-specialists">

    <? foreach ($arResult["ITEMS"] as $arItem) : ?>

      <?
$hlblockId = HL\HighloadBlockTable::getById(8)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblockId);
$entity_data_class = $entity->getDataClass();

$rsData = $entity_data_class::getList(array(
  "select" => array("*"),
  "order" => array("ID" => "ASC"),
  "filter" => array("UF_NAME" => $arItem["NAME"], "UF_CLINIC"  => $arItem['PROPERTIES']['CLINIC']["VALUE_XML_ID"][0])
));
$curentDate =  date("d.m", strtotime('now'));

$arTime = [];
$arDateCurent = [];

while ($arData = $rsData->Fetch()) {
  if ($curentDate > $arData['UF_BEGIN']->format("d.m")) {
    continue;
  }
  $arTime[]['time'] =  $arData['UF_BEGIN']->format("d.m") . ' c ' . $arData['UF_BEGIN']->format("H:i");
  $arDateCurent[] =  $arData['UF_BEGIN']->format("d.m");
}
?>

      <div class="item our-team__item specialists-item col-md-4 col-sm-6 col-xs-12 all-specialists__item">
        <div class="specialists-item__top">
          <div class="specialists-item__img">
            <img src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="" class="specialists-item__photo">
          </div>
          <div class="specialists-item__status">
            <? if ($arTime[0]['time'] != '') : ?>

              <?if( $arDateCurent[0] > $curentDate ) :?>
                <span title="Приема сегодня нет" class="no-active-status"></span>
              <?else:?> 
                <span title="Прием сегодня" class="active-status"></span>
              <?endif;?>

            <?else:?>
              <span class="no-active-status"></span>
            <?endif;?>
          </div>
          <div class="specialists-item__specialty">

            <? if (array_search("111", $arItem['DISPLAY_PROPERTIES']['AGE']['VALUE_ENUM_ID']) !== false) : ?>
              <div class="specialists-item__specialty--item specialists-item__specialty--adult">
                <svg width="17" height="24" viewBox="0 0 17 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M9.32737 17.6698C9.55318 17.6229 9.69635 17.4102 9.64713 17.1948C9.5979 16.9794 9.37497 16.8429 9.14916 16.8898C8.27159 17.0722 7.38262 16.8862 6.67866 16.425C6.79976 16.1696 6.87409 15.8947 6.89762 15.6099C10.5164 16.6262 14.0727 13.9894 14.0727 10.5179V7.24954C14.0727 5.7089 12.7586 4.45551 11.1434 4.45551H5.80805C4.1929 4.45551 2.87882 5.709 2.87882 7.24969V9.83745C2.59929 9.69919 2.40805 9.42391 2.40805 9.10717V7.03349C2.40805 1.46 7.06684 -0.149693 11.4233 1.29904L11.0888 1.43041C10.6891 1.58734 10.7735 2.15251 11.2036 2.19642L11.9391 2.27156C13.3547 2.41616 14.6065 3.12009 15.4088 4.21461C14.8824 4.82474 14.5958 5.58426 14.5958 6.38444V9.10727C14.5958 9.32771 14.7832 9.50644 15.0143 9.50644C15.2454 9.50644 15.4327 9.32771 15.4327 9.10727V6.38444C15.4327 5.69064 15.7136 5.03685 16.2236 4.54348C16.3014 4.46814 16.3315 4.38661 16.3436 4.29026C16.3618 4.1465 16.2985 4.05256 16.2566 3.99037L16.2474 3.97656C15.455 2.77616 14.2215 1.93741 12.7912 1.6046C13.0197 1.42093 12.9779 1.06627 12.7027 0.939787C9.87927 -0.356762 6.03946 -0.49662 3.64508 1.70509C1.70598 3.48808 1.54833 6.02494 1.57118 7.03783V9.10717C1.57118 9.87073 2.13124 10.5125 2.8829 10.6849C2.96105 12.7236 4.24311 14.4743 6.06965 15.3074V15.4125C6.06965 16.334 5.28676 17.0762 4.32105 17.0762C1.93362 17.0762 0.00195312 18.9191 0.00195312 21.1961V23.5541C0.00195312 23.7745 0.189319 23.9532 0.420415 23.9532C0.65151 23.9532 0.838876 23.7745 0.838876 23.5541V21.1961C0.838876 19.3601 2.39649 17.8745 4.32116 17.8745C4.16502 17.8745 5.33137 17.9914 6.21422 17.0889C7.10602 17.6696 8.22608 17.8987 9.32737 17.6698ZM16.9496 23.5541V21.1961C16.9496 18.9188 15.0176 17.0761 12.6304 17.0762C12.014 17.0762 11.4549 16.7768 11.1347 16.2753C11.0144 16.087 10.757 16.0273 10.5596 16.142C10.3622 16.2567 10.2997 16.5023 10.4199 16.6906C10.8934 17.4319 11.7197 17.8745 12.6304 17.8745C14.5552 17.8745 16.1127 19.3602 16.1127 21.1961V23.5541C16.1127 23.7745 16.3 23.9532 16.5311 23.9532C16.7622 23.9532 16.9496 23.7745 16.9496 23.5541ZM8.47575 15.0281C11.1004 15.0281 13.2357 12.9912 13.2357 10.4875V7.24954C13.2357 6.14913 12.2971 5.25385 11.1434 5.25385H5.80805C4.65436 5.25385 3.71575 6.14918 3.71575 7.24969V10.4875C3.71575 12.9912 5.85105 15.0281 8.47575 15.0281ZM11.4573 21.9075H12.7127C12.9438 21.9075 13.1311 22.0862 13.1311 22.3067C13.1311 22.5271 12.9438 22.7058 12.7127 22.7058H11.4573C11.2262 22.7058 11.0388 22.5271 11.0388 22.3067C11.0388 22.0862 11.2262 21.9075 11.4573 21.9075Z" fill="#75A72D" />
                </svg>
                <div class="specialist-tooltip">Принимает взрослых</div>
              </div>
            <? endif; ?>

            <? if (array_search("110", $arItem['DISPLAY_PROPERTIES']['AGE']['VALUE_ENUM_ID']) !== false) : ?>
              <div class="specialists-item__specialty--item specialists-item__specialty--children">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M21.8218 13.1639H23.175C23.6299 13.1639 24 13.534 24 13.9889V14.9357C24 15.3907 23.6299 15.7608 23.175 15.7608H21.8218V16.5742C21.8218 17.4404 21.3153 18.2382 20.5314 18.6066L12.3516 22.4512V23.6484C12.3516 23.8426 12.1942 24 12 24C11.8058 24 11.6484 23.8426 11.6484 23.6484V22.4512L3.46856 18.6067C2.68467 18.2383 2.17814 17.4405 2.17814 16.5743V15.7609H0.825C0.370125 15.7609 0 15.3907 0 14.9358V13.989C0 13.5341 0.370078 13.164 0.825 13.164H2.17819V12.3495C2.17819 11.8316 2.35936 11.3256 2.68842 10.9247C2.90091 10.6655 3.16256 10.4615 3.46598 10.3183L10.2281 7.13634V1.77188C10.2281 0.794859 11.023 0 12 0C12.4733 0 12.9184 0.184406 13.2532 0.519234C13.5876 0.853734 13.7719 1.29862 13.7719 1.77188V3.96094C13.7719 4.15514 13.6145 4.3125 13.4203 4.3125C13.2261 4.3125 13.0688 4.15514 13.0688 3.96094V1.77188C13.0688 1.48641 12.9577 1.21809 12.7559 1.01644C12.5539 0.814359 12.2854 0.703125 12 0.703125C11.4106 0.703125 10.9312 1.18256 10.9312 1.77188V7.008H13.0687V5.60156C13.0687 5.40736 13.2261 5.25 13.4203 5.25C13.6145 5.25 13.7718 5.40736 13.7718 5.60156V7.13634L20.534 10.3183C20.8375 10.4614 21.0991 10.6655 21.3117 10.9248C21.6406 11.3255 21.8218 11.8315 21.8218 12.3495V13.1639ZM17.3668 9.60516H6.63319L4.10241 10.7961H19.8976L17.3668 9.60516ZM10.6581 7.71112H13.3419L15.8727 8.90203H8.12733L10.6581 7.71112ZM23.175 15.0577C23.2422 15.0577 23.2969 15.003 23.2969 14.9358V13.9889C23.2969 13.9216 23.2422 13.867 23.175 13.867H5.55797C5.36381 13.867 5.20641 13.7096 5.20641 13.5154C5.20641 13.3212 5.36381 13.1639 5.55797 13.1639H21.1187V12.3494C21.1187 12.047 21.0284 11.7505 20.8624 11.4992H3.13758C2.97155 11.7506 2.88127 12.047 2.88127 12.3494V13.1639H3.91734C4.1115 13.1639 4.26891 13.3212 4.26891 13.5154C4.26891 13.7096 4.1115 13.867 3.91734 13.867H0.825C0.757828 13.867 0.703125 13.9216 0.703125 13.9889V14.9357C0.703125 15.003 0.757781 15.0577 0.825 15.0577H18.5264C18.7206 15.0577 18.878 15.215 18.878 15.4092C18.878 15.6034 18.7206 15.7608 18.5264 15.7608H2.88127V16.5742C2.88127 17.1692 3.22922 17.7172 3.76767 17.9702L12 21.8394L20.2323 17.9703C20.7708 17.7173 21.1187 17.1692 21.1187 16.5743V15.7608H20.167C19.9728 15.7608 19.8155 15.6035 19.8155 15.4093C19.8155 15.2151 19.9728 15.0577 20.167 15.0577H23.175Z" fill="#75A72D" />
                </svg>
                <div class="specialist-tooltip">Принимает детей</div>
              </div>
            <? endif; ?>
          </div>
        </div>
        <div class="specialists-item__content">
          <h4 class="specialists-item__title"><?= $arItem["NAME"] ?></h4>
          <?
          if (is_array($arItem['DISPLAY_PROPERTIES']['SPECIALIZATION']['DISPLAY_VALUE'])) :
            foreach ($arItem['DISPLAY_PROPERTIES']['SPECIALIZATION']['DISPLAY_VALUE'] as $arValue) :
          ?>
              <div class="specialists-item__position"><?= $arValue ?></div>
            <? endforeach;
          else :
            ?>
            <div class="specialists-item__position">
              <?= $arItem['DISPLAY_PROPERTIES']['SPECIALIZATION']['DISPLAY_VALUE']; ?></div>
          <? endif; ?>

          <div class="specialists-item__place">
            <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 0.0078125C2.0142 0.0078125 0 1.95819 0 4.37406C0 8.55131 4.5 13.9991 4.5 13.9991C4.5 13.9991 9 8.55044 9 4.37406C9 1.95906 6.9858 0.0078125 4.5 0.0078125ZM4.5 6.78994C3.1572 6.78994 2.07 5.73206 2.07 4.42744C2.07 3.12281 3.1572 2.06494 4.5 2.06494C5.841 2.06494 6.9291 3.12281 6.9291 4.42744C6.9291 5.73206 5.841 6.78994 4.5 6.78994Z" fill="#75A72D" />
            </svg>
            <?
            if (is_array($arItem['DISPLAY_PROPERTIES']['CLINIC']['DISPLAY_VALUE'])) :
            ?>
              Центр:
              <? foreach ($arItem['DISPLAY_PROPERTIES']['CLINIC']['DISPLAY_VALUE'] as $key => $clinic) : ?>
                <?= $clinic . '<br>'; ?>
              <? endforeach; ?>

            <? else : ?>
              Центр: <?= $arItem['DISPLAY_PROPERTIES']['CLINIC']['DISPLAY_VALUE']; ?>
            <? endif; ?>
          </div>
          <div class="specialists-item__admission">


            <div class="specialists-item__admission--time">
              <? if ($arTime[0]['time'] != '') : ?>
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M16 2H15V4H12V2H6V4H3V2H2C0.899 2 0 2.9 0 4V16C0 17.1 0.899 18 2 18H16C17.1 18 18 17.1 18 16V4C18 2.9 17.1 2 16 2ZM16 16H2V8H16V16ZM5.5 0H3.5V3.5H5.5V0ZM14.5 0H12.5V3.5H14.5V0Z" fill="#75A72D"></path>
                </svg>

                <div class="specialists-item__admission--title">Приём</div>
                <a class="specialists-item__admission--link"><?= $arTime[0]['time'] ?></a>
              <? endif; ?>
            </div>

          </div>


          <div class="specialists-item__btn">
            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="btn btn-grey-tr our-team__btn">Записаться</a>
          </div>
          <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="specialists-item__link--hidden"></a>
        </div>
      </div>
    <? endforeach; ?>

  </div>

  <? if ($arParams["DISPLAY_BOTTOM_PAGER"]) : ?>
    <?= $arResult["NAV_STRING"] ?>
  <? endif; ?>

</div>