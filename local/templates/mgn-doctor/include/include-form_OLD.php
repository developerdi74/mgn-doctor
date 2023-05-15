<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
	$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
	$arFilter = Array("IBLOCK_ID"=>25, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>150), $arSelect);
	while($ob = $res->GetNextElement())
	{
	 $arDoctors[] = $ob->GetFields();
	}
?>
<!-- POPUP APPOINMENT END -->

  <!-- POPUP REVIEWS -->
<div style="display: none;" id="reviews-modal" class="popup popup-small ask-question-modal">
	<div class="popup__content popup-content">
		<h4 class="popup__title">Оставить отзыв</h4>
		<div class="popup__form">
			<form name="form-reviews" method="post" class="form init">
				<div class="popup-item">
					<label> Ваши имя, фамилия и отчество *<br>
						<span class="form-control-wrap your-name">
							<input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required contact-input" aria-required="true" aria-invalid="false" placeholder="Имя Фамилия" required="">
						</span>
					</label>
				</div>
<!-- 				<div class="popup-item">
					<label> Ваш e-mail*
						<span class="form-control-wrap contact-tel">
							<input type="email" placeholder="name@example.ru" class="form-email" name="form_email" value="" required="">
						</span>
					</label>
				</div> -->
				<div class="popup-item">
					<label> Контактный телефон *
						<span class="form-control-wrap contact-tel">
							<input type="tel" name="contact-tel" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel contact-input" aria-required="true" aria-invalid="false" placeholder='+7 (___) ___-__-__' required="">
						</span>
					</label>
				</div>
				<div class="popup-item scoreClinic">
					<label> Выберите клинику
						<select name="clinic">
							<option value="Доменщиков, 8 а">Доменщиков, 8 а</option>
							<option value="Жукова, 11">Жукова, 11</option>
							<option value="50 лет Магнитки, 35/1">50 лет Магнитки, 35/1</option>
							<option value="Еще не был в клинике" selected>Не выбрано</option>
						</select>
					</label>
				</div>
				<div class="popup-item scoreSpecialist">
					<label> Выберите специалиста, если хотите его оценить
						<select name="specialists" id='docSelect'>
								<option value="0" selected>Не выбрано</option>
							<?foreach($arDoctors as $doc):?>
								<option value="<?=$doc['ID']?>"><?=$doc['NAME']?></option>
							<? endforeach; ?>
						</select>
					</label>
				</div>
				<div class="popup-item star_rew d-none">
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
				<div class="popup-item scoreClinic scoreSpecialist">
					<label> Напишите свои впечатления после посещения клиники, специалиста или обращения в контакт-центр*
						<span class="form-control-wrap contact-tel">
							<textarea name="contact-textarea" class="contact-input contact-textarea" cols="30" rows="10" placeholder="Отзыв"></textarea>
						</span>
					</label>
				</div>
				<div class="popup-item">
					<div class="form-accept">
						<span class="form-control-wrap acceptance-351">
							<input type="checkbox" name="acceptance-351" value="1" aria-invalid="false" id="formCheckbox3" required="">
						</span>
						<span class="checkbox-text">
							Согласен на обработку персональных данных.
							<noindex><a href="/personal/privaci.php" target="_blank">Политика конфиденциальности</a></noindex>
						</span>
					</div>
				</div>
				<div class="popup-item">
					<input type="submit" value="Отправить" class="btn-submit btn btn-green popup-btn">
				</div>
			</form>
		</div>
	</div>
</div>
  <!-- POPUP APPOINMENT END -->

  <!-- POPUP SUCCESS -->
<div style="display: none;" id="popoup-success" class="popoup-success">
	<div class="popup__content popup-content">
		<h4 class="popup__title">Благодарим Вас за обратную связь!</h4>
		<div id="popup-success-text" class="popup__text popoup-success__text">
			<p>Мы внимательно относимся к мнению каждого нашего пациента. Ваши добрые слова вдохновляют нас, а критические отзывы – помогают становиться лучше.</p>
		</div>
	</div>
</div>
  <!-- POPUP SUCCESS END -->

  <!-- POPUPS END -->
  <script type="text/javascript">
  $('#docSelect').on("click",function(){
  		if($(this).val()!=0){
  				$(".star_rew").removeClass("d-none");
  		}else{
  			if(!$(".star_rew").hasClass('d-none'))
  				$(".star_rew").addClass("d-none");  			
  		}
	});

  $('#scoreClinic').on("click",function(){

  		$('.box_btn_select').addClass('d-none');
  		$(".scoreClinic").removeClass("d-none");

  		return false;
	});

  $('#scoreSpecialist').on("click",function(){
  		$('.box_btn_select').addClass('d-none');
  		$(".scoreSpecialist").removeClass("d-none");
  		return false;
	});
  </script>
  
