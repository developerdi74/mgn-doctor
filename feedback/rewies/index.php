<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
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
		<div class="card row p-lg-4 p-xs-1">
			<div class="header">
				<div class="row">
					<div class="col-lg-3 text-center"><img src="/local/templates/mgn-doctor/img/main_logo.svg"></div>
					<div class="col-lg-9"><h1 class='text-center d-inline-block'>Ваша оценка работы Семейный доктор</h1></div>
				</div>
			</div>
			<form method="POST" class='form-anketa' action="add-rewies.php">

				<div class="row">
					<div class="col-lg-6 text-lg-right">
						<label>Укажите Ваш номер телефона:</label>
					</div>
					<div class="col-lg-4">
						<input type="text"  name="phone" id='phone' placeholder="Телефон" value="<?=$_GET['phone']?>">
					</div>
					<div class="col-12 mt-4 text-center	">
						<b>Пожалуйста, ответьте на 3 вопроса, оценкой от 1 до 5, где 1 - совсем не понравилось, 5 - всё отлично</b>
					</div>
					<div class="col-12 mt-4 text-center <?=($_GET['error']==1)?'error':'d-none'?>">
						<b>Пожалуйста, поставьте оценки для всех пунктов, для нас это важно!</b>
					</div>
				</div>	

				<div class="row">
					<div class="col-lg-7 mb-3">1. Понравилось ли Вам обслуживание в регистратурах?</div>
					<div class="col-lg-4 d-flex justify-content-around">
						<input type="radio" name="service" class='score1 score' value='1'>
						<input type="radio" name="service" class='score2 score' value='2'>
						<input type="radio" name="service" class='score3 score' value='3'>
						<input type="radio" name="service" class='score4 score' value='4'>
						<input type="radio" name="service" class='score5 score' value='5'>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-7 mb-3">2. Понравился ли Вам прием врача (медицинская услуга)?</div>
					<div class="col-lg-4 d-flex justify-content-around">
						<input type="radio" name="doc" class='score1 score' value='1'>
						<input type="radio" name="doc" class='score2 score' value='2'>
						<input type="radio" name="doc" class='score3 score' value='3'>
						<input type="radio" name="doc" class='score4 score' value='4'>
						<input type="radio" name="doc" class='score5 score' value='5'>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-7 mb-3">3. Какое общее впечатление осталось после визита в нашу клинику?</div>
					<div class="col-lg-4 d-flex justify-content-around">
						<input type="radio" name="visit" class='score1 score' value='1'>
						<input type="radio" name="visit" class='score2 score' value='2'>
						<input type="radio" name="visit" class='score3 score' value='3'>
						<input type="radio" name="visit" class='score4 score' value='4'>
						<input type="radio" name="visit" class='score5 score' value='5'>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-7 mb-3">4. Остались ли у Вас вопросы к врачу после визита?</div>
					<div class="col-lg-4 d-flex justify-content-around">
						<input type="text" name="vopros" class='' placeholder='Напишите свой вопрос'>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<input type="submit" name="score" class='send w-md-25 text-center mx-auto d-block' value = "Оценить">	
					</div>
				</div>

			</form>
		</div>
	</div>
</body>
</html>

<style type="text/css">
	div{
		font-size: 18px;
	}
	:active, :hover, :focus, :checked {
	    outline: 0; 
	    outline-offset: 0;
	}
	label{
		margin: 0;
		line-height: 39px;
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
	.container{
		max-width: 1240px;
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
    .card{
    	border: 2px solid #7ca82b;
    	padding: 20px;
    	margin-top: 40px;
    	margin: 40px 5px;
    }
   	.score{
    -webkit-appearance: none;
    border: none;
    width: 40px;
    height: 40px;
    background: url(/local/templates/mgn-doctor/img/starempt.svg) center no-repeat; 
	background-position: 0px 0px;
	overflow: hidden; 
	    border-radius: 20px;
		border: 2px solid #fff; 	
    background-size: 100% 100%;
    }
    .score:checked,.score:active, .score:focus,.score:hover{
		border:none; 	
    	background-image: url(/local/templates/mgn-doctor/img/starfull.svg); 
    }
    .starfull{    	
    	background-image: url(/local/templates/mgn-doctor/img/starfull.svg); 
    }
    .error{
    	color: #f00;
    	font-size: 12px;
    }
</style>

<script type="text/javascript">

	$("#phone").mask("+7 (999) 999-9999");

	$('input[ type="radio"]').on('click', function(){
		$(this).siblings('input[type="text"]').removeClass('d-none');
	});

	$('input[name="disease_chron"]').on('click', function(){
		if($(this).val() == 1){ 
			$('.hidden_uchet').removeClass('d-none');
		}
	});
$('.score').on("click", function(){
	d = $(this).val();
	var parent = $(this).parent();
	$(parent).find(".score").each(function(i,el){

			$(this).removeClass('starfull');

		if($(this).val()<=d)
			$(this).addClass('starfull');

	});
});

</script>