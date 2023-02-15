<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
?>

<?
$tab = ($_REQUEST['TAB'] == '') ? 1 : $_REQUEST['TAB'];
?>

<!--  CERTIFICATES  -->
<section class="certificates documents" id="documents">
	<div class="container">
		<div class="row">
			<div class="documents-col documents__navi">
				<h2 class="documents__title">ДОКУМЕНТЫ</h2>
				<ul class="nav nav-tabs nav-tabs-documents" id="tabs-documents">
					<li class="nav-item <? if ($tab == '1') echo "active" ?>">
						<a class="nav-link" href="#documents-1">Договор</a>
					</li>
					<li class="nav-item <? if ($tab == '2') echo "active" ?>">
						<a class="nav-link" href="#documents-2">Доверенность</a>
					</li>
					<li class="nav-item <? if ($tab == '3') echo "active" ?>">
						<a class="nav-link" href="#documents-3">Справка для налоговой</a>
					</li>
					<li class="nav-item <? if ($tab == '4') echo "active" ?>">
						<a class="nav-link" href="#documents-4">Согласие родителей</a>
					</li>
					<li class="nav-item <? if ($tab == '5') echo "active" ?>">
						<a class="nav-link" href="#documents-5">Бонусная программа</a>
					</li>
					<li class="nav-item <? if ($tab == '6') echo "active" ?>">
						<a class="nav-link" href="#documents-6">Памятки пациентам</a>
					</li>
					<li class="nav-item <? if ($tab == '7') echo "active" ?>">
						<a class="nav-link" href="#documents-7">Возврат денежных средств</a>
					</li>
					<li class="nav-item <? if ($tab == '8') echo "active" ?>">
						<a class="nav-link" href="#documents-8">Юридические документы</a>
					</li>
					<li class="nav-item <? if ($tab == '9') echo "active" ?>">
						<a class="nav-link" href="#documents-9">Лицензия</a>
					</li>
					<li class="nav-item <? if ($tab == '10') echo "active" ?>">
						<a class="nav-link" href="#documents-10">Реквизиты</a>
					</li>
					<li class="nav-item <? if ($tab == '11') echo "active" ?>">
						<a class="nav-link" href="#documents-11">Персональные данные</a>
					</li>
					<li class="nav-item <? if ($tab == '12') echo "active" ?>">
						<a class="nav-link" href="#documents-12">Правила поведения</a>
					</li>
				</ul>
				<?/*	<a href="" class="btn btn-tr btn-doc-more">ПОКАЗАТЬ ЕЩЕ</a>*/ ?>
			</div>
			<div class="documents-col documents__contents">
				<div class="tab-content documents-tab-content">
					<div class="tab-pane fade tab-content__documents  <? if ($tab == '1') echo "show active" ?>" id="documents-1">
						<div class="tab-documents-wrapper">
							<div class="row-certificates row-certificates-title">
								<h4 class="documents-tabs__title">Договор</h4>
							</div>
							<div class="row-certificates row-certificates-slider">
								<div class="certificates-slider slider-with-btn">
									<?foreach($arResult["PROPERTIES"]["CONTRACT"]["VALUE"] as $Value){
										$res=CFile::GetList(array(), array("ID" => $Value));
										$res_arr=$res->GetNext();
									?>
										<div class="item certificates-slider__item_flex">
											<a class="certificates-icon">
												<img src="<?= SITE_TEMPLATE_PATH ?>/img/pdf-icon.png" alt="">
											</a>
											<h5><a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" target="_blank"><?= $res_arr["ORIGINAL_NAME"] ?></a></h5>
											<a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" class="btn btn-green btn-download" target="_blank" download="">Скачать</a>
										</div>
									<?}?>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane fade tab-content__documents <? if ($tab == '2') echo "show active" ?>" id="documents-2">
						<div class="tab-documents-wrapper">
							<div class="row-certificates row-certificates-title">
								<h4 class="documents-tabs__title">Доверенность</h4>
							</div>
							<div class="row-certificates row-certificates-slider">
								<div class="certificates-slider slider-with-btn">
									<?foreach($arResult["PROPERTIES"]["POWERATTORNEY"]["VALUE"] as $Value){
										$res = CFile::GetList(array(), array("ID" => $Value));
										$res_arr = $res->GetNext();
									?>
										<div class="item certificates-slider__item_flex">
											<a class="certificates-icon">
												<img src="<?= SITE_TEMPLATE_PATH ?>/img/pdf-icon.png" alt="">
											</a>
											<h5><a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" target="_blank"><?= $res_arr["ORIGINAL_NAME"] ?></a></h5>
											<a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" class="btn btn-green btn-download" target="_blank" download="">Скачать</a>
										</div>
									<?}?>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane fade tab-content__documents <? if ($tab == '3') echo "show active" ?>" id="documents-3">
						<div class="tab-documents-wrapper">
							<div class="row-certificates row-certificates-title">
								<h4 class="documents-tabs__title">Справка для налоговой</h4>
							</div>
							<div class="row-certificates row-certificates-slider">
								<div class="certificates-slider slider-with-btn">
										<?foreach($arResult["PROPERTIES"]["NDFL"]["VALUE"] as $Value){
											$res = CFile::GetList(array(), array("ID" => $Value));
											$res_arr = $res->GetNext();
										?>
											<div class="item certificates-slider__item_flex">
												<a class="certificates-icon">
													<img src="<?= SITE_TEMPLATE_PATH ?>/img/pdf-icon.png" alt="">
												</a>
												<h5><a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" target="_blank"><?= $res_arr["ORIGINAL_NAME"] ?></a></h5>
												<a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" class="btn btn-green btn-download" target="_blank" download="">Скачать</a>
											</div>
										<?}?>
										<div style="border: 1px solid #d6d6d6; padding: 10px; font-size: 12px; background-color: #eff1f1;">
											Уважаемые пациенты! В соответствии с действующим законодательством РФ заказать справку для ИФНС можно по письменному заявлению пациента. Выдача справки осуществляется лично заявителю, либо законному представителю, либо лицу, действующему на основании доверенности. Возможна отправка справки посредством «Почты России» заказным письмом с уведомлением за счет получателя.
										</div>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane fade tab-content__documents <? if ($tab == '4') echo "show active" ?>" id="documents-4">
						<div class="tab-documents-wrapper">
							<div class="row-certificates row-certificates-title">
								<h4 class="documents-tabs__title">Согласие родителей</h4>
							</div>
							<div class="row-certificates row-certificates-slider">
								<div class="certificates-slider slider-with-btn">
										<? foreach ($arResult["PROPERTIES"]["CONSENT"]["VALUE"] as $Value) :

											$res = CFile::GetList(array(), array("ID" => $Value));
											$res_arr = $res->GetNext();
										?>
											<div class="item certificates-slider__item_flex">
												<a class="certificates-icon">
													<img src="<?= SITE_TEMPLATE_PATH ?>/img/pdf-icon.png" alt="">
												</a>
												<h5><a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" target="_blank"><?= $res_arr["ORIGINAL_NAME"] ?></a></h5>
												<a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" target="_blank" class="btn btn-green btn-download" download="">Скачать</a>
											</div>
										<? endforeach; ?>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane fade tab-content__documents <? if ($tab == '5') echo "show active" ?>" id="documents-5">
						<div class="tab-documents-wrapper">
							<div class="row-certificates row-certificates-title">
								<h4 class="documents-tabs__title">Бонусная программа</h4>
							</div>
							<div class="row-certificates row-certificates-slider">
								<div class="certificates-slider slider-with-btn" >
									<div class="certificates-slider slider-with-btn" id="documents__slider1">
										<?= $arResult["PROPERTIES"]["BONUS"]["~VALUE"]["TEXT"]; ?>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane fade tab-content__documents <? if ($tab == '6') echo "show active" ?>" id="documents-6">
						<div class="tab-documents-wrapper">
							<div class="row-certificates row-certificates-title">
								<h4 class="documents-tabs__title">Памятки пациентам</h4>
							</div>
							<div class="row-certificates row-certificates-slider">
								<div class="owl-carousel owl-theme certificates-slider slider-with-btn documents__slider" id="documents__slider1">
								
										<?
										foreach ($arResult["PROPERTIES"]["MEMOS"]["VALUE"] as $Value) :
											$res = CFile::GetList(array(), array("ID" => $Value));
											$res_arr = $res->GetNext();

										?>
											<div class="item certificates-slider__item">
												<a  data-fancybox="memos" href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>">
													<img  src="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>">
												</a>
												<?/*
												<h5><?= $res_arr["ORIGINAL_NAME"] ?></h5>
												<a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" class="btn btn-green btn-download" download="">Скачать</a>
												*/?>
											</div>
										<? endforeach; ?>
									
								</div>
							</div>
						</div>
					</div>


					<div class="tab-pane fade tab-content__documents <? if ($tab == '7') echo "show active" ?>" id="documents-7">
						<div class="tab-documents-wrapper">
							<div class="row-certificates row-certificates-title">
								<h4 class="documents-tabs__title">Возврат денежных средств</h4>
							</div>
							<div class="row-certificates row-certificates-slider">
								<div class="certificates-slider slider-with-btn">
										<? foreach ($arResult["PROPERTIES"]["REFUND"]["VALUE"] as $Value) :

											$res = CFile::GetList(array(), array("ID" => $Value));
											$res_arr = $res->GetNext();
										?>
											<div class="item certificates-slider__item_flex">
												<a class="certificates-icon">
													<img src="<?= SITE_TEMPLATE_PATH ?>/img/pdf-icon.png" alt="">
												</a>
												<h5><a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" target="_blank"><?= $res_arr["ORIGINAL_NAME"] ?></a></h5>
												<a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" class="btn btn-green btn-download" target="_blank" download="">Скачать</a>
											</div>
										<? endforeach; ?>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane fade tab-content__documents <? if ($tab == '8') echo "show active" ?>" id="documents-8">
						<div class="tab-documents-wrapper">
							<div class="row-certificates row-certificates-title">
								<h4 class="documents-tabs__title">Юридические документы</h4>
							</div>
							<div class="row-certificates row-certificates-slider">
								<div class="certificates-slider slider-with-btn">
										<? foreach ($arResult["PROPERTIES"]["LEGAL"]["VALUE"] as $Value) :

											$res = CFile::GetList(array(), array("ID" => $Value));
											$res_arr = $res->GetNext();
										?>
											<div class="item certificates-slider__item_flex">
												<a class="certificates-icon">
													<img src="<?= SITE_TEMPLATE_PATH ?>/img/pdf-icon.png" alt="">
												</a>
												<h5><a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" target="_blank"><?= $res_arr["ORIGINAL_NAME"] ?></a></h5>
												<a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" target="_blank" class="btn btn-green btn-download" download="">Скачать</a>
											</div>
										<? endforeach; ?>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane fade tab-content__documents <? if ($tab == '9') echo "show active" ?>" id="documents-9">
						<div class="tab-documents-wrapper">
							<div class="row-certificates row-certificates-title">
								<h4 class="documents-tabs__title">Лицензия</h4>
							</div>
							<div class="row-certificates row-certificates-slider">
								<div class="certificates-slider slider-with-btn">
										<?
										foreach ($arResult["PROPERTIES"]["LICENSE"]["VALUE"] as $Value) :
											$res = CFile::GetList(array(), array("ID" => $Value));
											$res_arr = $res->GetNext();
										?>
											<div class="item certificates-slider__item_flex">
											<a class="certificates-icon">
												<img src="<?= SITE_TEMPLATE_PATH ?>/img/pdf-icon.png" alt="">
												</a>
												<h5><a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" target="_blank"><?= $res_arr["ORIGINAL_NAME"] ?></a></h5>
												<a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" target="_blank" class="btn btn-green btn-download" download="">Скачать</a>
											</div>
										<? endforeach; ?>
								</div>
							</div>
						</div>
					</div>


					<div class="tab-pane fade tab-content__documents <? if ($tab == '10') echo "show active" ?>" id="documents-10">
						<div class="tab-documents-wrapper">
							<div class="row-certificates row-certificates-title">
								<h4 class="documents-tabs__title">Реквизиты</h4>
							</div>
							<div class="row-certificates row-certificates-slider">
								<div class="certificates-slider slider-with-btn">
									<?= $arResult["PROPERTIES"]["REQUISITES"]["~VALUE"]["TEXT"]; ?>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade tab-content__documents <? if ($tab == '11') echo "show active" ?>" id="documents-11">
						<div class="tab-documents-wrapper">
							<div class="row-certificates row-certificates-title">
								<h4 class="documents-tabs__title">Персональные данные</h4>
							</div>
							<div class="row-certificates row-certificates-slider">
								<div class="certificates-slider slider-with-btn">
										<?foreach($arResult["PROPERTIES"]["PERSONAL"]["VALUE"] as $Value){
											$res=CFile::GetList(array(), array("ID" => $Value));
											$res_arr=$res->GetNext();
										?>
											<div class="item certificates-slider__item_flex">
												<a class="certificates-icon">
													<img src="<?=SITE_TEMPLATE_PATH?>/img/pdf-icon.png" alt="">
												</a>
												<h5><a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" target="_blank"><?= $res_arr["ORIGINAL_NAME"] ?></a></h5>
												<a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" target="_blank" class="btn btn-green btn-download" download="">Скачать</a>
											</div>
										<?}?>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade tab-content__documents <? if ($tab == '12') echo "show active" ?>" id="documents-12">
						<div class="tab-documents-wrapper">
							<div class="row-certificates row-certificates-title">
								<h4 class="documents-tabs__title">Правила поведения</h4>
							</div>
							<div class="row-certificates row-certificates-slider">
								<div class="certificates-slider slider-with-btn">
										<? foreach ($arResult["PROPERTIES"]["RULES"]["VALUE"] as $Value) :
											$res = CFile::GetList(array(), array("ID" => $Value));
											$res_arr = $res->GetNext();
										?>
											<div class="item certificates-slider__item_flex">
												<a class="certificates-icon">
													<img src="<?= SITE_TEMPLATE_PATH ?>/img/pdf-icon.png" alt="">
												</a>
												<h5><a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" target="_blank"><?= $res_arr["ORIGINAL_NAME"] ?></a></h5>
												<a href="/upload/<? echo $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"]; ?>" class="btn btn-green btn-download" download="">Скачать</a>
											</div>
										<? endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>
<!-- CERTIFICATES END  -->