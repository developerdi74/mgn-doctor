<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Анкета клиента</title>
	<link rel="stylesheet" type="text/css" href="/local/templates/mgn-doctor/css/bootstrap.min.css">
	<script type="text/javascript" src='/local/templates/mgn-doctor/js/jquery.min.js'></script>
</head>
<body>
	<div class="container">
		
		<?
		$fio = validate($_POST['fio'],100,'r');
		$dateAdult = validate($_POST['dateAdult'],100,'r');
		$email = validate($_POST['email'],100,'r');
		$phone = validate($_POST['phone'],100,'r');

		//Проверка ребенка
		if($_POST['child']=='yes'){
			$child = validate($_POST['child'],3,'r');
			$fioChild = validate($_POST['fioChild'],100,'r');
			$dateChild = validate($_POST['dateChild'],100,'r');			
		}else{

		}

		$allergi = validate($_POST['allergi'],100);
		$blood_group = validate($_POST['blood-group'],100);
		$rezus_factor = validate($_POST['rezus-factor'],100);
		$disease = validate($_POST['disease'],100); //arr
		$disease_extend = validate($_POST['disease_extend'],100);
		$disease_extend_input = validate($_POST['disease_extend_input'],100);
		$disease_born = validate($_POST['disease_born'],100);
		$disease_born_input = validate($_POST['disease_born_input'],100);
		$disease_chron = validate($_POST['disease_chron'],100);
		$disease_chron_input = validate($_POST['disease_chron_input'],100);
		$uchet = validate($_POST['uchet'],100);
		$uchet_input = validate($_POST['uchet_input'],100);
		$invalid = validate($_POST['invalid'],100);



		$html.='1. Ваше ФИО: '.$_POST['fio']."\r\n<br>";
		echo $html;
		?>


	</div>
</body>
</html>
<pre>
<?
	var_dump($_POST);
	function validate($data, $max = 100, $rule='n') {
		if($rule=='r'){
			if(strlen($data)==0){
				return null;
			}
		}
		if(is_array($data))
			return $data;

		if(strlen($data)>$max){
			return null;
		}
	    $data = trim($data);
	    $data = stripslashes($data);
	    $data = htmlspecialchars($data);
	    return $data;
	}
?>