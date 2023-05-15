<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty("description", "Клиника для взрослых и детей. Современное оборудование. Высококвалифицированные врачи высшей категории. 3 медицинских центра в Магнитогорске. Удобная запись.");
$APPLICATION->SetPageProperty("keywords", "семейный доктор, семейный доктор магнитогорск, семейный доктор официальный, семейный доктор сайт, семейный доктор официальный сайт");
$APPLICATION->SetPageProperty("title", "Семейный доктор в Магнитогорске. Официальный сайт");
$APPLICATION->SetTitle("Семейный доктор в Магнитогорске. Официальный сайт");
?>


<!-- MAIN SLIDER  -->
<? $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"banner", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DETAIL_TEXT",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "23",
		"IBLOCK_TYPE" => "mgn_doctor_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
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
			0 => "TITLE",
			1 => "",
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
		"COMPONENT_TEMPLATE" => "banner"
	),
	false
); ?>




<!-- CHECK-UP  -->
<div class="container check-up">
  <div class="row">
    <div class="check-up-inner check-up__inner">
      <h4 class="check-up__title test">Чек-лист для ПРОВЕРКИ организма – <span>всего за 24 часа</span></h4>
      <div class="check-up__btns">
        <a href="/news/stati/chek-list-dlya-proverki-organizma-proydi-za-24-chasa/" class="btn btn-white check-up__btn">Узнать больше</a>
      </div>
      <div class="check-up__links check-up-links">
        <div class="check-up-links__item">
          <a href="/service//?AGE=114">
            Услуги<br> для детей
            <span>
              <svg width="24" height="12" viewBox="0 0 24 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.0005 4.99999H20.5865L17.2935 1.70699C16.9035 1.31699 16.9035 0.682988 17.2935 0.292988C17.6835 -0.0970117 18.3165 -0.0970117 18.7075 0.292988L23.7075 5.29299C23.7535 5.33899 23.7955 5.39099 23.8325 5.44599C23.8485 5.46999 23.8595 5.49599 23.8725 5.51999C23.8905 5.55299 23.9105 5.58399 23.9245 5.61799C23.9375 5.64999 23.9445 5.68399 23.9545 5.71799C23.9645 5.74799 23.9745 5.77399 23.9805 5.80499C24.0065 5.93499 24.0065 6.06699 23.9805 6.19499C23.9745 6.22499 23.9635 6.25299 23.9555 6.28199C23.9455 6.31599 23.9375 6.34999 23.9235 6.38199C23.9105 6.41699 23.8905 6.44799 23.8735 6.48199C23.8595 6.50499 23.8485 6.53199 23.8335 6.55399C23.7955 6.60899 23.7535 6.66099 23.7075 6.70799L18.7075 11.708C18.5115 11.902 18.2575 12 18.0005 12C17.7445 12 17.4905 11.902 17.2935 11.707C16.9035 11.317 16.9035 10.683 17.2935 10.293L20.5865 6.99999H1.0005C0.4485 6.99999 0.000499725 6.55299 0.000499725 5.99999C0.000499725 5.44799 0.4485 4.99999 1.0005 4.99999Z" fill="white" />
              </svg>
            </span>
          </a>
        </div>
        <div class="check-up-links__item">
          <a href="/service//?AGE=115">
            Услуги<br> для взрослых
            <span>
              <svg width="24" height="12" viewBox="0 0 24 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.0005 4.99999H20.5865L17.2935 1.70699C16.9035 1.31699 16.9035 0.682988 17.2935 0.292988C17.6835 -0.0970117 18.3165 -0.0970117 18.7075 0.292988L23.7075 5.29299C23.7535 5.33899 23.7955 5.39099 23.8325 5.44599C23.8485 5.46999 23.8595 5.49599 23.8725 5.51999C23.8905 5.55299 23.9105 5.58399 23.9245 5.61799C23.9375 5.64999 23.9445 5.68399 23.9545 5.71799C23.9645 5.74799 23.9745 5.77399 23.9805 5.80499C24.0065 5.93499 24.0065 6.06699 23.9805 6.19499C23.9745 6.22499 23.9635 6.25299 23.9555 6.28199C23.9455 6.31599 23.9375 6.34999 23.9235 6.38199C23.9105 6.41699 23.8905 6.44799 23.8735 6.48199C23.8595 6.50499 23.8485 6.53199 23.8335 6.55399C23.7955 6.60899 23.7535 6.66099 23.7075 6.70799L18.7075 11.708C18.5115 11.902 18.2575 12 18.0005 12C17.7445 12 17.4905 11.902 17.2935 11.707C16.9035 11.317 16.9035 10.683 17.2935 10.293L20.5865 6.99999H1.0005C0.4485 6.99999 0.000499725 6.55299 0.000499725 5.99999C0.000499725 5.44799 0.4485 4.99999 1.0005 4.99999Z" fill="white" />
              </svg>
            </span>
          </a>
        </div>
        <div class="check-up-links__item">
          <a href="/service-detail/napravleniya-kliniki/">
            Врач<br> онлайн
            <span>
              <svg width="24" height="12" viewBox="0 0 24 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.0005 4.99999H20.5865L17.2935 1.70699C16.9035 1.31699 16.9035 0.682988 17.2935 0.292988C17.6835 -0.0970117 18.3165 -0.0970117 18.7075 0.292988L23.7075 5.29299C23.7535 5.33899 23.7955 5.39099 23.8325 5.44599C23.8485 5.46999 23.8595 5.49599 23.8725 5.51999C23.8905 5.55299 23.9105 5.58399 23.9245 5.61799C23.9375 5.64999 23.9445 5.68399 23.9545 5.71799C23.9645 5.74799 23.9745 5.77399 23.9805 5.80499C24.0065 5.93499 24.0065 6.06699 23.9805 6.19499C23.9745 6.22499 23.9635 6.25299 23.9555 6.28199C23.9455 6.31599 23.9375 6.34999 23.9235 6.38199C23.9105 6.41699 23.8905 6.44799 23.8735 6.48199C23.8595 6.50499 23.8485 6.53199 23.8335 6.55399C23.7955 6.60899 23.7535 6.66099 23.7075 6.70799L18.7075 11.708C18.5115 11.902 18.2575 12 18.0005 12C17.7445 12 17.4905 11.902 17.2935 11.707C16.9035 11.317 16.9035 10.683 17.2935 10.293L20.5865 6.99999H1.0005C0.4485 6.99999 0.000499725 6.55299 0.000499725 5.99999C0.000499725 5.44799 0.4485 4.99999 1.0005 4.99999Z" fill="white" />
              </svg>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- CHECK-UP END -->

<!-- MAIN DIRECTIONS  -->
<section class="main-directions main-directions--home mt-60" id="main-directions">
  <div class="container">

  <!-- Популярные направления -->
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"popular_mainpage", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "popular_mainpage",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "NAME",
			3 => "PREVIEW_PICTURE",
			4 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "34",
		"IBLOCK_TYPE" => "mgn_doctor_content",
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
			0 => "LINK_ITEM",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>


<?if($_SESSION['isMobile']===true){?>
	<div class="row mobile-row">
		<div class="main-directions__right">
			<a class="btn btn-green btn-sign-up open_ondocwidjet">Записаться</a>
			<!-- <a href="#order-appointment" data-fancybox="" data-src="#order-appointment" class="btn btn-green btn-sign-up">Записаться</a> -->
			<div class="slider__nav main-directions__nav navigation">
				<div class="slider__nav-prev"><img src="<?=SITE_TEMPLATE_PATH?>/img/arrow-prev.svg" height="11" width="20" alt="prev"></div>
				<div class="slider__nav-next"><img src="<?=SITE_TEMPLATE_PATH?>/img/arrow-next.svg" height="11" width="20" alt="next"></div>
			</div>
		</div>
	</div>
<?}?>

  </div>
</section>
<!-- MAIN DIRECTIONS END -->


<!-- OUR TEAM  -->
<section class="our-team our-team-tabs mt-60" id="our-team">


  <?
  if ($_GET['SECTION_ID'] == "") {
    $GLOBALS['arrFilter'] = array("SECTION_ID" => "76");
  } else {
    $GLOBALS['arrFilter'] = array("SECTION_ID" => $_GET['SECTION_ID']);
  }

  ?>


  <? $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"doctors_block", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DETAIL_TEXT",
			2 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "25",
		"IBLOCK_TYPE" => "mgn_doctor_service",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "",
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
			1 => "CLINIC",
			2 => "AGE",
			3 => "SPECIALIZATION",
			4 => "TITLE",
			5 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "NAME",
		"SORT_BY2" => "NAME",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "doctors_block"
	),
	false
); ?>
</section>
<!-- OUR TEAM END -->




<!-- YOUR QUESTIONS  -->
<section class="popular-services your-questions mt-80 " id="popular-services">

  <? $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"questions", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
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
			0 => "PREVIEW_PICTURE",
			1 => "DETAIL_TEXT",
			2 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "26",
		"IBLOCK_TYPE" => "mgn_doctor_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
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
			0 => "",
			1 => "TITLE",
			2 => "",
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
		"COMPONENT_TEMPLATE" => "questions"
	),
	false
); ?>


</section>
<!-- YOUR QUESTIONS END -->


<!-- HEALTH CALCULATOR -->

<? $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"calculator", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
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
			0 => "PREVIEW_TEXT",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_TEXT",
			3 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "33",
		"IBLOCK_TYPE" => "mgn_doctor_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "6",
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
			0 => "",
			1 => "TITLE",
			2 => "",
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
		"COMPONENT_TEMPLATE" => "calculator"
	),
	false
); ?>


<!-- HEALTH CALCULATOR END -->



<!-- BLOG  -->
<section class="news some-news articles  " id="news">
  <div class="container">
    <div class="row justify-content-between row-vmiddle">
      <h2 class="section-title articles__title">МЕДИЦИНСКИЕ НОВОСТИ</h2>
      <div class="articles__btn-wrap">
        <a href="/news/" class="btn btn-grey-tr news__btn">Все новости</a>
      </div>
    </div>
    <div class="row ">

      <? $APPLICATION->IncludeComponent(
          "bitrix:news.list", 
          "news", 
          array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "Y",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "N",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(
              0 => "PREVIEW_PICTURE",
              1 => "DETAIL_TEXT",
              2 => "",
            ),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "27",
            "IBLOCK_TYPE" => "mgn_doctor_content",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "3",
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
              0 => "",
              1 => "TITLE",
              2 => "",
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
            "COMPONENT_TEMPLATE" => "news"
          ),
          false
        ); ?>

    </div>

<?if($_SESSION['isMobile']===true){?>
	<div class="row mobile-row">
		<div class="articles__btn-wrap--mob">
			<div class="some-news-btn__mob">
				<a href="/news/" class="btn btn-grey-tr news__btn">Все новости</a>
			</div>
			<div class="slider__nav some-news__nav navigation">
				<div class="slider__nav-prev"><img src="<?=SITE_TEMPLATE_PATH?>/img/arrow-prev.svg" height="11" width="20" alt="prev"></div>
				<div class="slider__nav-next"><img src="<?=SITE_TEMPLATE_PATH?>/img/arrow-next.svg" height="11" width="20" alt="next"></div>
			</div>
		</div>
	</div>
<?}?>

  </div>
</section>
<!-- BLOG END -->

<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>