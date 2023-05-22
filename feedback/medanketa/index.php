<?//require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Анкета клиента</title>
	<link rel="stylesheet" type="text/css" href="/local/templates/mgn-doctor/css/bootstrap.min.css">
	<script type="text/javascript" src='/local/templates/mgn-doctor/js/jquery.min.js'></script>
	<script type="text/javascript" src='/local/templates/mgn-doctor/js/jquery.maskedinput.min.js'></script>
	<link rel="icon" href="https://mgn-doctor.ru/favicon.svg" type="image/svg+xml">
</head>
<body>
	<div class="container">
		<div class="header mt-4 mb-4">
			<div class="row">
				<div class="col-lg-3"><img src="/local/templates/mgn-doctor/img/main_logo.svg"></div>
				<div class="col-lg-9"><h1 class='text-center d-inline-block'>Анкeта клиента</h1></div>
			</div>			
		</div>
		<form method="POST" class='form-anketa' action="anket-post.php">
			<div class="row">
				<div class="col-lg-4 text-lg-right">
					<label>Ваше ФИО*:</label>
				</div>
				<div class="col-lg-8">
					<input type="text" name="fio" placeholder="Фамилия Имя Отчество" required="">
				</div>
			</div>

			<div class="row">
				<div class="col-lg-4 text-lg-right">
				<label>Ваша дата рождения*:</label>
				</div>
				<div class="col-lg-8">
				<input type="date" name="dateAdult" placeholder="Год рождения" value="1990-01-01" required="">
				</div>
			</div>	

			<div class="row">
				<div class="col-lg-4 text-lg-right">
				<label>Ваш e-mail:</label>
				</div>
				<div class="col-lg-8">
				<input type="email" name="email" placeholder="E-Mail">
				</div>
			</div>	

			<div class="row">
				<div class="col-lg-4 text-lg-right">
				<label>Ваш телефон*:</label>
				</div>
				<div class="col-lg-8">
				<input type="text" name="phone" id='phone' placeholder="Телефон" value="" required="">
				</div>
			</div>				

			<div class="row">
				<div class="col-lg-4 text-lg-right">
					<label>Я записываю своего ребенка:</label>
				</div>
				<div class="col-lg-8 text-left">
					<input type="radio" name="child" value='no' checked  value="">Нет<span class='mr-3'></span>
					<input type="radio" name="child" value='yes'>Да
				</div>
			</div>	
			
			<div class="row child d-none">
				<div class="col-lg-4 text-lg-right">
					<label>ФИО ребенка*:</label>
				</div>
				<div class="col-lg-8">
					<input type="text" name="fioChild" placeholder="Фамилия Имя Отчество" required="" disabled="">
				</div>
			</div>

			<div class="row child d-none">
				<div class="col-lg-4 text-lg-right">
				<label>Дата рождения ребенка*:</label>
				</div>
				<div class="col-lg-8">
				<input type="date" name="dateChild" placeholder="Год рождения" value="1990-01-01" required="" disabled="">
				</div>
			</div>	

			<div class="row">
				<div class="col-lg-4 text-lg-right">
				<label>У <span class='adult'>Ваc</span><span class='d-none child'>ребенка</span> есть аллергия?(укажите какая и на что именно, если есть и укажите какие лекарства принимаете для лечения) </label>
				</div>
				<div class="col-lg-8">
				<input type="text" name="allergi" placeholder="Укажите если имеются" value="">
				</div>
			</div>	
			
			<div class="row">
				<div class="col-lg-4 text-lg-right">
				<label>Группа крови:</label>
				</div>
				<div class="col-lg-8">
					<input type="radio" name="blood-group" value='1 группа' checked>I<span class='mr-3'></span>
					<input type="radio" name="blood-group" value='2 группа'>II<span class='mr-3'></span>
					<input type="radio" name="blood-group" value='3 группа'>III<span class='mr-3'></span>
					<input type="radio" name="blood-group" value='4 группа'>IV<span class='mr-3'></span>
					<input type="radio" name="blood-group" value='0' checked>Не знаю
				</div>
			</div>	
			
			<div class="row">
				<div class="col-lg-4 text-lg-right">
				<label>Резус фактор:</label>
				</div>
				<div class="col-lg-8">
					<input type="radio" name="rezus-factor" id='rez1' value='Положительная' checked><label for='rez1'>Положительный</label><span class='mr-3'></span>
					<input type="radio" name="rezus-factor" id='rez2' value='Отрицательная'><label for='rez2'>Отрицательный</label><span class='mr-3'></span>
					<input type="radio" name="rezus-factor" id='rez3' value='0' checked><label for='rez3'>Не знаю</label>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-4 text-lg-right">
				<label>Если <span class='adult'>страдаете</span><span class='d-none child'>ребенок страдает</span> одним из ниже перечисленных заболеваний, отметье их (выберите одно или несколько, если это необходимо):</label>
				</div>
				<div class="col-lg-8 d-flex disease">					
					<div class="col-lg-6 p-0">
						<input type="checkbox" name="disease[]" id='disis1' value = "Эпилепсия"><label for='disis1'>Эпилепсия</label><br><br>
						<input type="checkbox" name="disease[]" id='disis2' value = "Сахарный диабет"><label for='disis2'>Сахарный диабет</label><br><br>
						<input type="checkbox" name="disease[]" id='disis3' value = "Кожно-венерологическое заболевание<"><label for='disis3'>Кожно-венерологическое заболевание</label><br><br>
						<input type="checkbox" name="disease[]" id='disis4' value = "Туберкулез"><label for='disis4'>Туберкулез</label><br><br>
						<input type="checkbox" name="disease[]" id='disis5' value = "Вирусный гепатит<"><label for='disis5'>Вирусный гепатит</label><br><br>
						<input type="checkbox" name="disease[]" id='disis6' value = "СПИД, ВИЧ"><label for='disis6'>СПИД, ВИЧ</label><br><br>
						<input type="checkbox" name="disease[]" id='disis7' value = "Психические заболевания"><label for='disis7'>Психические заболевания</label><br><br>
						<input type="checkbox" name="disease[]" id='disis8' value = "Онкология (злокачественные новообразования)"><label for='disis8'>Онкология (злокачественные новообразования)</label><br><br>
						<input type="checkbox" name="disease[]" id='disis9' value = "Лучевая болезнь</label>"><label for='disis9'>Лучевая болезнь</label>
					</div>
					<div class="col-lg-6 p-0">
						<input type="checkbox" name="disease[]" id='disis10' value = "Натуральная оспа/полиомиелит/тяжелый острый респираторный синдром"><label for='disis10'>Натуральная оспа/полиомиелит/тяжелый острый респираторный синдром</label><br><br>
						<input type="checkbox" name="disease[]" id='disis11' value = "Новообразование головного мозга, мозговых оболочек и ганглиев"><label for='disis11'>Новообразование головного мозга, мозговых оболочек и ганглиев</label><br><br>
						<input type="checkbox" name="disease[]" id='disis12' value = "Дегенеративные и демиелинизирующие заболевания нервной системы<"><label for='disis12'>Дегенеративные и демиелинизирующие заболевания нервной системы</label><br><br>
						<input type="checkbox" name="disease[]" id='disis13' value = "Системные заболевания соединительной ткани"><label for='disis13'>Системные заболевания соединительной ткани</label><br><br>
						<input type="checkbox" name="disease[]" id='disis14' value = "Нарушение сна, апноэ во сне"><label for='disis14'>Нарушение сна, апноэ во сне</label><br><br>
						<input type="checkbox" name="disease[]" id='disis15' value = "Ожирение"><label for='disis15'>Ожирение</label> <br><br>
						<input type="checkbox" name="disease[]" id='disis16' value = "Никаким"><label for='disis16'>Никаким</label>
					</div>
				</div>
			</div>		
					
			<div class="row">
				<div class="col-lg-4 text-lg-right">
				<label>Есть ли у <span class='adult'>Ваc</span><span class='d-none child'>ребенка</span> наследственные заболевания (если есть, то укажите какие):</label>
				</div>
				<div class="col-lg-8">					
					<input type="radio" name="disease_extend" value='Нет' checked>Нет<span class='mr-3'></span>
					<input type="radio" name="disease_extend" value='1'>Да<span class='mr-3'></span>
					<input type="text" name="disease_extend_input" class='w-50 d-none disease_extend_input' placeholder="если есть, то укажите какие">
				</div>
			</div>	
					
			<div class="row">
				<div class="col-lg-4 text-lg-right">
				<label>Есть ли у <span class='adult'>Ваc</span><span class='d-none child'>ребенка</span> врожденные заболевания (если есть, то укажите какие):</label>
				</div>
				<div class="col-lg-8">					
					<input type="radio" name="disease_born" value='Нет' checked>Нет<span class='mr-3'></span>
					<input type="radio" name="disease_born" value='1'>Да<span class='mr-3'></span>
					<input type="text" name="disease_born_input" class='w-50 disease_born_input d-none' placeholder="если есть, то укажите какие">
				</div>
			</div>	

			<div class="row">
				<div class="col-lg-4 text-lg-right">
				<label>Есть ли у <span class='adult'>Ваc</span><span class='d-none child'>ребенка</span> хронические заболевания?</label>
				</div>
				<div class="col-lg-8">					
					<input type="radio" name="disease_chron" value='Нет' checked>Нет<span class='mr-3'></span>
					<input type="radio" name="disease_chron" value='1'>Да<span class='mr-3'></span>
					<input type="text" name="disease_chron_input" class='w-50 disease_chron_input  d-none' placeholder="если есть, то укажите какие">
				</div>
			</div>				

			<div class="row hidden_uchet d-none">
				<div class="col-lg-4 text-lg-right">
				<label><span class='adult'>Состоите ли Вы</span><span class='d-none child'>Состоит ли ребенок</span> на диспансерном учете?</label>
				</div>
				<div class="col-lg-8">					
					<input type="radio" name="uchet" value='Нет' checked>Нет<span class='mr-3'></span>
					<input type="radio" name="uchet" value='1'>Да<span class='mr-3'></span>
					<input type="text" name="uchet_input" class='w-50 uchet_input d-none' placeholder="ФИО специалиста">
				</div>
			</div>	

			<div class="row">
				<div class="col-lg-4 text-lg-right">
				<label>Имеется ли у <span class='adult'>Ваc</span><span class='d-none child'>ребенка</span> инвалидность, или заболевания, служащие основанием установления инвалидности 1,2 группы:</label>
				</div>
				<div class="col-lg-8">					
					<input type="radio" name="invalid" id='i1' value='1 группа инвалидности'><label for='i1'>есть 1 группа инвалидности</label><span class='mr-3'></span><br>
					<input type="radio" name="invalid" id='i2' value='2 группа инвалидности'><label for='i2'>есть 2 группа инвалидности</label><span class='mr-3'></span><br>
					<input type="radio" name="invalid" id='i3' value='3 группа инвалидности'><label for='i3'>есть 3 группа инвалидности</label><span class='mr-3'></span><br>
					<input type="radio" name="invalid" id='i4' value='есть заболевания, служащие основанием установления инвалидности 1,2 гр.'><label for='i4'>есть заболевания, служащие основанием установления инвалидности 1,2 гр.</label><span class='mr-3'></span><br>
					<input type="radio" name="invalid" id='i5' value='0' checked ><label for='i5'>Нет</label>
				</div>
			</div>	

			<div class="row">
				<div class="col-12">
				<p><br><br><br>
					Напоминаем, что при первичном обращении в клинику Семейный доктор с ребенком необходимо  иметь свидетельство о рождении ребенка (или паспорт с 14 лет), Ваш паспорт.<br> 
					Если Вы на прием отправляете ребенка с бабушкой или дедушкой, то необходимо предоставить доверенность на представление интересов ребенка при обращении за медицинской помощью.<br>
					Образец доверенности : <a href="https://mgn-doctor.ru/upload/iblock/e91/9ip04z9vfrf1hlf520ji2rbl279oimhx.pdf">ООО МЦ Семейный доктор (ул. Доменщиков, 8 а)</a><br>
					Образец доверенности : <a href="https://mgn-doctor.ru/upload/iblock/497/cws65tmnues731twq2bzl9oleg1p9yjo.pdf">ООО Семейный доктор (ул. Жукова, 11 и ул. 50 лет Магнитки, 35.1)</a>
				</p>
				</div>
			</div>	

			<div class="row">
				<div class="col-12">
				<p>
					<a href="https://mgn-doctor.ru/documents/#documents-2">Доверенность</a> и <a href="https://mgn-doctor.ru/documents/#documents-4">cогласие</a> необходимо самостоятельно распечатать и заполнить в случае, если Вы не планируете приходить вместе с ребёнком.<br>
					Ссылки для ознакомления: <a href="https://mgn-doctor.ru/documents/">Договор</a>,
					<a href="https://mgn-doctor.ru/documents/#documents-2">Доверенность</a>,
					<a href="https://mgn-doctor.ru/documents/#documents-4">Согласие родителей</a>.
				</p>

					<br>С заботой, Семейный доктор!
				</div>
			</div>	

			<div class="row">
				<input type="submit" name="send" class='send' value = "Отправить">
			</div>	

		</form>
	</div>
</body>
</html>

<style type="text/css">
	:active, :hover, :focus {
	    outline: 0; 
	    outline-offset: 0;
	}
	input{
   	width: 100%;
    background: white;
    border: 1px solid rgba(44, 62, 80, 0.3);
    box-sizing: border-box;
    height: 40px;
    padding: 10px 14px;
    font-size: 14px;
    line-height: 16px;
    letter-spacing: 0.056px;
    cursor: pointer;
	}
	input[type='radio'],input[type='checkbox']{
		height: 20px;
   		width: 20px;
    	vertical-align: middle;
    	margin-right: 5px;
	}
	input:focus,input:active,input:focus-visible{
		border: 1px solid #7ca82b;
	}
	.form-anketa>.row{
		margin-bottom: 20px;
	}
	.disease label{
		cursor: pointer;
		display: inline;
	}

	.send{
	    height: 40px;
	    line-height: 40px;
	    padding: 0 10px;
	    font-weight: 500;
	    font-size: 15px;
	    text-align: center;
	    letter-spacing: 0.06px;
	    color: white;
	    background-color: #7ca82b;
	    box-shadow: none;
	    outline: none;
	    border: none;
    }
</style>

<script type="text/javascript">

	$("#phone").mask("+7 (999) 999-9999");

	$('input[type="radio"]').on('click', function(){
		$(this).siblings('input[type="text"]').removeClass('d-none');
	});

	$('input[name="disease_chron"]').on('click', function(){
		if($(this).val() == 1){ 
			$('.hidden_uchet').removeClass('d-none');
		}
	});

	$('input[name="child"]').on('click', function(){
		if($(this).val() == 'yes'){ 
			$('.child').removeClass('d-none');
			$('.adult').addClass('d-none');
  			$('input[name="fioChild"]').removeAttr('disabled');
  			$('input[name="dateChild"]').removeAttr('disabled');
		}		
		if($(this).val() == 'no'){ 
			$('.child').addClass('d-none');
			$('.adult').removeClass('d-none');
  			$('input[name="fioChild"]').prop("disabled",true);
  			$('input[name="dateChild"]').prop("disabled",true);
		}
	});

	var check = [];


	$('.send').on('click', function(){
		$('input').each(function(key,value){

			//console.log($(value).is("input[type='radio']"));
			//if( $(value).val() != 0 ){ 

				if($(value).is("input[type='radio']")){
					if($(value).is(':checked')){

						//console.log($(value).attr('name')+' - '+$(value).val());
					}
				}
				if($(value).is("input[type='checkbox']")){
					if($(value).is(':checked')){
						check.push($(value).attr('name')+' - '+$(value).val());
						//console.log($(value).attr('name')+' - '+$(value).val());
					}
				}
			//console.log($(value).attr('name')+' ---- '+$(value).val()); 

			//}

		})
				console.log(check);
		console.log(22);
		//return false;
	});
</script>