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

$months=[1=>'Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
$arWeek=["1"=>"ПН", "2"=>"ВТ", "3"=>"СР", "4"=>"ЧТ", "5"=>"ПТ", "6"=>"СБ", "0"=>"ВС"];

$curentDate=date("d.m.Y", strtotime('now'));
$lastday=date("d.m.Y", strtotime('now +13 days'));
$dateNow=date("d.m.Y", strtotime('now'));
$dayNow=date("d", strtotime('now'));
$strFirst=date('d ', strtotime($curentDate)).$months[(date('n', strtotime($curentDate)))];
$strLastday=date('d ', strtotime($lastday)).$months[(date('n', strtotime($lastday)))];

$hlblockId=HL\HighloadBlockTable::getById(8)->fetch();
$entity=HL\HighloadBlockTable::compileEntity($hlblockId);
$entity_data_class=$entity->getDataClass();

$rsData=$entity_data_class::getList([
	"select"=>["*"],
	"order" =>["ID"=>"ASC"],
	"filter"=>[
		"UF_NAME"=>preg_replace('/\s+/', ' ', $arResult["NAME"]),
		"UF_CLINIC"=>$clinic
	]
]);

$TimeData=$entity_data_class::getList([
	"select"=>["*"],
	"order" =>["ID"=>"ASC"],
	"filter"=>[
		"UF_NAME"=>preg_replace('/\s+/', ' ', $arResult["NAME"]),
		"UF_CLINIC"=>$clinic
	]
]);

$arTime=[];
$arDateCurent=[];
while($arDataT=$TimeData->Fetch()){
	if($curentDate>$arDataT['UF_BEGIN']->format("d.m.Y")){
		continue;
	}
	$arTime[]['time']=$arDataT['UF_BEGIN']->format("d.m.Y").' c '.$arDataT['UF_BEGIN']->format("H:i");
	$arDateCurent[]=$arDataT['UF_BEGIN']->format("d.m.Y");
}?>

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
//}
?>
	<!-- ONE SPECIALISTS  -->
	<section class="specialist-inner specialist-info">
		<div class="container">
			<form action="" method="post" id="datail-doctor-form">
				<div class="row">
					<div class="specialist-info__left">
						<div class="item our-team__item specialists-item ">
							<div class="specialists-item__top specialist-info__top">
								<div class="specialists-item__img specialist-info__img">
									<img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="" class="specialists-item__photo">
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
								<div class="specialists-item__specialty">
									<?if(array_search("111", $arResult['DISPLAY_PROPERTIES']['AGE']['VALUE_ENUM_ID'])!==false){?>
										<div class="specialists-item__specialty--item specialists-item__specialty--adult">
											<svg width="17" height="24" viewBox="0 0 17 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" clip-rule="evenodd" d="M9.32737 17.6698C9.55318 17.6229 9.69635 17.4102 9.64713 17.1948C9.5979 16.9794 9.37497 16.8429 9.14916 16.8898C8.27159 17.0722 7.38262 16.8862 6.67866 16.425C6.79976 16.1696 6.87409 15.8947 6.89762 15.6099C10.5164 16.6262 14.0727 13.9894 14.0727 10.5179V7.24954C14.0727 5.7089 12.7586 4.45551 11.1434 4.45551H5.80805C4.1929 4.45551 2.87882 5.709 2.87882 7.24969V9.83745C2.59929 9.69919 2.40805 9.42391 2.40805 9.10717V7.03349C2.40805 1.46 7.06684 -0.149693 11.4233 1.29904L11.0888 1.43041C10.6891 1.58734 10.7735 2.15251 11.2036 2.19642L11.9391 2.27156C13.3547 2.41616 14.6065 3.12009 15.4088 4.21461C14.8824 4.82474 14.5958 5.58426 14.5958 6.38444V9.10727C14.5958 9.32771 14.7832 9.50644 15.0143 9.50644C15.2454 9.50644 15.4327 9.32771 15.4327 9.10727V6.38444C15.4327 5.69064 15.7136 5.03685 16.2236 4.54348C16.3014 4.46814 16.3315 4.38661 16.3436 4.29026C16.3618 4.1465 16.2985 4.05256 16.2566 3.99037L16.2474 3.97656C15.455 2.77616 14.2215 1.93741 12.7912 1.6046C13.0197 1.42093 12.9779 1.06627 12.7027 0.939787C9.87927 -0.356762 6.03946 -0.49662 3.64508 1.70509C1.70598 3.48808 1.54833 6.02494 1.57118 7.03783V9.10717C1.57118 9.87073 2.13124 10.5125 2.8829 10.6849C2.96105 12.7236 4.24311 14.4743 6.06965 15.3074V15.4125C6.06965 16.334 5.28676 17.0762 4.32105 17.0762C1.93362 17.0762 0.00195312 18.9191 0.00195312 21.1961V23.5541C0.00195312 23.7745 0.189319 23.9532 0.420415 23.9532C0.65151 23.9532 0.838876 23.7745 0.838876 23.5541V21.1961C0.838876 19.3601 2.39649 17.8745 4.32116 17.8745C4.16502 17.8745 5.33137 17.9914 6.21422 17.0889C7.10602 17.6696 8.22608 17.8987 9.32737 17.6698ZM16.9496 23.5541V21.1961C16.9496 18.9188 15.0176 17.0761 12.6304 17.0762C12.014 17.0762 11.4549 16.7768 11.1347 16.2753C11.0144 16.087 10.757 16.0273 10.5596 16.142C10.3622 16.2567 10.2997 16.5023 10.4199 16.6906C10.8934 17.4319 11.7197 17.8745 12.6304 17.8745C14.5552 17.8745 16.1127 19.3602 16.1127 21.1961V23.5541C16.1127 23.7745 16.3 23.9532 16.5311 23.9532C16.7622 23.9532 16.9496 23.7745 16.9496 23.5541ZM8.47575 15.0281C11.1004 15.0281 13.2357 12.9912 13.2357 10.4875V7.24954C13.2357 6.14913 12.2971 5.25385 11.1434 5.25385H5.80805C4.65436 5.25385 3.71575 6.14918 3.71575 7.24969V10.4875C3.71575 12.9912 5.85105 15.0281 8.47575 15.0281ZM11.4573 21.9075H12.7127C12.9438 21.9075 13.1311 22.0862 13.1311 22.3067C13.1311 22.5271 12.9438 22.7058 12.7127 22.7058H11.4573C11.2262 22.7058 11.0388 22.5271 11.0388 22.3067C11.0388 22.0862 11.2262 21.9075 11.4573 21.9075Z" fill="#75A72D"/>
											</svg>
											<div class="specialist-tooltip">Принимает взрослых</div>
										</div>
									<?}?>
									
									<?if(array_search("110", $arResult['DISPLAY_PROPERTIES']['AGE']['VALUE_ENUM_ID'])!==false){?>
										<div class="specialists-item__specialty--item specialists-item__specialty--children">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" clip-rule="evenodd" d="M21.8218 13.1639H23.175C23.6299 13.1639 24 13.534 24 13.9889V14.9357C24 15.3907 23.6299 15.7608 23.175 15.7608H21.8218V16.5742C21.8218 17.4404 21.3153 18.2382 20.5314 18.6066L12.3516 22.4512V23.6484C12.3516 23.8426 12.1942 24 12 24C11.8058 24 11.6484 23.8426 11.6484 23.6484V22.4512L3.46856 18.6067C2.68467 18.2383 2.17814 17.4405 2.17814 16.5743V15.7609H0.825C0.370125 15.7609 0 15.3907 0 14.9358V13.989C0 13.5341 0.370078 13.164 0.825 13.164H2.17819V12.3495C2.17819 11.8316 2.35936 11.3256 2.68842 10.9247C2.90091 10.6655 3.16256 10.4615 3.46598 10.3183L10.2281 7.13634V1.77188C10.2281 0.794859 11.023 0 12 0C12.4733 0 12.9184 0.184406 13.2532 0.519234C13.5876 0.853734 13.7719 1.29862 13.7719 1.77188V3.96094C13.7719 4.15514 13.6145 4.3125 13.4203 4.3125C13.2261 4.3125 13.0688 4.15514 13.0688 3.96094V1.77188C13.0688 1.48641 12.9577 1.21809 12.7559 1.01644C12.5539 0.814359 12.2854 0.703125 12 0.703125C11.4106 0.703125 10.9312 1.18256 10.9312 1.77188V7.008H13.0687V5.60156C13.0687 5.40736 13.2261 5.25 13.4203 5.25C13.6145 5.25 13.7718 5.40736 13.7718 5.60156V7.13634L20.534 10.3183C20.8375 10.4614 21.0991 10.6655 21.3117 10.9248C21.6406 11.3255 21.8218 11.8315 21.8218 12.3495V13.1639ZM17.3668 9.60516H6.63319L4.10241 10.7961H19.8976L17.3668 9.60516ZM10.6581 7.71112H13.3419L15.8727 8.90203H8.12733L10.6581 7.71112ZM23.175 15.0577C23.2422 15.0577 23.2969 15.003 23.2969 14.9358V13.9889C23.2969 13.9216 23.2422 13.867 23.175 13.867H5.55797C5.36381 13.867 5.20641 13.7096 5.20641 13.5154C5.20641 13.3212 5.36381 13.1639 5.55797 13.1639H21.1187V12.3494C21.1187 12.047 21.0284 11.7505 20.8624 11.4992H3.13758C2.97155 11.7506 2.88127 12.047 2.88127 12.3494V13.1639H3.91734C4.1115 13.1639 4.26891 13.3212 4.26891 13.5154C4.26891 13.7096 4.1115 13.867 3.91734 13.867H0.825C0.757828 13.867 0.703125 13.9216 0.703125 13.9889V14.9357C0.703125 15.003 0.757781 15.0577 0.825 15.0577H18.5264C18.7206 15.0577 18.878 15.215 18.878 15.4092C18.878 15.6034 18.7206 15.7608 18.5264 15.7608H2.88127V16.5742C2.88127 17.1692 3.22922 17.7172 3.76767 17.9702L12 21.8394L20.2323 17.9703C20.7708 17.7173 21.1187 17.1692 21.1187 16.5743V15.7608H20.167C19.9728 15.7608 19.8155 15.6035 19.8155 15.4093C19.8155 15.2151 19.9728 15.0577 20.167 15.0577H23.175Z" fill="#75A72D"/>
											</svg>
											<div class="specialist-tooltip">Принимает детей</div>
										</div>
									<?}?>
								</div>
							</div>
							<div class="specialists-item__content specialist-info__content">
								<h1 class="specialists-item__title specialists-item__name"><?=$arResult["NAME"]?></h1>
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
					<div class="specialist-info__right">
						<?if($noCalendarFlag==true && $noCalendar==false){?>
							<div class="specialist-info__schedule specialist-schedule">
								<h2 class="specialist-schedule__title">Расписание</h2>
								<div class="specialist-schedule__items">
									<div class="specialist-schedule__item">
										<?if(is_array($arResult['PROPERTIES']['CLINIC']["VALUE"])){?>
											<select name="CLINIC" id="clinic">
												<?foreach($arResult['PROPERTIES']['CLINIC']["VALUE"] as $key=>$clinic){?>
													<?//if(strpos($arResult['PROPERTIES']['CLINIC']["VALUE_XML_ID"][$key], '50 лет')!==false || strpos($arResult['PROPERTIES']['CLINIC']["VALUE_XML_ID"][$key], 'Жук')!==false || strpos($arResult['PROPERTIES']['CLINIC']["VALUE_XML_ID"][$key], 'Домен')!==false){
														//continue;
													//}?>
													<option <?if($_POST['CLINIC']==$arResult['PROPERTIES']['CLINIC']["VALUE_XML_ID"][$key]) echo "selected"?> value="<?=$arResult['PROPERTIES']['CLINIC']["VALUE_XML_ID"][$key];?>"><?=$clinic?></option>
												<?}?>
											</select>
										<?}else{?>
											<select name="CLINIC" id="">
												<option value="<?=$arResult['PROPERTIES']['CLINIC']["VALUE_XML_ID"];?>">
													<?=$arResult['PROPERTIES']['CLINIC']["VALUE"];?>
												</option>
											</select>
										<?}?>
									</div>
									<div class="specialist-schedule__item">
										<select name="SERVICE" id="">
											<?foreach($arResult['PROPERTIES']['SERVICE']['VALUE'] as $arValue){
												$arSelect=["ID", "NAME", "IBLOCK_ID", "CATALOG_PRICE_1"];
												$arFilter=["IBLOCK_ID"=>"24", "ID"=>$arValue, "ACTIVE"=>"Y"];
												$res=CIblockElement::GetList(["DATE_CREATE"=>"DESC"], $arFilter, false, $arPages, $arSelect);
												while($ob=$res->GetNextElement()){
													$arFields=$ob->GetFields();
													echo '<option data-price="'.$arFields["CATALOG_PRICE_1"].'" value="'.$arFields["ID"].'">'.$arFields['NAME'].'</option>';
												}
											}?>
										</select>
									</div>
								</div>
							</div>
						<?}?>
						<!-- встроенный плагин расписания -->
						<div class="specialist__schedule specialist-schedule__module">
							<?
//							console($noCalendar);
//							console($noCalendarFlag);
							?>
							<?if(1==1 /*$rsData->getSelectedRowsCount()>0*/ /*&& ($noCalendarFlag==true && $noCalendar==false)*/){?>
								<div class="timesheet-nav">
									<div class="slider__nav-prev"><img src="<?=SITE_TEMPLATE_PATH?>/img/arrow-prev.svg" alt="prev"></div>
									<div class="timesheet-nav__text specialists-item__title"><?=$strFirst?> - <?=$strLastday;?></div>
									<div class="slider__nav-next"><img src="<?=SITE_TEMPLATE_PATH?>/img/arrow-next.svg" alt="next"></div>
								</div>
								<div class="timesheet">
									<div class="owl-carousel timesheet__content owl-theme" id="timesheet">
										<?while($arData=$rsData->Fetch()){
											$day=$arData['UF_BEGIN']->format("d");
											$week=$arData['UF_BEGIN']->format("w");
											$date=$arData['UF_BEGIN']->format("d.m.Y");
											if(strtotime($curentDate)>strtotime($date)){
												$curentDate=$date;
											}
											$i=0;
											while(strtotime($curentDate)<strtotime($lastday)){
												$i++;
												$day=date("d", strtotime($curentDate));
												$week=date("w", strtotime($curentDate));
												if($curentDate!=$date){?>
													<div class="timesheet__item slide">
														<div class="timesheet__head <?if($week==6 || $week==0) echo "timesheet__head--red" ?> <?if($dayNow==$day) echo "timesheet__head--strong" ?> "><?=$arWeek[$week]?>, <?=$day;?></div>
														<div class="timesheet__time-block">
															<div class="timesheet__text">В этот день приема нет</div>
														</div>
													</div>
												<?}else{?>
													<div class="timesheet__item slide">
														<div class="timesheet__head <?if($week==6 || $week==0) echo "timesheet__head--red" ?> <?if($dayNow==$day) echo "timesheet__head--strong" ?> "><?=$arWeek[$week]?>, <?=$day;?></div>
														<div class="timesheet__time-block">
															<?$j=0;
															$beginTime=$arData['UF_BEGIN']->format("H:i");
															$endTime=$arData['UF_END']->format("H:i");
															while($beginTime<$endTime){
																$j++;
																$endReception=date("H:i", strtotime($beginTime.$arData['UF_LENGTH'].'minutes'));
																$hlblockTemeId=HL\HighloadBlockTable::getById(9)->fetch();
																$entityTime=HL\HighloadBlockTable::compileEntity($hlblockTemeId);
																$entity_data_time_class=$entityTime->getDataClass();
																$rsDataTime=$entity_data_time_class::getList([
																	"select"=>["*"],
																	"order" =>["ID"=>"ASC"],
																	"filter"=>[
																		"UF_NAME"=>preg_replace('/\s+/', ' ', $arResult["NAME"]),
																		[
																			"LOGIC"=>"OR",
																			[
																				">=UF_BEGIN"=>date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), strtotime($date.' '.$beginTime)),
																				"<UF_BEGIN" =>date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), strtotime($date.' '.$endReception))
																			],
																			[
																				">UF_END"=>date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), strtotime($date.' '.$beginTime)),
																				"<UF_END"=>date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), strtotime($date.' '.$endReception))
																			],
																		]
																	]
																]);
																$timebusy=false;
																while($arDataTime=$rsDataTime->Fetch()){
																	$timebusy=true;
																}
																if($timebusy===true || strtotime($dateNow)>strtotime($curentDate)){
																	echo '<div class="timesheet__time">'.$beginTime.'</div>';
																}
																else{
																	echo '<div class="timesheet__time"><a href="#order-appointment" data-date="'.$date.'" data-fancybox="" data-src="#order-appointment" class="timesheet-link">'.$beginTime.'</a></div>';
																}
																$beginTime=date("H:i", strtotime($beginTime.$arData['UF_LENGTH'].'minutes'));
																if($j>100){
																	echo "error: infinite loop time;";
																	break;
																};
															}?>
														</div>
													</div>
													<?$curentDate=date("d.m.Y", strtotime($curentDate.'+1 day'));
													break;
												}
												$curentDate=date("d.m.Y", strtotime($curentDate.'+1 day'));
												if($i>100){
													echo "error: infinite loop date;";
													break;
												};
											}
										}?>
									</div>
								</div>
							<?}else{?>
								<div class="no-timesheet">
									В связи с техническими работами запись на прием недоступна. Приносим свои извинения за неудобства.
								</div>
								<div class="no-timesheet">
									Узнать акуальное расписание данного специалиста и записаться:
									<ul>
										<li>можно через форму онлайн-записи</li>
										<li>позвонив в контакт-центр <a href="tel:83519581111">8-3519-581-111</a></li>
										<li>через <a href="https://ok.ru/semeinyidoctor74"><img src="<?=SITE_TEMPLATE_PATH?>/img/OK_logo.svg" alt="" width="30" height="30"></a>  <a href="https://vk.com/semeinyi_doctor74"><img src="<?=SITE_TEMPLATE_PATH?>/img/VK_Compact_Logo.svg" alt="" width="30" height="30"></a></li>
										<li>написав в чат (на сайте справа внизу)</li>
									</ul>
								</div>
							<?}?>
						</div>
						<!-- встроенный плагин расписания end -->
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
							<a class="nav-link specialists-tabs__reviews" href="#spec_reviews">Отзывы (<span>3</span>)</a>
						</li>
						<li class="nav-item">
							<a class="nav-link specialists-tabs__service" href="#spec_services">Услуги (<span>0</span>)</a>
						</li>
						<li class="nav-item">
							<a class="nav-link specialists-tabs__gallery" href="#spec_gallery-specialist">Галерея врача
								(<span>10</span>)</a>
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
											<label> Эл.почта*
												<span class="form-control-wrap contact-tel">
													<input type="email" placeholder="name@example.ru" class="form-email" name="contact-email" value="" required="">
												</span>
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
											<?$arSelect=["ID", "NAME", "IBLOCK_ID", "DATE_CREATE", "PREVIEW_TEXT"];
											$arFilter=["IBLOCK_ID"=>"30", "ACTIVE"=>"Y", "PROPERTY_SPECIALIST"=>$arResult["ID"]];
											$res=CIblockElement::GetList(["DATE_CREATE"=>"DESC"], $arFilter, false, $arPages, $arSelect);
											while($ob=$res->GetNextElement()){
												$arFields=$ob->GetFields();?>
												<li class="review byuser comment-author-falewik796 even thread-even depth-1" id="li-comment-46">
													<div id="comment-46" class="comment_container">
														<div class="comment-text">
															<p class="meta">
																<strong class="woocommerce-review__author review__author"><?=$arFields["NAME"]?></strong>
																<span class="woocommerce-review__dash"></span>
																<time class="woocommerce-review__published-date" datetime="2020-07-29T21:26:23+03:00"><?=ConvertDateTime($arFields["DATE_CREATE"], "DD.MM.YYYY", "ru");?></time>
															</p>
															<div class="description">
																<p><?=$arFields["PREVIEW_TEXT"]?></p>
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
	<!-- TABS INFO END БЛЯ -->

<? /*
<!-- OTHER SPECIALISTS  -->
<section class="our-team    other-specialists" id="other-specialists">
  <div class="container">
    <div class="row justify-content-between row-vmiddle">
      <h2 class="other-specialists__title">ДРУГИЕ СПЕЦИАЛИСТЫ</h2>
      <div class="slider__nav our-team__nav navigation">
        <div class="slider__nav-prev"><img src="../img/arrow-prev.svg" alt="prev"></div>
        <div class="slider__nav-next"><img src="../img/arrow-next.svg" alt="next"></div>
      </div>
    </div>
    <div class="row">
      <div class="owl-carousel owl-theme our-team__owl other-specialists__slider" id="our-team__owl">


        <div class="item our-team__item specialists-item">
          <div class="specialists-item__top">
            <div class="specialists-item__img">
              <img src="../img/specialists-item.png" alt="" class="specialists-item__photo">
            </div>
            <div class="specialists-item__status">
              <span class="active-status"></span>
            </div>
            <div class="specialists-item__specialty">
              <div class="specialists-item__specialty--item specialists-item__specialty--adult">
                <img src="../img/adult-doc.png" alt="">
                <div class="specialist-tooltip">взрослый врач</div>
              </div>
              <div class="specialists-item__specialty--item specialists-item__specialty--children">
                <img src="../img/children-doc.png" alt="">
                <div class="specialist-tooltip">детский врач</div>
              </div>
            </div>
          </div>
          <div class="specialists-item__content">
            <h4 class="specialists-item__title">Аникеев Вадим Алексеевич</h4>
            <div class="specialists-item__position">кардиолог</div>
            <div class="specialists-item__position">врач функциональной диагностики</div>
            <div class="specialists-item__place">
              <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 0.0078125C2.0142 0.0078125 0 1.95819 0 4.37406C0 8.55131 4.5 13.9991 4.5 13.9991C4.5 13.9991 9 8.55044 9 4.37406C9 1.95906 6.9858 0.0078125 4.5 0.0078125ZM4.5 6.78994C3.1572 6.78994 2.07 5.73206 2.07 4.42744C2.07 3.12281 3.1572 2.06494 4.5 2.06494C5.841 2.06494 6.9291 3.12281 6.9291 4.42744C6.9291 5.73206 5.841 6.78994 4.5 6.78994Z" fill="#75A72D"></path>
              </svg>
              Клиника ул. Жукова, д.11
            </div>
            <div class="specialists-item__admission">
              <div class="specialists-item__admission--time">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M16 2H15V4H12V2H6V4H3V2H2C0.899 2 0 2.9 0 4V16C0 17.1 0.899 18 2 18H16C17.1 18 18 17.1 18 16V4C18 2.9 17.1 2 16 2ZM16 16H2V8H16V16ZM5.5 0H3.5V3.5H5.5V0ZM14.5 0H12.5V3.5H14.5V0Z" fill="#75A72D"></path>
                </svg>
                <div class="specialists-item__admission--title">Приём</div>
                <a href="" class="specialists-item__admission--link">05.08 в 14:55</a>
              </div>
            </div>
            <div class="specialists-item__btn">
              <a href="/page-specialist.html" class="btn btn-grey-tr our-team__btn">Записаться</a>
            </div>
          </div>
        </div>

        <div class="item our-team__item specialists-item">
          <div class="specialists-item__top">
            <div class="specialists-item__img">
              <img src="../img/specialists-item.png" alt="" class="specialists-item__photo">
            </div>
            <div class="specialists-item__status">
              <span class="active-status"></span>
            </div>
            <div class="specialists-item__specialty">
              <div class="specialists-item__specialty--item specialists-item__specialty--adult">
                <img src="../img/adult-doc.png" alt="">
                <div class="specialist-tooltip">взрослый врач</div>
              </div>
              <div class="specialists-item__specialty--item specialists-item__specialty--children">
                <img src="../img/children-doc.png" alt="">
                <div class="specialist-tooltip">детский врач</div>
              </div>
            </div>
          </div>
          <div class="specialists-item__content">
            <h4 class="specialists-item__title">Аникеев Вадим Алексеевич</h4>
            <div class="specialists-item__position">кардиолог</div>
            <div class="specialists-item__position">врач функциональной диагностики</div>
            <div class="specialists-item__place">
              <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 0.0078125C2.0142 0.0078125 0 1.95819 0 4.37406C0 8.55131 4.5 13.9991 4.5 13.9991C4.5 13.9991 9 8.55044 9 4.37406C9 1.95906 6.9858 0.0078125 4.5 0.0078125ZM4.5 6.78994C3.1572 6.78994 2.07 5.73206 2.07 4.42744C2.07 3.12281 3.1572 2.06494 4.5 2.06494C5.841 2.06494 6.9291 3.12281 6.9291 4.42744C6.9291 5.73206 5.841 6.78994 4.5 6.78994Z" fill="#75A72D"></path>
              </svg>
              Клиника ул. Жукова, д.11
            </div>
            <div class="specialists-item__admission">
              <div class="specialists-item__admission--time">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M16 2H15V4H12V2H6V4H3V2H2C0.899 2 0 2.9 0 4V16C0 17.1 0.899 18 2 18H16C17.1 18 18 17.1 18 16V4C18 2.9 17.1 2 16 2ZM16 16H2V8H16V16ZM5.5 0H3.5V3.5H5.5V0ZM14.5 0H12.5V3.5H14.5V0Z" fill="#75A72D"></path>
                </svg>
                <div class="specialists-item__admission--title">Приём</div>
                <a href="" class="specialists-item__admission--link">05.08 в 14:55</a>
              </div>
            </div>
            <div class="specialists-item__btn">
              <a href="/page-specialist.html" class="btn btn-grey-tr our-team__btn">Записаться</a>
            </div>
          </div>
        </div>

        <div class="item our-team__item specialists-item">
          <div class="specialists-item__top">
            <div class="specialists-item__img">
              <img src="../img/specialists-item.png" alt="" class="specialists-item__photo">
            </div>
            <div class="specialists-item__status">
              <span class="no-active-status"></span>
            </div>
            <div class="specialists-item__specialty">
              <div class="specialists-item__specialty--item specialists-item__specialty--adult">
                <img src="../img/adult-doc.png" alt="">
                <div class="specialist-tooltip">взрослый врач</div>
              </div>
              <div class="specialists-item__specialty--item specialists-item__specialty--children">
                <img src="../img/children-doc.png" alt="">
                <div class="specialist-tooltip">детский врач</div>
              </div>
            </div>
          </div>
          <div class="specialists-item__content">
            <h4 class="specialists-item__title">Аникеев Вадим Алексеевич</h4>
            <div class="specialists-item__position">кардиолог</div>
            <div class="specialists-item__position">врач функциональной диагностики</div>
            <div class="specialists-item__place">
              <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 0.0078125C2.0142 0.0078125 0 1.95819 0 4.37406C0 8.55131 4.5 13.9991 4.5 13.9991C4.5 13.9991 9 8.55044 9 4.37406C9 1.95906 6.9858 0.0078125 4.5 0.0078125ZM4.5 6.78994C3.1572 6.78994 2.07 5.73206 2.07 4.42744C2.07 3.12281 3.1572 2.06494 4.5 2.06494C5.841 2.06494 6.9291 3.12281 6.9291 4.42744C6.9291 5.73206 5.841 6.78994 4.5 6.78994Z" fill="#75A72D"></path>
              </svg>
              Клиника ул. Жукова, д.11
            </div>
            <div class="specialists-item__admission">
              <div class="specialists-item__admission--time">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M16 2H15V4H12V2H6V4H3V2H2C0.899 2 0 2.9 0 4V16C0 17.1 0.899 18 2 18H16C17.1 18 18 17.1 18 16V4C18 2.9 17.1 2 16 2ZM16 16H2V8H16V16ZM5.5 0H3.5V3.5H5.5V0ZM14.5 0H12.5V3.5H14.5V0Z" fill="#75A72D"></path>
                </svg>
                <div class="specialists-item__admission--title">Приём</div>
                <a href="" class="specialists-item__admission--link">05.08 в 14:55</a>
              </div>
            </div>
            <div class="specialists-item__btn">
              <a href="/page-specialist.html" class="btn btn-grey-tr our-team__btn">Записаться</a>
            </div>
          </div>
        </div>

        <div class="item our-team__item specialists-item">
          <div class="specialists-item__top">
            <div class="specialists-item__img">
              <img src="../img/specialists-item.png" alt="" class="specialists-item__photo">
            </div>
            <div class="specialists-item__status">
              <span class="active-status"></span>
            </div>
            <div class="specialists-item__specialty">
              <div class="specialists-item__specialty--item specialists-item__specialty--children">
                <img src="../img/children-doc.png" alt="">
                <div class="specialist-tooltip">детский врач</div>
              </div>
            </div>
          </div>
          <div class="specialists-item__content">
            <h4 class="specialists-item__title">Аникеев Вадим Алексеевич</h4>
            <div class="specialists-item__position">кардиолог</div>
            <div class="specialists-item__position">врач функциональной диагностики</div>
            <div class="specialists-item__place">
              <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 0.0078125C2.0142 0.0078125 0 1.95819 0 4.37406C0 8.55131 4.5 13.9991 4.5 13.9991C4.5 13.9991 9 8.55044 9 4.37406C9 1.95906 6.9858 0.0078125 4.5 0.0078125ZM4.5 6.78994C3.1572 6.78994 2.07 5.73206 2.07 4.42744C2.07 3.12281 3.1572 2.06494 4.5 2.06494C5.841 2.06494 6.9291 3.12281 6.9291 4.42744C6.9291 5.73206 5.841 6.78994 4.5 6.78994Z" fill="#75A72D"></path>
              </svg>
              Клиника ул. Жукова, д.11
            </div>
            <div class="specialists-item__admission">
              <div class="specialists-item__admission--time">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M16 2H15V4H12V2H6V4H3V2H2C0.899 2 0 2.9 0 4V16C0 17.1 0.899 18 2 18H16C17.1 18 18 17.1 18 16V4C18 2.9 17.1 2 16 2ZM16 16H2V8H16V16ZM5.5 0H3.5V3.5H5.5V0ZM14.5 0H12.5V3.5H14.5V0Z" fill="#75A72D"></path>
                </svg>
                <div class="specialists-item__admission--title">Приём</div>
                <a href="" class="specialists-item__admission--link">05.08 в 14:55</a>
              </div>
            </div>
            <div class="specialists-item__btn">
              <a href="/page-specialist.html" class="btn btn-grey-tr our-team__btn">Записаться</a>
            </div>
          </div>
        </div>

        <div class="item our-team__item specialists-item">
          <div class="specialists-item__top">
            <div class="specialists-item__img">
              <img src="../img/specialists-item.png" alt="" class="specialists-item__photo">
            </div>
            <div class="specialists-item__status">
              <span class="no-active-status"></span>
            </div>
            <div class="specialists-item__specialty">
              <div class="specialists-item__specialty--item specialists-item__specialty--adult">
                <img src="../img/adult-doc.png" alt="">
                <div class="specialist-tooltip">взрослый врач</div>
              </div>
              <div class="specialists-item__specialty--item specialists-item__specialty--children">
                <img src="../img/children-doc.png" alt="">
                <div class="specialist-tooltip">детский врач</div>
              </div>
            </div>
          </div>
          <div class="specialists-item__content">
            <h4 class="specialists-item__title">Аникеев Вадим Алексеевич</h4>
            <div class="specialists-item__position">кардиолог</div>
            <div class="specialists-item__position">врач функциональной диагностики</div>
            <div class="specialists-item__place">
              <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 0.0078125C2.0142 0.0078125 0 1.95819 0 4.37406C0 8.55131 4.5 13.9991 4.5 13.9991C4.5 13.9991 9 8.55044 9 4.37406C9 1.95906 6.9858 0.0078125 4.5 0.0078125ZM4.5 6.78994C3.1572 6.78994 2.07 5.73206 2.07 4.42744C2.07 3.12281 3.1572 2.06494 4.5 2.06494C5.841 2.06494 6.9291 3.12281 6.9291 4.42744C6.9291 5.73206 5.841 6.78994 4.5 6.78994Z" fill="#75A72D"></path>
              </svg>
              Клиника ул. Жукова, д.11
            </div>
            <div class="specialists-item__admission">
              <div class="specialists-item__admission--time">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M16 2H15V4H12V2H6V4H3V2H2C0.899 2 0 2.9 0 4V16C0 17.1 0.899 18 2 18H16C17.1 18 18 17.1 18 16V4C18 2.9 17.1 2 16 2ZM16 16H2V8H16V16ZM5.5 0H3.5V3.5H5.5V0ZM14.5 0H12.5V3.5H14.5V0Z" fill="#75A72D"></path>
                </svg>
                <div class="specialists-item__admission--title">Приём</div>
                <a href="" class="specialists-item__admission--link">05.08 в 14:55</a>
              </div>
            </div>
            <div class="specialists-item__btn">
              <a href="/page-specialist.html" class="btn btn-grey-tr our-team__btn">Записаться</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
<!-- OTHER SPECIALISTS END -->
*/ ?>

<? /*
<div class="news-detail">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
<img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
    width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
    alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>" />
<?endif?>
<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
<?endif;?>
<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
<h3><?=$arResult["NAME"]?></h3>
<?endif;?>
<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
<?endif;?>
<?if($arResult["NAV_RESULT"]):?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?echo $arResult["NAV_TEXT"];?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
<?elseif($arResult["DETAIL_TEXT"] <> ''):?>
<?echo $arResult["DETAIL_TEXT"];?>
<?else:?>
<?echo $arResult["PREVIEW_TEXT"];?>
<?endif?>
<div style="clear:both"></div>
<br />
<?foreach($arResult["FIELDS"] as $code=>$value):
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;
<?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>">
<?
			}
		}
		else
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
<?
		}
		?><br />
<?endforeach;
	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

<?=$arProperty["NAME"]?>:&nbsp;
<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
<?else:?>
<?=$arProperty["DISPLAY_VALUE"];?>
<?endif?>
<br />
<?endforeach;
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
<div class="news-detail-share">
    <noindex>
        <?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
    </noindex>
</div>
<?
	}

</div>	*/ ?>