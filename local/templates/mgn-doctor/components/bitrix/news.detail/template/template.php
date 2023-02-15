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
<article class="arcticle single-content__arcticle single-arcticle">
	<h1 class="page-title single-post__title single-content__title"><?=$arResult["NAME"]?></h1>
	<div class="single-arcticle__info">
		<div class="date">
			<?=$arResult["DISPLAY_ACTIVE_FROM"]?>
		</div>
		<div class="share">
			<h6 class="share__title">поделиться:</h6>
			<ul class="share__list"><? /*
                      <li class="share__list-item share__list-item--insta">
                        <a href="https://www.instagram.com/?hl=ru">
                          <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 13C0 5.8203 5.8203 0 13 0C20.1797 0 26 5.8203 26 13C26 20.1797 20.1797 26 13 26C5.8203 26 0 20.1797 0 13Z" fill="#333333"/><path fill-rule="evenodd" clip-rule="evenodd" d="M0 13C0 5.8203 5.8203 0 13 0C20.1797 0 26 5.8203 26 13C26 20.1797 20.1797 26 13 26C5.8203 26 0 20.1797 0 13Z" fill="#2C3E50"/><mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="26" height="26">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M0 13C0 5.8203 5.8203 0 13 0C20.1797 0 26 5.8203 26 13C26 20.1797 20.1797 26 13 26C5.8203 26 0 20.1797 0 13Z" fill="white"/>
                          </mask><g mask="url(#mask0)"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.0004 6.06689C11.1174 6.06689 10.8811 6.07513 10.1415 6.10878C9.4034 6.14258 8.89957 6.25944 8.45872 6.4309C8.0027 6.60799 7.61588 6.84488 7.2305 7.23041C6.84483 7.61579 6.60793 8.00261 6.43027 8.45849C6.25837 8.89948 6.14137 9.40345 6.10815 10.1413C6.07507 10.8808 6.06641 11.1173 6.06641 13.0003C6.06641 14.8833 6.07478 15.1189 6.1083 15.8585C6.14224 16.5966 6.2591 17.1004 6.43041 17.5412C6.60765 17.9973 6.84454 18.3841 7.23006 18.7695C7.6153 19.1551 8.00213 19.3926 8.45785 19.5697C8.89899 19.7412 9.40296 19.858 10.1409 19.8918C10.8805 19.9255 11.1167 19.9337 12.9995 19.9337C14.8827 19.9337 15.1183 19.9255 15.8578 19.8918C16.5959 19.858 17.1003 19.7412 17.5415 19.5697C17.9974 19.3926 18.3836 19.1551 18.7688 18.7695C19.1545 18.3841 19.3914 17.9973 19.5691 17.5414C19.7395 17.1004 19.8565 16.5964 19.8912 15.8586C19.9244 15.119 19.9331 14.8833 19.9331 13.0003C19.9331 11.1173 19.9244 10.881 19.8912 10.1414C19.8565 9.40331 19.7395 8.89948 19.5691 8.45863C19.3914 8.00261 19.1545 7.61579 18.7688 7.23041C18.3832 6.84474 17.9975 6.60784 17.541 6.4309C17.099 6.25944 16.5949 6.14258 15.8568 6.10878C15.1172 6.07513 14.8818 6.06689 12.9982 6.06689H13.0004ZM12.3784 7.31635C12.563 7.31606 12.769 7.31635 13.0004 7.31635C14.8516 7.31635 15.071 7.323 15.8021 7.35622C16.4781 7.38713 16.845 7.50009 17.0894 7.59499C17.4129 7.72066 17.6436 7.87088 17.8861 8.11355C18.1288 8.35622 18.279 8.58733 18.405 8.91089C18.4999 9.155 18.613 9.5219 18.6437 10.1979C18.677 10.9288 18.6842 11.1484 18.6842 12.9987C18.6842 14.8491 18.677 15.0686 18.6437 15.7995C18.6128 16.4755 18.4999 16.8424 18.405 17.0865C18.2793 17.4101 18.1288 17.6405 17.8861 17.883C17.6435 18.1257 17.4131 18.2759 17.0894 18.4016C16.8453 18.4969 16.4781 18.6096 15.8021 18.6405C15.0712 18.6737 14.8516 18.6809 13.0004 18.6809C11.149 18.6809 10.9296 18.6737 10.1987 18.6405C9.52271 18.6093 9.15582 18.4963 8.91127 18.4014C8.58771 18.2758 8.3566 18.1255 8.11393 17.8829C7.87126 17.6402 7.72103 17.4097 7.59508 17.086C7.50018 16.8418 7.38708 16.4749 7.35631 15.7989C7.32309 15.068 7.31644 14.8485 7.31644 12.997C7.31644 11.1455 7.32309 10.9271 7.35631 10.1962C7.38722 9.52016 7.50018 9.15327 7.59508 8.90887C7.72075 8.58531 7.87126 8.3542 8.11393 8.11153C8.3566 7.86886 8.58771 7.71863 8.91127 7.59268C9.15567 7.49734 9.52271 7.38467 10.1987 7.35362C10.8383 7.32473 11.0862 7.31606 12.3784 7.31462V7.31635ZM16.7014 8.46759C16.242 8.46759 15.8694 8.83982 15.8694 9.29931C15.8694 9.75864 16.242 10.1313 16.7014 10.1313C17.1607 10.1313 17.5334 9.75864 17.5334 9.29931C17.5334 8.83997 17.1607 8.4673 16.7014 8.4673V8.46759ZM13.0004 9.43971C11.034 9.43971 9.4398 11.034 9.4398 13.0003C9.4398 14.9666 11.034 16.5602 13.0004 16.5602C14.9667 16.5602 16.5604 14.9666 16.5604 13.0003C16.5604 11.034 14.9666 9.43971 13.0002 9.43971H13.0004ZM13.0004 10.6892C14.2767 10.6892 15.3115 11.7238 15.3115 13.0003C15.3115 14.2766 14.2767 15.3114 13.0004 15.3114C11.7239 15.3114 10.6893 14.2766 10.6893 13.0003C10.6893 11.7238 11.7239 10.6892 13.0004 10.6892Z" fill="white"/>
                          </g>
                          </svg>
                        </a>
                      </li>*/ ?>
				<li class="share__list-item share__list-item--vk">
					<a href="https://vk.com/share.php?url=https://mgn-doctor.ru<?=$APPLICATION->GetCurPage()?>">
						<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M0 13C0 5.8203 5.8203 0 13 0C20.1797 0 26 5.8203 26 13C26 20.1797 20.1797 26 13 26C5.8203 26 0 20.1797 0 13Z" fill="#2C3E50"/>
							<path fill-rule="evenodd" clip-rule="evenodd" d="M13.6798 16.833C13.6798 16.833 13.93 16.8057 14.0582 16.6705C14.1756 16.5467 14.1715 16.313 14.1715 16.313C14.1715 16.313 14.1559 15.2219 14.672 15.0608C15.1807 14.9023 15.8338 16.116 16.5269 16.5827C17.0505 16.9355 17.448 16.8583 17.448 16.8583L19.3002 16.833C19.3002 16.833 20.2687 16.7744 19.8095 16.0268C19.7715 15.9655 19.5416 15.4735 18.4327 14.4629C17.271 13.4051 17.4269 13.5762 18.8254 11.7461C19.6773 10.6316 20.0177 9.95124 19.9113 9.66032C19.8102 9.38204 19.1835 9.45594 19.1835 9.45594L17.0987 9.46858C17.0987 9.46858 16.9441 9.44795 16.8294 9.51519C16.7175 9.58109 16.645 9.73488 16.645 9.73488C16.645 9.73488 16.3153 10.597 15.8752 11.3307C14.9467 12.8778 14.5757 12.9597 14.4238 12.8638C14.0704 12.6395 14.1586 11.9638 14.1586 11.4838C14.1586 9.98387 14.3906 9.35874 13.7076 9.19696C13.4811 9.14304 13.3142 9.10776 12.7343 9.10176C11.9903 9.09444 11.361 9.10443 11.0042 9.27552C10.7668 9.38936 10.5837 9.64367 10.6956 9.65832C10.8333 9.67629 11.1453 9.74087 11.3108 9.9619C11.5244 10.2475 11.5169 10.8879 11.5169 10.8879C11.5169 10.8879 11.6397 12.6535 11.2301 12.8725C10.9493 13.023 10.564 12.7161 9.73594 11.312C9.31205 10.593 8.99193 9.79812 8.99193 9.79812C8.99193 9.79812 8.93021 9.64967 8.81966 9.56978C8.68605 9.47324 8.49954 9.44329 8.49954 9.44329L6.51847 9.45594C6.51847 9.45594 6.22073 9.46392 6.11153 9.59108C6.01455 9.70359 6.10407 9.93726 6.10407 9.93726C6.10407 9.93726 7.65516 13.4996 9.41175 15.2951C11.0225 16.9408 12.851 16.833 12.851 16.833H13.6798Z" fill="white"/>
						</svg>
					</a>
				</li><? /*
                      <li class="share__list-item share__list-item--fb">
                        <a href="https://www.facebook.com/sharer.php">
                          <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0 13C0 5.8203 5.8203 0 13 0C20.1797 0 26 5.8203 26 13C26 20.1797 20.1797 26 13 26C5.8203 26 0 20.1797 0 13Z" fill="#2C3E50"/><path fill-rule="evenodd" clip-rule="evenodd" d="M13.9235 20.2106V13.1379H15.8759L16.1346 10.7006H13.9235L13.9268 9.48075C13.9268 8.84507 13.9872 8.50446 14.9002 8.50446H16.1208V6.06689H14.1681C11.8227 6.06689 10.9972 7.24924 10.9972 9.23758V10.7009H9.53516V13.1382H10.9972V20.2106H13.9235Z" fill="white"/>
                          </svg>
                        </a>
                      </li>*/ ?>
			</ul>
		</div>
	</div>
	<div class="single-arcticle__img">
		<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="">
	</div>
	<div class="single-arcticle__content">
		<? echo $arResult["DETAIL_TEXT"]; ?>
	</div>
</article>
<!-- SINGLE POST END -->

 







