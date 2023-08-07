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
    $('html').on('click', '#confirm_entry_modal .btn-submit', function(){

        $('#confirm_entry_modal .success-hide').hide();
        $('#confirm_entry_modal .preload_container_popup').show();

        var phone = validatePhone($('#entry_btn').val());
        var date_rec = $('#date_rec').val();
        var exam_id_form = $('#exam_id_form').val();
        var namemyname = $('#namemyname').val();
        var medecins_id = $('#medecins_id').val();

        if($(this).prop('disabled') === false && phone != false && date_rec.length != 0 && exam_id_form.length != 0){
            $("#confirm_entry_modal .btn-submit").attr('disabled',true);
            $.ajax({
                url: '/include/api/setplanning.php',
                method: 'post',
                dataType: 'json',
                data: {
                    phone: phone,
                    date_rec: date_rec,
                    exam_id_form: exam_id_form,
                    namemyname: namemyname,
                    medecins_id: medecins_id,
                },
                success: function(data){
                    if(data.code == '001'){
                        $('.success_exam').html($(':selected', "#exam_id").text());
                        $('.success_date').html(date_rec);
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
                        $('#confirm_entry_modal .success_message .popup-item').html("<div class='text-center'>За Вами забронировано уже более 3 дат. <br>Свяжитесь по телефону <a href='tel:+73519581111'>+7 (3519) 581-111</a>, для перезаписи.</div>");
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