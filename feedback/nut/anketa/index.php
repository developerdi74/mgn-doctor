<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty("title", "Семейный доктор в Магнитогорске. Загрузить анкету");
$APPLICATION->SetTitle("Семейный доктор в Магнитогорске. Загрузить анкету");
?>
<div class="container">
    <h3>Анкеты для скачивания и заполнения перед приемом нутрициолога</h3>
    <p class="">Перед приемом нутрициолога, обязательно, скачайте, заполните и отправьте удобным способом доктору указанные ниже анкеты</p>
    <ul>
        <li><a target="_blank" href="/upload/ankets/Дневник питания и образа жизни.docx">Дневник питания и образа жизни.docx</a></li>
        <li><a target="_blank" href="/upload/ankets/Опросник пациента.docx">Опросник пациента.docx</a></li>
        <li><a target="_blank" href="/upload/ankets/Опросник по ключевым дефицитам верный.xlsx">Опросник по ключевым дефицитам верный.xlsx</a></li>
    </ul>
        <p>
            После скачивания:<br>
            <ul>
                <li> Заполните анкеты в электронном виде <b>или</b> распечатайте, заполните от руки и сделайте снимки</li>
                <li> Фотографии или анкеты в электронном виде отправьте одним из способов ниже:<br>
                    - по электронной почте, приложив в письме файлы, по адресу <a href="mailto:nutriciolog@doctor-74.ru">nutriciolog@doctor-74.ru</a> <br>
                    - воспользоваться <a href="#form-load-ankets">формой отправки</a> ниже, выбрав файлы <br><br><br>
                </li>
            </ul>
        </p>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"loadankets", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "N",
		"WEB_FORM_ID" => "8",
		"COMPONENT_TEMPLATE" => "loadankets",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);
 require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');?><br>