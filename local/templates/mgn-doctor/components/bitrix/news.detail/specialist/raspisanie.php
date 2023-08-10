<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$arResult = $_GET;
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
                    <h4 class="popup__title">Подтверждение записи</h4>
                    <div class="popup-item">
                        <label>Услуга
                            <span class="form-control-wrap contact-tel">
                                <input type="hidden" name="exam_id_form" id="exam_id_form" readonly>
                                <input type="hidden" name="medecins_id" id="medecins_id" value="<?=$medecins_id?>" readonly>
                                <input type="text" style="display:block;height:0px;width:0px;opacity:0;padding:0;border:0;margin:0;" value="" name="namemyname" id="namemyname" readonly>
                                <div class="select_exam" id="exam_id_name"></div>
                            </span>
                        </label>
                    </div>

                    <div class="popup-item">
                        <label>Выбранная дата и время записи
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

                    <input type="submit" value="Записаться" class="btn-submit btn btn-green popup-btn disabled" disabled>
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
    <div class="no-timesheet">
        Узнать акуальное расписание данного специалиста и записаться:
        <ul>
            <li>можно через форму онлайн-записи</li>
            <li>позвонив в контакт-центр <a href="tel:83519581111">8-3519-581-111</a></li>
            <li>через <a href="https://ok.ru/semeinyidoctor74" rel="nofollow"><img src="<?=SITE_TEMPLATE_PATH?>/img/OK_logo.svg" alt="" width="30" height="30"></a>  <a href="https://vk.com/semeinyi_doctor74" rel="nofollow"><img src="<?=SITE_TEMPLATE_PATH?>/img/VK_Compact_Logo.svg" alt="" width="30" height="30"></a></li>
            <li>написав в чат (на сайте справа внизу)</li>
        </ul>
    </div>
<? endif;//конец проверки дней расписания ?>
<?php
//print_r($planningArray['exams']);
?>