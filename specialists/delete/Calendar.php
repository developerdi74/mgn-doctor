<?
namespace wk00FF;
class Calendar{
	public static $DMonth;
	public static $age;
	public static $specialization;
	public static $service;
	public static $doctor;
	public static $clinic;
	
	function __construct($DMonth, $age, $specialization=false, $service=false, $doctor=false, $clinic=false){
		self::$DMonth=$DMonth;
		self::$age=$age;
		self::$specialization=$specialization;
		self::$service=$service;
		self::$doctor=$doctor;
		self::$clinic=$clinic;
	}
	
	public static function getMonth($month, $year, $events=[]){																									//Вывод календаря на один месяц.
		$months=[
			1 =>'Январь',
			2 =>'Февраль',
			3 =>'Март',
			4 =>'Апрель',
			5 =>'Май',
			6 =>'Июнь',
			7 =>'Июль',
			8 =>'Август',
			9 =>'Сентябрь',
			10=>'Октябрь',
			11=>'Ноябрь',
			12=>'Декабрь'
		];
		$month=intval($month);
		$out='
		<div class="calendar-item">
			<div class="specialists-filter-name">Доступные даты и время*</div>
			<div class="pagin-row page-navigation calendar-head">
				<div class="wp-pagenavi justify-content-between">
					<a href="javascript:void(0)" data-month="'.(self::$DMonth-1).'" data-age="'.self::$age.'" class="previouspostslink" id="month-minus"></a>
					<div class="align-self-center">'.$months[$month].' '.$year.'</div>
					<div class="d-flex">
						<a href="javascript:void(0)" data-age="'.self::$age.'" class="today-link" id="month-today">Сегодня</a>
						<a href="javascript:void(0)" data-month="'.(self::$DMonth+1).'" data-age="'.self::$age.'" class="nextpostslink" id="month-plus"></a>
					</div>
				</div>
			</div>
			<table>
				<tr>
					<th>Пн</th> <th>Вт</th> <th>Ср</th> <th>Чт</th> <th>Пт</th> <th>Сб</th> <th style="border-right: none">Вс</th>
				</tr>';
		$day_week=date('N', mktime(0, 0, 0, $month, 1, $year));
		$day_week--;
		$out.='<tr>';
		for($x=0; $x<$day_week; $x++){
			$out.='<td></td>';
		}
		$days_counter=0;
		$days_month=date('t', mktime(0, 0, 0, $month, 1, $year));
		for($day=1; $day<=$days_month; $day++){
//			console($day.'.'.$month.'.'.$year);
			if(date('j.n.Y')==$day.'.'.$month.'.'.$year){
				$class='today';
			}
			elseif(time()>strtotime($day.'.'.$month.'.'.$year)){
				$class='last';
			}
			else{
				$class='';
			}
			$event_show=false;
			$event_text=[];
			if(!empty($events)){
				foreach($events as $date=>$text){
					$date=explode('.', $date);
					if(count($date)==3){
						$y=explode(' ', $date[2]);
						if(count($y)==2){
							$date[2]=$y[0];
						}
						if($day==intval($date[0]) && $month==intval($date[1]) && $year==$date[2]){
							$event_show=true;
							$event_text[]=$text;
						}
					}
					elseif(count($date)==2){
						if($day==intval($date[0]) && $month==intval($date[1])){
							$event_show=true;
							$event_text[]=$text;
						}
					}
					elseif($day==intval($date[0])){
						$event_show=true;
						$event_text[]=$text;
					}
				}
			}
			if($event_show){
				$out.='<td class="calendar-day '.$class.' event">'.$day;
				if(!empty($event_text)){
					$out.='<div class="calendar-popup">'.implode('<br>', $event_text).'</div>';
				}
				$out.='</td>';
			}
			else{
				$out.='<td class="calendar-day '.$class.'">'.$day.'</td>';																						// просто день, без событий
			}
			if($day_week==6){
				$out.='</tr>';
				if(($days_counter+1)!=$days_month){
					$out.='<tr>';
				}
				$day_week=-1;
			}
			$day_week++;
			$days_counter++;
		}
		$out.='</tr></table>';
		
		ob_start();?>
		<div class="pagin-row calendar-footer">
			<div class="specialists-filter-name">Свободное время</div>
		</div>
		<table>
			<tr>
				<td class="calendar-day"></td>
				<td class="calendar-day"></td>
				<td class="calendar-day"></td>
				<td class="calendar-day"></td>
				<td class="calendar-day"></td>
				<td class="calendar-day"></td>
				<td class="calendar-day"></td>
			</tr>
		</table>
		
		<?
		$out.=ob_get_contents();
		ob_end_clean();
		return $out;
	}

	public static function getInterval($start=false, $end=false, $events=[]){																					// Вывод календаря на несколько месяцев.
		if(!$start){
			$start=date('n.Y', strtotime('+'.self::$DMonth.' month'));
		}
		if(!$end){
			$end=date('n.Y', strtotime('+'.self::$DMonth.' month'));
		}
		$curent=explode('.', $start);
		$curent[0]=intval($curent[0]);
		$end=explode('.', $end);
		$end[0]=intval($end[0]);
		$begin=true;
		$out='<div class="calendar-wrp">';
		do{
			$out.=self::getMonth($curent[0], $curent[1], $events);
			if($curent[0]==$end[0] && $curent[1]==$end[1]){
				$begin=false;
			}
			$curent[0]++;
			if($curent[0]==13){
				$curent[0]=1;
				$curent[1]++;
			}
		}while($begin==true);
		$out.='</div>';
		return $out;
	}
}