<?
$name=$_POST["your-name"];
$mail=$_POST["your-mail"];
$tel=$_POST["contact-tel"];
$text=$_POST["contact-textarea"];
if($_POST["id-clinic"]=='727'){
	$to='info@mgn-doctor.ru';
}
if($_POST["id-clinic"]=='728'){
	$to='info@doctor-74.ru';
}
if($_POST["id-clinic"]=='1240'){
	$to='info@mgn-doctor.ru';
}
$subject='письмо глав. врачу с сайта mgn-doctor.ru';
$message='<html><body><p>Имя: '.$name.'<br>';
$message.='Почта: '.$mail.'<br>';
$message.='Телефон: '.$tel.'<br>';
$message.='Текст сообщения: '.$_POST["contact-textarea"].'</p></body></html>';
$message=wordwrap($message, 70, "\r\n");
//$message = iconv ('UTF-8', 'windows-1251', $message);
$headers='MIME-Version: 1.0'."\r\n";
$headers.='Content-type: text/html; charset=UTF-8'."\r\n";
$headers=iconv('UTF-8', 'windows-1251', $headers);
mail($to, $subject, $message, $headers);
$toSecond="doktor74mgn@yandex.ru";
mail($toSecond, $subject, $message, $headers); 
