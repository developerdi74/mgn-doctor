<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(true);?>

<section class="contacts">
	<div class="container">
		<div class="row row-contacts-title ">
			<h1 class="page-title contacts__title">Адреса и телефоны медицинских центров Семейный доктор в Магнитогорске</h1>
		</div>
		<?foreach($arResult["ITEMS"] as $arItem){
			if(empty($arItem['PREVIEW_TEXT'])) continue;
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), ["CONFIRM"=>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);?>
			<div class="row row-contacts-details">
				<div class="tab-content contacts-tab-content">
					<div class="tab-pane fade show active  " id="spec_education">
						<div class="tab-contacts-wrapper">
							<div class="contacts__img">
								<img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" height = "<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" width = "<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" alt="">
							</div>
							<div class="contacts__details contacts-details">
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="contacts-details__place"><?=$arItem["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"];?></a>
								<p class="contacts-details__desc">Многопрофильный медицинский центр «Семейный доктор»</p>
								<div class="contacts-info contacts-details__info">
									<div class="contacts-info__item">
										<h6 class="contacts-info__title">Часы работы</h6>
										<? foreach($arItem["DISPLAY_PROPERTIES"]["OPENING_HOURS"]["VALUE"] as $Value) echo "<time>".$Value."</time>"; ?>
									</div>
									<div class="contacts-info__item">
										<h6 class="contacts-info__title">Контакты</h6>
										<? foreach($arItem["DISPLAY_PROPERTIES"]["PHONE"]["VALUE"] as $Value) echo '<a href="tel:'.$Value.'" class="phone contacts-info__phone">'.$Value.'</a>'; ?>
										<? echo '<a href="mailto:'.$arItem["DISPLAY_PROPERTIES"]["E_MAIL"]["VALUE"].'" class="mail email-gtag contacts-info__email">'.$arItem["DISPLAY_PROPERTIES"]["E_MAIL"]["VALUE"].'</a>'; ?>
									</div>
									<div class="contacts-info__item">
										<a href="#order-appointment" data-fancybox="" data-src="#order-appointment" class="btn btn-lred contacts-info__btn">Записаться на приём</a>
										<?if($arItem["ID"]=='727'){?>
											<a href="/specialists/raspisanie-vrachey/?CLINIC=1" class="btn btn-grey contacts-info__btn">Расписание</a>
										<?}?>
										<?if($arItem["ID"]=='728'){?>
											<a href="/specialists/raspisanie-vrachey/?CLINIC=2" class="btn btn-grey contacts-info__btn">Расписание</a>
										<?}?>
										<?if($arItem["ID"]=='1240'){?>
											<a href="/specialists/raspisanie-vrachey/?CLINIC=3" class="btn btn-grey contacts-info__btn">Расписание</a>
										<?}?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?}?>
	</div>
</section>


