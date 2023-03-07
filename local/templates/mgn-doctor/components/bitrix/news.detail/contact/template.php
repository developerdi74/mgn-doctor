<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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

<section class="contacts contacts-page">
	<div class="container">
		<div class="row row-contacts-title ">
			<h1 class="page-title contacts__title">Контакты филиалов</h1>
		</div>
		<div class="row row-contacts-tabs">
			<ul class="nav nav-tabs nav-tabs-contacts">
				<li class="nav-item <? if($_REQUEST['ELEMENT_CODE']=='klinika-na-zhukova') echo "active"; ?>">
					<a class="nav-link " href="/about/klinika-na-zhukova/">
						<svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 0.0078125C2.0142 0.0078125 0 1.95819 0 4.37406C0 8.55131 4.5 13.9991 4.5 13.9991C4.5 13.9991 9 8.55044 9 4.37406C9 1.95906 6.9858 0.0078125 4.5 0.0078125ZM4.5 6.78994C3.1572 6.78994 2.07 5.73206 2.07 4.42744C2.07 3.12281 3.1572 2.06494 4.5 2.06494C5.841 2.06494 6.9291 3.12281 6.9291 4.42744C6.9291 5.73206 5.841 6.78994 4.5 6.78994Z" fill="white"/>
						</svg>
						ул. Жукова, д.11
					</a>
				</li>
				<li class="nav-item <? if($_REQUEST['ELEMENT_CODE']=='klinika-na-domenshchikov-8a') echo "active"; ?>">
					<a class="nav-link" href="/about/klinika-na-domenshchikov-8a/">
						<svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 0.0078125C2.0142 0.0078125 0 1.95819 0 4.37406C0 8.55131 4.5 13.9991 4.5 13.9991C4.5 13.9991 9 8.55044 9 4.37406C9 1.95906 6.9858 0.0078125 4.5 0.0078125ZM4.5 6.78994C3.1572 6.78994 2.07 5.73206 2.07 4.42744C2.07 3.12281 3.1572 2.06494 4.5 2.06494C5.841 2.06494 6.9291 3.12281 6.9291 4.42744C6.9291 5.73206 5.841 6.78994 4.5 6.78994Z" fill="white"/>
						</svg>
						ул. Доменщиков, д.8а
					</a>
				</li>
				<li class="nav-item <? if($_REQUEST['ELEMENT_CODE']=='klinika-na-50-let-magnitki') echo "active"; ?>">
					<a class="nav-link" href="/about/klinika-na-50-let-magnitki/">
						<svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 0.0078125C2.0142 0.0078125 0 1.95819 0 4.37406C0 8.55131 4.5 13.9991 4.5 13.9991C4.5 13.9991 9 8.55044 9 4.37406C9 1.95906 6.9858 0.0078125 4.5 0.0078125ZM4.5 6.78994C3.1572 6.78994 2.07 5.73206 2.07 4.42744C2.07 3.12281 3.1572 2.06494 4.5 2.06494C5.841 2.06494 6.9291 3.12281 6.9291 4.42744C6.9291 5.73206 5.841 6.78994 4.5 6.78994Z" fill="white"/>
						</svg>
						ул. 50 лет Магнитки, д.35/1
					</a>
				</li>
			</ul>
		</div>
		<div class="row row-contacts-details">
			<div class="tab-content contacts-tab-content">
				<div class="tab-pane fade show active  " id="spec_education">
					<div class="tab-contacts-wrapper">
						<div class="contacts__img">
							<img src="<?=$arResult['PREVIEW_PICTURE']['SRC'];?>" height = "<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>" width = "<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" alt="">
						</div>
						<div class="contacts__details contacts-details">
							<h4 class="contacts-details__place"><?=$arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"];?></h4>
							<p class="contacts-details__desc">Многопрофильный медицинский центр «Семейный доктор»</p>
							<div class="contacts-info contacts-details__info">
								<div class="contacts-info__item">
									<h6 class="contacts-info__title">Часы работы</h6>
									<? foreach($arResult["DISPLAY_PROPERTIES"]["OPENING_HOURS"]["VALUE"] as $Value) echo "<time>".$Value."</time>"; ?>
								</div>
								<div class="contacts-info__item">
									<h6 class="contacts-info__title">Контакты</h6>
									<? foreach($arResult["DISPLAY_PROPERTIES"]["PHONE"]["VALUE"] as $Value) echo '<a href="tel:'.$Value.'" class="phone contacts-info__phone">'.$Value.'</a>'; ?>
									<? echo '<a href="mailto:'.$arResult["DISPLAY_PROPERTIES"]["E_MAIL"]["VALUE"].'" class="mail email-gtag contacts-info__email">'.$arResult["DISPLAY_PROPERTIES"]["E_MAIL"]["VALUE"].'</a>'; ?>
								</div>
								<div class="contacts-info__item">
									<a href="#order-appointment" data-fancybox="" data-src="#order-appointment" class="btn btn-lred contacts-info__btn">Записаться на приём</a>
									<?if($arResult["ID"]=='727'){?>
										<a href="/specialists/raspisanie-vrachey/?CLINIC=1" class="btn btn-grey contacts-info__btn">Расписание</a>
									<?}?>
									<?if($arResult["ID"]=='728'){?>
										<a href="/specialists/raspisanie-vrachey/?CLINIC=2" class="btn btn-grey contacts-info__btn">Расписание</a>
									<?}?>
									<?if($arResult["ID"]=='1240'){?>
										<a href="/specialists/raspisanie-vrachey/?CLINIC=3" class="btn btn-grey contacts-info__btn">Расписание</a>
									<?}?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<? /*
<!-- MAIN DIRECTIONS  -->
<section class="main-directions main-directions--contacts mt-60" id="main-directions">
	<div class="container">
		<div class="row justify-content-between row-vmiddle">
			<h2 class="section-title main-directions__title">НАПРАВЛЕНИЯ КЛИНИКИ</h2>
			<div class="main-directions__right main-directions__right--desktop">
				<a href="#order-appointment" data-fancybox="" data-src="#order-appointment" class="btn btn-green btn-sign-up">Записаться</a>
				<div class="slider__nav main-directions__nav navigation">
					<div class="slider__nav-prev"><img src="<?= SITE_TEMPLATE_PATH ?>/img/arrow-prev.svg" alt="prev"></div>
					<div class="slider__nav-next"><img src="<?= SITE_TEMPLATE_PATH ?>/img/arrow-next.svg" alt="next"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="owl-carousel owl-theme main-directions__owl" id="main-directions__owl">

				<? $APPLICATION->IncludeComponent(
					"bitrix:catalog.section.list",
					"department",
					array(
						"ADD_SECTIONS_CHAIN" => "Y",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "Y",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"COUNT_ELEMENTS" => "Y",
						"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
						"FILTER_NAME" => "sectionsFilter",
						"IBLOCK_ID" => "24",
						"IBLOCK_TYPE" => "mgn_doctor_service",
						"SECTION_CODE" => "",
						"SECTION_FIELDS" => array(
							0 => "",
							1 => "",
						),
						"SECTION_ID" => "",
						"SECTION_URL" => "",
						"SECTION_USER_FIELDS" => array(
							0 => "",
							1 => "",
						),
						"SHOW_PARENT_NAME" => "Y",
						"TOP_DEPTH" => "1",
						"VIEW_MODE" => "LINE",
						"COMPONENT_TEMPLATE" => "department"
					),
					false
				); ?>

			</div>
		</div>

		<div class="row mobile-row">
			<div class="main-directions__right">
				<a href="#ask-question" data-fancybox="" data-src="#ask-question" class="btn btn-green btn-sign-up">Записаться</a>
				<div class="slider__nav main-directions__nav navigation">
					<div class="slider__nav-prev"><img src="../img/arrow-prev.svg" alt="prev"></div>
					<div class="slider__nav-next"><img src="../img/arrow-next.svg" alt="next"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- MAIN DIRECTIONS END -->
*/ ?>
<!-- CHIEF -->
<section class="chief  mt-60 " id="chief">
	<div class="container">
		<div class="row row-chief">
			<div class="chief__text chief__col chief__col--left">
				<h2 class="chief__title">О клинике</h2>
				<div class="chief__about">
					<?=$arResult["PREVIEW_TEXT"];?>
				</div>
				<div class="show-more-text">развернуть</div>
			</div>
			<div class="chief__col chief__col--right">
				<div class="specialists-item__top chief__top">
					<div class="chief__img">
						<?if($_REQUEST['ELEMENT_CODE']=='klinika-na-domenshchikov-8a'){?>
							<img src="/upload/Kazantseva_Lidia_Andreevna.png">
						<?}?>
						<?if($_REQUEST['ELEMENT_CODE']=='klinika-na-50-let-magnitki' || $_REQUEST['ELEMENT_CODE']=='klinika-na-zhukova'){?>
							<img src="/upload/Andronov_Vladimir_Petrovich.png">
						<?}?>
					</div>
					<div class="specialists-item__status"><span class="active-status"></span></div>
				</div>
				<div class="chief__desc">
					<?if($_REQUEST['ELEMENT_CODE']=='klinika-na-domenshchikov-8a'){?>
						<h4 class="chief__name">Казанцева Лидия Андреевна</h4>
					<?}?>
					<?if($_REQUEST['ELEMENT_CODE']=='klinika-na-50-let-magnitki' || $_REQUEST['ELEMENT_CODE']=='klinika-na-zhukova'){?>
						<h4 class="chief__name">Андронов Владимир Петрович</h4>
					<?}?>
					<h6 class="chief__position">ГЛАВНЫЙ ВРАЧ</h6>
					<p class="chief__description">
						<?=$arResult["DISPLAY_PROPERTIES"]["DOCTOR"]["DISPLAY_VALUE"];?>
					</p>
						<a name="doc" href="#mail-doctor" data-fancybox="" data-src="#mail-doctor" class="btn btn-green btn-chief">Отправить письмо</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- CHIEF END -->

<!--  PHOTO GALLERY  -->
<section class="gallery contacts__gallery" id="gallery">
	<div class="container">
		<div class="row row-services-prices ">
			<h2 class="  gallery__title">Фотогалерея</h2>
		</div>
		<div class="row row-gallery">
			<div class="gallery-grid gallery__grid">
				<?foreach($arResult["DISPLAY_PROPERTIES"]["PHOTO"]["FILE_VALUE"] as $Value){?>
					<div class="gallery-grid__item gallery-grid__item-1">
						<a data-fancybox="gallery" href="<?=$Value["SRC"]?>">
							<img class="fadeup" src="<?=$Value["SRC"]?>">
						</a>
					</div>
				<?}?>
			</div>
		</div>
	</div>
</section>
<!-- PHOTO GALLERY END  -->