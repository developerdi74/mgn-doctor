<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Задайте вопрос");
?>

<div id="page" class="site page-grey">
  <!-- BREADCUMBS  -->
  <div class="container">
    <div class="row">
      <ol class="breadcrumb">
        <div class="breadcrumbs" itemscope="" itemtype="https://schema.org/BreadcrumbList">
          <span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
            <a class="breadcrumbs__link" href=" " itemprop="item">
            <span itemprop="name">Главная</span></a><meta itemprop="position" content="1">
          </span> – 
          <span class="breadcrumbs__current">Врачи</span>
        </div>
      </ol>
    </div>
  </div>
  <!-- BREADCUMBS END  -->




<!-- ALL SPECIALISTS  -->
<section class="specialists-inner all-our-specialists">
    <div class="container"> 
      
      <div class="row justify-content-between page-row-middle">
        <h1 class="page-title specialists-inner__title all-our-specialists__title">Наши специалисты</h1>
        <div class="specialists-inner__text">
          <p class="page-desc">Если вы не знаете, к кому обратиться, наш <a href="#ask-question-modal" data-fancybox="" data-src="#ask-question-modal">специалист</a>  вам поможет!</p>
        </div>
      </div>
      <div class="specialists-statistics specialists__statistics">
        <div class="row">
          <div class="col-md-3 specialists-statistics__item">
            <div class="specialists-statistics__item-num num-count"><?if(is_array($arResult["ITEMS"])) echo count($arResult["ITEMS"]);?></div>
            <div class="specialists-statistics__item-title">Врача<br> всего</div>
          </div>
          <div class="col-md-3 specialists-statistics__item">
            <div class="specialists-statistics__item-num num-count">47</div>
            <div class="specialists-statistics__item-title">Детских <br>врачей</div>
          </div>
          <div class="col-md-3 specialists-statistics__item">
            <div class="specialists-statistics__item-num num-count">29</div>
            <div class="specialists-statistics__item-title">Врачей<br> ультразвуковой диагностики</div>
          </div>
          <div class="col-md-3 specialists-statistics__item">
            <div class="specialists-statistics__item-num num-count">6</div>
            <div class="specialists-statistics__item-title">Врачей<br> функциональной диагностики</div>
          </div>
        </div>
      </div>

      <div class="row specialists-filter specialists__filter filter-itmes">
        <form action="" class="filter-itmes__form specialists-filter__form" id = "specialists-form">
          <div class="specialists-filter__item">
            <select name="AGE" id="">
              <option value="1">Детский</option>
              <option value="2">Взрослый</option>
            </select>
          </div>

          <div class="specialists-filter__item specialists-filter__item--clinics">
            <select name="CLINIC" id="">
              <option value="">Все клиники</option>
              <option value="4">ул. Жукова, д.11</option>
              <option value="5">ул. Доменщиков, д.8А </option>
            </select>
          </div>

          <div class="specialists-filter__item specialists-filter__item--search specialists-filter__item--slist">
            <input type="text" name="specialist-profile" class="filter-itmes__input filter-itmes__search" placeholder="специальность">
            <div class="specialists-filter__item--additional">
              <a href="#" class="specialists-filter__item--adlink">список специальностей</a>
            </div>
            <div class="specialists-filter__list--doc">
              <div class="spec-list__list--flex">

				<?
				if(CModule::IncludeModule('iblock'))
				{
					$arFilter = Array('IBLOCK_ID'=>"5", 'GLOBAL_ACTIVE'=>'Y');
					$db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
					while($ar_result = $db_list->GetNext())
					{?>
						<div class="spec-list__additem"><a href="#"><?=$ar_result['NAME']?></a></div>
					<?}
				}
				?>
              </div>
            </div>
          </div>

          <div class="specialists-filter__item specialists-filter__item--date">
            <input  type="date" id="start" name="DATE"
                    value="Дата"
                    class="filter-itmes__input filter-itmes__date"
                    min="2021-01-01" max="2028-12-31">
          </div>

          <div class="specialists-filter__item specialists-filter__item--search">
            <input type="text" name="NAME" placeholder="ФИО Врача" class="filter-itmes__input filter-itmes__search">
          </div>

          <input type="hidden" name="set_filter" value="Y" >

          <div class="specialists-filter__item">

            <button form = "specialists-form" type = "submit" class="btn btn-green filter-itmes__btn">Найти</button>
          </div>


        </form>
      </div>


 <?$GLOBALS['arrFilter'] = array(
    array(
      "LOGIC" => "AND",
      "PROPERTY_AGE" => $_GET['AGE'],
      "PROPERTY_CLINIC" => $_GET['CLINIC'],
      "%PROPERTY_DATE" => $_GET['DATE'],
      "%NAME" => $_GET['NAME']
    )
   );?>





  <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"specialists", 
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
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "mgn_doctor_service",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
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
			0 => "SPECIAIZATION",
			1 => "AGE",
			2 => "DATE",
			3 => "CLINIC",
			4 => "TITLE",
			5 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "specialists"
	),
	false
);?>

</div>
  </section>
  <!-- ALL SPECIALISTS END -->

 
 
</div>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>