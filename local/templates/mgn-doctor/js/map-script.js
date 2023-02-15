document.addEventListener('DOMContentLoaded', (event) => {

	// Плавный скролл
	$(".how-to-get__btn").on("click", function (event) {
		event.preventDefault(); //опустошим стандартную обработку
		var id  = $(this).attr('href'), //заберем айдишник блока с параметром URL
			top = $(id).offset().top; //определим высоту от начала страницы до якоря
	$('body,html').animate({scrollTop: top}, 1000); //сделаем прокрутку за 1 с
	});


 	// YANDEX MAPS FOR CONTACT PAGE
	if($('#map').length>0){
		ymaps.ready(init);

		function init(){  
		    var myMap = new ymaps.Map("map", {
		        center: [53.367,58.97],
		        zoom: 13,
		        controls: ['zoomControl'],
		        behaviors: ['drag']
		    });
		  
		    var placemark = new ymaps.Placemark([53.35729307109895, 58.97059850000001],{
		        hintContent: '<div class="map__hint">Семейный доктор, г. Магнитогорск, ул. Жукова, дом 11</div>',
		        balloonContent: [
		          '<div class="map__balloon">',
		          ' ',
		          'Семейный доктор<br> г. Магнитогорск, ул. Жукова, дом 11',
		          '</div">',
		        ].join('')
		    },
		    {
		        iconLayout: 'default#image',
		        iconImageHref: '../img/main_logo.svg',
		        iconImageSize: [80, 41],
		        iconImageOffset: [-23, -57]
		    });

		    var placemark2 = new ymaps.Placemark([53.376082, 58.965819],{
		        hintContent: '<div class="map__hint">Семейный доктор, г. Магнитогорск, ул. Доменщиков, д.8А</div>',
		        balloonContent: [
		          '<div class="map__balloon">',
		          ' ',
		          'Семейный доктор, г. Магнитогорск, ул. Доменщиков, д.8А',
		          '</div">',
		        ].join('')
		    },
		    {
		        iconLayout: 'default#image',
		        iconImageHref: '../img/main_logo.svg',
		        iconImageSize: [80, 41],
		        iconImageOffset: [-23, -57]
		    });
		  
		    myMap.geoObjects.add(placemark); 
		    myMap.geoObjects.add(placemark2); 
		}
	}
	 
	// if($('#map2').length>0){
	// 	ymaps.ready(init);

	// 	function init(){  
	// 	    var myMap = new ymaps.Map("map2", {
	// 	        center: [53.376082, 58.965819],
	// 	        zoom: 16,
	// 	        controls: ['zoomControl'],
	// 	        behaviors: ['drag']
	// 	    });
		  
	// 	    var placemark = new ymaps.Placemark([53.376082, 58.965819],{
	// 	        hintContent: '<div class="map__hint">Семейный доктор, г. Магнитогорск, ул. Доменщиков, д.8А</div>',
	// 	        balloonContent: [
	// 	          '<div class="map__balloon">',
	// 	          ' ',
	// 	          'Семейный доктор, г. Магнитогорск, ул. Доменщиков, д.8А',
	// 	          '</div">',
	// 	        ].join('')
	// 	    },
	// 	    {
	// 	        iconLayout: 'default#image',
	// 	        iconImageHref: '../img/main_logo.svg',
	// 	        iconImageSize: [80, 41],
	// 	        iconImageOffset: [-23, -57]
	// 	    });
		  
	// 	    myMap.geoObjects.add(placemark); 
	// 	}
	// }

	// TOGGLE MAPS
	// $('.nav-tabs-contacts .nav-item:nth-child(1) .nav-link').click(function(){
	// 	$('#map2').removeClass('active--map');
	// 	$('#map').addClass('active--map');
	// });
	// $('.nav-tabs-contacts .nav-item:nth-child(2) .nav-link').click(function(){
	// 	$('#map').removeClass('active--map');
	// 	$('#map2').addClass('active--map');
	// });

});