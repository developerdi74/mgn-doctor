$(document).ready(function(){
	load_main();
});

function load_main () { //Функция, получающая данные с сервера методом ajax
  $.ajax({
    type: "POST", //Метод передачи параметров на сервер: GET или POST
    cache: false, //Кешировать ли полученные данные
    url: "/include/raspisanie.php", //Откуда берём данные
    data: {
    	NAME: $('#data_name_clinic').attr("name"),
    	CLINIC: $('#data_name_clinic').attr("clinic"),
    }, //Какие-то параметры которые вы хотите передать на сервер.
    async: true, //Асинхронная загрузка - грузить фронтенд не дожидаясь ответа сервера
    success: function (html) {  // Что делаем, если данные успешно получены.
      $(".ajax-raspisane-load").html(html); //Добавить html код, сгенерированный сервером, в начало
      load_owl_detail();               //контейнера main
    }
  });

}
function load_owl_detail(){
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


	$(".timesheet .timesheet__time-block").each(function(){
			if($(this).find('a').length == 0){
				$(this).html("<div class='timesheet__text'>В этот день приема нет</div>");
			}
		});

}