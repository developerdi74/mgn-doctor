<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Запись на прием");


$DOCTOR_ID = $_GET['DOCTOR'];
$CLINIC = $_GET['CLINIC'];

$SERVICE = $_GET['SERVICE'];

CModule::IncludeModule("iblock");

if ($SERVICE != '') {
    $arSelect = array("IBLOCK_ID", "ID", "NAME", 'IBLOCK_SECTION_ID', "PROPERTY_*");
    $arFilter = array("IBLOCK_ID" => '24', 'ID' =>  $SERVICE, "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);
    $ob = $res->GetNextElement();
    $arProps = $ob->GetProperties();

    $SPECIALIZATION =  $arProps['SPECIALIZATION']['VALUE'];
}

$arSelect = array("IBLOCK_ID", "ID", "NAME", 'IBLOCK_SECTION_ID', "PROPERTY_*");
$arFilter = array("IBLOCK_ID" => '25', 'ID' =>  $_GET['DOCTOR'], "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);

$ob = $res->GetNextElement();
$arProps = $ob->GetProperties();

if (count($arProps['CLINIC']['VALUE_ENUM_ID']) > 1) {
    $OPENCLINIK = 'ALL';
} else {
    $OPENCLINIK = ($CLINIC != '') ? $arProps['CLINIC']['VALUE_ENUM_ID'] : $CLINIC;
}
$AGE = $arProps['AGE']['VALUE_ENUM_ID'];

$dbGroups = CIBlockElement::GetElementGroups($DOCTOR, true);
$arNewGroups = array($NEW_GROUP_ID);

while ($arGroup = $dbGroups->Fetch())
    $arNewGroups[] = $ar_group["ID"];


$rsSection = CIBlockSection::GetList(
    array("SORT" => "ASC"),
    array("IBLOCK_ID" => '25'),
    true,
    $arSelect = array("UF_*")
);

$Section = array();

while ($arSection = $rsSection->GetNext())
    $Section[] = $arSection;

$Doctor = array();


$SECTION_ID =  ($SPECIALIZATION != '') ? $SPECIALIZATION : $arNewGroups[1];


$arSelect = array("ID", "NAME", 'IBLOCK_SECTION_ID', "catalog_PRICE_1");
$arFilter = array("IBLOCK_ID" => '25', "IBLOCK_SECTION_ID" => $SECTION_ID, "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);

while ($arDoctor = $res->GetNext()) {
    $Doctor[] = $arDoctor;
}

$arSelect = array("IBLOCK_ID", "ID", "NAME", 'IBLOCK_SECTION_ID', "PROPERTY_*");
$arFilter = array("IBLOCK_ID" => '25', 'ID' =>  $_GET['DOCTOR'], "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);
$ob = $res->GetNextElement();
$arProps = $ob->GetProperties();

foreach ($arProps['SERVICE']['VALUE'] as $arValue) {
    $arSelect = array("ID", "NAME", "IBLOCK_ID",  "IBLOCK_ID", "CATALOG_PRICE_1", "PROPERTY_*");
    $arFilter = array("IBLOCK_ID" => "24", "ID" => $arValue, "ACTIVE" => "Y");

    $res1 = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, $arPages, $arSelect);
    while ($ob1 = $res1->GetNextElement()) {
        $arProps = $ob1->GetProperties();
        $arFields = $ob1->GetFields();
        $arElement[]  = $arFields;
        $arElement[array_key_last($arElement)]["PROPERTIES"] = $arProps;
    }
}
?>


<div id="page" class="site page-forms page-dark-grey">



    <!-- PAGE FORM 1  -->
    <section class="page-form page-form-1" id="page-form-1">
        <div class="container">

            <div class="row page-form__row--title">
                <div class="page-form__step">
                    <svg width="94" height="22" viewBox="0 0 94 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.268 20V0.651999H3.908V17.06H9.088V0.651999H12.56V17.06H17.768V0.651999H21.408V20H0.268ZM29.0424 15.52L27.8384 20H24.0024L30.0224 0.651999H34.5864L40.5784 20H36.6584L35.4544 15.52H29.0424ZM32.2344 3.48L29.7704 12.72H34.7264L32.2344 3.48ZM46.8973 3.648V20H43.2013V0.651999H55.0453L54.5973 3.648H46.8973ZM79.7669 21.944L77.7689 21.476L81.9809 5.384L83.9609 5.834L79.7669 21.944ZM89.6342 7.67C90.4382 7.67 91.1282 7.808 91.7042 8.084C92.2922 8.36 92.7302 8.732 93.0182 9.2C93.3182 9.668 93.4682 10.184 93.4682 10.748C93.4682 11.48 93.2582 12.092 92.8382 12.584C92.4182 13.064 91.8422 13.4 91.1102 13.592C91.9142 13.664 92.5742 13.952 93.0902 14.456C93.6062 14.96 93.8642 15.656 93.8642 16.544C93.8642 17.24 93.6842 17.87 93.3242 18.434C92.9762 18.998 92.4722 19.448 91.8122 19.784C91.1522 20.108 90.3722 20.27 89.4722 20.27C87.8162 20.27 86.5082 19.688 85.5482 18.524L86.8622 17.282C87.2222 17.69 87.6062 17.99 88.0142 18.182C88.4222 18.374 88.8662 18.47 89.3462 18.47C89.9942 18.47 90.5102 18.29 90.8942 17.93C91.2902 17.558 91.4882 17.06 91.4882 16.436C91.4882 15.74 91.3022 15.242 90.9302 14.942C90.5702 14.642 90.0302 14.492 89.3102 14.492H88.3562L88.6262 12.854H89.2742C89.8622 12.854 90.3302 12.692 90.6782 12.368C91.0382 12.044 91.2182 11.594 91.2182 11.018C91.2182 10.526 91.0562 10.142 90.7322 9.866C90.4082 9.578 89.9762 9.434 89.4362 9.434C88.9682 9.434 88.5422 9.524 88.1582 9.704C87.7742 9.872 87.3902 10.136 87.0062 10.496L85.8362 9.218C86.9282 8.186 88.1942 7.67 89.6342 7.67Z" fill="#A6ADB4" />
                        <path d="M69.5248 20V4.768L65.3248 7.316L63.7568 4.908L69.8888 1.156H73.0528V20H69.5248Z" fill="#75A72D" />
                    </svg>
                </div>
                <h1 class="page-form__title">Запись на приём</h1>
            </div>

            <div class="row page-form__row">
                <form id="form1" action="" method="post" class="wpcf7-form init wpcf7-acceptance-as-validation" novalidate="novalidate" data-status="init">

                    <div class="page-form__item">
                        <div class="page-form__name">
                            Клиника
                        </div>
                        <div class="page-form__content page-form__content--clinic">
                            <div class="clinic-radio">
                                <input type="radio" <? if ($OPENCLINIK != 'ALL' && $CLINIC != '108') echo "disabled"  ?> id="clinicChoice1" name="ADDRESS" value="ул. Жукова, д.11" <? if ($_GET['CLINIC'] == '108') echo "checked"; ?>>
                                <label for="clinicChoice1"> ул. Жукова, д.11</label>
                            </div>

                            <div class="clinic-radio">
                                <input type="radio" <? if ($OPENCLINIK != 'ALL' && $CLINIC != '109') echo "disabled"  ?> id="clinicChoice2" name="ADDRESS" value="ул. Доменщиков, д.8А" <? if ($_GET['CLINIC'] == '109') echo "checked"; ?>>
                                <label for="clinicChoice2"> ул. Доменщиков, д.8А</label>
                            </div>
                        </div>
                    </div>

                    <div class="page-form__item page-form__item--age">
                        <div class="page-form__name">
                            Пациент
                        </div>
                        <div class="page-form__content form-check">
                            <div class="contact-subitem contact-radio contact--invalid">
                                <label for="ageChoice1">
                                    <input type="radio" id="ageChoice1" name="AGE" value="111" <? if (array_search('111', $AGE) === false) echo "disabled"; ?>>
                                    Взрослый</label>
                                <? if (array_search('111', $AGE) === false) : ?>
                                    <div class="error">
                                        Данный специалист прием взрослых не ведет
                                    </div>
                                <? endif; ?>
                            </div>
                            <div class="contact-subitem contact-radio contact--invalid">
                                <label for="ageChoice2"> <input type="radio" id="ageChoice2" name="AGE" value="110" <? if (array_search('110', $AGE) === false) echo "disabled"; ?>>
                                    Ребенок до 18 лет</label>
                                <? if (array_search('110', $AGE) === false) : ?>
                                    <div class="error">
                                        Данный специалист прием детей не ведет
                                    </div>
                                <? endif; ?>
                            </div>
                            <span class="form-check__hint">Выберите возраст пациэнта</span>
                        </div>
                    </div>

                    <div class="page-form__item page-form__item--doctor">
                        <div class="page-form__name">
                            Врач
                        </div>
                        <div class="page-form__content">
                            <select id="selectSpecialization" name="SPECIALIZATION" id="">
                                <? foreach ($Section as $Item) {
                                    if ($SPECIALIZATION != '' &&  $Item['ID'] == $SPECIALIZATION)
                                        echo '<option selected value="' . $Item['ID'] . '">' . $Item['NAME'] . '</option>';
                                    elseif ($Item['ID'] == $arNewGroups['1'])
                                        echo '<option selected value="' . $Item['ID'] . '">' . $Item['NAME'] . '</option>';
                                    else
                                        echo '<option value="' . $Item['ID'] . '">' . $Item['NAME'] . '</option>';
                                } ?>
                            </select>

                            <select id="selectDoctor" name="DOCTOR" id="">
                                <? foreach ($Doctor as $Item) {
                                    if ($Item['ID'] == $_GET['DOCTOR'])
                                        echo '<option selected value="' . $Item['NAME'] . '">' . $Item['NAME'] . '</option>';
                                    else
                                        echo '<option value="' . $Item['NAME'] . '">' . $Item['NAME'] . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="page-form__item page-form__item--service">
                        <div class="page-form__name">
                            Услуга
                        </div>
                        <div class="page-form__content">
                            <div class="contact-subitem contact-subitem__service contact--invalid">
                                <select id="selectService" name="SERVICE" id="">
                                    <?
                                    foreach ($arElement as $key => $arItem) {
                                        $note = CFile::GetPath($arItem['PROPERTIES']['FILE']['VALUE']);
                                        if ($arItem['ID'] == $_GET['SERVICE']) {
                                            $noteActiv = CFile::GetPath($arItem['PROPERTIES']['FILE']['VALUE']);
                                            echo '<option data-note="' . $note . '" data-price="' . CurrencyFormat($arItem['CATALOG_PRICE_1'], "RUB") . '" data-section="' . $arItem['PROPERTIES']['SPECIALIZATION']['VALUE'] . '" selected value="' . $arItem['ID'] . '"> - ' . $arItem['NAME'] . ', <strong>' . CurrencyFormat($arItem['CATALOG_PRICE_1'], "RUB") . '</strong></option>';
                                        } else {
                                            echo '<option data-note="' . $note . '" data-price="' . CurrencyFormat($arItem['CATALOG_PRICE_1'], "RUB") . '" data-section="' .  $arItem['PROPERTIES']['SPECIALIZATION']['VALUE'] . '" value="' . $arItem['ID'] . '"> - ' . $arItem['NAME'] . ', <strong>' . CurrencyFormat($arItem['CATALOG_PRICE_1'], "RUB") . '</strong></option>';
                                        }
                                    }
                                    /*
                                    foreach ($arSection as $arSec) {
                                        echo '<option disabled value="">' . $arSec['NAME'] . '</option>';
                                        foreach ($arElement as $key => $arItem) {
                                            if ($arItem['IBLOCK_SECTION_ID'] == $arSec['ID']) {
                                                if ($arItem['ID'] == $_GET['ID']) {
                                                    echo '<option selected value="' . $arItem['ID'] . '"> - ' . $arItem['NAME'] . ', <strong>' . CurrencyFormat($arItem['CATALOG_PRICE_1'], "RUB") . '</strong></option>';
                                                } else {
                                                    echo '<option value="' . $arItem['ID'] . '"> - ' . $arItem['NAME'] . ', <strong>' . CurrencyFormat($arItem['CATALOG_PRICE_1'], "RUB") . '</strong></option>';
                                                }
                                            }
                                        }
                                    }*/
                                    ?>
                                </select>

                                <div class="<? if ($noteActiv != '') echo "note" ?> error error-with-icon">Внимание! Требуется <a id="note" href="<?= $noteActiv ?>" data-fancybox="file">подготовка</a></div>

                                <?/*
                                <span class="form-check__hint">Выберете услугу</span>
                                */ ?>
                            </div>
                        </div>
                    </div>


                    <div class="page-form__item page-form__item--doctor">
                        <div class="page-form__name">
                            Время
                        </div>
                        <div class="page-form__content">
                            <input name="DATE" type="date" value="<?php echo date("Y-m-d"); ?>">

                            <select name="TIME" id="">
                                <option value="Любое">Любое</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                            </select>
                        </div>
                    </div>

                    <div class="page-form__item page-form__btn page-form__btn-1">
                        <input type="submit" value="Далее" class="button page-form__submit">
                    </div>

                </form>

            </div>

        </div>
    </section>
    <!-- PAGE FORM END 1 -->


    <!-- PAGE FORM 2  -->
    <section class="page-form page-form-2 page-form-confirm" id="page-form-2">
        <div class="container">

            <div class="row page-form__row--title">
                <div class="page-form__step">
                    <svg width="96" height="22" viewBox="0 0 96 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.268 20V0.651999H3.908V17.06H9.088V0.651999H12.56V17.06H17.768V0.651999H21.408V20H0.268ZM29.0424 15.52L27.8384 20H24.0024L30.0224 0.651999H34.5864L40.5784 20H36.6584L35.4544 15.52H29.0424ZM32.2344 3.48L29.7704 12.72H34.7264L32.2344 3.48ZM46.8973 3.648V20H43.2013V0.651999H55.0453L54.5973 3.648H46.8973ZM81.3528 21.944L79.3548 21.476L83.5668 5.384L85.5468 5.834L81.3528 21.944ZM91.2201 7.67C92.0241 7.67 92.7141 7.808 93.2901 8.084C93.8781 8.36 94.3161 8.732 94.6041 9.2C94.9041 9.668 95.0541 10.184 95.0541 10.748C95.0541 11.48 94.8441 12.092 94.4241 12.584C94.0041 13.064 93.4281 13.4 92.6961 13.592C93.5001 13.664 94.1601 13.952 94.6761 14.456C95.1921 14.96 95.4501 15.656 95.4501 16.544C95.4501 17.24 95.2701 17.87 94.9101 18.434C94.5621 18.998 94.0581 19.448 93.3981 19.784C92.7381 20.108 91.9581 20.27 91.0581 20.27C89.4021 20.27 88.0941 19.688 87.1341 18.524L88.4481 17.282C88.8081 17.69 89.1921 17.99 89.6001 18.182C90.0081 18.374 90.4521 18.47 90.9321 18.47C91.5801 18.47 92.0961 18.29 92.4801 17.93C92.8761 17.558 93.0741 17.06 93.0741 16.436C93.0741 15.74 92.8881 15.242 92.5161 14.942C92.1561 14.642 91.6161 14.492 90.8961 14.492H89.9421L90.2121 12.854H90.8601C91.4481 12.854 91.9161 12.692 92.2641 12.368C92.6241 12.044 92.8041 11.594 92.8041 11.018C92.8041 10.526 92.6421 10.142 92.3181 9.866C91.9941 9.578 91.5621 9.434 91.0221 9.434C90.5541 9.434 90.1281 9.524 89.7441 9.704C89.3601 9.872 88.9761 10.136 88.5921 10.496L87.4221 9.218C88.5141 8.186 89.7801 7.67 91.2201 7.67Z" fill="#A6ADB4" />
                        <path d="M69.6368 0.819998C70.9061 0.819998 71.9981 1.05333 72.9128 1.52C73.8461 1.98667 74.5554 2.62133 75.0408 3.424C75.5261 4.22667 75.7688 5.12267 75.7688 6.112C75.7688 7.176 75.5354 8.20267 75.0688 9.192C74.6208 10.1627 73.8648 11.2453 72.8008 12.44C71.7368 13.6347 70.1781 15.212 68.1248 17.172H76.1888L75.7968 20H64.0648V17.368C66.4541 14.9413 68.1621 13.1493 69.1888 11.992C70.2341 10.816 70.9714 9.81733 71.4008 8.996C71.8488 8.156 72.0728 7.288 72.0728 6.392C72.0728 5.53333 71.8208 4.86133 71.3168 4.376C70.8314 3.89067 70.1781 3.648 69.3568 3.648C68.6288 3.648 67.9941 3.80667 67.4528 4.124C66.9114 4.42267 66.3421 4.92667 65.7448 5.636L63.5328 3.9C65.1194 1.84667 67.1541 0.819998 69.6368 0.819998Z" fill="#75A72D" />
                    </svg>
                </div>
                <h2 class="page-form__title">Подтвердите запись</h2>
            </div>

            <div class="row page-form__row page-form__row--confirm">
                <form action="" method="post" class="form init " novalidate="novalidate" data-status="init">

                    <h4 class="page-form-confirm__subtitle">Проверьте корректность выбранных параметров</h4>

                    <div class="page-form__item page-form__item--confirm">
                        <div class="page-form__name">
                            Клиника
                        </div>
                        <div class="page-form__content page-form__content">
                            <span>Семейный Доктор</span>
                        </div>
                    </div>

                    <div class="page-form__item page-form__item--confirm">
                        <div class="page-form__name">
                            Пациент
                        </div>
                        <div class="page-form__content">
                            <span>Взрослый</span>
                        </div>
                    </div>

                    <div class="page-form__item page-form__item--confirm">
                        <div class="page-form__name">
                            Адрес
                        </div>
                        <div class="page-form__content page-form__content">
                            <span class="confirm__addr">ул. Жукова, д.11</span>
                        </div>
                    </div>

                    <div class="page-form__item page-form__item--confirm">
                        <div class="page-form__name">
                            Специалист
                        </div>
                        <div class="page-form__content">
                            <span class="confirm__position">Кардиолог</span>, <span class="confirm__doc">Горбунова Наталья Анатольевна</span>
                        </div>
                    </div>

                    <div class="page-form__item page-form__item--confirm">
                        <div class="page-form__name">
                            Услуга
                        </div>
                        <div class="page-form__content">
                            <span class="confirm__serv">Приём (осмотр, консультация) врача кардиолога первичный</span>
                        </div>
                    </div>

                    <div class="page-form__item page-form__item--confirm">
                        <div class="page-form__name">
                            Дата приёма
                        </div>
                        <div class="page-form__content">
                            <span class="confirm__date">14 апреля</span>, <span class="confirm__time">14:00</span>
                        </div>
                    </div>

                    <div class="page-form__item page-form__item--confirm">
                        <div class="page-form__name">
                            Тип записи
                        </div>
                        <div class="page-form__content">
                            <span class="confirm__typerec">Прием по талону</span>
                        </div>
                    </div>

                    <div class="page-form__item page-form__item--confirm">
                        <div class="page-form__name">
                            Стоимость
                        </div>
                        <div class="page-form__content">
                            <span class="confirm__price">1 200 руб</span>
                        </div>
                    </div>

                    <div class="page-form__item page-form__btn page-form__btn-2 page-form__item--confirm">
                        <input type="submit" value="Подтвердить" class="button page-form__submit">
                    </div>

                </form>

            </div>

        </div>
    </section>
    <!-- PAGE FORM END 2 -->


    <!-- PAGE FORM 3  -->
    <section class="page-form page-form-3" id="page-form-3">
        <div class="container">

            <div class="row page-form__row--title">
                <div class="page-form__step">
                    <svg width="96" height="22" viewBox="0 0 96 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.268 20V0.651999H3.908V17.06H9.088V0.651999H12.56V17.06H17.768V0.651999H21.408V20H0.268ZM29.0424 15.52L27.8384 20H24.0024L30.0224 0.651999H34.5864L40.5784 20H36.6584L35.4544 15.52H29.0424ZM32.2344 3.48L29.7704 12.72H34.7264L32.2344 3.48ZM46.8973 3.648V20H43.2013V0.651999H55.0453L54.5973 3.648H46.8973ZM81.4349 21.944L79.4369 21.476L83.6489 5.384L85.6289 5.834L81.4349 21.944ZM91.3022 7.67C92.1062 7.67 92.7962 7.808 93.3722 8.084C93.9602 8.36 94.3982 8.732 94.6862 9.2C94.9862 9.668 95.1362 10.184 95.1362 10.748C95.1362 11.48 94.9262 12.092 94.5062 12.584C94.0862 13.064 93.5102 13.4 92.7782 13.592C93.5822 13.664 94.2422 13.952 94.7582 14.456C95.2742 14.96 95.5322 15.656 95.5322 16.544C95.5322 17.24 95.3522 17.87 94.9922 18.434C94.6442 18.998 94.1402 19.448 93.4802 19.784C92.8202 20.108 92.0402 20.27 91.1402 20.27C89.4842 20.27 88.1762 19.688 87.2162 18.524L88.5302 17.282C88.8902 17.69 89.2742 17.99 89.6822 18.182C90.0902 18.374 90.5342 18.47 91.0142 18.47C91.6622 18.47 92.1782 18.29 92.5622 17.93C92.9582 17.558 93.1562 17.06 93.1562 16.436C93.1562 15.74 92.9702 15.242 92.5982 14.942C92.2382 14.642 91.6982 14.492 90.9782 14.492H90.0242L90.2942 12.854H90.9422C91.5302 12.854 91.9982 12.692 92.3462 12.368C92.7062 12.044 92.8862 11.594 92.8862 11.018C92.8862 10.526 92.7242 10.142 92.4002 9.866C92.0762 9.578 91.6442 9.434 91.1042 9.434C90.6362 9.434 90.2102 9.524 89.8262 9.704C89.4422 9.872 89.0582 10.136 88.6742 10.496L87.5042 9.218C88.5962 8.186 89.8622 7.67 91.3022 7.67Z" fill="#A6ADB4" />
                        <path d="M69.6088 0.819998C70.8594 0.819998 71.9328 1.03466 72.8288 1.464C73.7434 1.89333 74.4248 2.472 74.8728 3.2C75.3394 3.928 75.5728 4.73067 75.5728 5.608C75.5728 6.74667 75.2461 7.69867 74.5928 8.464C73.9394 9.21067 73.0434 9.73333 71.9048 10.032C73.1554 10.144 74.1821 10.592 74.9848 11.376C75.7874 12.16 76.1888 13.2427 76.1888 14.624C76.1888 15.7067 75.9088 16.6867 75.3488 17.564C74.8074 18.4413 74.0234 19.1413 72.9968 19.664C71.9701 20.168 70.7568 20.42 69.3568 20.42C66.7808 20.42 64.7461 19.5147 63.2528 17.704L65.2968 15.772C65.8568 16.4067 66.4541 16.8733 67.0888 17.172C67.7234 17.4707 68.4141 17.62 69.1608 17.62C70.1688 17.62 70.9714 17.34 71.5688 16.78C72.1848 16.2013 72.4928 15.4267 72.4928 14.456C72.4928 13.3733 72.2034 12.5987 71.6248 12.132C71.0648 11.6653 70.2248 11.432 69.1048 11.432H67.6208L68.0408 8.884H69.0488C69.9634 8.884 70.6914 8.632 71.2328 8.128C71.7928 7.624 72.0728 6.924 72.0728 6.028C72.0728 5.26267 71.8208 4.66533 71.3168 4.236C70.8128 3.788 70.1408 3.564 69.3008 3.564C68.5728 3.564 67.9101 3.704 67.3128 3.984C66.7154 4.24533 66.1181 4.656 65.5208 5.216L63.7008 3.228C65.3994 1.62267 67.3688 0.819998 69.6088 0.819998Z" fill="#75A72D" />
                    </svg>

                </div>
                <h2 class="page-form__title">Запись на приём</h2>
            </div>

            <div class="row page-form__row page-form__row-3">

                <div class="form-contact-info page-form-3__col">
                    <h5>Контактные данные</h5>
                    <form id="form2" action="" method="post" class="form init" novalidate="novalidate" data-status="init">
                        <div class="contacts-form">

                            <div class="contacts-form__item contacts-form-6">
                                <label>Эл.почта*</label>
                                <input type="email" placeholder="name@example.ru" class="form-email" name="EMAIL" value="" required="">
                            </div>

                            <div class="contacts-form__item contacts-form-6">
                                <label>Телефон*</label>
                                <input type="tel" class="form-phone wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel contact-input" name="PHONE" value="" aria-required="true" placeholder='+7 (___) ___-__-__'>
                            </div>

                            <div class="contacts-form__item contacts-form-4">
                                <input type="text" class="form-soname" name="SURNAME" value="" aria-required="true" placeholder="Фамилия" required="">
                            </div>

                            <div class="contacts-form__item contacts-form-4">
                                <input type="text" class="form-name" name="NAME" value="" aria-required="true" placeholder="Имя" required="">
                            </div>

                            <div class="contacts-form__item contacts-form-4">
                                <input type="text" class="form-fatherhood" name="PATRONYMIC" value="" aria-required="true" placeholder="Отчество">
                            </div>

                            <div id="idlicenses" class="contacts-form__item contacts-form-12 contacts-form__accept form-accept">
                                <input type="checkbox" id="licenses_popup" name="licenses_popup" required="" value="Y" aria-required="true">
                                <label for="licenses_popup">
                                    Я принимаю ответственность за правильность предоставленных <noindex><a href="/privacy_policy.pdf" target="_blank">персональных данных</a></noindex> и даю согласие на их обработку
                                </label>
                            </div>
                            <?/*
                            <div class="page-form__item contacts-form__item contacts-form__item--payment contacts-form-12">
                                <div class="page-form__name">
                                    Оплата:
                                </div>
                                <div class="page-form__content">
                                    <div class="contact-subitem contact-radio  ">
                                        <input type="radio" id="payChoice1" name="contact" value="онлайн">
                                        <label for="payChoice1">онлайн</label>
                                    </div>

                                    <div class="contact-subitem contact-radio ">
                                        <input type="radio" id="payChoice2" name="contact" value="в клинике">
                                        <label for="payChoice2">в клинике</label>
                                    </div>
                                </div>
                            </div>
                                            */ ?>
                            <div class="contacts-form__item contacts-form-12 contacts-form__accept item--hidden form-accept form-accept--online">
                                <input type="checkbox" id="licenses_popup" name="licenses_popup" value="Y" aria-required="true">
                                <label for="licenses_popup">
                                    Соглашаюсь с <a href="/privacy_policy.pdf" target="_blank">договором оферты</a>, ознакомлен и принимаю <a href="/privacy_policy.pdf" target="_blank">информированное согласие на дистанционное консультирование</a>, его содержание мне понятно и соглашаюсь на <a href="/privacy_policy.pdf" target="_blank">обработку персональных данных</a>, в соответствии с Федеральным законом от 27.07.2006 года №152-ФЗ «О персональных данных», на условиях и для целей, определенных в Согласии на обработку персональных данных
                                </label>
                            </div>

                            <div class="contacts-form__item page-form__btn contacts-form-12 page-form__btn-3">
                                <input type="submit" value="Подтвердить" class="button page-form__submit">
                            </div>

                        </div>
                    </form>
                </div>

                <div class="form-visit-info page-form-3__col">
                    <h5 class="page-form-3__col--infotitle">Данные о приёме</h5>
                    <div class="">
                        <div class="page-form__item page-form__item--confirm">
                            <div class="page-form__name">
                                Дата приёма
                            </div>
                            <div class="page-form__content">
                                <span id="frm-date" class="confirm__date"></span>,
                                <span id="frm-time" class="confirm__time"></span>
                            </div>
                        </div>

                        <div class="page-form__item page-form__item--confirm">
                            <div class="page-form__name">
                                Пациент
                            </div>
                            <div class="page-form__content">
                                <span id="frm-age"></span>
                            </div>
                        </div>

                        <div class="page-form__item page-form__item--confirm">
                            <div class="page-form__name">
                                Услуга
                            </div>
                            <div class="page-form__content">
                                <span id="frm-service" class="confirm__serv"></span>
                            </div>
                        </div>


                        <div class="page-form__item page-form__item--confirm">
                            <div class="page-form__name">
                                Врач
                            </div>
                            <div class="page-form__content">
                                <span id="frm-doctor" class="confirm__doc"></span>
                            </div>
                        </div>

                        <div class="page-form__item page-form__item--confirm">
                            <div class="page-form__name">
                                Клиника
                            </div>
                            <div class="page-form__content page-form__content">
                                <span id="frm-clinic" class="confirm__addr"></span>
                            </div>
                        </div>

                        <div class="page-form__item page-form__item--confirm page-form__item--confirm-price">
                            <div class="page-form__name">
                                Стоимость
                            </div>
                            <div class="page-form__content">
                                <span id="frm-price" class="confirm__price"></span>
                            </div>
                        </div>

                        <div class="page-form__item page-form__btn page-form__btn-2  ">
                            <a href="" class="btn btn-form-change">изменить</a>
                        </div>
                    </div>

                    <div class="contacts-form__item page-form__btn contacts-form-12 page-form__btn-3 page-form__btn-3-mobile">
                        <input type="submit" value="Подтвердить" class="button page-form__submit page-form__submit-3 page-form__submit--mobile">
                    </div>


                </div>

            </div>

        </div>
    </section>
    <!-- PAGE FORM END 3 -->




    <!-- PAGE FORM SUCCESS  -->
    <section class="page-form page-form-4 page-form-success" id="page-form-4">
        <div class="container">

            <div class="row page-form__row--title">
                <h2 class="page-form__title">Ваша заявка принята!</h2>
            </div>

            <div class="row page-form__row">

                <div class="form-contact-info">
                    <h6>Для подтверждения приема ожидайте звонка оператора. </h6>
                    <div class="page-form-success__btns">
                        <a href="#" class="btn btn-green page-form-success__btn">Как добраться</a>
                        <a href="#" class="btn btn-green page-form-success__btn">Как подготовиться</a>
                    </div>
                </div>

                <div class="form-visit-info">
                    <h5 class="page-form-3__col--infotitle">Данные о приёме</h5>

                    <div class="page-form__item page-form__item--confirm">
                        <div class="page-form__name">
                            Дата приёма
                        </div>
                        <div class="page-form__content">
                            <span id="frm-date1" class="confirm__date"></span>,
                            <span id="frm-time1" class="confirm__time"></span>
                        </div>
                    </div>

                    <div class="page-form__item page-form__item--confirm">
                        <div class="page-form__name">
                            Пациент
                        </div>
                        <div class="page-form__content">
                            <span id="frm-age1"></span>
                        </div>
                    </div>

                    <div class="page-form__item page-form__item--confirm">
                        <div class="page-form__name">
                            Услуга
                        </div>
                        <div class="page-form__content">
                            <span id="frm-service1" class="confirm__serv"></span>
                        </div>
                    </div>


                    <div class="page-form__item page-form__item--confirm">
                        <div class="page-form__name">
                            Врач
                        </div>
                        <div class="page-form__content">
                            <span id="frm-doctor1" class="confirm__doc"></span>
                        </div>
                    </div>

                    <div class="page-form__item page-form__item--confirm">
                        <div class="page-form__name">
                            Клиника
                        </div>
                        <div class="page-form__content page-form__content">
                            <span id="frm-clinic1" class="confirm__addr"></span>
                        </div>
                    </div>

                    <div class="page-form__item page-form__item--confirm page-form__item--confirm-price">
                        <div class="page-form__name">
                            Стоимость
                        </div>
                        <div class="page-form__content">
                            <span id="frm-price1" class="confirm__price"></span>
                        </div>
                    </div>

                    <div class="page-form__item page-form__btn page-form__btn-2  ">
                        <a onClick="javascript:window.print();" class="btn btn-form-change">Распечатать</a>
                    </div>

                </div>

            </div>

        </div>
    </section>
    <!-- PAGE FORM SUCCESS -->


</div>

<div id="print" class="print">
    <h5 class="page-form-3__col--infotitle">Данные о приёме</h5>

    <div class="page-form__item">
        <div class="page-form__name">
            Дата приёма
        </div>
        <div class="page-form__content">
            <span id="frm-date2" class="confirm__date"></span>,
            <span id="frm-time2" class="confirm__time"></span>
        </div>
    </div>

    <div class="page-form__item">
        <div class="page-form__name">
            Пациент
        </div>
        <div class="page-form__content">
            <span id="frm-age2"></span>
        </div>
    </div>

    <div class="page-form__item">
        <div class="page-form__name">
            Услуга
        </div>
        <div class="page-form__content">
            <span id="frm-service2" class="confirm__serv"></span>
        </div>
    </div>


    <div class="page-form__item">
        <div class="page-form__name">
            Врач
        </div>
        <div class="page-form__content">
            <span id="frm-doctor2" class="confirm__doc"></span>
        </div>
    </div>

    <div class="page-form__item">
        <div class="page-form__name">
            Клиника
        </div>
        <div class="page-form__content">
            <span id="frm-clinic2" class="confirm__addr"></span>
        </div>
    </div>

    <div class="page-form__item page-form__item--confirm-price">
        <div class="page-form__name">
            Стоимость
        </div>
        <div class="page-form__content">
            <span id="frm-price2" class="confirm__price"></span>
        </div>
    </div>

</div>



<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?>