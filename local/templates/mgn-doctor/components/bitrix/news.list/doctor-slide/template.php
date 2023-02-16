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
$this->setFrameMode(true);?>
<?//prnt($arResult);?>
<?if(count($arResult["ITEMS"])){?>
	<div class="serviceit-price__item serviceit-price__item--team">
		<!-- Swiper -->
		<div class="swiper-container two our-slider__team">
			<div class="swiper-wrapper">
				<?foreach($arResult["ITEMS"] as $arItem){?>
					<div class="swiper-slide">
						<div class="item our-team__item specialists-item">
							<div class="specialists-item__top">
								<div class="specialists-item__img">
									<img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="" class="specialists-item__photo">
								</div>
								<div class="specialists-item__status">
									<span class="active-status"></span>
								</div>
								<div class="specialists-item__specialty">
									<div class="specialists-item__specialty--item specialists-item__specialty--adult">
										<img src="/local/templates/mgn-doctor/img/adult-doc.png" alt="">
										<div class="specialist-tooltip">взрослый врач</div>
									</div>
									<div class="specialists-item__specialty--item specialists-item__specialty--children">
										<img src="/local/templates/mgn-doctor/img/children-doc.png" alt="">
										<div class="specialist-tooltip">детский врач</div>
									</div>
								</div>
							</div>
							<div class="specialists-item__content">
								<a href="/page-specialist.html" class="specialists-item__link-hidden"></a>
								<h4 class="specialists-item__title"><?=$arItem["NAME"]?></h4>
								<?if(is_array($arItem['DISPLAY_PROPERTIES']['SPECIALIZATION']['DISPLAY_VALUE'])){
									foreach($arItem['DISPLAY_PROPERTIES']['SPECIALIZATION']['DISPLAY_VALUE'] as $arValue){?>
										<div class="specialists-item__position"><?=$arValue?></div>
									<?}
								}else{?>
									<div class="specialists-item__position">
										<?=$arItem['DISPLAY_PROPERTIES']['SPECIALIZATION']['DISPLAY_VALUE'];?>
									</div>
								<?}?>
								<div class="specialists-item__place">
									<svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 0.0078125C2.0142 0.0078125 0 1.95819 0 4.37406C0 8.55131 4.5 13.9991 4.5 13.9991C4.5 13.9991 9 8.55044 9 4.37406C9 1.95906 6.9858 0.0078125 4.5 0.0078125ZM4.5 6.78994C3.1572 6.78994 2.07 5.73206 2.07 4.42744C2.07 3.12281 3.1572 2.06494 4.5 2.06494C5.841 2.06494 6.9291 3.12281 6.9291 4.42744C6.9291 5.73206 5.841 6.78994 4.5 6.78994Z" fill="#75A72D"></path>
									</svg>
									Клиника <?=$arItem['DISPLAY_PROPERTIES']['CLINIC']['DISPLAY_VALUE'];?>
								</div>
								<div class="specialists-item__admission">
									<div class="specialists-item__admission--time">
										<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" clip-rule="evenodd" d="M16 2H15V4H12V2H6V4H3V2H2C0.899 2 0 2.9 0 4V16C0 17.1 0.899 18 2 18H16C17.1 18 18 17.1 18 16V4C18 2.9 17.1 2 16 2ZM16 16H2V8H16V16ZM5.5 0H3.5V3.5H5.5V0ZM14.5 0H12.5V3.5H14.5V0Z" fill="#75A72D"></path>
										</svg>
										<div class="specialists-item__admission--title">Приём</div>
										<a href="" class="specialists-item__admission--link"></a>
									</div>
								</div>
								<div class="specialists-item__btn">
									<a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="btn btn-green our-team__btn">Записаться</a>
								</div>
							</div>
						</div>
					</div>
				<?}?>
			</div>
			<?if(count($arResult["ITEMS"])>1){?>
				<!-- Add Navigation -->
				<div class="swiper-button-next swiper-button-white"></div>
				<div class="swiper-button-prev swiper-button-white"></div>
			<?}?>
			<!-- <div class="swiper-pagination"></div> -->
		</div>
	</div>
<?}?>
