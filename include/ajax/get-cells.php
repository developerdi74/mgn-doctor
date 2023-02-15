<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
/**
 * Created by PhpStorm.
 * User: william
 * Date: 23.12.2022
 * Time: 9:15
 */

use Bitrix\Main\Loader;
Loader::includeModule("highloadblock");
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$hlblockId=HL\HighloadBlockTable::getById(8)->fetch();																										// расписание
$entity=HL\HighloadBlockTable::compileEntity($hlblockId);
$entity_data_class=$entity->getDataClass();
$filter=[
	[
		"LOGIC"=>"AND",
		[
			">=UF_BEGIN"=>date('m/d/Y h:i:s a', strtotime($_REQUEST['first-day'].' '.'00:00:00')),
			"<UF_BEGIN" =>date('m/d/Y h:i:s a', strtotime($_REQUEST['last-day'].' '.'23:59:00'))
		],
	]
];

console($filter);
$TimeData=$entity_data_class::getList([
	"select"=>["*"],
	"order" =>["ID"=>"ASC"],
	"filter"=>$filter,
]);
$shedule=[];
$cells=0;
while($arDataT=$TimeData->Fetch()){
//console($arDataT);
	$interval=new \DateInterval('PT'.(string)($arDataT['UF_LENGTH']*60).'S');
	$shedule[$arDataT['UF_BEGIN']->format("d.m.Y")][$arDataT['UF_NAME']][$arDataT['UF_CLINIC']]=[
		'id'      =>$arDataT['ID'],
		'begin'   =>$arDataT['UF_BEGIN']->format("H:i"),
		'end'     =>$arDataT['UF_END']->format("H:i"),
		'interval'=>$arDataT['UF_LENGTH'],
		'shedule' =>[]
	];
	$currentShedule=\DateTime::createFromFormat('d.m.Y H:i', $arDataT['UF_BEGIN']->format("d.m.Y H:i"));
	$endShedule=\DateTime::createFromFormat('d.m.Y H:i', $arDataT['UF_END']->format("d.m.Y H:i"));
	while($currentShedule<$endShedule){																															// временные интервалы
		array_push($shedule[$arDataT['UF_BEGIN']->format("d.m.Y")][$arDataT['UF_NAME']][$arDataT['UF_CLINIC']]['shedule'], [$currentShedule->format("H:i")=>false]);
		$cells++;
//		console($arDataT['UF_NAME'].' '.$arDataT['UF_CLINIC'].' '.$arDataT['UF_BEGIN']->format("d.m.Y H:i"));
		$currentShedule->add($interval);
	}
}

$interval=new \DateInterval('PT'.(string)(60).'S');
foreach($shedule as $date=>$doctors){
//	console($date);
//	console($shedule[$date]);
	foreach($doctors as $doctor=>$addreses){
//		console(count($shedule[$date][$doctor]));
		if(count($addreses)>1){
			$begin1=$begin2=$begin3=$end1=$end2=$end3=0;
			foreach($addreses as $addres=>$data){
//				console('begin: '.$data['begin'].' end: '.$data['end']);
				if(!$begin1){
					$begin1=\DateTime::createFromFormat('H:i', $data['begin']);
					$end1=\DateTime::createFromFormat('H:i', $data['end']);
				}
				elseif(!$begin2){
					$begin2=\DateTime::createFromFormat('H:i', $data['begin']);
					$end2=\DateTime::createFromFormat('H:i', $data['end']);
				}
				else{
					$begin3=\DateTime::createFromFormat('H:i', $data['begin']);
					$end3=\DateTime::createFromFormat('H:i', $data['end']);
				}
			}
			do{
				if($begin2>$begin1 && $begin2<$end1){
					$toDelete=0;
					foreach($addreses as $addres=>$data){
						if(!$toDelete || $data['id']<$toDelete){
							$toDelete=$data['id'];
						}
					}
//					console($toDelete);
					foreach($addreses as $addres=>$data){
						if($data['id']==$toDelete){
							unset($shedule[$date][$doctor][$addres]);
							$cells--;
						}
					}
					continue 2;
				}
				$begin2->add($interval);
			}while($begin1<=$end1 && $begin2<=$end2);
//			console('--------');
//			console(' begin1 '.$begin1.' end1 '.$end1.' | begin2 '.$begin2.' end2 '.$end2.' | begin3 '.$begin3.' end3 '.$end3);
		}
	}
}

//console($shedule);
?>
<div class="row">
	<div class="col-12">
		<?_vardump($shedule);?>
		<?
//		_vardump(' begin1 '.$begin1.' end1 '.$end1.' | begin2 '.$begin2.' end2 '.$end2);
		?>
	</div>
</div>
<div class="row">
	<div class="col-12">
		Всего ячеек: <?=$cells?>
	</div>
</div>
