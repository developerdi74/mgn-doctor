<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
?>
<div id="page" class="site page-grey page-dark-grey">
	<div class="container">
		<? $APPLICATION->IncludeComponent("bitrix:search.page", "doctor", Array(
	"RESTART" => "Y",	// Искать без учета морфологии (при отсутствии результата поиска)
		"CHECK_DATES" => "N",	// Искать только в активных по дате документах
		"USE_TITLE_RANK" => "N",	// При ранжировании результата учитывать заголовки
		"DEFAULT_SORT" => "rank",	// Сортировка по умолчанию
		"arrFILTER" => array(	// Ограничение области поиска
			0 => "iblock_mgn_doctor_content",
			1 => "iblock_mgn_doctor_service",
		),
		"arrFILTER_main" => "",
		"arrFILTER_iblock_services" => array(
			0 => "all",
		),
		"arrFILTER_iblock_news" => array(
			0 => "all",
		),
		"arrFILTER_iblock_catalog" => array(
			0 => "all",
		),
		"SHOW_WHERE" => "N",	// Показывать выпадающий список "Где искать"
		"SHOW_WHEN" => "N",	// Показывать фильтр по датам
		"PAGE_RESULT_COUNT" => "25",	// Количество результатов на странице
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над результатами
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под результатами
		"PAGER_TITLE" => "Результаты поиска",	// Название результатов поиска
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => "arrows",	// Название шаблона
		"USE_SUGGEST" => "N",	// Показывать подсказку с поисковыми фразами
		"SHOW_ITEM_TAGS" => "N",	// Показывать теги документа
		"SHOW_ITEM_DATE_CHANGE" => "N",	// Показывать дату изменения документа
		"SHOW_ORDER_BY" => "N",	// Показывать сортировку
		"SHOW_TAGS_CLOUD" => "N",	// Показывать облако тегов
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"COMPONENT_TEMPLATE" => "clear",
		"NO_WORD_LOGIC" => "Y",	// Отключить обработку слов как логических операторов
		"FILTER_NAME" => "",	// Дополнительный фильтр
		"USE_LANGUAGE_GUESS" => "N",	// Включить автоопределение раскладки клавиатуры
		"SHOW_RATING" => "",	// Включить рейтинг
		"RATING_TYPE" => "",	// Вид кнопок рейтинга
		"PATH_TO_USER_PROFILE" => "",	// Шаблон пути к профилю пользователя
		"TAGS_SORT" => "NAME",
		"TAGS_PAGE_ELEMENTS" => "150",
		"TAGS_PERIOD" => "",
		"TAGS_URL_SEARCH" => "",
		"TAGS_INHERIT" => "Y",
		"FONT_MAX" => "50",
		"FONT_MIN" => "10",
		"COLOR_NEW" => "000000",
		"COLOR_OLD" => "C8C8C8",
		"PERIOD_NEW_TAGS" => "",
		"SHOW_CHAIN" => "Y",
		"COLOR_TYPE" => "Y",
		"WIDTH" => "100%",
		"STRUCTURE_FILTER" => "structure",
		"NAME_TEMPLATE" => "",
		"SHOW_LOGIN" => "Y",
		"arrFILTER_iblock_mgn_doctor_content" => array(	// Искать в информационных блоках типа "iblock_mgn_doctor_content"
			0 => "all",
		),
		"arrFILTER_iblock_mgn_doctor_service" => array(	// Искать в информационных блоках типа "iblock_mgn_doctor_service"
			0 => "all",
		)
	),
	false
); ?>
	</div>
</div>

	<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>