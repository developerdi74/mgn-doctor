<?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	"main",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONTROLS" => array("ZOOM","MINIMAP","TYPECONTROL","SCALELINE"),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.04452156352566;s:10:\"yandex_lon\";d:43.697661041869985;s:12:\"yandex_scale\";i:4;s:10:\"PLACEMARKS\";a:3:{i:0;a:3:{s:3:\"LON\";d:37.623439111328;s:3:\"LAT\";d:55.75417970656;s:4:\"TEXT\";s:118:\"ТК Маяк Удачи###RN######RN###г. Москва, ул. Цвиллинга, д.97###RN######RN###Пн–Пт: 9.00 - 18.00 ###RN###Сб–Вс: выходные\";}i:1;a:3:{s:3:\"LON\";d:58.983028582031;s:3:\"LAT\";d:53.411260867063;s:4:\"TEXT\";s:120:\"ТК Стрела###RN######RN###г. Магнитогорск, ул. Энтузиастов 159###RN######RN###Пн–Пт: 9.00 - 18.00 ###RN###Сб–Вс: выходные\";}i:2;a:3:{s:3:\"LON\";d:37.4281584021;s:3:\"LAT\";d:55.889777060519;s:4:\"TEXT\";s:126:\"Магазин \"Магнолия\"###RN######RN###г. Химки, пер. Лермонтова, 55###RN######RN###Пн-Пт: 8.30 - 18.30 ###RN###Сб-Вс: 9.00 - 18.00\";}}}",
		"MAP_HEIGHT" => "400px",
		"MAP_ID" => "",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array("ENABLE_DRAGGING", "ENABLE_SCROLL_ZOOM")
	)
);?>