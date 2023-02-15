<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>

  <nav class="menu main-menu">
    <ul class="main-menu__list">
      <?$previousLevel = 0;
      foreach ($arResult as $arItem) :
		$target=(strpos($arItem["LINK"], '://')!==false)?'target="_blank" rel="nofollow"':'';

        if($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) : ?>
          <?= str_repeat("</ul></div></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
        <? endif ?>

        <? if ($arItem["IS_PARENT"]) : ?>

          <? if ($arItem["DEPTH_LEVEL"] == 1) : ?>
            <li class="drop-down 11">
              <?if(!empty($arItem["LINK"]) && !$arItem['PARAMS']['noPoint']){?>
				<a href="<?=$arItem["LINK"]?>" <?=$target?>><?=$arItem["TEXT"]?></a>
			  <?}else{?>
				<span><?=$arItem["TEXT"]?></span>
			  <?}?>
              <div class="mega-menu fadeIn anated">
                <div class="mm-6column">
                  <ul>
                  <? else : ?>
                    <li><span><img src="<?= SITE_TEMPLATE_PATH ?>/img/<?= $arItem["PARAMS"]["img"] ?>" alt="меню"></span>
						<a href=" <?= $arItem["LINK"] ?>" <?=$target?>><?= $arItem["TEXT"] ?></a></li>
                  <? endif ?>

                <? else : ?>

                  <? if ($arItem["PERMISSION"] > "D") : ?>

                    <? if ($arItem["DEPTH_LEVEL"] == 1) : ?>
                      <li class="drop-down 22"><a href="<?= $arItem["LINK"] ?>" <?=$target?>><?= $arItem["TEXT"] ?></a></li>
                    <? else : ?>
                      <li>
						  <span><img src="<?= SITE_TEMPLATE_PATH ?>/img/<?= $arItem["PARAMS"]["img"] ?>" alt="меню"></span>
						  <a <?if($arItem["PARAMS"]["data"]!='')echo 'data-fancybox=""'?> data-src="<?=$arItem["PARAMS"]["data"]?>" href="<?=$arItem["LINK"]?>" <?=$target?>><?= $arItem["TEXT"] ?></a>
					  </li>
                    <? endif; ?>

                  <? else : ?>

                    <? if ($arItem["DEPTH_LEVEL"] == 1) : ?>
                      <li class="drop-down 33"><a href="<?= $arItem["LINK"] ?>" <?=$target?>><?= $arItem["TEXT"] ?></a></li>
                    <? else : ?>
                      <li>
						  <span><img src="<?= SITE_TEMPLATE_PATH ?>/img/<?= $arItem["PARAMS"]["img"] ?>" alt="меню"></span>
						  <a href="<?= $arItem["LINK"] ?>" <?=$target?>><?= $arItem["TEXT"] ?></a>
					  </li>
                    <? endif; ?>

                  <? endif; ?>

                <? endif; ?>

                <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

              <? endforeach; ?>

              <? if ($previousLevel > 1) : //close
              ?>
                <?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
              <? endif; ?>

                  </ul>
  </nav>

<? endif; ?>