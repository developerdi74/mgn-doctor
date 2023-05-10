<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
  <?
  use Bitrix\Main\Application;
  use Bitrix\Main\Page\Asset;
  use Bitrix\Main\Localization\Loc;
  Loc::loadMessages(__FILE__);
  ?>

  <title><? $APPLICATION->ShowTitle() ?></title>
  <?$APPLICATION->ShowHead();?>

  <meta charset="utf-8">
  <meta name="viewport" content='width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=1.0' />
  <meta name="apple-mobile-web-app-capable" content="yes" />
	
	<?
		$url='https://mgn-doctor.ru'.$APPLICATION->GetCurPage(false);
	?>
	<link rel=canonical href="<?=$url?>" />

  <link rel="icon" href="https://mgn-doctor.ru/favicon.svg" type="image/svg+xml">

		  <!— Yandex.Metrika counter —>
		<script type="text/javascript">
			(function(m, e, t, r, i, k, a){
				m[i]=m[i]||function(){
					(m[i].a=m[i].a||[]).push(arguments)
				};
				m[i].l=1*new Date();
				k=e.createElement(t), a=e.getElementsByTagName(t)[0], k.async=1, k.src=r, a.parentNode.insertBefore(k, a)
			})
			(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
			ym(87764265, "init", {
				clickmap:true,
				trackLinks:true,
				accurateTrackBounce:true,
				webvisor:true,
				ecommerce:"dataLayer"
			});
		</script>
		  <noscript><div><img src="https://mc.yandex.ru/watch/87764265" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
		  <!— /Yandex.Metrika counter —>
  <!-- libraries -->
  <?
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.min.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/bootstrap.bundle.min.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/bootstrap.min.js'); //сыпется в деталке переключение вкладок
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/owl.carousel.min.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.fancybox.min.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.maskedinput.min.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.formstyler.min.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/swiper.min.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/app.js');
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.lazyload.min.js');
  ?>
  <!-- CSS стили -->
  <?
  Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/bootstrap.min.css');
  Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/owl.carousel.min.css');
  Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/owl.theme.default.min.css');
  Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/jquery.formstyler.css');
   Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/jquery.formstyler.theme.css');
  Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/jquery.fancybox.min.css');
  Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/swiper.min.css');
  Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/animate.min.css');
  ?>

<!--<script data-skip-moving=true type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src='https://vk.com/js/api/openapi.js?169',t.onload=function(){VK.Retargeting.Init("VK-RTRG-1497894-3oCL8"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script>-->
<!--<noscript><img src="https://vk.com/rtrg?p=VK-RTRG-1497894-3oCL8" style="position:fixed; left:-999px;" alt=""/></noscript>-->

</head>

<body>
<?$detect=new Mobile_Detect;
$_SESSION['isMobile']=$detect->isMobile();
$APPLICATION->ShowPanel();?>

<?if($_SESSION['isMobile']===true){?>
	<!-- MOBILE HEADER BOTTOM -->
	<div class="header-bottom__mobile">
		<div class="container">
			<div class="row header-bottom__mobile-row">
				<div class="header__schedule header-bottom__mobile-col">
					<a href="/specialists/raspisanie-vrachey/">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M17.6562 1.5625H16.7188V0H15.1562V1.5625H4.84375V0H3.28125V1.5625H2.34375C1.05141 1.5625 0 2.61391 0 3.90625V17.6562C0 18.9486 1.05141 20 2.34375 20H17.6562C18.9486 20 20 18.9486 20 17.6562V3.90625C20 2.61391 18.9486 1.5625 17.6562 1.5625ZM18.4375 17.6562C18.4375 18.087 18.087 18.4375 17.6562 18.4375H2.34375C1.91297 18.4375 1.5625 18.087 1.5625 17.6562V7.34375H18.4375V17.6562ZM1.5625 5.78125H18.4375V3.90625C18.4375 3.47547 18.087 3.125 17.6562 3.125H16.7188V4.6875H15.1562V3.125H4.84375V4.6875H3.28125V3.125H2.34375C1.91297 3.125 1.5625 3.47547 1.5625 3.90625V5.78125Z" fill="#fff"/>
							<rect x="3" y="9" width="2" height="2" fill="white"/>
							<rect x="6" y="9" width="2" height="2" fill="white"/>
							<rect x="9" y="9" width="2" height="2" fill="white"/>
							<rect x="12" y="9" width="2" height="2" fill="white"/>
							<rect x="15" y="9" width="2" height="2" fill="white"/>
							<rect x="3" y="12" width="2" height="2" fill="white"/>
							<rect x="6" y="12" width="2" height="2" fill="white"/>
							<rect x="9" y="12" width="2" height="2" fill="white"/>
							<rect x="12" y="12" width="2" height="2" fill="white"/>
							<rect x="3" y="15" width="2" height="2" fill="white"/>
							<rect x="6" y="15" width="2" height="2" fill="white"/>
							<rect x="9" y="15" width="2" height="2" fill="white"/>
							<rect x="12" y="15" width="2" height="2" fill="white"/>
							<rect x="15" y="12" width="2" height="2" fill="white"/>
						</svg>
						График работы
					</a>
				</div>
<!--				<div class="header__login header-bottom__mobile-col">
					<a href="/">
						<svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M8.09449 9.81818C7.36592 9.81818 6.7183 9.57273 6.15164 9.24545C4.77545 8.34546 4.04688 6.46364 4.04688 4.09091C4.04688 1.8 5.82783 0 8.09449 0C10.3612 0 12.1421 1.8 12.1421 4.09091C12.1421 6.46364 11.4135 8.34546 10.0374 9.24545C9.47068 9.57273 8.82307 9.81818 8.09449 9.81818ZM8.09449 1.63636C6.7183 1.63636 5.66592 2.7 5.66592 4.09091C5.66592 5.89091 6.15164 7.28182 7.04211 7.85455C7.68973 8.26364 8.49926 8.26364 9.14687 7.85455C10.0374 7.28182 10.5231 5.89091 10.5231 4.09091C10.5231 2.7 9.47068 1.63636 8.09449 1.63636Z" fill="white"></path>
							<path fill-rule="evenodd" clip-rule="evenodd" d="M8.09524 18C6.23333 18 0 17.7546 0 14.7273C0 11.7 2.18571 10.6364 4.61429 9.90004C4.77619 9.81822 5.42381 9.57276 5.66667 8.34549L7.28571 8.67276C7.04286 10.1455 6.23333 11.0455 5.1 11.4546C2.67143 12.2728 1.61905 12.9273 1.61905 14.7273C1.61905 15.6273 5.01905 16.3637 8.09524 16.3637C11.1714 16.3637 14.5714 15.6273 14.5714 14.7273C14.5714 12.9273 13.519 12.2728 11.0905 11.3728C9.95714 10.9637 9.22857 10.0637 8.90476 8.59094L10.5238 8.26367C10.7667 9.49094 11.4143 9.7364 11.6571 9.81822C14.0857 10.6364 16.2714 11.6182 16.2714 14.6455C16.1905 15.4637 15.6238 18 8.09524 18Z" fill="white"></path>
						</svg>
						Личный кабинет
					</a>
				</div>
-->
			</div>
		</div>
	</div>
	<!--   MOBILE HEADER BOTTOM END   -->

	<!--  MOBILE MENU   -->
	<div class="mobile-menu menu-expanded burger-menu" id="mobile-menu">
		<div class="burger-menu__logo">
			<a class="burger-menu__logo-link" href="/"><img src="<?=SITE_TEMPLATE_PATH?>/img/main_logo.svg" height="41" width="125" alt="" class="logo"></a>
		</div>
		<div class="burger-menu__login">

<!--			<div class="burger-menu__login-item">
				<a href="/">
					<svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M9.04725 10.9091C8.23296 10.9091 7.50915 10.6364 6.87582 10.2727C5.33772 9.27273 4.52344 7.18182 4.52344 4.54545C4.52344 2 6.51391 0 9.04725 0C11.5806 0 13.5711 2 13.5711 4.54545C13.5711 7.18182 12.7568 9.27273 11.2187 10.2727C10.5853 10.6364 9.86153 10.9091 9.04725 10.9091ZM9.04725 1.81818C7.50915 1.81818 6.33296 3 6.33296 4.54545C6.33296 6.54545 6.87582 8.09091 7.87106 8.72727C8.59487 9.18182 9.49963 9.18182 10.2234 8.72727C11.2187 8.09091 11.7615 6.54545 11.7615 4.54545C11.7615 3 10.5853 1.81818 9.04725 1.81818Z" fill="#7CA82B"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M9.04762 19.9998C6.96667 19.9998 0 19.7271 0 16.3635C0 12.9998 2.44286 11.818 5.15714 10.9998C5.3381 10.9089 6.0619 10.6362 6.33333 9.27255L8.14286 9.63619C7.87143 11.2725 6.96667 12.2725 5.7 12.7271C2.98571 13.6362 1.80952 14.3635 1.80952 16.3635C1.80952 17.3635 5.60952 18.1816 9.04762 18.1816C12.4857 18.1816 16.2857 17.3635 16.2857 16.3635C16.2857 14.3635 15.1095 13.6362 12.3952 12.6362C11.1286 12.1816 10.3143 11.1816 9.95238 9.54528L11.7619 9.18164C12.0333 10.5453 12.7571 10.818 13.0286 10.9089C15.7429 11.818 18.1857 12.9089 18.1857 16.2725C18.0952 17.1816 17.4619 19.9998 9.04762 19.9998Z" fill="#7CA82B"/>
					</svg>
					Личный кабинет
				</a>
			</div>
-->
			<div class="burger-menu__login-item">
				<a href="/specialists/raspisanie-vrachey/">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M17.6562 1.5625H16.7188V0H15.1562V1.5625H4.84375V0H3.28125V1.5625H2.34375C1.05141 1.5625 0 2.61391 0 3.90625V17.6562C0 18.9486 1.05141 20 2.34375 20H17.6562C18.9486 20 20 18.9486 20 17.6562V3.90625C20 2.61391 18.9486 1.5625 17.6562 1.5625ZM18.4375 17.6562C18.4375 18.087 18.087 18.4375 17.6562 18.4375H2.34375C1.91297 18.4375 1.5625 18.087 1.5625 17.6562V7.34375H18.4375V17.6562ZM1.5625 5.78125H18.4375V3.90625C18.4375 3.47547 18.087 3.125 17.6562 3.125H16.7188V4.6875H15.1562V3.125H4.84375V4.6875H3.28125V3.125H2.34375C1.91297 3.125 1.5625 3.47547 1.5625 3.90625V5.78125Z" fill="#75A72D"/>
						<rect x="3" y="9" width="2" height="2" fill="#75A72D"/>
						<rect x="6" y="9" width="2" height="2" fill="#75A72D"/>
						<rect x="9" y="9" width="2" height="2" fill="#75A72D"/>
						<rect x="12" y="9" width="2" height="2" fill="#75A72D"/>
						<rect x="15" y="9" width="2" height="2" fill="#75A72D"/>
						<rect x="3" y="12" width="2" height="2" fill="#75A72D"/>
						<rect x="6" y="12" width="2" height="2" fill="#75A72D"/>
						<rect x="9" y="12" width="2" height="2" fill="#75A72D"/>
						<rect x="12" y="12" width="2" height="2" fill="#75A72D"/>
						<rect x="3" y="15" width="2" height="2" fill="#75A72D"/>
						<rect x="6" y="15" width="2" height="2" fill="#75A72D"/>
						<rect x="9" y="15" width="2" height="2" fill="#75A72D"/>
						<rect x="12" y="15" width="2" height="2" fill="#75A72D"/>
						<rect x="15" y="12" width="2" height="2" fill="#75A72D"/>
					</svg>
					График работы
				</a>
			</div>
		</div>
		<div class="burger-menu__nav">
			<?$APPLICATION->IncludeComponent("bitrix:menu", "mob_menu", [
					"COMPONENT_TEMPLATE"   =>"menu",
					"ROOT_MENU_TYPE"       =>"top",
					"MENU_CACHE_TYPE"      =>"N",
					"MENU_CACHE_TIME"      =>"3600",
					"MENU_CACHE_USE_GROUPS"=>"Y",
					"MENU_CACHE_GET_VARS"  =>[],
					"MAX_LEVEL"            =>"2",
					"CHILD_MENU_TYPE"      =>"left",
					"USE_EXT"              =>"Y",
					"DELAY"                =>"N",
					"ALLOW_MULTI_SELECT"   =>"N",
					"MENU_THEME"           =>"site"
				], false);?>
		</div>
	</div>
	<div class="close-menu mobile-menu__close">
		<div class="bar burger-menu__icon"></div>
	</div>
<!--  MOBILE MENU END  -->
<?}?>

<!-- HEADER END -->

<!-- HEADER -->
	<header class="header">
		<div class="header__top">
			<div class="container">
				<div class="row justify-content-between">
					<div class="header__left">

<!--						<ul class="header__menu header__menu-top menu-nodeko">
							<li class="header__menu-item"><a href="/404.html">Название проекта</a></li>
							<li class="header__menu-item"><a href="/404.html">Название проекта</a></li>
							<li class="header__menu-item"><a href="/404.html">Длинное название проекта</a></li>
						</ul>
-->
					</div>
					<div class="header__right">
						<div class="header__schedule">
							<a href="/specialists/raspisanie-vrachey/">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M17.6562 1.5625H16.7188V0H15.1562V1.5625H4.84375V0H3.28125V1.5625H2.34375C1.05141 1.5625 0 2.61391 0 3.90625V17.6562C0 18.9486 1.05141 20 2.34375 20H17.6562C18.9486 20 20 18.9486 20 17.6562V3.90625C20 2.61391 18.9486 1.5625 17.6562 1.5625ZM18.4375 17.6562C18.4375 18.087 18.087 18.4375 17.6562 18.4375H2.34375C1.91297 18.4375 1.5625 18.087 1.5625 17.6562V7.34375H18.4375V17.6562ZM1.5625 5.78125H18.4375V3.90625C18.4375 3.47547 18.087 3.125 17.6562 3.125H16.7188V4.6875H15.1562V3.125H4.84375V4.6875H3.28125V3.125H2.34375C1.91297 3.125 1.5625 3.47547 1.5625 3.90625V5.78125Z" fill="#75A72D"/>
									<rect x="3" y="9" width="2" height="2" fill="#75A72D"/>
									<rect x="6" y="9" width="2" height="2" fill="#75A72D"/>
									<rect x="9" y="9" width="2" height="2" fill="#75A72D"/>
									<rect x="12" y="9" width="2" height="2" fill="#75A72D"/>
									<rect x="15" y="9" width="2" height="2" fill="#75A72D"/>
									<rect x="3" y="12" width="2" height="2" fill="#75A72D"/>
									<rect x="6" y="12" width="2" height="2" fill="#75A72D"/>
									<rect x="9" y="12" width="2" height="2" fill="#75A72D"/>
									<rect x="12" y="12" width="2" height="2" fill="#75A72D"/>
									<rect x="3" y="15" width="2" height="2" fill="#75A72D"/>
									<rect x="6" y="15" width="2" height="2" fill="#75A72D"/>
									<rect x="9" y="15" width="2" height="2" fill="#75A72D"/>
									<rect x="12" y="15" width="2" height="2" fill="#75A72D"/>
									<rect x="15" y="12" width="2" height="2" fill="#75A72D"/>
								</svg>
								График работы
							</a>
						</div>
						<div class="header__version ver-site">
							<svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M5.92258 8.57601C7.30814 9.96041 8.9134 11.2853 9.54798 10.6509C10.4556 9.74339 11.0158 8.9523 13.0184 10.5616C15.0202 12.17 13.4823 13.2429 12.6027 14.1215C11.5874 15.1366 7.80268 14.1758 4.06174 10.4365C0.321687 6.69629 -0.636741 2.91236 0.379456 1.89724C1.25911 1.01689 2.32695 -0.519783 3.9357 1.48157C5.54534 3.48292 4.75496 4.04299 3.84555 4.95134C3.2136 5.58579 4.53789 7.19072 5.92258 8.57601Z" fill="#7CA82B"/>
							</svg>
							<a href="tel:73519581111" class=""> +7 (3519) 581-111</a>
						</div>
						<div class="header__version ver-site">
							<a href="#">
								<svg width="21" height="14" viewBox="0 0 21 14" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M0.147469 6.55213C-0.0491565 6.81632 -0.0491565 7.17714 0.147469 7.44132C2.43077 10.5116 5.90663 13.9938 10.4993 14C15.0925 13.9951 18.5694 10.5124 20.8525 7.44787C21.0492 7.18368 21.0492 6.82287 20.8525 6.55868C18.5692 3.48839 15.0934 0.0061674 10.5007 0C5.90752 0.00485916 2.43061 3.48757 0.147469 6.55213ZM19.271 7.00254C17.118 9.76673 14.1138 12.5003 10.5007 12.5049C6.8853 12.5 3.88208 9.76632 1.72903 6.99746C3.88205 4.23327 6.88619 1.49972 10.4993 1.49513C14.1155 1.50073 17.1182 4.23401 19.271 7.00254ZM10.5 3.63559C8.63944 3.63559 7.11503 5.1506 7.11503 6.99963C7.11503 8.84869 8.63944 10.3637 10.5 10.3637C12.3606 10.3637 13.885 8.84869 13.885 6.99963C13.885 5.1506 12.3606 3.63559 10.5 3.63559ZM10.5 5.13072C11.5475 5.13072 12.3805 5.95861 12.3805 6.99963C12.3805 8.04065 11.5475 8.86854 10.5 8.86854C9.4525 8.86854 8.61946 8.04065 8.61946 6.99963C8.61946 5.95861 9.4525 5.13072 10.5 5.13072Z" fill="#75A72D"/>
								</svg>
								Версия для слабовидящих
							</a>
						</div>

<!--						<div class="header__phone header__phone-top">
							<a href="tel:73519581111" class="phone phone-gtag">
								<svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M5.92258 8.57601C7.30814 9.96041 8.9134 11.2853 9.54798 10.6509C10.4556 9.74339 11.0158 8.9523 13.0184 10.5616C15.0202 12.17 13.4823 13.2429 12.6027 14.1215C11.5874 15.1366 7.80268 14.1758 4.06174 10.4365C0.321687 6.69629 -0.636741 2.91236 0.379456 1.89724C1.25911 1.01689 2.32695 -0.519783 3.9357 1.48157C5.54534 3.48292 4.75496 4.04299 3.84555 4.95134C3.2136 5.58579 4.53789 7.19072 5.92258 8.57601Z" fill="#F9304C"/>
								</svg>
								+73519581111</a>
						</div>
-->
					</div>
				</div>
			</div>
		</div>
		<div class="header__bottom" id="menu-fix">
			<div class="container">
				<div class="row justify-content-between">
					<div class="header__bottom-left">
						<a class="navbar-brand" href="/"><img src="<?=SITE_TEMPLATE_PATH?>/img/main_logo.svg" height="49" width="149" alt="" class="logo"></a>
						<?$APPLICATION->IncludeComponent("bitrix:menu", "menu", [
							"COMPONENT_TEMPLATE"   =>"menu",
							"ROOT_MENU_TYPE"       =>"top",
							"MENU_CACHE_TYPE"      =>"N",
							"MENU_CACHE_TIME"      =>"3600",
							"MENU_CACHE_USE_GROUPS"=>"Y",
							"MENU_CACHE_GET_VARS"  =>[],
							"MAX_LEVEL"            =>"2",
							"CHILD_MENU_TYPE"      =>"left",
							"USE_EXT"              =>"Y",
							"DELAY"                =>"N",
							"ALLOW_MULTI_SELECT"   =>"N",
							"MENU_THEME"           =>"site"
						], false);?>
					</div>
					<div class="header__bottom-right">
						<div class="header__call">
							<a href="#order-appointment" data-fancybox data-src="#order-appointment" class="btn btn-grey header__btn">Записаться на приём</a>
						<!--<a href="/personal/" class="btn btn-grey header__btn">Записаться на приём</a>-->
						</div>
						<div class="header__navi header__phone">
							<a href="tel:73519581111" class="phone phone-gtag">
								<svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M5.92258 8.57601C7.30814 9.96041 8.9134 11.2853 9.54798 10.6509C10.4556 9.74339 11.0158 8.9523 13.0184 10.5616C15.0202 12.17 13.4823 13.2429 12.6027 14.1215C11.5874 15.1366 7.80268 14.1758 4.06174 10.4365C0.321687 6.69629 -0.636741 2.91236 0.379456 1.89724C1.25911 1.01689 2.32695 -0.519783 3.9357 1.48157C5.54534 3.48292 4.75496 4.04299 3.84555 4.95134C3.2136 5.58579 4.53789 7.19072 5.92258 8.57601Z" fill="#fff"/>
								</svg>
							</a>
						</div>
						<div class="header__navi header__search">
							<a href="/">
								<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M11.7316 10.3187C12.5183 9.24443 12.9888 7.9249 12.9888 6.49442C12.9888 2.91352 10.0753 0 6.49439 0C2.91349 0 0 2.91352 0 6.49442C0 10.0753 2.91352 12.9888 6.49442 12.9888C7.9249 12.9888 9.24456 12.5182 10.3188 11.7316L14.5735 15.9862L15.9863 14.5734C15.9863 14.5733 11.7316 10.3187 11.7316 10.3187ZM6.49442 10.9905C4.0151 10.9905 1.99829 8.97374 1.99829 6.49442C1.99829 4.0151 4.0151 1.99829 6.49442 1.99829C8.97374 1.99829 10.9905 4.0151 10.9905 6.49442C10.9905 8.97374 8.97371 10.9905 6.49442 10.9905Z" fill="white"/>
								</svg>
							</a>
						</div>
<!--						<div class="header__navi header__login">
							<a href="/">
								<svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M8.09449 9.81818C7.36592 9.81818 6.7183 9.57273 6.15164 9.24545C4.77545 8.34546 4.04688 6.46364 4.04688 4.09091C4.04688 1.8 5.82783 0 8.09449 0C10.3612 0 12.1421 1.8 12.1421 4.09091C12.1421 6.46364 11.4135 8.34546 10.0374 9.24545C9.47068 9.57273 8.82307 9.81818 8.09449 9.81818ZM8.09449 1.63636C6.7183 1.63636 5.66592 2.7 5.66592 4.09091C5.66592 5.89091 6.15164 7.28182 7.04211 7.85455C7.68973 8.26364 8.49926 8.26364 9.14687 7.85455C10.0374 7.28182 10.5231 5.89091 10.5231 4.09091C10.5231 2.7 9.47068 1.63636 8.09449 1.63636Z" fill="white"/>
									<path fill-rule="evenodd" clip-rule="evenodd" d="M8.09524 18C6.23333 18 0 17.7546 0 14.7273C0 11.7 2.18571 10.6364 4.61429 9.90004C4.77619 9.81822 5.42381 9.57276 5.66667 8.34549L7.28571 8.67276C7.04286 10.1455 6.23333 11.0455 5.1 11.4546C2.67143 12.2728 1.61905 12.9273 1.61905 14.7273C1.61905 15.6273 5.01905 16.3637 8.09524 16.3637C11.1714 16.3637 14.5714 15.6273 14.5714 14.7273C14.5714 12.9273 13.519 12.2728 11.0905 11.3728C9.95714 10.9637 9.22857 10.0637 8.90476 8.59094L10.5238 8.26367C10.7667 9.49094 11.4143 9.7364 11.6571 9.81822C14.0857 10.6364 16.2714 11.6182 16.2714 14.6455C16.1905 15.4637 15.6238 18 8.09524 18Z" fill="white"/>
								</svg>
							</a>
						</div>
-->
					</div>
					<?if($_SESSION['isMobile']===true){?>
						<div class="header__mobile-menu burger-menu">
							<div class="menu-collapsed">
								<div class="bar burger-menu__icon"></div>
							</div>
						</div>
					<?}?>
				</div>
			</div>
		</div>

		<!--   SEARCH BLOCK   -->
		<? $APPLICATION->IncludeComponent("bitrix:search.title", "template", [
				"COMPONENT_TEMPLATE"                  =>"template",
				"NUM_CATEGORIES"                      =>"1",
				"TOP_COUNT"                           =>"5",
				"ORDER"                               =>"date",
				"USE_LANGUAGE_GUESS"                  =>"N",
				"CHECK_DATES"                         =>"N",
				"SHOW_OTHERS"                         =>"N",
				"PAGE"                                =>"#SITE_DIR#search/index.php",
				"SHOW_INPUT"                          =>"Y",
				"INPUT_ID"                            =>"title-search-input",
				"CONTAINER_ID"                        =>"title-search",
				"CATEGORY_0_TITLE"                    =>"",
				"CATEGORY_0"                          =>[
					0=>"iblock_mgn_doctor_service",
				],
				"CATEGORY_0_iblock_mgn_doctor_service"=>[
					0=>"24",
					1=>"25",
				]
			], false); ?>
		<!--   SEARCH BLOCK END   -->

	</header>

<?if($APPLICATION->GetCurPage(false)!=='/'){?>
	<div id="page" class="site page-grey">
	<div class="container">
		<div class="row">
			<!-- BREADCUMBS  -->
			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "template", [
				"PATH"      =>"/",																																// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
				"SITE_ID"   =>"s2",																																// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
				"START_FROM"=>"0",																																// Номер пункта, начиная с которого будет построена навигационная цепочка
			], false);?>
			<!-- BREADCUMBS END  -->
		</div>
	</div>
<?}?>