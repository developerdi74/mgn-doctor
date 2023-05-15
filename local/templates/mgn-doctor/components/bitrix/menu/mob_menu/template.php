<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>

  <nav class="burger-menu__nav">
    <ul>
      <?
      $previousLevel = 0;
      foreach ($arResult as $arItem) : ?>

        <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) : ?>
          <?= str_repeat("</ul></div></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
        <? endif ?>

        <? if ($arItem["IS_PARENT"]) : ?>

          <? if ($arItem["DEPTH_LEVEL"] == 1) : ?>
            <li class="drop-down has-submenu"> <a href="#"><?= $arItem["TEXT"] ?></a>
              <div class='onPress'></div>
              <span class="submenu-icon">
                <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.327898 0.35799C0.778951 -0.101145 1.40691 -0.137175 1.95831 0.35799L6.00123 4.21534L10.0441 0.35799C10.5955 -0.137175 11.2245 -0.101145 11.6725 0.35799C12.1235 0.816095 12.0946 1.59024 11.6725 2.02055C11.2525 2.45086 6.8154 6.65513 6.8154 6.65513C6.5909 6.8847 6.29606 7 6.00123 7C5.70639 7 5.41155 6.8847 5.18499 6.65513C5.18499 6.65513 0.749984 2.45086 0.327898 2.02055C-0.0952218 1.59024 -0.123154 0.816095 0.327898 0.35799Z"></path>
                </svg>
              </span>
              <div class="mega-menu fadeIn animated">
                <div class="mm-6column">
                  <ul>
          <? else : ?>
                    <li><span><img src="<?= SITE_TEMPLATE_PATH ?>/img/<?= $arItem["PARAMS"]["img"] ?>" alt="меню"></span><a <?if($arItem["PARAMS"]["data"]!='')echo 'data-fancybox=""'?> data-src="<?=$arItem["PARAMS"]["data"]?>"  href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
          <? endif ?>

        <? else : ?>
          <? if ($arItem["PERMISSION"] > "D") : ?>
                    <? if ($arItem["DEPTH_LEVEL"] == 1) : ?>
                      <li class="drop-down"><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                    <? else : ?>
                      <li><span><img src="<?= SITE_TEMPLATE_PATH ?>/img/<?= $arItem["PARAMS"]["img"] ?>" alt="меню"></span><a <?if($arItem["PARAMS"]["data"]!='')echo 'data-fancybox=""'?> data-src="<?=$arItem["PARAMS"]["data"]?>"  href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                    <? endif ?>

          <? else : ?>

                    <? if ($arItem["DEPTH_LEVEL"] == 1) : ?>
                      <li class="drop-down"><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                    <? else : ?>
                      <li><span><img src="<?= SITE_TEMPLATE_PATH ?>/img/<?= $arItem["PARAMS"]["img"] ?>" alt="меню"></span><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                    <? endif ?>

          <? endif ?>

        <? endif ?>

                <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

              <? endforeach ?>

              <? if ($previousLevel > 1) : //close last item tags
              ?>
                <?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
              <? endif ?>

                  </ul>
  </nav>

<? endif ?>


<?/*
		<li class="active drop-down">
                    <a href="/page-services_and_prices.html">Пациентам</a>
                    <div class="mega-menu fadeIn animated">
                      <div class="mm-6column">
                        <ul>
                          <li><span><img src="../img/menu-icon-1.png" alt="меню"></span><a href="/page-service-item.html">Запрос на НДФЛ</a></li>
                          <li><span><img src="../img/menu-icon-2.png" alt=""></span><a href="/page-service-item.html">Запрос на результаты анализов</a></li>
                          <li><span><img src="../img/menu-icon-3.png" alt=""></span><a href="/page-service-item.html">Справки</a></li>
                          <li><span><img src="../img/menu-icon-4.png" alt=""></span><a href="/page-service-item.html">Задать вопрос</a></li>
                          <li><span><img src="../img/menu-icon-5.png" alt=""></span><a href="/page-service-item.html">Оставить отзыв</a></li>
                          <li><span><img src="../img/menu-icon-6.png" alt=""></span><a href="#order-call" data-fancybox="" data-src="#order-call">Записаться к врачу</a></li>
                          <li><span><img src="../img/menu-icon-7.png" alt=""></span><a href="/page-service-item.html">Памятки</a></li>
                          <li><span><img src="../img/menu-icon-8.png" alt=""></span><a href="/page-service-item.html">Согласие родителей</a></li>
                        </ul>
                      </div>
                    </div>
                  </li>
                  <li class="drop-down">
                    <a href="/page-all-doctors.html">Врачи</a>
                    <div class="mega-menu fadeIn animated">
                      <div class="mm-6column">
                        <ul>
                          <li><span><img src="../img/menu-icon-8.png" alt="меню"></span><a href="/page-service-item.html">Взрослые</a></li>
                          <li><span><img src="../img/menu-icon-8.png" alt=""></span><a href="/page-service-item.html">Детские</a></li>
                        </ul>
                      </div>
                    </div>
                  </li>
                  <li >
                    <a href="/page-services_and_prices.html">Услуги</a>
                  </li>
                  <li>
                    <a href="/404.html">Аптека</a>
                  </li>
                  <li class="drop-down">
                    <a href="/contacts.html">О нас</a>
                    <div class="mega-menu fadeIn animated">
                      <div class="mm-6column">
                        <ul>
                          <li><span><img src="../img/menu-icon-8.png" alt="меню"></span><a href="/page-news.html">Новости</a></li>
                          <li><span><img src="../img/menu-icon-8.png" alt=""></span><a href="/contacts.html">О клинике жукова</a></li>
                          <li><span><img src="../img/menu-icon-8.png" alt=""></span><a href="/contacts.html">О клинике доменщиков</a></li>
                        </ul>
                      </div>
                    </div>
                  </li>
                </ul>
            </nav>
 

*/ ?>