$(document).ready(function(){
    $('.specialist-info__right').on('click', '.addSaveDate', function(){
        var select_date = $(this).find('.active_date').attr('data-date');
        if(!select_date){
            return false;
        }
        $('.select_date').removeClass('select_date');
        $(this).addClass('select_date');
        $("select option[select-date$="+select_date+"]").prop('selected', true);
        var assss = $("select option[select-date$="+select_date+"]").val();

        $(".selected_date").addClass('d-none');
        var activeSelectTime = $(".selected_date").find(".selected_date[selected-date$="+select_date+"]");
        activeSelectTime.removeClass('d-none');
        $('#selected_day').trigger('refresh');
        $('.selected_date').trigger('refresh');

        var select_date_time = activeSelectTime.val();
        setDatePlanningCnt(select_date_time);
        $('.hide_load_block').show();
    });


    $('.specialist-info__right').on('change', '#selected_day', function(){
        var id = $(this).val();

        var activeSelectTime = $(".selected_date").find(".selected_date[selected-date$="+id+"]");

        $(".selected_date").addClass('d-none');
        activeSelectTime.removeClass('d-none');

        $('.selected_date').trigger('refresh');
        var select_date_time = activeSelectTime.val();
        setDatePlanningCnt(select_date_time);
        $('.hide_load_block').show();
    });

    $('.specialist-info__right').on('change', 'select[name="selected_date"]', function(){
        var select_date_time = $(this).val();
        setDatePlanningCnt(select_date_time);
    });
	//load_main();

    $(".phone").mask("+7 (999) 999-9999");
    $('html').on('keyup', '#entry_btn', function(){
        var phoneNumber = $(this).val();
        var regExp = /\+|\(|\)|\-|\_|\ /g;
        var validPhone = phoneNumber.replace(regExp, ''); // => +7 999 123 45 67

        if(validPhone.length == 11){
            $("#confirm_entry_modal .btn-submit").removeAttr('disabled');
            $("#confirm_entry_modal .btn-submit").removeClass('disabled');
        }else{
            $("#confirm_entry_modal .btn-submit").attr('disabled',true);
            $("#confirm_entry_modal .btn-submit").addClass('disabled');
        }
    });
    $('html').on('click', '#child-btn', function(){
        $('#child-block').slideToggle();
    });

    $('html').on('click', '#confirm_entry_modal .btn-submit', function(){

        $('#confirm_entry_modal .success-hide').hide();
        $('#confirm_entry_modal .preload_container_popup').show();

        var phone = validatePhone($('#entry_btn').val());
        var date_rec = $('#date_rec').val();
        var exam_id_form = $('#exam_id_form').val();
        var data={
            phone:          phone,
            date_rec:       date_rec,
            exam_id_form:   exam_id_form,
            comment:        $('#comment').val(),
            childReg:       $('#childReg').val(),
            nameReg:        $('#nameReg').val(),
            namemyname:     $('#namemyname').val(),
            medecins_id:    $('#medecins_id').val(),
            doc_name:       $('.specialists-item__name').html(),
            doc_spec:       $('.specialist-info__position:eq(1)').html(),
        }
        if($(this).prop('disabled') === false && phone != false && date_rec.length != 0 && exam_id_form.length != 0){
            $("#confirm_entry_modal .btn-submit").attr('disabled',true);
            $.ajax({
                url: '/include/api/setplanning.php',
                method: 'post',
                dataType: 'json',
                data: data,
                success: function(data){
                    if(data.code == '001'){
                        console.log(data);
                        $('.success_exam').html($(':selected', "#exam_id").text());
                        $('.success_date').html(data.info.DATE_START);
                        $('.success_phone').html($('#entry_btn').val());
                        $('#confirm_entry_modal .preload_container_popup').hide();
                        $('#confirm_entry_modal .success_message').show();
                        ym(87764265,'reachGoal','lead_booking');
                        return;
                    }
                    //код 102 записался по этому ip более 3 раз
                    if(data.code == '102'){
                        $('#confirm_entry_modal .success-hide').hide();
                        $('#confirm_entry_modal .preload_container_popup').hide();
                        $('#confirm_entry_modal .success_message .popup__title').html("Запись невозможна.");
                        $('#confirm_entry_modal .success_message .popup-item').html("<div class='text-center'>Вы уже записаны к этом врачу. <br>Для смены даты записи свяжитесь по телефону <a href='tel:+73519581111'>+7 (3519) 581-111</a></div>");
                        $('#confirm_entry_modal .success_message').show();
                        return;
                    }
                    if(data.code == '103'){
                        $('#confirm_entry_modal .success-hide').show();
                        $('#confirm_entry_modal .preload_container_popup').hide();
                        $('#confirm_entry_modal .error_message').html('Не верный номер телефона');
                        $('#confirm_entry_modal .error_phone').show();
                        return;
                    }
                    if(data.code == '105'){
                        $('#confirm_entry_modal .success-hide').show();
                        $('#confirm_entry_modal .preload_container_popup').hide();
                        $('#confirm_entry_modal .error_message').html('Ошибка записи! Попробуйте выбрать другую дату или время!');
                        $('#confirm_entry_modal .error_message').show();
                        return;
                    }
                    $('#confirm_entry_modal .success-hide').show();
                    $('#confirm_entry_modal .preload_container_popup').hide();
                    $('#confirm_entry_modal .error_message').html('Ошибка! Попробуйте позже!');
                    $('#confirm_entry_modal .error_message').show();

                },
                error: function (e){
                    console.log(e);
                    $('#confirm_entry_modal .success-hide').show();
                    $('#confirm_entry_modal .preload_container_popup').hide();
                    $('#confirm_entry_modal .error_message').html('Неизвестная ошибка! Попробуйте позже!');
                    $('#confirm_entry_modal .error_message').show();
                }
            });
        }
        return false;
    })
});

function validatePhone(phoneNumber){
    var regExp = /\+|\(|\)|\-|\_|\ /g;
    var validPhone = phoneNumber.replace(regExp, ''); // => +7 999 123 45 67
    if(validPhone.length==11){
        return validPhone;
    }else{
        return false;
    }
}
function setDatePlanningCnt(dataTime){
    $("#date_rec").val(dataTime);
    $("#exam_id_form").val($('#exam_id').val());
    var text = $(':selected', "#exam_id").text();
    $("#exam_id_name").html(text);
}

var dateFormat = function () {
    var	token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
        timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
        timezoneClip = /[^-+\dA-Z]/g,
        pad = function (val, len) {
            val = String(val);
            len = len || 2;
            while (val.length < len) val = "0" + val;
            return val;
        };

    // Regexes and supporting functions are cached through closure
    return function (date, mask, utc) {
        var dF = dateFormat;

        // You can't provide utc if you skip other args (use the "UTC:" mask prefix)
        if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
            mask = date;
            date = undefined;
        }

        // Passing date through Date applies Date.parse, if necessary
        date = date ? new Date(date) : new Date;
        if (isNaN(date)) throw SyntaxError("invalid date");

        mask = String(dF.masks[mask] || mask || dF.masks["default"]);

        // Allow setting the utc argument via the mask
        if (mask.slice(0, 4) == "UTC:") {
            mask = mask.slice(4);
            utc = true;
        }

        var	_ = utc ? "getUTC" : "get",
            d = date[_ + "Date"](),
            D = date[_ + "Day"](),
            m = date[_ + "Month"](),
            y = date[_ + "FullYear"](),
            H = date[_ + "Hours"](),
            M = date[_ + "Minutes"](),
            s = date[_ + "Seconds"](),
            L = date[_ + "Milliseconds"](),
            o = utc ? 0 : date.getTimezoneOffset(),
            flags = {
                d:    d,
                dd:   pad(d),
                ddd:  dF.i18n.dayNames[D],
                dddd: dF.i18n.dayNames[D + 7],
                m:    m + 1,
                mm:   pad(m + 1),
                mmm:  dF.i18n.monthNames[m],
                mmmm: dF.i18n.monthNames[m + 12],
                yy:   String(y).slice(2),
                yyyy: y,
                h:    H % 12 || 12,
                hh:   pad(H % 12 || 12),
                H:    H,
                HH:   pad(H),
                M:    M,
                MM:   pad(M),
                s:    s,
                ss:   pad(s),
                l:    pad(L, 3),
                L:    pad(L > 99 ? Math.round(L / 10) : L),
                t:    H < 12 ? "a"  : "p",
                tt:   H < 12 ? "am" : "pm",
                T:    H < 12 ? "A"  : "P",
                TT:   H < 12 ? "AM" : "PM",
                Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
                o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
                S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
            };

        return mask.replace(token, function ($0) {
            return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
        });
    };
}();

// Some common format strings
dateFormat.masks = {
    "default":      "ddd mmm dd yyyy HH:MM:ss",
    shortDate:      "m/d/yy",
    mediumDate:     "mmm d, yyyy",
    longDate:       "mmmm d, yyyy",
    fullDate:       "dddd, mmmm d, yyyy",
    shortTime:      "h:MM TT",
    mediumTime:     "h:MM:ss TT",
    longTime:       "h:MM:ss TT Z",
    isoDate:        "yyyy-mm-dd",
    isoTime:        "HH:MM:ss",
    isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
    isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};

// Internationalization strings
dateFormat.i18n = {
    dayNames: [
        "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
        "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
    ],
    monthNames: [
        "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
        "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
    ]
};

// For convenience...
Date.prototype.format = function (mask, utc) {
    return dateFormat(this, mask, utc);
};