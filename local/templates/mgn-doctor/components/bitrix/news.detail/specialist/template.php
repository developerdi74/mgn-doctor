<?
//_vardump('пришли в шаблон блять');
//_vardump($arResult);
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

use Bitrix\Main\Loader;
Loader::includeModule("highloadblock");
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$clinic=$_POST["CLINIC"];
if($clinic=='') $clinic=$arResult['PROPERTIES']['CLINIC']["VALUE_XML_ID"][0];

$name = $arResult["NAME"];?>
<? //console($arResult);
//$noCalendar=$noCalendarFlag=false;
//foreach($arResult['PROPERTIES']['CLINIC']['VALUE'] as $clinic){
//	console($clinic);
//	if(strpos($clinic, '50 лет')!==false || strpos($clinic, 'Жук')!==false || strpos($clinic, 'Домен')!==false){
//		$noCalendar=true;
//		console('сработало if');
//	}
//	else{
//		$noCalendar=false;
//		$noCalendarFlag=true;
//		console('не сработало');
//	}
//}?>
<!-- Микроразметка ---><div>
<script type='application/ld+json'>
{
  "@context": "http://www.schema.org",
  "@type": "Physician",
  "name": "<?=$arResult["NAME"]?>",
  "url": "<?="https://mgn-doctor.ru".$arResult["DETAIL_PAGE_URL"]?>",
  "logo": "<?="https://mgn-doctor.ru".$arResult["PREVIEW_PICTURE"]['SRC']?>",
  "image": "https://mgn-doctor.ru/local/templates/mgn-doctor/img/main_logo.svg",
  "description": "<?if(is_array($arResult['DISPLAY_PROPERTIES']['SPECIALIZATION']['DISPLAY_VALUE'])){
 		foreach($arResult['DISPLAY_PROPERTIES']['SPECIALIZATION']['DISPLAY_VALUE'] as $arValue){ echo $arValue." "; }}
 		else{ echo $arResult['DISPLAY_PROPERTIES']['SPECIALIZATION']['DISPLAY_VALUE']; }
	?>",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "<?=$arResult["PROPERTIES"]["CLINIC"]["VALUE"][0]?>",
    "addressLocality": "Магнитогорск",
    "addressCountry": "Россия"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+7 (3519) 581-111",
    "contactType": "customer service"
  }
}
 </script>
<!-- Микроразметка --->
	<!-- ONE SPECIALISTS  -->
	<section class="specialist-inner specialist-info">
		<div class="container">
			<form action="" method="post" id="datail-doctor-form">
				<div class="row">
					<div class="specialist-info__left">
						<div class="item our-team__item specialists-item ">
							<div class="specialists-item__top specialist-info__top">
								<div class="specialists-item__img specialist-info__img">
									<img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" height = "<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>" width = "<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" alt="" class="specialists-item__photo">
								</div>
								<div class="specialists-item__status">
									<?if($arTime[0]['time']!=''){?>
										<?if($arDateCurent[0]>$curentDate){?>
											<span title="Приема сегодня нет" class="no-active-status"></span>
										<?}else{?>
											<span title="Прием сегодня" class="active-status"></span>
										<?}?>
									<?}else{?>
										<span class="no-active-status"></span>
									<?}?>
								</div>
							</div>
							<div class="specialists-item__content specialist-info__content">
								<h1 class="specialists-item__title specialists-item__name"><?=$arResult["NAME"]?></h1>

									<?if(isset($arResult['DISPLAY_PROPERTIES']['AGE']['VALUE_ENUM_ID'])):?>
									<?
										$priem = 0;
                                        $priemVzros = 0;
                                        $priemChild = 0;
										if(in_array("111", $arResult['DISPLAY_PROPERTIES']['AGE']['VALUE_ENUM_ID'])!==false){
										    $priemVzros = 1;
											$priem++;
											$text_who="Принимает только взрослых";
										}
										if(in_array("110", $arResult['DISPLAY_PROPERTIES']['AGE']['VALUE_ENUM_ID'])!==false){
											$text_who="Принимает только детей";
											$priem++;
                                            $priemChild = 1;
										}
										if($priem == 2){
                                            $priemVzros = 1;
                                            $priemChild = 1;
											$text_who="Принимает взрослых и детей";
										}

										if(isset($text_who)){?>
											<div class="specialists-experience">
												<div class="specialists-item__position specialist-info__position text_who_is"><?=$text_who;?></div>
											</div>
										<?}?>
									<?endif;?>

								<?if(is_array($arResult['DISPLAY_PROPERTIES']['SPECIALIZATION']['DISPLAY_VALUE'])){
									foreach($arResult['DISPLAY_PROPERTIES']['SPECIALIZATION']['DISPLAY_VALUE'] as $arValue){?>
										<div class="specialists-experience">
											<div class="specialists-item__position specialist-info__position"><?=$arValue?></div>
										</div>
									<?}
								}else{?>
									<div class="specialists-experience">
										<div class="specialists-item__position specialist-info__position">
											<?=$arResult['DISPLAY_PROPERTIES']['SPECIALIZATION']['DISPLAY_VALUE'];?></div>
									</div>
								<?}?>
								<div class="specialists-item__place specialist-info__place">
									<svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 0.0078125C2.0142 0.0078125 0 1.95819 0 4.37406C0 8.55131 4.5 13.9991 4.5 13.9991C4.5 13.9991 9 8.55044 9 4.37406C9 1.95906 6.9858 0.0078125 4.5 0.0078125ZM4.5 6.78994C3.1572 6.78994 2.07 5.73206 2.07 4.42744C2.07 3.12281 3.1572 2.06494 4.5 2.06494C5.841 2.06494 6.9291 3.12281 6.9291 4.42744C6.9291 5.73206 5.841 6.78994 4.5 6.78994Z" fill="#75A72D"></path>
									</svg>
									<?if(is_array($arResult['DISPLAY_PROPERTIES']['CLINIC']['DISPLAY_VALUE'])){?>
										Центр:
										<?foreach($arResult['DISPLAY_PROPERTIES']['CLINIC']['DISPLAY_VALUE'] as $key=>$clinic){?>
											<?=$clinic.' ';?>
										<?}?>
									<?}else{?>
										Центр: <?=$arResult['DISPLAY_PROPERTIES']['CLINIC']['DISPLAY_VALUE'];?>
									<?}?>
								</div>

								<?if($arResult['RAITING']>1):?>
								<div class='rating mt-2 static_rating'>
										<div class="star_rew">
											<? 	$star = floor($arResult['RAITING']);
														$half=0;
												if(($arResult['RAITING']-$star)<=0.5 && ($arResult['RAITING']-$star)!=0){
														$half=1;
												}else{
													 if(($arResult['RAITING']-$star)!=0){
															$star++;
													 }
												}
											?>
											<label> Рейтинг врача: <?=$arResult['RAITING']?>/5
												<div>
													<? for($i=1; $i<=5; $i++):?>
													<span class='star d-inline-block <?
													if($i<=$star){
														echo "starfull";
													}elseif($half==1){
														echo "starhalf"; $half=0;
													}?>' value = <?=$i?>></span>
													<?endfor;?>
												</div>
											</label>
										</div>
								</div>
								<?endif;?>

								<?if($noCalendarFlag==true && $noCalendar==false){?>
									<div class="specialists-item__btn">
										<input type="hidden" value="<?=$arResult['ID']?>" name="DOCTOR">
										<?/*<button class="btn btn-grey-tr btn-spec-signup" type="submit">Записаться на приём</a></button>*/?>
										<?if($arResult['DISPLAY_PROPERTIES']['SPECIALIZATION']['DISPLAY_VALUE']=="Инструктор по плаванию"){?>
											<a href="#order-appointment" data-fancybox="" data-src="#order-appointment" id="doctorOrder" class="btn btn-grey-tr btn-spec-signup">Записаться на занятие</a>
										<?}else{?>
											<a href="#order-appointment" data-fancybox="" data-src="#order-appointment" id="doctorOrder" class="btn btn-grey-tr btn-spec-signup">Записаться на приём</a>
										<?}?>
										<?/*<a href="/personal/?ID=<?= $arResult['ID'] ?>" class="btn btn-grey-tr btn-spec-signup">Записаться на приём</a>*/?>
									</div>
								<?}?>
							</div>
						</div>
					</div>
                    <? //print_r($arResult['PROPERTIES'])?>
					<div class="specialist-info__right" <?=($arResult['PROPERTIES']['ONLINE_PLANNING']['VALUE'] != 0) ? "online_pl=1" : "online_pl=0";?>>
                        <?if($arResult['PROPERTIES']['ONLINE_PLANNING']['VALUE'] != 0):?>
                            <div class="cnt_loader"><div class="loader" style=""></div></div>
                        <?else:?>
                            <div class="no-timesheet">
                                Узнать акуальное расписание данного специалиста и записаться:
                                <ul>
                                    <li>можно через форму онлайн-записи</li>
                                    <li>позвонив в контакт-центр <a href="tel:83519581111">8-3519-581-111</a></li>
                                    <li>через <a href="https://ok.ru/semeinyidoctor74" rel="nofollow"><img src="<?=SITE_TEMPLATE_PATH?>/img/OK_logo.svg" alt="" width="30" height="30"></a>  <a href="https://vk.com/semeinyi_doctor74" rel="nofollow"><img src="<?=SITE_TEMPLATE_PATH?>/img/VK_Compact_Logo.svg" alt="" width="30" height="30"></a></li>
                                    <li>написав в чат (на сайте справа внизу)</li>
                                </ul>
                            </div>
                        <?endif;?>
                        <? //include_once ("raspisanie.php")?>
					</div>
				</div>
			</form>
		</div>
	</section>
	<!-- ALL SPECIALISTS END -->

	<!-- TABS INFO  -->
	<section class="specialists-tabs " id="specialists-tabs">
		<div class="container">
			<div class="row">
				<div class="specialists-tabs__nav">
					<ul class="nav nav-tabs nav-tabs-specialists" id="tabs-specialists">
						<li class="nav-item active">
							<a class="nav-link " href="#spec_education">Квалификация</a>
						</li>
						<li class="nav-item">
							<a class="nav-link specialists-tabs__reviews" href="#spec_reviews">Отзывы(<span>0</span>)</a>
						</li>
						<li class="nav-item">
							<a class="nav-link specialists-tabs__service" href="#spec_services">Услуги(<span>0</span>)</a>
						</li>
						<li class="nav-item">
							<a class="nav-link specialists-tabs__gallery" href="#spec_gallery-specialist">Галерея врача(<span>0</span>)</a>
						</li>
					</ul>
				</div>
				<div class="specialists-tabs__content">
					<div class="tab-content specialists-tab-content">
						<div class="tab-pane fade show active tab-content__education" id="spec_education">
							<div class="tab-education-wrapper">
								<div class="tab-pane-edu specialists-tabs__edu-left">
									<h4 class="tab-pane-edu__title">Образование</h4>
									<?=$arResult["PREVIEW_TEXT"];?>
								</div>
								<div class="tab-pane-edu specialists-tabs__edu-right">
									<h4 class="tab-pane-edu__title">Опыт работы</h4>
									<?=$arResult["DETAIL_TEXT"];?>
								</div>
							</div>
						</div>
						<div class="tab-pane fade tab-content__reviews" id="spec_reviews">
							<div class="tab-reviews-wrapper">
								<div class="add-review">
									<a href="" class="add-review__btn">
										<svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M29.6053 15.8823C29.6053 23.9347 23.0669 30.4634 15 30.4634C6.93314 30.4634 0.394737 23.9347 0.394737 15.8823C0.394737 7.83002 6.93314 1.30123 15 1.30123C23.0669 1.30123 29.6053 7.83002 29.6053 15.8823Z" stroke="#75A72D" stroke-width="0.789474"/>
											<path fill-rule="evenodd" clip-rule="evenodd" d="M20.7197 14.5858V17.3721H16.6026V21.5929H13.5631V17.3721H9.47363V14.5858H13.5631V10.365H16.6026V14.5858H20.7197Z" fill="#75A72D"/>
										</svg>
										добавить отзыв</a>
								</div>
								<div class="wpd-form-wrap">
									<form action="/specialists/" name="form-reviews" method="post" class="form init">
										<input name="specialists" type="hidden" value="<?=$arResult["ID"]?>">
										<div class="review-form__item">
											<label> Ваши имя и фамилия*<br>
												<span class="form-control-wrap your-name">
													<input type="text" name="your-name" value="" size="40" class="contact-input" aria-required="true" placeholder="Имя Фамилия">
												</span>
											</label>
										</div>

										<div class="review-form__item">
											<label> Контактный телефон *
												<span class="form-control-wrap contact-tel">
													<input type="tel" name="contact-tel" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel contact-input" aria-required="true" aria-invalid="false" placeholder='+7 (___) ___-__-__' required="">
												</span>
											</label>
										</div>


											<div class="popup-item star_rew review-form__item">
												<label> Ваша оценка специалиста
													<div>
														<input type="radio" name="star" class='star' value = 1>
														<input type="radio" name="star" class='star' value = 2>
														<input type="radio" name="star" class='star' value = 3>
														<input type="radio" name="star" class='star' value = 4>
														<input type="radio" name="star" class='star' value = 5>
													</div>
												</label>
											</div>
										<div class="review-form__item">
											<label> Ваш отзыв*
												<span class="form-control-wrap contact-tel">
													<textarea name="contact-textarea" class="contact-input contact-textarea" id="" cols="30" rows="10" placeholder="Введите текст отзыва"></textarea>
												</span>
											</label>
										</div>
										<div class="review-form__item">
											<div class="form-accept">
												<span class="form-control-wrap contact-acceptance">
													<input type="checkbox" name="contact-acceptance" value="1" aria-invalid="false" id="formCheckbox">
												</span>
												<span class="checkbox-text">Согласен на обработку персональных данных. <noindex><a href="/privacy_policy.pdf" target="_blank">Политикаконфиденциальности</a></noindex></span>
											</div>
										</div>
										<div class="review-form__item">
											<input type="submit" value="Отправить" class="btn-submit btn btn-green review-form__btn">
										</div>
									</form>
								</div>
								<div class="specialists-reviews-success">
									<h4 class="specialists-item__title">Ваш отзыв успешно добавлен</h4>
									<p>Благодарим вас за оставленный отзыв он появится сразу после проверки модератором.</p>
								</div>
								<div id="reviews" class="woocommerce-Reviews">
									<div id="comments">
										<ol class="commentlist">
											<? foreach ($arResult['REWIEVS']  as $rewievs) { ?>
												<li class="review byuser comment-author-falewik796 even thread-even depth-1" id="li-comment-46">
													<div id="comment-46" class="comment_container">
														<div class="comment-text">
															<p class="meta">
																<strong class="woocommerce-review__author review__author"><?=$rewievs["NAME"]?></strong>
																<span class="woocommerce-review__dash"></span>
																<time class="woocommerce-review__published-date" datetime="2020-07-29T21:26:23+03:00"><?=ConvertDateTime($rewievs["DATE_CREATE"], "DD.MM.YYYY");?></time>
															</p>
															<div class="description">
																<p><?=$rewievs["PREVIEW_TEXT"]?></p>
															</div>
															<br>
															<div class="description">
																<p>Оценка: <?=$rewievs['PROPERTY_RAITING_VALUE'];?></p>
															</div>

														</div>
													</div>
												</li>
											<?}?>
										</ol>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade tab-content__services" id="spec_services">
							<div class="tab-services-wrapper tab-services">
								<h5 class="tab-services__title"></h5>
								<ul class="tab-services__list">
									<?foreach($arResult['PROPERTIES']['SERVICE']['VALUE'] as $arValue){
										$arSelect=["ID", "NAME", "IBLOCK_ID", "CATALOG_PRICE_1"];
										$arFilter=["IBLOCK_ID"=>"24", "ID"=>$arValue, "ACTIVE"=>"Y"];
										$res=CIblockElement::GetList(["DATE_CREATE"=>"DESC"], $arFilter, false, $arPages, $arSelect);
										while($ob=$res->GetNextElement()){
											$arFields=$ob->GetFields();
											echo '<li><span><a href="#order-appointment" data-fancybox="" data-src="#order-appointment">'.$arFields['NAME'].'</a></span>';
											echo '<span class="price">'.CurrencyFormat($arFields['CATALOG_PRICE_1'], "RUB").'</span></li>';
										}
									}?>
								</ul>
							</div>
						</div>
						<div class="tab-pane fade tab-content__gallery-specialist" id="spec_gallery-specialist">
							<div class="tab-gallery-wrapper tab-gallery">
								<div class="tab-gallery-slider__wrapper tab-gallery-slider__wrapper-1">
									<div class="row justify-content-between   row-gallery-slider">
										<h6 class="tab-gallery__title">Галерея</h6>
										<div class="slider__nav gallery-slider__nav navigation">
											<div class="slider__nav-prev"><img src="<?=SITE_TEMPLATE_PATH?>/img/arrow-prev.svg" alt="prev"></div>
											<div class="slider__nav-next"><img src="<?=SITE_TEMPLATE_PATH?>/img/arrow-next.svg" alt="next"></div>
										</div>
									</div>
									<div class="owl-carousel owl-theme tab-gallery__slider gallery-slider" id="tab-gallery__slider-1">
										<?foreach($arResult['DISPLAY_PROPERTIES']['PHOTO']['FILE_VALUE'] as $arPhoto){?>
											<div class="item tab-gallery__item gallery-item">
												<div class="gallery-item__img">
													<a href="<?=$arPhoto['SRC'];?>" data-fancybox="gallery" class="fancybox-gallery">
														<img src="<?=$arPhoto['SRC'];?>" alt="галерея">
													</a>
												</div>
											</div>
										<?}?>
									</div>
									<? /*
                <div class="tab-gallery__more ">
                  <a href="#" class="btn show-more gallery-item__btn">Показать больше</a>
                </div>
              */ ?>
								</div>
								<div class="grey-line"></div>
								<?$GLOBALS['arrFilter']=[
									"PROPERTY_SPECIALIST"=>$arResult["ID"]
								];?>
								<div class="tab-gallery-slider__wrapper tab-gallery-slider__wrapper-3">
									<?$APPLICATION->IncludeComponent("bitrix:news.list", "specialists-news", [
										"ACTIVE_DATE_FORMAT"             =>"d.m.Y",
										"ADD_SECTIONS_CHAIN"             =>"N",
										"AJAX_MODE"                      =>"Y",
										"AJAX_OPTION_ADDITIONAL"         =>"",
										"AJAX_OPTION_HISTORY"            =>"N",
										"AJAX_OPTION_JUMP"               =>"N",
										"AJAX_OPTION_STYLE"              =>"Y",
										"CACHE_FILTER"                   =>"N",
										"CACHE_GROUPS"                   =>"Y",
										"CACHE_TIME"                     =>"36000000",
										"CACHE_TYPE"                     =>"N",
										"CHECK_DATES"                    =>"Y",
										"DETAIL_URL"                     =>"",
										"DISPLAY_BOTTOM_PAGER"           =>"Y",
										"DISPLAY_DATE"                   =>"Y",
										"DISPLAY_NAME"                   =>"Y",
										"DISPLAY_PICTURE"                =>"Y",
										"DISPLAY_PREVIEW_TEXT"           =>"Y",
										"DISPLAY_TOP_PAGER"              =>"N",
										"FIELD_CODE"                     =>[
											0=>"PREVIEW_PICTURE",
											1=>"DETAIL_TEXT",
											2=>"",
										],
										"FILTER_NAME"                    =>"arrFilter",
										"HIDE_LINK_WHEN_NO_DETAIL"       =>"N",
										"IBLOCK_ID"                      =>"27",
										"IBLOCK_TYPE"                    =>"mgn_doctor_content",
										"INCLUDE_IBLOCK_INTO_CHAIN"      =>"N",
										"INCLUDE_SUBSECTIONS"            =>"Y",
										"MESSAGE_404"                    =>"",
										"NEWS_COUNT"                     =>"20",
										"PAGER_BASE_LINK_ENABLE"         =>"N",
										"PAGER_DESC_NUMBERING"           =>"N",
										"PAGER_DESC_NUMBERING_CACHE_TIME"=>"36000",
										"PAGER_SHOW_ALL"                 =>"N",
										"PAGER_SHOW_ALWAYS"              =>"N",
										"PAGER_TEMPLATE"                 =>".default",
										"PAGER_TITLE"                    =>"Новости",
										"PARENT_SECTION"                 =>"",
										"PARENT_SECTION_CODE"            =>"",
										"PREVIEW_TRUNCATE_LEN"           =>"",
										"PROPERTY_CODE"                  =>[
											0=>"",
											1=>"TITLE",
											2=>"",
										],
										"SET_BROWSER_TITLE"              =>"N",
										"SET_LAST_MODIFIED"              =>"N",
										"SET_META_DESCRIPTION"           =>"N",
										"SET_META_KEYWORDS"              =>"N",
										"SET_STATUS_404"                 =>"N",
										"SET_TITLE"                      =>"N",
										"SHOW_404"                       =>"N",
										"SORT_BY1"                       =>"ACTIVE_FROM",
										"SORT_BY2"                       =>"SORT",
										"SORT_ORDER1"                    =>"DESC",
										"SORT_ORDER2"                    =>"ASC",
										"STRICT_SECTION_CHECK"           =>"N",
										"COMPONENT_TEMPLATE"             =>"specialists-news"
									], false);?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
    <?
    $dataAjax['ID'] = $arResult['ID'];
    $dataAjax['NAME'] = $arResult['NAME'];
    $dataAjax['CHILD'] = $priemChild;
    $dataAjax['VZROS'] = $priemVzros;
    $dataAjax['PROPERTIES']['MEDIALOG_ID']['VALUE'] = $arResult['PROPERTIES']['MEDIALOG_ID']['VALUE'];
    $dataAjaxJson = json_encode($dataAjax);
    ?>
    <script async>
        $(document).ready(function(){
            if($('.specialist-info__right').attr('online_pl') == 1){
                var data = <?=$dataAjaxJson?>;
                $.ajax({
                    url: '/local/templates/mgn-doctor/components/bitrix/news.detail/specialist/raspisanie.php',
                    method: 'get',
                    dataType: 'html',
                    data: data,
                    success: function(data){
                        $('.specialist-info__right').html(data);
                        setTimeout(function() {
                            $('select').styler();
                            $(".phone").mask("+7 (999) 999-9999");
                        }, 99)
                    }
                });
            }
        })
    </script>
