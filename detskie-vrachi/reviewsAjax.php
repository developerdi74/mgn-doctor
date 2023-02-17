<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if(!$_SERVER['HTTP_REFERER']){
header('Location: '."/404.php/");
die();
}


$name=$_POST["your-name"];
$mail=$_POST["form_email"];
$tel=$_POST["contact-tel"];
$text=$_POST["contact-textarea"];
$clinic=$_POST["clinic"];
$specialists=$_POST["specialists"];
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
CModule::IncludeModule('iblock');
$el=new CIBlockElement;
if($clinic=="Доменщиков, 8 а") $ENUM_ID=118;
if($clinic=="Жукова, 11") $ENUM_ID=119;
if($clinic=="50 лет Магнитки, 35/1") $ENUM_ID=120;
if($clinic=="Еще не был в клинике") $ENUM_ID=121;
$PROP=[];
$PROP[214]=["VALUE"=>$ENUM_ID];
$PROP[185]=$specialists;
$arLoadProductArray=[
	"MODIFIED_BY"      =>$USER->GetID(),
	"IBLOCK_SECTION_ID"=>false,
	"IBLOCK_ID"        =>30,
	"PROPERTY_VALUES"  =>$PROP,
	"NAME"             =>$name,
	"ACTIVE"           =>"N",
	"PREVIEW_TEXT"     =>$text,
	"DETAIL_TEXT"      =>""
];
if($PRODUCT_ID=$el->Add($arLoadProductArray)) echo "New ID: ".$PRODUCT_ID;
else
	echo "Error: ".$el->LAST_ERROR;
