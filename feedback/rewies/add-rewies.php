<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php'); ?>
<?
	$phone = validate($_POST['phone']);
	$service = validate($_POST['service'],1);
	$doc = validate($_POST['doc'],1);   
	$visit = validate($_POST['visit'],1);  
	$vopros = validate($_POST['vopros']);

	$el = new CIBlockElement;
	$PROP = array();
	$PROP["PHONE"] = $phone;
	$PROP["SERVICE"] = $service; 
	$PROP["DOC"] = $doc; 
	$PROP["ALL"] = $visit;

	foreach ($PROP as $value) {
		if($value == null){
			$get = (isset($_POST['phone']))?'&phone='.str_replace("+7", '', $_POST['phone']) : '';
			header('Location: /feedback/rewies/?error=1'.$get);
			exit;
		}
	}
	$arLoadProductArray = Array(
	  //"MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
	  //"IBLOCK_SECTION_ID" => true,          // элемент лежит в корне раздела
	  "IBLOCK_ID"      => 35,
	  "PROPERTY_VALUES"=> $PROP,
	  "NAME"           => $phone,
	  "PREVIEW_TEXT" 	=> $vopros,
	  "ACTIVE"         => "Y",    
	  );

	if($PRODUCT_ID = $el->Add($arLoadProductArray))
	 $success = "New ID: ".$PRODUCT_ID;
	else{		
		$get = (isset($_POST['phone']))?'&phone='.str_replace("+7", '', $_POST['phone']) : '';
		header('Location: /feedback/rewies/?error=1'.$get);
	}

	function validate($data,$max = 17) {
		if(strlen($data)==0 || strlen($data)>$max){
			return null;
		}
	    $data = trim($data);
	    $data = stripslashes($data);
	    $data = htmlspecialchars($data);
	    return $data;
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Анкета клиента</title>
	<link rel="stylesheet" type="text/css" href="/local/templates/mgn-doctor/css/bootstrap.min.css">
	<script type="text/javascript" src='/local/templates/mgn-doctor/js/jquery.min.js'></script>
	<script type="text/javascript" src='/local/templates/mgn-doctor/js/jquery.maskedinput.min.js'></script>
</head>
<body>
	<div class="container">
		<div class="card row">
			<div class="header">
				<div class="row">
					<div class="col-lg-3"><img src="/local/templates/mgn-doctor/img/main_logo.svg"></div>
					<div class="col-lg-9 mb-5"><h1 class='text-center d-inline-block'>Спасибо, за Ваше мнение!</h1></div>
					<a class='send text-center' href='https://mgn-doctor.ru/'>Перейти на главную страницу сайта - Семейный доктор</a>
				</div>
			</div>
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
	.send{
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
    	margin: 0 auto;
    	padding: 5px 50px;
    }
    .card{
    	border: 2px solid #7ca82b;
    	padding: 40px;
    	margin-top: 40px;
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

</script>