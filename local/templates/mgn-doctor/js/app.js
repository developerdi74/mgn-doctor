document.addEventListener('DOMContentLoaded', (event)=>{
});

var docWidth=document.documentElement.offsetWidth;
[].forEach.call(
	document.querySelectorAll('*'),
	function (el) {
		if(el.offsetWidth>docWidth){
		}
	}
);

function bindEvent(e, eventName, callback){
	if (e.addEventListener) // new browsers
		e.addEventListener(eventName, callback, false);
	else if (e.attachEvent) // IE
		e.attachEvent('on' + eventName, callback);
};

bindEvent(document.body, 'scroll', function (e) {
	document.body.scrollLeft = 0;
});

var specialization=false, service=false, doctor=false, clinic=false;
$(document).ready(function(){
	var buttonCteated=false;

	/*
        $(document).on('click', '.b24-widget-button-wrapper', function() {
            if (!buttonCteated ) {
                       $('.b24-widget-button-social').append('<a href="https://wa.me/73519581111" class="whatsapp b24-widget-button-social-item ui-icon ui-icon-service-whatsapp connector-icon-45" target="_blank"><i></i><span data-b24-crm-button-tooltip="" class="b24-widget-button-social-tooltip">whatsapp</span></div>');
                 buttonCteated = true;
             }
	   });
*/
	$(".footer-item .footer-item__title").click(function(){
		$(this).closest('.footer-item').find('.footer-item__list').toggle( "slow");
	});
	$(document).on('click', '.show-more-text', function () {
		if( $(this).html() == "развернуть" ){
			$('.chief__about').css('max-height','100%');
			$(this).html('свернуть');
		}else{
			$('.chief__about').css('max-height','435px');
			$(this).html('развернуть');
		}
	});

	$(document).on('click', '.serv-subitem-btn', function(){																								// записаться на прием
		item=$(this).closest('.all-services__subitem');
		price=item.find('.price').text();
		text=item.children('h6').text()+' '+price;
		$('textarea[name="form_textarea_24"]').val(text);
	});
	$('.btn__').click(function(){																															// записаться в /service/
		item=$(this).closest('.service-detail');
		text=item.find('.service-detail-name').text()+' '+item.find('.service-detail-price').data('price')+' руб.';
		$('textarea[name="form_textarea_24"]').val(text);
	});

	$(document).on('click', '.timesheet-link', function () {
		item = $(this).closest('.specialist-inner');
		date = $(this).data("date");
		price = Math.round( $('select[name=SERVICE] option:selected').data("price") );
		clinic =  'Клиника: ' + $('select[name=CLINIC] option:selected').text() + '\n';

		add_clnc = $.trim($('.specialist-info__place').text());
		clinic = add_clnc + '\n';
		//serv = 'Услуга: ' + $('select[name=SERVICE] option:selected').text() + ' ' + price + 'р. \n';
		time = 'Желаемая дата и время: ' + date + ', ' + $(this).text()+ '\n';;
		text = 'Врач: '+ item.find('.specialists-item__name').text()+ '\n';;
		str = text + time;
		str.replace(/ +/g, ' ').trim();
		$('textarea[name="form_textarea_24"]').val(str);
	});

	$(document).on('click', '#doctorOrder', function () {
		item = $(this).closest('.specialists-item__content');
		//prof = item.find('.specialists-item__position ').text();
		price = Math.round( $('select[name=SERVICE] option:selected').data("price") );
		clinic =  'Клиника: ' + $('select[name=CLINIC] option:selected').text() + '\n';
		serv = 'Услуга: ' + $('select[name=SERVICE] option:selected').text()+ ' ' + price + 'р. \n';
		text = 'Врач: '+ item.children('h4').text()+ '\n';;
		str = clinic + serv + text;
		str.replace(/ +/g, ' ').trim();
	
		$('textarea[name="form_textarea_24"]').val(str);
	});

	// $('select[name=CLINIC]').on("change", function () {
	// 	$('#datail-doctor-form').submit();
	// });

	$('form[name="MGN_ORDER"]').submit(function (event) {

		error = true;

		if ($('#order_frm_fio').val() < 1) {
			$('#order_frm_fio').css("border", "red solid 1px");
			error = false;
		} else {
			$('#order_frm_fio').css("border", "#7CA82B solid 1px");
		}

		if ($('#order_frm_age').val() < 1) {
			$('#order_frm_age').css("border", "red solid 1px");
			error = false;
		} else {
			$('#order_frm_age').css("border", "#7CA82B solid 1px");
		}

		if ($('#order_frm_phone').val() < 1) {
			$('#order_frm_phone').css("border", "red solid 1px");
			error = false;
		} else {
			$('#order_frm_phone').css("border", "#7CA82B solid 1px");
		}

		if ($('#order_frm_accord').prop('checked') !== true ) {
			$('#order_frm_accord').addClass("error");
			error = false;
		} else {
			$('#order_frm_accord').removeClass("error");
		} 

		if (error) {
			$(this).hide();
			$('.popup__subtitle').show();
			ym(87764265,'reachGoal','lead');
		} else {
			event.preventDefault();
		}

	});

	$('form[name="form-reviews"]').submit(function (event) {
		event.preventDefault();

		$.ajax({
			method: "POST",
			url: "/include/reviewsAjax.php",
			data: $(this).serialize(),
			dataType: 'json',
			success: function (data) {
				if(data.success == 1){
					$('#reviews-modal').html( $('#popoup-success') );
					$('#popoup-success').show();
					$('.wpd-form-wrap').hide();
					$('.specialists-reviews-success').show();
				}else{
					$('[name=form-reviews]').append("<div class='error-msg'>Не все обязательные поля заполнены!</div>")
				}
			}
		});

	});



	$('form[name="form-mail"]').submit(function (event) {
		event.preventDefault();

		$.ajax({
			method: "POST",
			url: "/specialists/mailAjax.php",
			data: $(this).serialize(),
			success: function (data) {
				console.log( data );
				$('#mail-doctor').html( $('#popoup-success') );
				$('#popup-success-text').html('<p>Ваше письмо успешно отправлено.</p>');
				$('#popoup-success').show();
			}
		});

	});

	$('#selectDoctor').on("change", function () {
		$('#selectService').empty();
		$.ajax({
			type: "POST",
			url: "formAjax.php",
			data: { id: $(this).val() },
			success: function (msg) {
				$('#selectService').append(msg);
				$('#selectService').trigger('refresh');
			}
		});
	})
	
	$('#selectSpecialization').on("change", function () {
		$('#selectDoctor').empty();
		$.ajax({
			type: "POST",
			url: "getDoctor.php",
			data: { id: $(this).val() },
			success: function (msg) {
				$('#selectDoctor').append(msg);
				$('#selectDoctor').trigger('refresh');
			}
		});
	})

	$('#filterNews').on("change", function () {
		$('#formNews').submit();
	});

	$('#selectService').on("change", function () {
		val = $(this).find('option:selected').data('section');
		href = $(this).find('option:selected').data('note');
		$("#selectSpecialization").find('option[value=' + val + ']').prop('selected', true);
		$('#selectSpecialization').trigger('refresh');

		if (href !=''){
			$('#note').closest("div").addClass('note');
		}
		else{
			$('#note').closest("div").removeClass('note');
		}
		
		$('#note').attr("href", href);

	})

	// ВРЕМЕННО ДЛЯ ПЕРЕХОДА PAGE FORM
	$('#page-form-1 input[type="submit"]').click(function (event) {
		event.preventDefault();

		if ($('input[name="AGE"]').is(':checked')) {
			$('#page-form-1').hide();
			$('#page-form-3').show();
			arForm = $("#form1, #form2").serializeArray();
			service = $('select[name="SERVICE"] option:selected');

			$('#frm-date').text( $('input[name="DATE"]').val() );
			$('#frm-time').text($('select[name="TIME"] option:selected').text());
			$('#frm-age').text($('input[name="AGE"]:checked').closest('label').text());
			$('#frm-service').text($('select[name="SERVICE"] option:selected').text());
			$('#frm-doctor').text($('select[name="DOCTOR"] option:selected').text());
			$('#frm-clinic').text($('input[name="ADDRESS"]:checked').next('label').text());
			$('#frm-price').text( service.data('price') );

			$('#frm-date2').text($('input[name="DATE"]').val());
			$('#frm-time2').text($('select[name="TIME"] option:selected').text());
			$('#frm-age2').text($('input[name="AGE"]:checked').closest('label').text());
			$('#frm-service2').text($('select[name="SERVICE"] option:selected').text());
			$('#frm-doctor2').text($('select[name="DOCTOR"] option:selected').text());
			$('#frm-clinic2').text($('input[name="ADDRESS"]:checked').next('label').text());
			$('#frm-price2').text(service.data('price'));

		} else {
			$('.form-check').addClass('form-check__required');
			setTimeout(function () {
				$('.form-check').removeClass('form-check__required')
			}.bind(this), 2000);
		}
	});

	$('#page-form-2 input[type="submit"]').click(function (event) {
		event.preventDefault();
	
		$('#page-form-2').hide();
		$('#page-form-3').show();
	});

	$('#page-form-3 input[type="submit"]').click(function (event) {
		event.preventDefault();
		error = true;

		if ($('input[name="EMAIL"]').val() < 1) {
			$('input[name="EMAIL"]').css("border", "red solid 1px");
			setTimeout(function () {
				$('input[name="EMAIL"]').css("border", "1px solid rgba(44, 62, 80, 0.3)");
			}.bind(this), 2000);
			error = false;
		}else{
			$('input[name="EMAIL"]').css("border", "1px solid rgba(44, 62, 80, 0.3)");

		}

		if ($('input[name="PHONE"]').val() < 1) {
			$('input[name="PHONE"]').css("border", "red solid 1px");
			setTimeout(function () {
				$('input[name="PHONE"]').css("border", "1px solid rgba(44, 62, 80, 0.3)");
			}.bind(this), 2000);
			error = false;
		} else {
			$('input[name="PHONE"]').css("border", "1px solid rgba(44, 62, 80, 0.3)");
	
		}

		if ($('input[name="SURNAME"]').val() < 1) {
			$('input[name="SURNAME"]').css("border", "red solid 1px");
			setTimeout(function () {
				$('input[name="SURNAME"]').css("border", "1px solid rgba(44, 62, 80, 0.3)");
			}.bind(this), 2000);
			error = false;
		} else {
			$('input[name="SURNAME"]').css("border", "1px solid rgba(44, 62, 80, 0.3)");

		}

		if ($('input[name="NAME"]').val() < 1) {
			$('input[name="NAME"]').css("border", "red solid 1px");
			setTimeout(function () {
				$('input[name="NAME"]').css("border", "1px solid rgba(44, 62, 80, 0.3)");
			}.bind(this), 2000);
			error = false;
		} else {
			$('input[name="NAME"]').css("border", "1px solid rgba(44, 62, 80, 0.3)");
		}

		if ($('input[name="PATRONYMIC"]').val() < 1) {
			$('input[name="PATRONYMIC"]').css("border", "red solid 1px");
			setTimeout(function () {
				$('input[name="PATRONYMIC"]').css("border", "1px solid rgba(44, 62, 80, 0.3)");
			}.bind(this), 2000);
			error = false;
		} else {
			$('input[name="PATRONYMIC"]').css("border", "1px solid rgba(44, 62, 80, 0.3)");
		}

		if ($('#licenses_popup').is(':checked')) {
			$('#idlicenses').css("border", "none");
		} else {
			$('#idlicenses').css("border", "red solid 1px");
			setTimeout(function () {
				$('#idlicenses').css("border", "none");
			}.bind(this), 2000);
			error = false;
		} 

		if (error) {
			$('#page-form-3').hide();
			$('#page-form-4').show();

			$('#frm-date1').text($('input[name="DATE"]').val());
			$('#frm-time1').text($('select[name="TIME"] option:selected').text());
			$('#frm-age1').text($('input[name="AGE"]:checked').closest('label').text());
			$('#frm-service1').text($('select[name="SERVICE"] option:selected').text());
			$('#frm-doctor1').text($('select[name="DOCTOR"] option:selected').text());
			$('#frm-clinic1').text($('input[name="ADDRESS"]:checked').next('label').text());
			$('#frm-price1').text(service.data('price'));

			$.ajax({
				type: "POST",
				url: "appointment.php",
				data: $("#form1, #form2").serializeArray(),
				success: function (msg) {
				}
			});
		}

	});

	$('#page-form-3 .btn-form-change').click(function (event) {
		event.preventDefault();
		$('#page-form-3').hide();
		$('#page-form-1').show();
	});

	$('#page-form-4 input[type="submit"]').click(function (event) {
		event.preventDefault();
		$('#page-form-3').hide();
		$('#page-form-4').show();
	});


	// FORMSTYLER INIT
	jQuery('.filter-itmes input, select').styler({
		selectSearch: 'true'
	});


/*
	// ВРЕМЕННО Подрузка услуг на странице услуги
	$('.btn-serviceit-price__show').click(function (event) {
		event.preventDefault();
		$(this).hide();
		$('.all-services-load').slideDown();
		$('.serviceit-price__subitem--tr').addClass('serviceit-price__subitem--rel');
	});
*/

	// PAGE ALL SERVICES NAV
	let servItem=        $('.all-services__item--has-submenu');
	let servItemLink=    $('.all-services__item--has-submenu>a');
	let servContentTitle=$('.services-prices__subtitle');

	if($(window).width()>768){
		servItemLink.on('click', function(){
			event.preventDefault();
			if(!$(this).parent('li').hasClass('all-services__item--active')){
				// $('.all-services__item--has-submenu ul').slideUp();
				$(this).siblings('ul').slideDown();
				$('.all-services__item--has-submenu').removeClass('all-services__item--active');
				$(this).parent('li').addClass('all-services__item--active');
			}
			else{
				$(this).parent('li').removeClass('all-services__item--active');
				$(this).siblings('ul').slideUp();
			}
		});
		/*
				  $('.all-services__list ul li a').click(function(event) {
					event.preventDefault();
					let currTitleServ = $(this).text();
					servContentTitle.text(currTitleServ);
				});
		*/
	}
	else{
		// ALL SERVICES NAV MOBILE
		$('.all-services__btn--mobile').click(function(){
			event.preventDefault();
			if(!$(this).hasClass('all-services__btn--mactive')){
				$('.all-services__navi--mobile').slideDown();
				$(this).addClass('all-services__btn--mactive');

			}
			else{
				$('.all-services__navi--mobile').slideUp();
				$(this).removeClass('all-services__btn--mactive');
			}
		});

		servItemLink.on('click', function(){
			event.preventDefault();
			if(!$(this).parent('li').hasClass('all-services__item--active')){
				$('.all-services__item--has-submenu ul').slideUp();
				$(this).siblings('ul').slideDown();
				$('.all-services__item--has-submenu').removeClass('all-services__item--active');
				$(this).parent('li').addClass('all-services__item--active');
			}
			else{
				$(this).parent('li').removeClass('all-services__item--active');
				$(this).siblings('ul').slideUp();
			}
		});

		$('.all-services__list ul li a').click(function(event){
			event.preventDefault();
			let currTitleServ=$(this).text();
			servContentTitle.text(currTitleServ);
			$('.all-services__btn--mobile span').text(currTitleServ);
			$('.all-services__btn--mobile').val(currTitleServ);
			$('.all-services__navi--mobile').slideUp();
			$('.all-services__btn--mobile').removeClass('all-services__btn--mactive');
		});

		// ALL SERVICES SEARCH MOBILE
		$('.all-services__searchbtn--mobile').click(function(){
			event.preventDefault();
			if(!$(this).hasClass('all-services__searchbtn--mactive')){
				$('.all-services__search-content').slideDown();
				$(this).addClass('all-services__searchbtn--mactive');

			}
			else{
				$('.all-services__search-content').slideUp();
				$(this).removeClass('all-services__searchbtn--mactive');
			}
		});
	}

	// ACCORDION
	$('.btn-faq').click(function(event){
		$('.card-header.faq').removeClass('card__item--active').find('.faq-figure').css('transform', 'none');
		$(this).closest('.card-header').addClass('card__item--active');
		var o=$(this);
		if($(this).attr('aria-expanded')=='false'){																												// раскрытие уровня, смотреть вверх
			setTimeout(function(){
				o.find('.faq-figure').css('transform', 'rotate(180deg)');
			}, 20);
			if(o.attr('data-fullName')!=undefined){
				o.attr({'data-shortName': o.find('.group-name').text(), 'data-height': o.css('height')}).css('height', 'auto').find('.group-name').text(o.attr('data-fullName'));
			}
		}
		else{																																					// закрытие уровня
			setTimeout(function(){
				o.find('.faq-figure').css('transform', 'none');
			}, 20);
			if(o.attr('data-fullName')!=undefined){
				o.css('height', o.attr('data-height')).find('.group-name').text(o.attr('data-shortName'));
			}
			setTimeout(function(){
				o.blur();
			}, 1000);
		}
	});

	// SEARCH BLOCK HEADER
	$('.header__search').click(function () {
		event.preventDefault();
		if (!$(this).hasClass('search-block--active')) {
			$(this).addClass('search-block--active');
			$('.inline-search-block').slideDown();

		} else {
			$(this).removeClass('search-block--active');
			$('.inline-search-block').slideUp();
		}
	});

	// VIDEO POPUPS
	$(".fancybox-video").fancybox({
		type: "iframe",
		// other API options
	})
	// PHOTO POPUPS
	$(".fancybox-photo").fancybox({
		openEffect: 'none',
		closeEffect: 'none'
	});


	// PAGE FORMS
	$('.contacts-form__item input[type="radio"]').click(function () {
		let targetRadio = $(this).val();
		if (targetRadio == 'онлайн') {
			$('.form-accept--online').removeClass('item--hidden');
		}
		if (targetRadio == 'в клинике') {
			$('.form-accept--online').addClass('item--hidden');
			$.fancybox.close();
			$.fancybox.open({
				src: '#popup-attention',
				type: 'inline',
				opts: {
					afterShow: function (instance, current) {
						console.info('done!');
					}
				}
			});

		}
	});

	// HOME NAVIGATION MOBILE
	$('.home-footer-navi-trigger').click(function () {
		event.preventDefault();

		if (!$(this).hasClass('home-footer-navi--active')) {
			$(this).addClass('home-footer-navi--active');
			$('.home-footer-navi').slideDown();
		} else {
			$(this).removeClass('home-footer-navi--active');
			$('.home-footer-navi').slideUp();
		}

	});


	// TEAM HOME DATA FILTER  НАШИ ВРАЧИ
	var example = new DataFilterJS({
		filterGroup: '.filter-group',
		filterNode: '.filter-node',
		filterButtonGroup: '.filter-search',
		transitionSpeed: '0.75s'
	});

	function DataFilterJS(config) {
		var filterGroup = config.filterGroup;
		var filterNode = config.filterNode;
		var filterButtonGroup = config.filterButtonGroup;
		var transitionSpeed = config.transitionSpeed;
		var filter_group = $(filterGroup);
		var filter_node = $(filterGroup + ' > ' + filterNode);
		var search_val = $(filterButtonGroup + '> ' + 'input[type="text"]').value;
		$(filterGroup + ', ' + filterNode + ', ' + filterNode + '.filter-me').css({ "transition": "all " + transitionSpeed });

		// (Button) Data Filter Function
		$(filterButtonGroup + ' .filter-button').on('click', function (e) {
			$('.btn-team-filter').removeClass('btn-team-filter--active');
			$(this).addClass('btn-team-filter--active');
			var eventFilter = e.currentTarget.attributes[1].nodeValue;
			// Loop through Filter Nodes on Button Click
			$.each(filter_node, function (i, v) {
				if (eventFilter == "*") {
					filter_node[i].classList.remove('filter-me');
				} else if (filter_node[i].getAttribute('data-filter').includes(eventFilter) == false) {
					filter_node[i].classList.add('filter-me')
				} else { filter_node[i].classList.remove('filter-me'); }
			});
		}); // end click event

		// (Keystroke) Data Filter Function    
		$(filterButtonGroup + ' > input[type="text"]').on('keypress keydown keyup', function (e, fnd) {
			// Loop through Filter Nodes on Keystroke
			$.each($(filterNode), function (i, v) {
				var node = v.getAttribute("data-filter").toString().toUpperCase();
				var search_string = $(filterButtonGroup + ' > ' + 'input[type="text"]').val().toUpperCase();
				//console.log(node.getAttribute('data-filter'));
				if (node.includes(search_string) == false) {
					v.classList.add('filter-me');
				} else { v.classList.remove('filter-me'); }
			}); // end each
		}); // end keypress
	}

	// EQUAL BLOCK HEIGHT 
	if ($(window).width() > 767) {
		function equalWidth(selector) {
			var wider = 0;
			jQuery(selector).each(function () {
				var thisWidth = jQuery(this).width();
				if (thisWidth > wider) {
					wider = thisWidth;
				}
			});
			jQuery(selector).width(wider);
		}
		function equalHeight(selector) {
			var tallest = 0;
			jQuery(selector).each(function () {
				var thisHeight = jQuery(this).height();
				if (thisHeight > tallest) {
					tallest = thisHeight;
				}
			});
			jQuery(selector).height(tallest);
		}

		equalWidth(".page-form-1 .page-form__name");
		equalWidth(".page-form-2 .page-form__name");


		// Равная высота в карточках специалистов
		equalHeight(".all-specialists .specialists-item__content .specialists-item__title");
		equalHeight(".all-specialists .specialists-item__content");

		// Равная высота колонок на 3 шаге записи
		// equalHeight( ".page-form-3 .page-form-3__col" );

		equalHeight(".row-all-news .item-news__text");
		equalHeight(".row-all-news .allnews-item__title");
		equalHeight(".home .item-news__title");
	}

	// FIXED MENU
	var nav = $('#menu-fix');
	var navSearch = $('.inline-search-block');

	$(window).scroll(function () {
		if ($(this).scrollTop() > 136) {
			nav.addClass("f-nav");
			navSearch.addClass("inline-search-block--fixed");
		} else {
			nav.removeClass("f-nav");
			navSearch.removeClass("inline-search-block--fixed");
		}
	});


	// $(function(){
	// 	$nav = $('.fixed-div');
	// 	$nav.css('width', $nav.outerWidth());
	// 	$window = $(window);
	// 	$h = $nav.offset().top;
	// 	$window.scroll(function(){
	// 		if ($window.scrollTop() > $h){
	// 			$nav.addClass('fixed');
	// 		} else {
	// 			$nav.removeClass('fixed');
	// 		}
	// 	});
	// });

	// FIXED SIDEBAR SINGLE
	const $window = $(window);
	const $sidebar = $(".aside-news");

	// if ($('.aside-news').length > 0) {
	// 	let $sidebarTop = $sidebar.position().top;
	// 	let $sidebarHeight = $sidebar.height();
	// 	let $footer = $('.footer');
	// 	let $footerTop = $footer.position().top;
	// 	$h = $sidebar.offset().top;
	//
	// 	$window.scroll(function (event) {
	// 		if ($window.scrollTop() > $h) {
	// 			$sidebar.addClass("fixed-aside");
	// 		} else {
	// 			$sidebar.removeClass('fixed-aside');
	// 		}
	//
	// 		var $scrollTop = $window.scrollTop();
	// 		var $topPosition = Math.max(0, $sidebarTop - $scrollTop);
	//
	// 		if ($scrollTop + $sidebarHeight > $footerTop) {
	// 			var $topPosition = Math.min($topPosition, $footerTop - $scrollTop - $sidebarHeight);
	// 		}
	// 		$sidebar.css("top", $topPosition);
	// 	});
	// }

	$('.specialists-filter__item--adlink').click(function () {																							// Список специальностов
		event.preventDefault();
		$('.specialists-filter__list--doc').slideDown();

	});

	$('.spec-list__additem a').click(function () {																										// Список специальностов
		event.preventDefault();
		$('.specialists-filter__list--doc').slideUp();

		$("input[name='SPECIALIZATION']").val($(this).closest('.spec-list__additem').text());
		$('#section_id').val($(this).closest('.spec-list__additem').data('id'));
	});

	$(document).ready(function () {																														// Количество услуг и галереи на странице Специалиста
		if (jQuery('.specialists-tabs__service').length > 0) {
			let cntReview = $('#comments li').length;
			let lengthServices = jQuery('.tab-services .tab-services__list li').length;
			let lengthSlides = jQuery('.tab-gallery-slider__wrapper-1 .gallery-item').length;
			let lengthSlides2 = jQuery('.tab-gallery-slider__wrapper-2 .gallery-item').length;
			let allSlides = lengthSlides + lengthSlides2;
			jQuery(".specialists-tabs__reviews span").html(cntReview);
			jQuery('.specialists-tabs__service span').html(lengthServices);
			jQuery('.specialists-tabs__gallery span').html(allSlides);
			if(allSlides == 0){
				$('#spec_gallery-specialist').html("<div class=''>В галереи врача нет фотографий</div>");
			}
		}
	});

	// PRELOADER
	// jQuery("body").find(".pageloader").delay(1e3).fadeOut("slow")

	// BTN TO TOP
	var top_show = 150;																																// В каком положении полосы прокрутки начинать показ кнопки "Наверх"
	var delay = 1000;																																	// Задержка прокрутки

	$(window).scroll(function () {																														// При прокрутке попадаем в эту функцию
		/* В зависимости от положения полосы прокрукти и значения top_show, скрываем или открываем кнопку "Наверх" */
		if ($(this).scrollTop() > top_show) $('#top').fadeIn();
		else $('#top').fadeOut();
	});
	$('#top').click(function () {																															// При клике по кнопке "Наверх" попадаем в эту функцию
		/* Плавная прокрутка наверх */
		$('body, html').animate({
			scrollTop: 0
		}, delay);
	});

	var numcount = localStorage.getItem('numcount');

	if(!numcount){
		//  jQuery animated number counter
		$('.num-count').each(function () {
			$(this).prop('Counter', 0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				}
			});
		});
		localStorage.setItem('numcount', 'true');
	}

	// MENU
	if ($(window).width() < 992) {
	}
	else {
		$(".drop-down").hover(function () {
			$(this).children('.mega-menu').addClass('display-on');
		});
		$(".drop-down").mouseleave(function () {
			$(this).children('.mega-menu').removeClass('display-on');
		});
	}

	// OPEN BUREGER MENU
	$('.menu-collapsed').click(function (event) {
		$('#mobile-menu').addClass('mobile-menu--active');
		$("html,body").css("overflow", "hidden");
		$("#menu-fix").removeClass("f-nav");
	});

	// CLOSE BUREGER MENU
	$('.close-menu').click(function (event) {
		$('#mobile-menu').removeClass('mobile-menu--active');
		$("html,body").css("overflow", "auto");
		$("html,body").css("overflowX", "hidden");
	});

	// OPEN SUB MENU
	$('.menu-block .menu-name .arrow').click(function (event) {
		$(this).toggleClass('rotate');
		$(this).closest('.menu-name').find('.name').toggleClass('active');
		$(this).closest('.menu-block').find('.header-submenu').slideToggle();
	});

	// OPEN SUB MENU
	// $(".has-submenu").click(function () {
	// 		event.preventDefault();
	// 		event.stopPropagation();
	// 		$(this).find('.submenu-icon').toggleClass('active-menu-icon');
	// 	 	$(this).toggleClass('active-menu-item');
	// 		$(this).find('.mega-menu').toggleClass('display-on');
	// });

	$(".onPress").click(function () {
		event.preventDefault();
		event.stopPropagation();
		$(this).toggleClass('active-menu-icon');
		$(this).parent().toggleClass('active-menu-item');
		$(this).siblings('.mega-menu').toggleClass('display-on');
	});

	$(".menu-expanded .burger-menu__icon").click(function () {
		$('.menu-collapsed ul li').removeClass('active-menu-item');

	});

	// TABS SPECIALIST  
	$('#tabs-specialists a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
		$("#tabs-specialists li").removeClass('active');
		$(this).parent().addClass('active');
		let curHref = $(this).attr('href');
		/*if (curHref == '#spec_reviews') {
			$('.specialists-tabs').addClass('grey-tabs');
		} else {
			$('.specialists-tabs').removeClass('grey-tabs');
		}*/
	});

	// TABS DOCUMENTS
	$('#tabs-documents a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
		let curHref = $(this).attr('href');
		if (curHref == '#spec_reviews') {
			$('.specialists-tabs').addClass('grey-tabs');
		} else {
			$('.specialists-tabs').removeClass('grey-tabs');
		}
	});

	// SUCCESS POPUP

	$.fn.setCursorPosition=function(pos){
		if($(this).get(0).setSelectionRange){
			$(this).get(0).setSelectionRange(pos, pos);
		}
		else if($(this).get(0).createTextRange){
			var range=$(this).get(0).createTextRange();
			range.collapse(true);
			range.moveEnd('character', pos);
			range.moveStart('character', pos);
			range.select();
		}
	};

	// PHONE MASK --------------------------------
	// $.mask.definitions['h']="[0|1|3|4|5|6|7|9]";
	$.mask.definitions['h']="[9]";

	$("#order_frm_phone, .wpcf7-tel").attr('type', 'tel');

	$("#order_frm_phone, .wpcf7-tel").click(function(){
		telFocus(this);
	});

	$("#order_frm_phone, .wpcf7-tel").focus(function(){
		telFocus(this);
	});

	$("#order_frm_phone, .wpcf7-tel").keydown(function(e){																								// срабатывает даже если зажать клавишу
		if(e.which==37 || e.which==39 || e.which==38 || e.which==40){																							// стрелки отключить
			e.preventDefault();
		}
	});

	$("#order_frm_phone, .wpcf7-tel").keyup(function(e){
		if(e.which==229 && $(this).val()=='+7 (___) ___-__-__'){
			telFocus(this);
		}
		if(e.which==27){
			telFocus(this);
		}
	});

	function telFocus(e){
		val=$(e).val();
		if(val.length==0 || val=="+7 (" || val=="+7 (___) ___-__-__"){
			$(e).mask("+7 (h99) 999-99-99", {placeholder:"+7 (___) ___-__-__"});
			$(e).val("+7 (___) ___-__-__");
			$(e).setCursorPosition(4);
			// e.preventDefault();
			// return false;
		}
	}

	// ADD REVIEW
	$(".add-review__btn").click(function () {
		event.preventDefault();
		$('.wpd-form-wrap').show();
		$(this).hide();
	});

	// HIDDEN INPUTS
	$(".order-appointment").click(function () {
		titleService = $(this).attr('data-title-service');
		priceService = $(this).attr('data-price-service');

		$('.hide-title').val(titleService);
		$('.hide-price').val(priceService);
	});

	// HIDDEN INPUTS SPEC
	$(".btn-spec-order").click(function () {
		titleSpec = $(this).attr('data-title-spec');
		$('.hide-spec').val(titleSpec);
	});

	// OWL SLIDER

	// MAIN HOME SLIDER
	if ($('#main-slider').length > 0) {
		const owlMainSlider = $("#main-slider");
		if (window.innerWidth >= 769) {
			owlMainSlider.owlCarousel({
				items: 1,
				loop: true,
				nav: false,
				dots: false,
				mouseDrag: false,
				autoplay: false,
				autoplayTimeout: 8000,
				autoPlay: 3000,
				speed: 1200,
				smartSpeed: 2100,
				paginationSpeed: 7000,
				animateOut: "slideOutDown",
				animateIn: "slideInDown",
				responsive: {
					0: {
						animateOut: "fadeOut",
						animateIn: "fadeIn",
						nav: false,
						dots: false,
						autoplayHoverPause: false,
						mouseDrag: false,
						touchDrag: false,
						items: 1
					},
					550: {
						animateOut: "fadeOut",
						animateIn: "fadeIn",
						nav: false,
						dots: false,
						autoplayHoverPause: false,
						mouseDrag: false,
						touchDrag: false,
						items: 1
					},
					768: {
						items: 1,
						autoplayHoverPause: false,
						animateOut: "slideOutDown",
						animateIn: "slideInDown",
					},
					2000: {
						items: 1,
						animateOut: "slideOutDown",
						animateIn: "slideInDown",
					}
				}
			});
		} else {
			owlMainSlider.owlCarousel({
				items: 1,
				loop: true,
				nav: false,
				dots: false,
				mouseDrag: false,
				autoplay: true,
				autoplayTimeout: 8000,
				autoPlay: 3000,
				speed: 800,
				smartSpeed: 1200,
				paginationSpeed: 7000,
				responsive: {
					0: {
						nav: false,
						dots: false,
						autoplayHoverPause: false,
						mouseDrag: false,
						touchDrag: false,
						items: 1
					},
					550: {
						nav: false,
						dots: false,
						autoplayHoverPause: false,
						mouseDrag: false,
						touchDrag: false,
						items: 1
					},
					768: {
						items: 1,
						autoplayHoverPause: false,
						animateOut: "slideOutDown",
						animateIn: "slideInDown",
					},
					2000: {
						items: 1,
						animateOut: "slideOutDown",
						animateIn: "slideInDown",
					}
				}


			});
		}


		$(".main-slider__nav .slider__nav-next").click(function () {
			owlMainSlider.trigger("next.owl.carousel");
		});
		$(".main-slider__nav .slider__nav-prev").click(function () {
			owlMainSlider.trigger("prev.owl.carousel");
		});
	}

	// SERVICES AND PRICES SLIDER
	if ($('#services-prices__slider').length > 0) {
		let owlSp = $("#services-prices__slider");
		owlSp.owlCarousel({
			items: 5,
			lazyLoad: true,
			loop: true,
			autoPlay: 3000,
			singleItem: false,
			speed: 900,
			margin: 20,
			dots: false,
			nav: false,
			responsive: {
				0: {
					items: 1
				},
				550: {
					items: 2
				},
				768: {
					items: 4
				},
				1000: {
					items: 5
				}
			}
		});
		$(".services-prices-slider-wrap .slider__nav-next").click(function () {
			owlSp.trigger("next.owl.carousel");
		});
		$(".services-prices-slider-wrap .slider__nav-prev").click(function () {
			owlSp.trigger("prev.owl.carousel");
		});
	}

	// MAIN DIRECTIONS


	if ($('#main-directions__owl2').length > 0) {
		let owlDirections2 = $("#main-directions__owl2");
		owlDirections2.owlCarousel({
			items: 5,
			lazyLoad: true,
			loop: true,
			autoPlay: 3000,
			singleItem: false,
			speed: 900,
			dots: false,
			margin: 13,
			nav: false,
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 2
				},
				800: {
					items: 3
				},
				1000: {
					items: 4
				},
				1200: {
					items: 5
				}
			}

		});

		$(".main-directions__nav2 .slider__nav-next").click(function () {
			owlDirections2.trigger("next.owl.carousel");
		});
		$(".main-directions__nav2 .slider__nav-prev").click(function () {
			owlDirections2.trigger("prev.owl.carousel");
		});
	}


	// SHOW MAIN DIRECTIONS VS TABS
	$('.main_directions__adult').show();
	$('.main_directions__children').hide();

	$('.services-prices-inner #tabs-specialists a').on('click', function (e) {
		e.preventDefault()
		$(this).tab('show');
		targetTab = jQuery(this).attr("href");
		if (targetTab == '#services_child') {
			$('.main_directions__adult').hide();
			$('.main_directions__children').show();
		} else {
			$('.main_directions__children').hide();
			$('.main_directions__adult').show();
		}
	})


	// OUR TEAM SWIPER SLIDER
	if ($('.swiper-container.two').length > 0) {
		var swiper = new Swiper('.swiper-container.two', {
			pagination: '.swiper-pagination',
			paginationClickable: true,
			observer: true,
			effect: 'coverflow',
			loop: true,
			// speed: 1400,
			// autoplay: {
			// 	delay: 17000,
			// },
			centeredSlides: true,
			slidesPerView: 'auto',
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',
			coverflow: {
				rotate: 0,
				stretch: 130,
				depth: 90,
				modifier: 2,
				slideShadows: false,
			}
		});
	}

	let timesheet = $("#timesheet"); 
	timesheet.owlCarousel({
		items: 7,
		singleItem: false,
		dots: false,
		nav: false,
		responsive: {
			0: {
				items: 3
			},
			550: {
				items: 7
			},
			768: {
				items: 7
			},
			1000: {
				items: 7
			}
		}
	});
	$(".timesheet-nav .slider__nav-next").click(function () {
		timesheet.trigger("next.owl.carousel");
	});
	$(".timesheet-nav .slider__nav-prev").click(function () {
		timesheet.trigger("prev.owl.carousel");
	});

	// OUR TEAM SLIDER
	if ($('#our-team__owl--home').length > 0) {
		let owlSpecialistsHome = $("#our-team__owl--home");
		owlSpecialistsHome.owlCarousel({
			items: 1,
			lazyLoad: true,
			center: true,
			loop: true,
			autoPlay: 3000,
			singleItem: false,
			speed: 900,
			margin: 20,
			dots: false,
			nav: false,
			responsive: {
				0: {
					items: 1
				},
				550: {
					items: 1
				},
				768: {
					items: 1
				},
				1000: {
					items: 1
				}
			}

		});

		$(".our-team__nav .slider__nav-next").click(function () {
			owlSpecialistsHome.trigger("next.owl.carousel");
		});
		$(".our-team__nav .slider__nav-prev").click(function () {
			owlSpecialistsHome.trigger("prev.owl.carousel");
		});
	}

	// other-specialists
	if ($('#our-team__owl').length > 0) {
		let owlSpecialists = $("#our-team__owl");
		owlSpecialists.owlCarousel({
			items: 3,
			lazyLoad: true,
			center: true,
			loop: true,
			autoPlay: 3000,
			singleItem: false,
			speed: 900,
			margin: 20,
			dots: false,
			nav: false,
			responsive: {
				0: {
					nav: true,
					items: 1
				},
				550: {
					nav: true,
					items: 1
				},
				768: {
					center: false,
					items: 2
				},
				992: {
					items: 2
				},
				1000: {
					items: 3
				}
			}
		});

		$(".our-team__nav .slider__nav-next").click(function () {
			owlSpecialists.trigger("next.owl.carousel");
		});
		$(".our-team__nav .slider__nav-prev").click(function () {
			owlSpecialists.trigger("prev.owl.carousel");
		});
	}

	// GALLERY SPECIALIST SLIDER
	if ($('#tab-gallery__slider-1').length > 0) {
		let owlGal1 = $("#tab-gallery__slider-1");
		owlGal1.owlCarousel({
			items: 4,
			lazyLoad: true,
			loop: true,
			autoPlay: 3000,
			singleItem: false,
			speed: 900,
			margin: 20,
			dots: false,
			nav: false,
			responsive: {
				0: {
					items: 1
				},
				580: {
					items: 2
				},
				768: {
					items: 3
				},
				1000: {
					items: 4
				}
			}
		});

		$(".tab-gallery-slider__wrapper-1 .slider__nav-next").click(function () {
			owlGal1.trigger("next.owl.carousel");
		});
		$(".tab-gallery-slider__wrapper-1 .slider__nav-prev").click(function () {
			owlGal1.trigger("prev.owl.carousel");
		});
	}
	if ($('#tab-gallery__slider-2').length > 0) {
		let owlGal2 = $("#tab-gallery__slider-2");
		owlGal2.owlCarousel({
			items: 4,
			lazyLoad: true,
			loop: true,
			autoPlay: 3000,
			singleItem: false,
			speed: 900,
			margin: 20,
			dots: false,
			nav: false,
			responsive: {
				0: {
					items: 1
				},
				580: {
					items: 2
				},
				768: {
					items: 3
				},
				1000: {
					items: 4
				}
			}

		});

		$(".tab-gallery-slider__wrapper-2 .slider__nav-next").click(function () {
			owlGal2.trigger("next.owl.carousel");
		});
		$(".tab-gallery-slider__wrapper-2 .slider__nav-prev").click(function () {
			owlGal2.trigger("prev.owl.carousel");
		});
	}
	if ($('#tab-gallery__slider-3').length > 0) {
		let owlGal3 = $("#tab-gallery__slider-3");
		owlGal3.owlCarousel({
			items: 4,
			lazyLoad: true,
			loop: true,
			autoPlay: 3000,
			singleItem: false,
			speed: 900,
			margin: 20,
			dots: false,
			nav: false,
			responsive: {
				0: {
					items: 1
				},
				580: {
					items: 2
				},
				768: {
					items: 3
				},
				1000: {
					items: 4
				}
			}
		});

		$(".tab-gallery-slider__wrapper-3 .slider__nav-next").click(function () {
			owlGal3.trigger("next.owl.carousel");
		});
		$(".tab-gallery-slider__wrapper-3 .slider__nav-prev").click(function () {
			owlGal3.trigger("prev.owl.carousel");
		});
	}

	if ($('.documents__slider').length > 0) {
		$(".documents__slider").owlCarousel({
			items: 3,
			lazyLoad: true,
			loop: true,
			autoPlay: 3000,
			singleItem: false,
			speed: 1200,
			smartSpeed: 1000,
			margin: 20,
			dots: false,
			nav: true,
			responsive: {
				0: {
					items: 1
				},
				580: {
					items: 2
				},
				768: {
					items: 2
				},
				1000: {
					items: 3
				}
			}
		});
	}

	$(document).ready(function() {
		sliderInit2();
	})
	$(window).resize(function() {
		sliderInit2();
	});
function sliderInit2(){
	$('.owl-slider-news').owlCarousel('destroy');
	$(".owl-slider-news").owlCarousel({
		items:3,
		autoplay: false,
		margin: 15,
		loop: false,
		dots: false,
		nav: false,
		responsive:{
			0:{
				items:1
			},
			650:{
				items:2
			},
			900:{
				items:3
			},
		}
	});
	$(".some-news__nav .slider__nav-next").click(function () {
		$(".owl-slider-news").trigger("next.owl.carousel");
	});
	$(".some-news__nav .slider__nav-prev").click(function () {
		$(".owl-slider-news").trigger("prev.owl.carousel");
	});
}
	$('#directions-click').click(function(){
		$.ajax({
			type:"POST",
			url:"/include/ajax/directions-show.php",
			data:{},
			// dataType:'json',
			cache:false,
			success:function(data){
				console.log(data);
				$('#directions').html(data).css('height', '100%');
			},
			error:function(jqXHR, exception){
				console.log(jqXHR);
				alert('что то пошло не так '+jqXHR+exception);
			},
		});
	});

	// $("img.lazyload").lazyload({
	// 	effect:"fadeIn"
	// });

	$('#specialization').change(function(e){																												// выбор специальзации
		e.preventDefault();
		$('#service').empty();
		$('#doctor').empty();
		$('#clinic').empty();
		specialization=$(this).val();
		$.ajax({
			type:"POST",
			url:"/include/ajax/get-services.php",
			data:{
				'sectionID': specialization,
			},
			dataType:'json',
			cache:false,
			success:function(data){
				$('#service').append('<option value="">любая</option>');
				$.each(data, function(key, value){
					$('#service').append('<option value="'+key+'">'+value+'</option>');
				});
				$('#service').attr('disabled', false).trigger('refresh');
			},
			error:function(jqXHR, exception){
			},
		});
	});
	var Doctors=[];
	$('#service').change(function(e){																														// выбор услуги
		e.preventDefault();
		$('#doctor').empty();
		$('#clinic').empty();
		service=$(this).val();
		$.ajax({
			type:"POST",
			url:"/include/ajax/get-doctors.php",
			data:{
				'sectionID': service,
			},
			dataType:'json',
			cache:false,
			success:function(data){
				console.log(data);
				Doctors=data;
				console.log(Doctors);
				$('#doctor').append('<option value="">любой</option>');
				$.each(data, function(key, value){
					$('#doctor').append('<option value="'+key+'">'+value.NAME+'</option>');
				});
				$('#doctor').attr('disabled', false).trigger('refresh');
			},
			error:function(jqXHR, exception){
			},
		});
	});
	$('#doctor').change(function(e){																														// выбор доктора
		e.preventDefault();
		$('#clinic').empty();
		doctor=$(this).val();
		if(Object.keys(Doctors[$(this).val()].CLINIC).length){
			$('#clinic').append('<option value="">любой</option>');
			$.each(Doctors[$(this).val()].CLINIC, function(key, value){
				$('#clinic').append('<option value="'+key+'">'+value+'</option>');
			});
			$('#clinic').attr('disabled', false).trigger('refresh');
		}
	});
	$('#clinic').change(function(e){																														// выбор клиники
		e.preventDefault();
		clinic=$(this).val();
	});
});

function heightCalul(){
	$('.direction-item-img').each(function(){
		$(this).css('line-height', $(this).css('max-height'));
		let img=$(this).find('img'), x;
		// if($(window).width()<650) x=0.96;
		// else x=0.9;
		x=($(window).width()<650)?0.96:0.9;
		let mh=($(img).prop("height")*x-$(img).prop("width"))/2;
		mh='-'+mh+'%'+' auto';
		$(img).css('margin', mh);
	});
}

function calendarInit(){
	$('#month-plus, #month-minus, #month-today').click(function(){
		$.ajax({
			type:"POST",
			url:"/include/ajax/calendar-shedule.php",
			data:{
				'month': $(this).data('month'),																													// смещение месяца (0 - текущий)
				'age': $(this).data('age'),																														// детский/взрослый
				'specialization': specialization,
				'service': service,
				'doctor': doctor,
				'clinic': clinic
			},
			dataType:'html',
			cache:false,
			success:function(data){
				$('#schedule-doctors').html(data);
			},
			error:function(jqXHR, exception){
			},
		});
	});
}

//yandex цели в мобильном нижнем меню
$('.mobile_box__flex .call').click(function(){
	ym(87764265,'reachGoal','MobileMenu_Tel');
});
$('.mobile_box__flex .write').click(function(){
	ym(87764265,'reachGoal','MobileMenu_Chat');
});
$('.mobile_box__flex .to-order').click(function(){
	ym(87764265,'reachGoal','MobileMenu_Form');
});


//Закрытие звезд при оценке
$('.form .star').on("click", function(){
	d = $(this).val();
	
	$(".form  .star").each(function(i,el){

			$(this).removeClass('starfull');

		if($(this).val()<=d)
			$(this).addClass('starfull');

	});
});

$('.form  .star').hover(function(){
	d = $(this).val();
	$(".form  .star").each(function(i,el){

			$(this).removeClass('starfull');

		if($(this).val()<=d)
			$(this).addClass('starfull');

	});
});
//Открытие виджета ОНДОК
$('.open_ondocwidjet').on('click', function(){
	$('.ondoc-s-btn').click();
})

$(document).ready(function(){
  $("#popular_slider_owl").owlCarousel({
     nav:false,
     margin: 20,
     loop: true,
     mouseDrag: true,
     mouseDrag: true,
     dots: false,
     autoPlay:false,     
  	 responsive:{
				0: {items: 1},
				600: {items: 2},
				800: {items: 3},
				1000: {items: 5},
				1200: {items: 5}
        }
  });

    $("#popular-services__owl").owlCarousel({
     nav:false,
     margin: 20,
     loop: true,
     mouseDrag: true,
     mouseDrag: true,
     dots: false,
     autoPlay:false,     
  	 responsive:{
				0: {items: 1},
        }
  });

	$(".your-questions__top .slider__nav-next").click(function () {
		 $("#popular-services__owl").trigger("next.owl.carousel");
	});
	$(".your-questions__top .slider__nav-prev").click(function () {
		 $("#popular-services__owl").trigger("prev.owl.carousel");
	});

	$(".phone-mask").mask("+7 (999) 999-9999");
});