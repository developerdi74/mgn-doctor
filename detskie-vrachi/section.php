<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Все врачи аллергологи в Семейном докторе. Первичный прием аллерголога от 1100 рублей.  Высококвалифицированные врачи. Удобная онлайн-запись. Большой выбор услуг");
$APPLICATION->SetPageProperty("keywords", "аллерголог, аллерголог магнитогорск");
$APPLICATION->SetPageProperty("title", "Врачи в Магнитогорске | Семейный доктор");
?>
<?
$age=110;
$arrFilterVrachiDetail = array("PROPERTY_AGE"=>$age); //Фильтр деталки для вызова детских врачей

$section_code = explode("/",$_SERVER['REQUEST_URI']);

//Фильтр списка врачей
$arrFilterVrachi = array(
    "PROPERTY" => array("AGE"=> $age),
    "SECTION_CODE" => $section_code[2],
);

define("SECTION_CODE", $section_code[2]);
?>
    <section class="specialists-inner all-our-specialists">
    <div class="container">
        <?
        if($section_code[1]=='detskie-vrachi')
            $APPLICATION->AddChainItem("Детские врачи", "/detskie-vrachi/");
        else
            $APPLICATION->AddChainItem("Специалисты", "/specialists/");




        //Проверка существует ли раздел
        if($_REQUEST['SECTION_CODE']):
            $arFilter = array('IBLOCK_ID' => 25, "CODE" =>  $_REQUEST['SECTION_CODE']);
            $rsSections = CIBlockSection::GetList(array(), $arFilter);
            if($arSction = $rsSections->Fetch()):

                ?>
                <?// $APPLICATION->AddChainItem($arSction['NAME'], $arSction['CODE']); ?>
                <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "vrachi",
                array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "Y",
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "FILTER_NAME" => "arrFilterVrachi",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "25",
                    "IBLOCK_TYPE" => "mgn_doctor_service",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "Страница не найдена",
                    "NEWS_COUNT" => "35",
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
                        4 => "SKILL",
                        5 => "DETI_TITLE",
                        6 => "",
                    ),
                    "SET_BROWSER_TITLE" => "Y",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "Y",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_STATUS_404" => "Y",
                    "SET_TITLE" => "Y",
                    "SHOW_404" => "Y",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N",
                    "COMPONENT_TEMPLATE" => "vrachi",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "SECT_CODE_PARAM" => $section_code[2],
                ),
                false
            );?>
            <?else:
                CHTTP::SetStatus("404 Not Found");
                @define("ERROR_404","Y");
                if ($APPLICATION->RestartWorkarea())
                {
                    require(\Bitrix\Main\Application::getDocumentRoot() . "/404.php");
                    die();
                }

            endif;
        endif;
        ?>
    </div>
    </section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>