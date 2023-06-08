<?php
$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");

if( $iPod || $iPhone || $iPad ){
    //echo "<br> ----- ios";
    $link = "https://apps.apple.com/ru/app/%D1%81%D0%B5%D0%BC%D0%B5%D0%B9%D0%BD%D1%8B%D0%B9-%D0%B4%D0%BE%D0%BA%D1%82%D0%BE%D1%80-%D0%BC%D0%B0%D0%B3%D0%BD%D0%B8%D1%82%D0%BE%D0%B3%D0%BE%D1%80%D1%81%D0%BA/id1529553109";
}else if($Android){
    //echo "android";
    $link = "https://play.google.com/store/apps/details?id=me.ondoc.custom.mgndoctor";
}else{
	//echo "Компуютеры";
	$link= 'https://mgn-doctor.ru';
}

header("Location: ".$link);
exit();
?>