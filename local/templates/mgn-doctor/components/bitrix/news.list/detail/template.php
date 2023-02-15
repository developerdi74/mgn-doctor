<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
	$arFilter = Array('IBLOCK_ID'=>'24', "CODE"=> $_REQUEST["SECTION_CODE"]);
	$db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, false, $arSelect = array("UF_*"));
	$ar_result = $db_list->GetNext();
?>


  <!-- SERVICE ITEM BANNER  -->
  <section class="serviceit-banner" >
    <div class="container-full"> 
      <div class="row">
        <div class="serviceit-banner__inner" style="background-image:url('<?=CFile::GetPath($ar_result["PICTURE"]);?>');">
          <div class="container"> 
            <div class="serviceit-banner__overlay">

              <h1 class="page-title serviceit-banner__title title-slider"><?=$ar_result["NAME"]?></h1>

              <div class="serviceit-banner__text">
			  	<?=$ar_result["DESCRIPTION"]?>
              </div>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- SERVICE ITEM BANNER END -->




   <!-- SERVICE ITEM PRICE AND TEAM  -->
   <section class="serviceit-price" id="serviceit-price">
    <div class="container"> 

      <div class="row justify-content-between row-vmiddle">
        <h2 class="section-title serviceit-price__title  ">Услуги и цены</h2>
      </div>

      <div class="row serviceit-price__row">

        <div class="serviceit-price__item serviceit-price__item--left">

            <div class="serviceit-price__item--top row-center">
              <div class="line line-green serviceit-line"></div>
              <div class="services-prices__text">
                <p class="page-desc">
                  Если у Вас появились вопросы, наш специалист вам обязательно 
                  <a href="#order-call" data-fancybox="" data-src="#order-call">поможет<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.9 16.2571H16C17.7526 16.2571 18.9 14.59 18.9 12.9286V4.42857C18.9 2.76716 17.7526 1.1 16 1.1H4C2.24611 1.1 1.1 2.76747 1.1 4.42857V12.9286C1.1 14.5897 2.24611 16.2571 4 16.2571H7.65159L11.394 19.6654L12.9 21.0369V19V16.2571Z" stroke="#75A72D" stroke-width="1.8"/>
                    </svg>
                  </a> 
                </p>
              </div>
            </div>

			<?foreach($arResult["ITEMS"] as $arItem):?>
 
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>

            <div class="all-services__subitem serviceit-price__subitem">
              <h6><?=$arItem["NAME"]?></h6>
              <div>
                <span><a href="#order-call" data-fancybox="" data-src="#order-call" class="serv-subitem-btn">записаться</a></span> 
                <span class="price"></span>
              </div>
            </div>

  			<?endforeach;?>


            <div class="serviceit-price__subitem serviceit-price__subitem--tr">
              <a href="../docs/test.pdf" class="download-doc" >
                <svg width="29" height="27" viewBox="0 0 29 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M19 25.0026V23H10.0068C8.33599 23 7 21.6574 7 20.0012V12.9988C7 11.3423 8.34621 10 10.0068 10H19V8H14.0059C12.8981 8 12 7.11329 12 6.0019V0H2.00853C0.89925 0 0 0.898338 0 2.00733V24.9927C0 26.1013 0.890925 27 1.99742 27H17.0026C18.1057 27 19 26.1091 19 25.0026ZM13 5.99707V0L19 7H13.9908C13.451 7 13 6.55097 13 5.99707ZM9.99456 11C8.893 11 8 11.9002 8 12.992V20.008C8 21.1081 8.90234 22 9.99456 22H27.0054C28.107 22 29 21.0998 29 20.008V12.992C29 11.8919 28.0977 11 27.0054 11H9.99456ZM23 16H26V17H23V20H22V13H27V14H23V16ZM10 15V20H11V17H12.9951C14.1024 17 15 16.1123 15 15C15 13.8954 14.1061 13 12.9951 13H10V15ZM13.001 16H11V14H13.001C13.5573 14 14 14.4477 14 15C14 15.5561 13.5528 16 13.001 16ZM16 13V20H18.9951C20.1024 20 21 19.1134 21 17.9941V15.0059C21 13.8981 20.1061 13 18.9951 13H16ZM17 19V14H19.001C19.5573 14 20 14.4476 20 14.9998V18.0002C20 18.5563 19.5528 19 19.001 19H17Z" fill="#75A72D"/>
                </svg>
                Скачать прайс-лист
              </a>
              <a href="#" class="btn btn-grey-tr btn-serviceit-price__show">Показать ещё</a>
            </div>



        </div>

        <div class="serviceit-price__item serviceit-price__item--team">
          <!-- Swiper -->
          <div class="swiper-container two our-slider__team">

            <div class="swiper-wrapper">

                <div class="swiper-slide">
                  <div class="item our-team__item specialists-item" >
                    <div class="specialists-item__top">
                        <div class="specialists-item__img">
                          <img src="../img/specialists-item.png" alt="" class="specialists-item__photo">
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
                        <a href="/page-specialist.html" class="btn btn-green our-team__btn">Записаться</a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="item our-team__item specialists-item" >
                    <div class="specialists-item__top">
                        <div class="specialists-item__img">
                          <img src="/local/templates/mgn-doctor/img/specialists-item.png" alt="" class="specialists-item__photo">
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
                      <h4 class="specialists-item__title">Аникеев Сергей Алексеевич</h4>
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
                        <a href="/page-specialist.html" class="btn btn-green our-team__btn">Записаться</a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="item our-team__item specialists-item" >
                    <div class="specialists-item__top">
                        <div class="specialists-item__img">
                          <img src="/local/templates/mgn-doctor/img/specialists-item.png" alt="" class="specialists-item__photo">
                        </div>
                        <div class="specialists-item__status">
                          <span class="active-status"></span>
                        </div>
                        <div class="specialists-item__specialty">
                          <div class="specialists-item__specialty--item specialists-item__specialty--adult">
                            <img src="/local/templates/mgn-doctor/img/adult-doc.png" alt="">
                            <div class="specialist-tooltip">взрослый врач</div>
                          </div>
                        </div>
                    </div>
                    <div class="specialists-item__content">
                      <a href="/page-specialist.html" class="specialists-item__link-hidden"></a>
                      <h4 class="specialists-item__title">Аникеев Вадим Алексеевич</h4>
                      <div class="specialists-item__position">стоматолог</div>
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
                        <a href="/page-specialist.html" class="btn btn-green our-team__btn">Записаться</a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide swiper-slide">
                  <div class="item our-team__item specialists-item" >
                    <div class="specialists-item__top">
                        <div class="specialists-item__img">
                          <img src="/local/templates/mgn-doctor/img/specialists-item.png" alt="" class="specialists-item__photo">
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
                        <a href="/page-specialist.html" class="btn btn-green our-team__btn">Записаться</a>
                      </div>
                    </div>
                  </div>
                </div>

                    
            </div>
            <!-- Add Navigation -->
            <div class="swiper-button-next swiper-button-white"></div>
            <div class="swiper-button-prev swiper-button-white"></div>
            <!-- <div class="swiper-pagination"></div> -->

          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- SERVICE ITEM PRICE AND TEAM END -->


   <!-- SERVICE ITEM DESCRIPTION  -->
   <section class="serviceit-description mt-60" >  
    <div class="container"> 

      <div class="row">
          <h2 class="serviceit-description__title title-wborder"><?=$ar_result["NAME"]?></h2>
      </div>

      <div class="row">
        <article class="arcticle servdesc__item serviceit__arcticle serviceit-arcticle">

          <div id="accordion" class="faq-acc page-faq__acc">

		  <?foreach ($ar_result["UF_QUESTION"] as $key=>$UFItems ):?>

            <div class="card">
              <div class="card-header faq <?if($key==0) echo"card__item--active"?>" id="heading<?=$key?>">
                <h5 class="mb-0">
                  <button class="btn btn-faq  " data-toggle="collapse" data-target="#collapse<?=$key?>" aria-expanded="false" aria-controls="collapse<?=$key?>">
				  	<?=$UFItems?> 
                    <span class="faq-figure"> 
                      <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.327898 0.35799C0.778951 -0.101145 1.40691 -0.137175 1.95831 0.35799L6.00123 4.21534L10.0441 0.35799C10.5955 -0.137175 11.2245 -0.101145 11.6725 0.35799C12.1235 0.816095 12.0946 1.59024 11.6725 2.02055C11.2525 2.45086 6.8154 6.65513 6.8154 6.65513C6.5909 6.8847 6.29606 7 6.00123 7C5.70639 7 5.41155 6.8847 5.18499 6.65513C5.18499 6.65513 0.749984 2.45086 0.327898 2.02055C-0.0952218 1.59024 -0.123154 0.816095 0.327898 0.35799Z"></path></svg>
                    </span>                  
                  </button>
                </h5>
              </div>

              <div id="collapse<?=$key?>" class="collapse <?if($key==0) echo"show"?>" aria-labelledby="heading1" data-parent="#accordion" style="">
                <div class="card-body">
					<?=htmlspecialcharsBack($ar_result["UF_ANSWER"][$key])?>
                </div>
              </div>
            </div>
		<?endforeach;?> 


    

          </div>

          <div class="serviceit__form green-form contacts-form">

            <div class="green-form__item green-form__item--left">
              <h5>Позвоните сейчас</h5>
              <div class="green-form__phones">
                <a href="tel:+7 (3519) 581-111" class="phone green-form__phone">
                  <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.69858 11.0989C9.49981 12.8986 11.5866 14.621 12.4116 13.7962C13.5915 12.6165 14.3198 11.5881 16.9232 13.6802C19.5255 15.7712 17.5263 17.1659 16.3827 18.3081C15.0628 19.6277 10.1427 18.3786 5.27949 13.5175C0.417412 8.65528 -0.828545 3.73616 0.49251 2.41651C1.63606 1.27206 3.02425 -0.725621 5.11563 1.87614C7.20816 4.4779 6.18067 5.20598 4.99843 6.38684C4.1769 7.21162 5.89848 9.29804 7.69858 11.0989Z" fill="#274023"/></svg>
                  +7(3519)581-111
                </a>
                <a href="tel:+7 (3519) 581-400" class="phone green-form__phone">
                  <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.69858 11.0989C9.49981 12.8986 11.5866 14.621 12.4116 13.7962C13.5915 12.6165 14.3198 11.5881 16.9232 13.6802C19.5255 15.7712 17.5263 17.1659 16.3827 18.3081C15.0628 19.6277 10.1427 18.3786 5.27949 13.5175C0.417412 8.65528 -0.828545 3.73616 0.49251 2.41651C1.63606 1.27206 3.02425 -0.725621 5.11563 1.87614C7.20816 4.4779 6.18067 5.20598 4.99843 6.38684C4.1769 7.21162 5.89848 9.29804 7.69858 11.0989Z" fill="#274023"/></svg>
                  +7(3519)581-400
                </a>
              </div>
            </div>

            <div class="green-form__item green-form__item--right">
              <h5>Оставьте заявку</h5>
                <form action="" method="post" class="form acceptance-as-validation" novalidate="novalidate">
                  <div class="wrap">
                      <div class="contacts__form">
                          <div class="contacts__form__field field">
                              <input type="tel" name="contact-tel" value="" size="40" class="contact-tel contact-input"   placeholder="Ваш телефон" required >
                          </div>

                          <div class="contacts__form__field contacts__form__button">
                              <input type="submit" value="Заказать звонок" class="button js-form-contacts-submit">
                          </div>

                          <div class="contacts__form__field contacts__form__accept form-accept">
                              <input type="checkbox" id="licenses_popup" name="licenses_popup"  required="" value="Y" aria-required="true" required >
                              <label for="licenses_popup">
                                Согласен на обработку 
                                <noindex><a href="/privacy_policy.pdf" target="_blank">персональных данных</a>.</noindex></a>     
                              </label>
                          </div>

                      </div>
                  </div>
              </form>
            </div>
          </div>

        </article>

        <aside class="aside servdesc__item serviceit__aside">

         
        <?$APPLICATION->IncludeComponent(
          "bitrix:news.list",
          "top-news",
          Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array("", ""),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "27",
            "IBLOCK_TYPE" => "mgn_doctor_content",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "10",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array("", ""),
            "SET_BROWSER_TITLE" => "Y",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "Y",
            "SHOW_404" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N"
          )
        );?>

 

          </div>

        </aside>
      </div>
    </div>
  </section>
  <!-- SERVICE ITEM DESCRIPTION END -->