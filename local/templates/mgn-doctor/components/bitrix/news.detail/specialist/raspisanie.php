<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

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

							<?if(/*1==1 */ $rsData->getSelectedRowsCount()>0 /*&& ($noCalendarFlag==true && $noCalendar==false)*/){?>
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
									Узнать акуальное расписание данного специалиста и записаться:
									<ul>
										<li>можно через форму онлайн-записи</li>
										<li>позвонив в контакт-центр <a href="tel:83519581111">8-3519-581-111</a></li>
										<li>через <a href="https://ok.ru/semeinyidoctor74" rel="nofollow"><img src="<?=SITE_TEMPLATE_PATH?>/img/OK_logo.svg" alt="" width="30" height="30"></a>  <a href="https://vk.com/semeinyi_doctor74" rel="nofollow"><img src="<?=SITE_TEMPLATE_PATH?>/img/VK_Compact_Logo.svg" alt="" width="30" height="30"></a></li>
										<li>написав в чат (на сайте справа внизу)</li>
									</ul>
								</div>
							<?}?>