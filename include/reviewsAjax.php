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
//mail($to, $subject, $message, $headers);



CModule::IncludeModule('iblock');
$el=new CIBlockElement;

if(strlen($clinic)>0){
	if($clinic=="Доменщиков, 8 а") $ENUM_ID=118;
	if($clinic=="Жукова, 11") $ENUM_ID=119;
	if($clinic=="50 лет Магнитки, 35/1") $ENUM_ID=120;
	if($clinic=="Еще не был в клинике") $ENUM_ID=121;
	$PROP[214]=["VALUE"=>$ENUM_ID];
}

$PROP["PHONE"]=$tel;

$arLoadProductArray=[
	"MODIFIED_BY"      =>$USER->GetID(),
	"IBLOCK_SECTION_ID"=>false,
	"IBLOCK_ID"        =>30,
	"PROPERTY_VALUES"  =>$PROP,
	"NAME"             =>$name,
	"ACTIVE"           =>"N",
	"PREVIEW_TEXT"     =>$text,
	"DETAIL_TEXT"      =>$docText,
];

if($PRODUCT_ID=$el->Add($arLoadProductArray)) echo "New ID: ".$PRODUCT_ID;
else
	echo "Error: ".$el->LAST_ERROR;
