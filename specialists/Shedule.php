<?
namespace wk00FF;
class Shedule{
	
	/**
	 * расписание для одного доктора
	*/
	private $start;
	private $end;
	private $period;
	private $address;
	private $appointments;

	public function __construct($start, $end, $period, $address){
		$this->start[]=DateTime::createFromFormat('d.m.Y H:i:s', $start);
		$this->end[]=DateTime::createFromFormat('d.m.Y H:i:s', $end);
		$this->period[]=new DateInterval("P".(string)$period."i");
		$this->address[]=$address;
		$this->appointments=[];
	}

	public function addAppointment(){																															// добавить запись на прием
	
	}

	public function getShedules(){																																// получить расписание
	
	}
}