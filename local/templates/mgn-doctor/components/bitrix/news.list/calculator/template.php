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

<section class="health-calc" id="health-calc">
  <div class="container health-calc__container">
    <div class="row justify-content-between row-vmiddle">
      <h2 class="section-title health-calc__title">КАЛЬКУЛЯТОР ЗДОРОВЬЯ</h2>
      <?/*<div class="health-calc__btn-wrap">
        <a href="/calculator/" class="btn btn-grey-tr news__btn">Все тесты</a>
      </div>*/?>
    </div>
      <?/*
    <div class="mobile-row">
         <div class="health-calc-select">
        <select name="health-calc-select" id="health-calc-select">
          <option value="">Калькулятор нормы воды</option>
          <option value="">Экспресс тест на коронавирус</option>
          <option value="">Калькулятор даты родов</option>
          <option value="">Калькулятор калорий</option>
          <option value="">Календарь прививок</option>
          <option value="">Расчет нормы давления</option>
        </select>
      </div>
      <div class="health-calc-select__text" data-health-desc="">
        В случае острого заболевания или обострения хронического проводится экспертиза временной нетрудоспособности с выдачей "больничного листа" по болезни или по уходу за больным ребенком.
      </div>
    </div>*/?>

    <div class="row">
      <div class="health-calc__list health-calc__list--left">

      <? foreach ($arResult["ITEMS"] as $key=>$arItem) : ?>
        <? if( $key > 2) break; ?>
        <div class="health-calc__item health-calc-item" data-hcalc="hc-<?=$key?>">
          <h5 class="health-calc-item__title"><?=$arItem["NAME"]?></h5>
          <div class="line line-lred line-green"></div>
          <p class="health-calc-item__text"><?=$arItem["PREVIEW_TEXT"]?></p>

          <a class="a-link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">Рассчитать</a>
        </div>
      <? endforeach; ?>
      
      </div>

      <div class="health-calc__description health-calc__list--center">
        <div class="health-calc__img health-calc-description__img">
          <svg width="278" height="384" viewBox="0 0 278 384" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M168.298 141.628C169.466 139.079 170.523 133.039 169.8 129.105C169.077 125.116 168.298 105.002 170.523 99.6826C172.748 94.3632 170.078 84.6111 176.029 74.9697C181.981 65.3284 195.553 65.7162 195.553 65.7162C195.553 65.7162 208.29 61.5605 210.07 59.0116C211.85 56.4628 210.96 45.3254 210.96 45.3254C207.512 42.7765 207.122 35.2408 207.122 35.2408C207.122 35.2408 206.844 36.5706 205.509 35.684C204.174 34.7975 203.729 25.8765 204.119 25.1007C204.453 24.325 205.954 24.5466 205.954 24.5466C205.954 24.5466 203.841 12.9105 207.456 6.87084C211.072 0.88656 219.693 0 223.03 0C226.423 0 234.989 0.88656 238.605 6.87084C242.22 12.8551 240.107 24.5466 240.107 24.5466C240.107 24.5466 241.608 24.2696 241.942 25.1007C242.276 25.8765 241.831 34.7975 240.552 35.684C239.217 36.5706 238.939 35.2408 238.939 35.2408C238.939 35.2408 238.605 42.7211 235.101 45.3254C235.101 45.3254 234.211 56.4628 235.991 59.0116C237.77 61.5605 250.508 65.7162 250.508 65.7162C250.508 65.7162 264.08 65.3838 270.032 74.9697C275.983 84.6111 273.313 94.4186 275.538 99.6826C277.763 105.002 276.929 125.116 276.261 129.105C275.538 133.095 276.595 139.079 277.763 141.628C278.931 144.177 275.371 186.122 275.928 191.885C276.484 197.647 278.319 213.051 277.596 214.381C276.873 215.711 272.201 227.513 267.306 228.234C267.306 228.234 263.746 230.783 262.523 230.007C261.299 229.231 262.801 227.458 262.801 227.458C262.801 227.458 261.799 227.624 261.188 227.015C260.576 226.405 265.86 221.252 265.86 221.252C265.86 221.252 263.19 222.416 262.3 221.363C261.41 220.31 269.142 216.265 270.477 213.218C271.812 210.226 270.032 208.286 270.032 208.286L267.807 209.339C267.807 209.339 265.693 216.321 264.191 216.376C262.689 216.487 261.688 216.487 262.968 208.231C262.968 208.231 261.188 202.136 262.634 199.421C264.024 196.705 265.637 195.985 265.637 193.048C265.637 190.112 261.299 174.929 259.853 166.562C258.462 158.196 261.076 141.85 259.686 138.636C258.295 135.477 256.571 127.942 256.515 122.567C256.404 117.192 255.014 110.044 253.679 108.271C252.344 106.498 254.29 118.522 251.287 126.224C248.339 133.926 250.397 147.224 251.787 152.987C253.234 158.75 257.906 190.943 258.351 202.69C258.796 214.437 255.403 257.989 255.848 264.25C256.293 270.512 259.296 279.377 259.296 297.385C259.296 315.394 256.293 316.89 253.734 324.426C251.176 331.906 248.617 351.466 248.839 355.067C248.839 355.067 250.397 357.616 250.452 359.112C250.508 360.608 250.452 362.492 250.953 364.321C251.509 366.149 256.905 379.226 255.292 381.11C253.679 382.938 244.278 383.16 240.997 382.883C240.997 382.883 240.218 384.379 236.936 383.88C233.654 383.326 234.099 371.856 235.101 365.872C236.102 359.888 233.265 358.392 234.099 354.569C234.989 350.745 236.658 349.083 236.825 347.421C236.992 345.758 238.327 326.254 236.046 316.779C233.766 307.304 234.099 292.953 236.324 286.58C238.549 280.208 235.267 276.717 232.876 269.016C230.484 261.314 229.26 242.696 229.26 234.495C229.26 226.294 226.535 220.532 225.2 215.767C223.865 211.001 224.032 204.13 224.032 204.13L222.975 203.687L221.918 204.13C221.918 204.13 222.085 211.001 220.75 215.767C219.415 220.532 216.689 226.294 216.689 234.495C216.689 242.696 215.466 261.314 213.074 269.016C210.682 276.717 207.401 280.208 209.625 286.58C211.85 292.953 212.184 307.359 209.904 316.779C207.623 326.199 208.902 345.758 209.125 347.421C209.292 349.083 210.96 350.801 211.85 354.569C212.74 358.392 209.904 359.888 210.849 365.872C211.85 371.856 212.24 383.382 209.014 383.88C205.732 384.435 204.953 382.883 204.953 382.883C201.671 383.16 192.271 382.994 190.658 381.11C189.045 379.281 194.496 366.205 194.997 364.321C195.553 362.492 195.442 360.608 195.497 359.112C195.553 357.616 197.11 355.067 197.11 355.067C197.388 351.466 194.83 331.906 192.216 324.426C189.657 316.945 186.653 315.394 186.653 297.385C186.653 279.377 189.657 270.567 190.102 264.25C190.547 257.989 187.154 214.437 187.599 202.69C188.044 190.943 192.716 158.694 194.162 152.987C195.609 147.224 197.611 133.926 194.663 126.224C191.715 118.522 193.606 106.553 192.271 108.271C190.936 110.044 189.546 117.192 189.434 122.567C189.323 127.942 187.654 135.477 186.264 138.636C184.818 141.794 187.488 158.14 186.097 166.562C184.706 174.929 180.312 190.112 180.312 193.048C180.312 195.985 181.925 196.65 183.316 199.421C184.706 202.136 182.982 208.231 182.982 208.231C184.206 216.431 183.26 216.431 181.758 216.376C180.257 216.265 178.143 209.339 178.143 209.339L175.918 208.286C175.918 208.286 174.138 210.226 175.473 213.218C176.808 216.21 184.54 220.255 183.65 221.363C182.76 222.416 180.09 221.252 180.09 221.252C180.09 221.252 185.43 226.35 184.762 227.015C184.15 227.624 183.149 227.458 183.149 227.458C183.149 227.458 184.651 229.231 183.427 230.007C182.203 230.783 178.644 228.234 178.644 228.234C173.749 227.513 169.077 215.711 168.353 214.381C167.63 213.051 169.521 197.592 170.022 191.885C170.69 186.178 167.13 144.232 168.298 141.628Z" fill="#FFDBBC" />
            <path d="M1.85096 196.477C1.85096 196.477 3.73099 191.429 3.34392 169.576C3.01215 147.777 5.00277 143.728 5.88749 139.513C6.71692 135.297 8.0993 120.931 8.92872 104.014C9.75815 87.0968 11.6382 87.0968 13.7947 83.0478C16.0065 78.9987 32.8162 75.1161 35.1939 74.0622C37.5716 73.0638 40.3916 70.8451 40.7234 69.0147C41.0551 67.1289 40.7234 58.3652 40.7234 58.3652C35.968 53.9833 35.5256 46.7727 35.5256 46.7727C33.8668 46.8836 33.7009 44.1103 33.6456 43.2228C33.5903 42.3353 32.4844 38.2863 32.5397 36.2895C32.595 34.2927 35.0833 34.9583 35.0833 34.9583C35.0833 19.0394 43.2669 17.4863 49.0176 17.4863C54.7683 17.4863 62.952 19.0394 62.952 34.9583C62.952 34.9583 65.4403 34.2372 65.4956 36.2895C65.5509 38.2863 64.445 42.3353 64.3897 43.2228C64.3344 44.1103 64.1685 46.8836 62.5096 46.7727C62.5096 46.7727 62.012 53.9833 57.3119 58.3652C57.3119 58.3652 56.9801 67.1289 57.3119 69.0147C57.6437 70.9006 60.519 73.0638 62.8414 74.0622C65.2191 75.0606 82.0288 78.9433 84.2406 83.0478C86.4524 87.0968 88.2771 87.0968 89.1065 104.014C89.936 120.931 91.3184 135.297 92.1478 139.513C92.9772 143.728 95.0231 147.777 94.6913 169.576C94.3596 191.374 96.1843 196.477 96.1843 196.477C96.1843 196.477 99.2255 211.675 97.5114 215.225C95.8525 218.774 93.8066 221.326 92.8113 221.159C91.816 220.993 92.3137 219.107 92.3137 219.107C92.3137 219.107 88.1112 221.825 87.1159 221.159C86.1206 220.494 85.7888 220.993 84.9041 219.773C84.0747 218.608 85.5677 217.388 85.5677 217.388C85.5677 217.388 84.5723 217.055 83.9088 216.223C83.2453 215.391 88.6089 212.34 88.6089 208.125C88.6089 203.909 87.7795 199.139 89.1065 194.258C90.4336 189.377 83.0241 175.344 81.8629 160.424C80.7017 145.503 82.1947 145.725 81.0335 140.788C79.8723 135.907 74.7851 118.491 74.7851 112.556C74.7851 112.334 74.7851 112.112 74.7851 111.89C74.7851 111.89 73.458 120.155 71.2462 122.706C69.0344 125.258 67.8732 141.454 68.5368 143.506C69.2003 145.559 81.5311 173.07 81.3652 191.152C81.1993 209.234 73.1263 243.069 73.5686 248.948C73.9557 254.883 76.1675 272.799 76.3334 287.331C76.4993 301.863 66.5462 336.031 66.8779 351.062C67.2097 366.094 72.9604 375.745 71.2462 378.463C69.5874 381.18 64.1685 382.844 62.2884 382.844C62.2884 382.844 60.9614 384.508 58.5837 383.843C56.206 383.177 55.5424 377.409 56.0401 371.141C56.5378 364.873 56.3719 356.609 55.2107 353.059C54.0495 349.509 59.4131 344.794 58.5837 339.192C57.7542 333.59 59.579 329.208 57.2566 314.343C54.8789 299.478 55.4319 284.447 56.9248 277.181C58.4178 269.915 55.0448 253.996 53.7177 249.281C52.3906 244.566 49.0176 209.567 49.0176 209.567C49.0176 209.567 45.6999 244.566 44.3176 249.281C42.9905 253.996 39.6175 269.915 41.1104 277.181C42.6034 284.447 43.1564 299.478 40.7787 314.343C38.401 329.208 40.281 333.59 39.4516 339.192C38.6222 344.794 43.9858 349.509 42.8246 353.059C41.6634 356.609 41.4975 364.873 41.9952 371.141C42.4928 377.409 41.8293 383.122 39.4516 383.843C37.0739 384.508 35.7468 382.844 35.7468 382.844C33.8668 382.844 28.5032 381.18 26.789 378.463C25.1302 375.745 30.8256 366.149 31.1573 351.062C31.4891 336.031 21.536 301.863 21.7019 287.331C21.8678 272.799 24.0796 254.883 24.4666 248.948C24.8537 243.013 16.8359 209.234 16.67 191.152C16.5041 173.07 28.7796 145.503 29.4985 143.506C30.162 141.454 29.0008 125.258 26.789 122.706C24.5772 120.155 23.2501 111.89 23.2501 111.89C23.2501 112.112 23.2501 112.334 23.2501 112.556C23.2501 118.491 18.2183 135.907 17.0018 140.788C15.8406 145.67 17.3336 145.503 16.1724 160.424C15.0112 175.289 7.60164 189.322 8.92872 194.258C10.2558 199.139 9.42638 203.909 9.42638 208.125C9.42638 212.34 14.8453 215.391 14.1265 216.223C13.4629 217.055 12.4676 217.388 12.4676 217.388C12.4676 217.388 13.9606 218.553 13.1311 219.773C12.3017 220.938 11.9699 220.438 10.9193 221.159C9.92403 221.825 5.72161 219.107 5.72161 219.107C5.72161 219.107 6.21926 220.993 5.22395 221.159C4.22864 221.326 2.18273 218.774 0.523875 215.225C-1.19027 211.675 1.85096 196.477 1.85096 196.477Z" fill="#FFDBBC" />
            
            <? foreach ($arResult["ITEMS"] as $key=>$arItem) : ?>
              <circle id="hc-<?=$key?>"  cx="<?=$arItem["PROPERTIES"]["POINT_X"]["VALUE"];?>" cy="<?=$arItem["PROPERTIES"]["POINT_Y"]["VALUE"];?>" r="<?=$arItem["PROPERTIES"]["SIZE"]["VALUE"];?>" fill="#7ED321" stroke="white" stroke-width="1.4" />
            <? endforeach; ?>

          </svg>

        </div>
        <div class="health-calc-description__info">
          <h5 class="health-calc-description__title">Заголовок текста выбранного раздела</h5>
          <p class="health-calc-description__text">В случае острого заболевания или обострения хронического проводится экспертиза временной нетрудоспособности с выдачей "больничного листа" </p>
        </div>
      </div>

      <div class="health-calc__list health-calc__list--right">
        <? foreach ($arResult["ITEMS"] as $key=>$arItem) : ?>
          <? if( $key < 3) continue ; ?>
          <div class="health-calc__item health-calc-item" data-hcalc="hc-<?=$key?>">
            <h5 class="health-calc-item__title"><?=$arItem["NAME"]?></h5>
            <div class="line line-lred line-green"></div>
            <p class="health-calc-item__text"><?=$arItem["PREVIEW_TEXT"]?></p>
            <a class="a-link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">Рассчитать</a>
          </div>
        <? endforeach; ?>
      </div>

    </div>
  </div>
</section>

