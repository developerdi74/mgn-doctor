<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(!$_SERVER['HTTP_REFERER']){
header('Location: '."/404.php/");
die();
}
$PROP=[];
$name=$_POST["your-name"];
if(isset($_POST["form_email"]))
	$mail=$_POST["form_email"];
else
	$mail='none';
$tel=$_POST["contact-tel"];
if(!empty($_POST["contact-textarea"])){
	$text=$_POST["contact-textarea"];
}
if(!empty($_POST["contact-textarea-doctors"])){
	$text=$_POST["contact-textarea-doctors"];
}
$clinic=$_POST["clinic"];
if(isset($_POST["star"])){
	$specialists=$_POST["specialists"];
	$score = $_POST["star"];	
	$PROP[185]=$specialists;
	$PROP["RAITING"]=$score;
}
$to='info@doctor-74.ru';
$subject='Отзыв с сайта mgn-doctor.ru';
$message='<html><body><p>Имя: '.$name.'<br>';
$message.='Почта: '.$mail.'<br>';
$message.='Телефон: '.$tel.'<br>';
$message.='Клиника: '.$clinic.'<br>';
$message.='Отзыв: '.$_POST["contact-textarea"].'</p></body></html>';
$message=wordwrap($message, 70, "\r\n");
//$message = iconv ('UTF-8', 'windows-1251', $message);
$headers='MIME-Version: 1.0'."\r\n";
$headers.='Content-type: text/html; charset=UTF-8'."\r\n";
$headers=iconv('UTF-8', 'windows-1251', $headers);
mail($to, $subject, $message, $headers);



Expand All
	@@ -60,6 +60,11 @@
	$PROP[214]=["VALUE"=>$ENUM_ID];
}


$type=($score>0) ? "clinic": "docs";

sendTelegram($name, $tel, $text, $clinic);

$PROP["PHONE"]=$tel;

$arLoadProductArray=[
Expand All
	@@ -76,3 +81,31 @@
if($PRODUCT_ID=$el->Add($arLoadProductArray)) echo "New ID: ".$PRODUCT_ID;
else
	echo "Error: ".$el->LAST_ERROR;


function sendTelegram($name=0,$tel=0,$message=0,$clinic=0){

	  $token = "6080201894:AAGdKExw1H0jxifd7P4i17oWy6U7AyDdzBo";
	  $chat_id = "-1001672635509";

	  $arr = array(
	    'Новый отзыв с сайта' => 'mgn-doctor.ru',
	    'Имя клиента: ' => $name,
	    'Телефон: ' => $tel,
	    'Текст отзыва: ' => $message,
	    'Адрес клиники: ' => $clinic,
	    'Дата отзыва: ' => date('Y-M-d h:i:s'),
	  );

	  foreach($arr as $key => $value) {
	    $txt .= "<b>".$key."</b> ".$value."%0A";
	  };

	  $url = "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&parse_mode=html&text=".$txt;

	    if( $curl = curl_init() ) {
	      curl_setopt($curl, CURLOPT_URL, $url);
	      $out = curl_exec($curl);
	      curl_close($curl);
	    }
}