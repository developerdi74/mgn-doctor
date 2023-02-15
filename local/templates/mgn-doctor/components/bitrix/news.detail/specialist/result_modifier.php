<?
/*
 function translit($value)
 {
     $converter = array(
         'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
         'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
         'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
         'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
         'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
         'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
         'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
 
         'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
         'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
         'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
         'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
         'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
         'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
         'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
     );
 
     $value = mb_strtolower($value);
     $value = strtr($value, $converter);
     $value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
     $value = mb_ereg_replace('[-]+', '-', $value);
     $value = trim($value, '-');
     return $value;
 }
 
 $f_appointment_json = 'http://mgn-doctor.ru/json/appointment.json';
 $appointment_json = json_decode(file_get_contents($f_appointment_json));
 
 
 $f_timesheet_json = 'http://mgn-doctor.ru/json/timesheet.json';
 $timesheet_json = json_decode(file_get_contents($f_timesheet_json));
 ?>
 
 <?
 $months = array( 1 => 'Января' , 'Февраля' , 'Марта' , 'Апреля' , 'Мая' , 'Июня' , 'Июля' , 'Августа' , 'Сентября' , 'Октября' , 'Ноября' , 'Декабря' );
 
 $timesheet = array(); //Расписание
 $appointment = array(); //Запись  
 $arrDate = array();
 
 foreach ($appointment_json as $key => $item) {
     $doctor = translit($item->doctor);
     $address = translit($item->address);
     
     $date =  date("Y-m-d", strtotime($item->begin));
     $time =  date("H:i:s", strtotime($item->begin));
 
     $appointment[$doctor]["doctor"] =  $item->doctor;
     $appointment[$doctor][$address]["date"][$date]["date"] =  $date;
     //$appointment[$doctor][$address]["date"][$date]["time"][$time]["time"]  =  $time;
 }
 
 foreach ($timesheet_json as $key => $item) {
     $doctor = translit($item->doctor);
     $address = translit($item->address);
     
     $date =  date("Y-m-d", strtotime($item->begin));
     $timeBegin =  date("H:i:s", strtotime($item->begin));
     $timeEnd =  date("H:i:s", strtotime($item->end));
     $length = $item->length;
 
     $timesheet[$doctor]["doctor"] =  $item->doctor;
     $timesheet[$doctor][$address]["date"][$date]["date"] =  $date;
 
     $timesheet[$doctor][$address]["date"][$date]["timebegin"] =  $timeBegin;
     $timesheet[$doctor][$address]["date"][$date]["timeend"]=  $timeEnd;
     
     $time = $timeBegin;
     
     
     $i = 0;
     while( $time <= $timeEnd){
         $timesheet[$doctor][$address]["date"][$date]["time"][$time]["free"] =  "Y";
         $timesheet[$doctor][$address]["date"][$date]["time"][$time]["time"] = $time;
         $time = date("H:i:s", strtotime( $time . $length . 'minutes'));      
      }
        
     if ($appointment[$doctor][$address]["date"][$date]["date"] ==  $date) {
         if ($appointment[$doctor][$address]["date"][$date]["time"][$time]["time"] == $time) {
             $timesheet[$doctor][$address]["date"][$date]["time"][$time]["free"] =  "N";
         }
     }
     
 }
 
 
 $firstday =  date("Y-m-d", strtotime('now'));
 $lastday =  date("Y-m-d", strtotime('now +13 days'));
 
 $strFirst = date('d ', strtotime($firstday)) . $months[(date('n', strtotime($firstday)))] ;
 $strLastday = date('d ', strtotime($lastday)) . $months[(date('n', strtotime($lastday)))];
 
 $arrDate = array();
 for ( $i=0; $i<=13; $i++) {
     $arrDate[$firstday]['date'] = $firstday;
     $firstday =  date("Y-m-d", strtotime($firstday . '+1 day'));
 }
 
 foreach ($timesheet as $key=>$item){
     $result[$key]['doctor'] = $item['doctor'];
     //$result[$key]['address'] = $item['address'];
     $result[$key]['domenschikov-8a']['date'] = $arrDate;
     $result[$key]['zhukova-11']['date'] = $arrDate;
  
 }
 
 
 foreach ($result as $key=>$item){
     $address = translit($item['address']);
 
     foreach ($arrDate as $date){
         $result[$key]['domenschikov-8a']['date'][$date['date']]['time'] = $timesheet[$key]['domenschikov-8a']['date'][$date['date']]['time'];
         $result[$key]['zhukova-11']['date'][$date['date']]['time'] = $timesheet[$key]['zhukova-11']['date'][$date['date']]['time'];
     }
 }

$arResult['timesheet'] = $result;
$arResult['timesheet']['firstday'] = $strFirst;
$arResult['timesheet']['lastday'] = $strLastday;
*/
?>
