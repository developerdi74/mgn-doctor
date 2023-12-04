<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$arResult = $_GET;
if($arResult['VZROS']==1 && $arResult['CHILD']==1){
    $priem = 3;
}elseif($arResult['CHILD']){
    $priem = 2;
}else{
    $priem = 1;
}
if(empty($arResult['PROPERTIES']['MEDIALOG_ID']['VALUE'])){
    $explodeName = explode(' ',$arResult['NAME']);
    $medecins_id = getMedecinsID($explodeName[0], $explodeName[1],$explodeName[2], $arResult['ID']);

}else{
    $medecins_id = $arResult['PROPERTIES']['MEDIALOG_ID']['VALUE'];
}

if(isset($medecins_id)){
    $planningArray = getPlanning($medecins_id);
}
if(isset($planningArray['days'])): //начало проверки дней расписания

foreach ($planningArray['days'] as $allDay){
    $allDay=0;
}
//убираем дубли дат
    foreach ($planningArray['days'] as $n) {
        $unique[$n['date_rec']] = $n;
    }
    $planningArray['days'] = array_values($unique);
    $monthes = array("s","Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь");
    $nmWeek = array("ВС","ПН","ВТ","СР","ЧТ","ПТ","СБ");
    $dayNow = date('d', time());
    $countDays = cal_days_in_month(CAL_GREGORIAN, date('m', time()), date('y', time()));
    $monthNow = date('m', time());
    $yearNow = date('y', time());
    $dayday = date('d', time());
    $activeMonth = 1;
    ?>
<div class="row">
    <div class="planning_select col-12">
        <div>Выбeрите услугу для записи</div>
        <select name="exam_id" class="w-100" id="exam_id">
            <? foreach ($planningArray['exams'] as $exam){?>
                <option value="<?=$exam['PL_EXAM_ID']?>"><?=mb_strtoupper( mb_substr(($exam['NAME']),0,1) ) . mb_substr(($exam['NAME']),1);?></option>
            <?}?>
        </select>
    </div>
    <div class="col-12 mb-2">
        <label for="calendarSlider">Расписание врача для онлайн-записи:</label>
        <div id="calendarSlider" class="carousel slide" data-ride="carousel" data-interval="false">
        <div class="carousel-inner">
            <? for($month=$monthNow;$month<=12;$month++): //месяц
            $countDays=cal_days_in_month(CAL_GREGORIAN, $month, date('y', time()));
            $prevOK=0;
            $week=0;
            if($month==1){
                $prevMonth=12;
                $prev_year=1;
            }
            else{
                $prevMonth=$month-1;
                $prev_year=0;
            }
            $prevMonthDays=cal_days_in_month(CAL_GREGORIAN, $prevMonth, date('y', time())-$prev_year);
            ?>
            <div class="carousel-item <?=($activeMonth==1)? 'active' : ''?>">
                <?$activeMonth=0?>

                <div tabindex="0" data-month="" aria-roledescription="Calendar" class="b-calendar-grid form-control h-auto text-center" id="">
                    <div class="b-calendar-grid-caption text-center font-weight-bold" id="" aria-live="polite" aria-atomic="true">
                        <?=$monthes[ltrim($month, '0')]; ?>
                    </div>
                    <div aria-hidden="true" class="b-calendar-grid-weekdays row no-gutters border-bottom mb-2">
                       <? foreach($nmWeek as $nameDay):?>
                        <small title="<?=$nameDay?>" class="col text-truncate"><?=$nameDay?></small>
                        <? endforeach;?>
                    </div>
                    <div class="b-calendar-grid-body">
                        <? for($day=1;$day<=$countDays;$day++): //день ?>

                        <? $keyDate = date('Y-m-d', strtotime($yearNow."-".$month.'-'.$day));
                        $dayday=date('w', strtotime($keyDate));
                        if($prevOK==0){
                            $week=$dayday-1;
                        }
                        if($prevOK==0 && $dayday==00){
                            $prevOK=1;
                            $week=0;
                        }
                        $avilable_check = 0;
                        ?>

                        <? if($week==0 || $prevOK==0): ?>
                        <div class="row no-gutters">
                            <? endif; ?>

                            <? if($dayday!=0 && $prevOK==0 && $day!=$countDays): ?>
                                <? $prevOK=1;?>
                                <? for($prevMonthDay=$prevMonthDays-$week; $prevMonthDay<=$prevMonthDays; $prevMonthDay++):?>
                                    <div id="" class="col p-1">
                                        <span class="btn_calendar p-0 border-0 rounded-circle text-nowrap text-dark disabled text-hide font-weight-bold"><?=$prevMonthDay?></span>
                                    </div>
                                    </a>
                                <? endfor; $week=$dayday+1; else: $week++; endif; ?>

                            <div id="" role="button" aria-label="" class="col p-1 addSaveDate">
                                <?
                                foreach($planningArray['days'] as $avilable_day):
                                    if(in_array($keyDate, $avilable_day) && $avilable_check==0){?>
                                        <span class="btn_calendar p-0 border-0 rounded-circle text-nowrap text-dark font-weight-bold active_date" data-date="<?=$keyDate;?>"><?=$day?></span>
                                    <?
                                        $avilable_check = 1;
                                    }
                                endforeach;
                                if($avilable_check == 0){
                                ?>
                                <span class="btn_calendar p-0 border-0 rounded-circle text-nowrap text-dark disabled"><?=$day?></span>
                                <?}?>
                            </div>

                            <? if($day==$countDays && $week<=6):
                                $asda=$week; ?>
                                <? for($nextMonthDay=1; $nextMonthDay<=(7-$asda); $nextMonthDay++): ?>
                                <div class="col p-1">
                                    <span class="btn_calendar p-0 border-0 rounded-circle text-nowrap text-dark disabled text-hide font-weight-bold"><?=$nextMonthDay?></span>
                                </div>
                                <? $week++; endfor; ?>
                            <? endif;?>

                            <? if($week>=7 || $day==$countDays):
                                echo "</div>"; //<div class="row no-gutters">
                                $week=0;
                            endif; ?>
                            <? endfor; //день
                            ?>
                        </div>
                    </div>
                </div>
                <? endfor; //месяц?>
            </div>
            <a class="carousel-control-prev" href="#calendarSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Пр</span>
            </a>
            <a class="carousel-control-next" href="#calendarSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>


    <div class="planning_select col-12 col-md-4 mb-2">
        <div>Дата</div>
        <select class="w-100" id="selected_day" >
            <option class="doctor_day" select-date="" value="0" selected>Выберите день</option>
            <?foreach ($planningArray['days'] as $i => $day):?>
                <option class="doctor_day" select-date="<?=$day['date_rec']?>" value="<?=$day['date_rec']?>" <?=($i==0)?'':''?>>
                    <?=date('d.m.Y', strtotime($day['date_rec']))?>
                </option>
            <? endforeach;?>
        </select>
    </div>
    <div class="planning_select col-12 col-md-4 mb-2 hide_load_block" style="display: none;">
        <div>Время</div>
        <? foreach ($planningArray['days'] as $i => $day):?>
            <select name="selected_date" class="w-100 selected_date <?=($i!=0)?'d-none':''?>" selected-date="<?=$day['date_rec']?>">
                <? foreach ($day['time_rec'] as $time):?>
                    <option class="doctor_day" select-time="<?=$time?>" value="<?=$day['date_rec']." ".$time?>" <?=($i==0)?'':''?>>
                        <?=$time?>
                    </option>
                <? endforeach;?>
            </select>
        <? endforeach;?>
    </div>

    <div class="planning_select col-12 col-md-4 hide_load_block" style="display: none;">
        <div style="opacity: 0">label</div>
            <a data-fancybox="" class="btn-submit btn btn-green popup-btn" data-src="#confirm_entry_modal" href="#confirm_entry_modal">Подтвердить</a>
        <div class="cnt_selected_date"></div>
    </div>

    <div style="display: none;" id="confirm_entry_modal" class="popup popup-small ask-question-modal fancybox-content">
        <div class="popup__content popup-content">
            <div class="popup__form success-hide">
                <form name="form-set-planning" class='' action="<?=SITE_DIR."include/api/setplanning.php"?>" method="post">
                    <div class="save_slide" slide=1>
                        <h4 class="popup__title">Кого записываете?</h4>
                        <?/*if($priem == 2):?>
                            <div class="popup-item">
                                <label style="color: #ff0000">Внимание! Данный врач принимает только детей!
                                </label>
                            </div>
                        <?endif;*/?>
                            <div class="">
                                    <span class="slide-btn <?=($priem != 1 && $priem != 3)? "disabled" : "next-slide" ;?>" id="self" step="1">Записываю себя</span>
                                    <span class="slide-btn <?=($priem != 2 && $priem != 3)? "disabled" : "next-slide" ;?>" id="child" step="1" >Записываю ребенка</span>
                                <?/*if($priem == 3 || $priem == 1 ):?>
                                    <span class="slide-btn next-slide" id="alien" step="1">Записываю другого человека</span>
                                <?endif;*/?>
                            </div>

                    </div>

                    <div class="save_slide hidden_popup_slide" slide=2>
                        <h4 class="popup__title">Данные для записи:</h4>
                        <div class="popup-item">
                            <label><span id = 'label_nom'>Ваша фамилия*</span>
                                <span class="form-control-wrap contact-tel">
                                <input type="text" name="NOM" placeholder="Фамилия" id='NOM' class="require-filed" value="">
                            </span>
                            </label>
                        </div>
                        <div class="popup-item">
                            <label><span id = 'label_prenom'>Ваше имя*</span>
                                <span class="form-control-wrap contact-tel">
                                <input type="text" name="PRENOM" placeholder="Введите имя" id='PRENOM' class="require-filed" value="">
                            </span>
                            </label>
                        </div>
                        <div class="popup-item">
                            <label><span id = 'label_patronyme'>Ваше отчество*</span>
                                <span class="form-control-wrap contact-tel">
                                <input type="text" name="PATRONYME" placeholder="Введите отчество" id='PATRONYME' class="require-filed" value="">
                            </span>
                            </label>
                        </div>
                        <div class="popup-item">
                            <label>
                             <span id = 'label_god_rog'>Год рождения*</span>
                             <span class="form-control-wrap contact-tel">
                                    <select name="GOD_ROGDENIQ" id="GOD_ROGDENIQ" class="">
                                        <?for($year=1900; $year<=date('Y'); $year++):?>
                                            <option value="<?=$year?>" <?=$year==1999 ? "selected": "";?>><?=$year?></option>
                                        <?endfor;?>
                                    </select>
                            </span>
                            </label>
                        </div>
                        <div class="popup-item">
                            <label>
                                <div class="form-accept">
                                    <span>
                                            <input type="checkbox" id="check_politic" class="require-filed" name="check_politic" value="">
                                    </span>
                                    <span class="checkbox-text">Согласен на обработку персональных данных.
                                        <noindex>
                                            <a href="/personal/privaci.php" target="_blank">Политика конфиденциальности</a>
                                        </noindex>
                                    </span>
                                </div>
                            </label>
                        </div>
                        <div class="error-message" style="display: none">
                            Заполните все обязательные поля!
                        </div>
                        <div class="popup-item">
                            <div class="slide-btn next-slide prev-slide" step="-1" param="reset">Назад</div>
                            <div class="slide-btn next-slide check-field" step="1">Далее</div>
                        </div>
                    </div>
                    <div class="save_slide hidden_popup_slide" slide="3">
                        <h4 class="popup__title">Информация о записи:</h4>
                        <div class="popup-item">
                            <label>Услуга
                                <span class="form-control-wrap contact-tel">
                                <input type="hidden" name="exam_id_form" id="exam_id_form" readonly>
                                <input type="hidden" name="medecins_id" id="medecins_id" value="<?=$medecins_id?>" readonly>
                                <input type="hidden" name="childReg" id="childReg" value="0" readonly>
                                <input type="text" style="display:block;height:0px;width:0px;opacity:0;padding:0;border:0;margin:0;" value="" name="namemyname" id="namemyname" readonly>
                                <div class="select_exam" id="exam_id_name"></div>
                            </span>
                            </label>
                        </div>
                        <div class="popup-item">
                            <label>Выбранная дата и время записи:
                                <span class="form-control-wrap contact-tel">
                                    <input type="text" name="date_rec" id="date_rec" readonly>
                                </span>
                            </label>
                        </div>
                        <div class="popup-item">
                            <label>Для подтверждения записи введите Ваш номер телефона
                                <span class="form-control-wrap contact-tel">
                                    <input type="tel" name="phone" placeholder="+7 (___) ___-____" id='entry_btn' class="phone" value="">
                                </span>
                                <span class="error_message" style="display: none">
                                </span>
                            </label>
                        </div>

                        <div class="popup-item">
                            <label>Ваш комментарий
                                <span class="form-control-wrap contact-tel">
                                <input type="text" name="comment" id='comment' placeholder="Напишите вопрос, или другая интересующая информация" value="">
                            </span>
                            </label>
                        </div>
                        <div class="popup-item">
                            <div class="slide-btn next-slide prev-slide" step="-1">Назад</div>
                            <input type="submit" value="Записаться" class="btn-submit btn btn-green popup-btn disabled" disabled>
                        </div>

                    </div>

                </form>
            </div>
            <div class="preload_container_popup" style="display: none;">
                <h4 class="popup__title">Записываю....</h4>
                <div class="popup-item justify-content-center">
                    <div class="cnt_loader"><div class="loader" style=""></div></div>
                </div>
            </div>
            <div class="success_message" style="display: none;">
                <h4 class="popup__title">Время забронировано!</h4>
                <div class="popup-item">
                    <label>Услуга:
                        <div class="success_exam"></div>
                    </label>
                    <label>Дата и время записи:
                        <div class="success_date"></div>
                    </label>
                    <label>Ваш номер телефона:
                        <div class="success_phone"></div>
                    </label>
                </div>
            </div>
        </div>
        <button type="button" data-fancybox-close="" class="fancybox-button fancybox-close-small" title="Close"><svg xmlns="http://www.w3.org/2000/svg" version="1.0" viewBox="0 0 24 24"><path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path></svg></button>
    </div>

</div>
<? else: //пустое значение проверки дней расписания ?>

    <?

    $db_old_groups = CIBlockElement::GetElementGroups($arResult['ID'], true);
    $ar_new_groups = [];
    while($ar_group = $db_old_groups->Fetch())
        $ar_new_groups[] = $ar_group["ID"];

    $age=[];
    if($arResult['CHILD']==1)
        $age[]='110';
    if($arResult['VZROS']==1)
        $age[]='111';
    $arrFilterVrachi = array(
        "SECTION_ID" => $ar_new_groups,
        "!=ID"=>$arResult['ID'],
        "PROPERTY_AGE"=>$age,
        "!=PROPERTY_ONLINE_PLANNING"=>0,
        "!=PROPERTY_MEDIALOG_ID"=>"",
        "ONLINE_PLANNING"=>1,
    );
   // dd($arrFilterVrachi);
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "docs-list-detail",
        array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "N",
            "CACHE_TIME" => "0",
            "CACHE_TYPE" => "N",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(
                0 => "NAME",
                1 => "",
            ),
            "FILTER_NAME" => "arrFilterVrachi",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "25",
            "IBLOCK_TYPE" => "mgn_doctor_service",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "5",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(
                0 => "DATE",
               // 1 => "CLINIC",
                2 => "AGE",
                3 => "SPECIALIZATION",
               // 4 => "SKILL",
                6 => "RAITING",
                7 => "",
            ),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N",
            "COMPONENT_TEMPLATE" => "vrachi",
            "COMPOSITE_FRAME_MODE" => "A",
            "COMPOSITE_FRAME_TYPE" => "AUTO",
        ),
        false
    );?>
<?/*else:?>
    <div class="no-timesheet">
        Узнать акуальное расписание данного специалиста и записаться:
        <ul>
            <li>можно через форму онлайн-записи</li>
            <li>позвонив в контакт-центр <a href="tel:83519581111">8-3519-581-111</a></li>
            <li>через <a href="https://ok.ru/semeinyidoctor74" rel="nofollow"><img src="<?=SITE_TEMPLATE_PATH?>/img/OK_logo.svg" alt="" width="30" height="30"></a>  <a href="https://vk.com/semeinyi_doctor74" rel="nofollow"><img src="<?=SITE_TEMPLATE_PATH?>/img/VK_Compact_Logo.svg" alt="" width="30" height="30"></a></li>
            <li>написав в чат (на сайте справа внизу)</li>
        </ul>
    </div>
<?
*/?>


<? endif;//конец проверки дней расписания ?>
<?php
//print_r($planningArray['exams']);
?>