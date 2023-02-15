<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
/**
 * Created by PhpStorm.
 * User: william
 * Date: 07.11.2022
 * Time: 12:09
 */
$APPLICATION->SetPageProperty("title", "Семейный доктор в Магнитогорске. Врачи клиники");
$APPLICATION->SetPageProperty("description", "Список и расписание врачей в Семейном докторе. 126 специалистов. 45 детских врачей. 26 врачей ультразвуковой диагностики (УЗИ). 7 врачей функциональной диагностики.");
$APPLICATION->SetPageProperty("keywords", "семейный доктор врачи, семейный доктор магнитогорск врачи, семейный доктор магнитогорск официальный сайт врачи, семейный доктор официальный сайт врачи");
$APPLICATION->SetTitle("Семейный доктор в Магнитогорске. Врачи клиники");
require_once __DIR__.'/Calendar.php';
$month=$_REQUEST['month']?$_REQUEST['month']:0;
$age=$age=$_REQUEST['age']?$_REQUEST['age']:111;
$url=explode('?', $_SERVER['REQUEST_URI'])[0];
?>
<!-- ALL SPECIALISTS  -->
	<link rel="stylesheet" href="calendar.css">
	<section class="specialists-inner all-our-specialists">
		<div class="container">
			<div class="row justify-content-between page-row-middle">
				<h1 class="page-title specialists-inner__title all-our-specialists__title">Врачи в медицинском центре “Семейный доктор”</h1>
			</div>

			<div class="row page-row-middle all-specialists">
				<?if($age==111){?>
					<button class="btn btn-spec-flt active">Взрослые</button>
					<a href="<?=$url.'?age=110&month='.$month?>"><button class="btn btn-spec-flt">Детские</button></a>
				<?}elseif($age==110){?>
					<a href="<?=$url.'?age=111&month='.$month?>"><button class="btn btn-spec-flt">Взрослые</button></a>
					<button class="btn btn-spec-flt active">Детские</button>
				<?}?>
			</div>

			<div class="row all-specialists">
				<div class="col-xl-3 col-md-6 col-sm-6">
					<div class="row">
						<b>А</b>
					</div>
					<div class="row">Аллерголог-иммунолог</div>
					<div class="row">Анестезиолог</div>

					<div class="row" style="margin-top: 20px">
						<b>В</b>
					</div>
					<div class="row">Врач УЗИ</div>
					<div class="row">Врач функциональной диагностики</div>

					<div class="row" style="margin-top: 20px">
						<b>Г</b>
					</div>
					<div class="row">Гастроэнтеролог</div>
					<div class="row">Гематолог</div>
					<div class="row">Гинеколог</div>
					<div class="row">Гинеколог-эндокринолог</div>

					<div class="row" style="margin-top: 20px">
						<b>Д</b>
					</div>
					<div class="row">Дерматолог</div>
				</div>
				<div class="col-xl-3 col-md-6 col-sm-6">
					<div class="row">
						<b>И</b>
					</div>
					<div class="row">Инструктор по плаванию</div>
					<div class="row">Инфекционист</div>

					<div class="row" style="margin-top: 5px">
						<b>К</b>
					</div>
					<div class="row">Кардиолог</div>
					<div class="row">Клинический психолог</div>
					<div class="row">Колопроктолог</div>

					<div class="row" style="margin-top: 20px">
						<b>М</b>
					</div>
					<div class="row">Маммолог</div>

					<div class="row" style="margin-top: 20px">
						<b>Н</b>
					</div>
					<div class="row">Невролог</div>
					<div class="row">Нейрохирург</div>
					<div class="row">Нефролог</div>
					<div class="row">Нутрициолог</div>
				</div>
				<div class="col-xl-3 col-md-6 col-sm-6">
					<div class="row">
						<b>О</b>
					</div>
					<div class="row">Онколог</div>
					<div class="row">Онколог-маммолог</div>
					<div class="row">Отоларинголог</div>
					<div class="row">Офтальмолог</div>
					<div class="row">
						<b>П</b>
					</div>
					<div class="row">Педиатр</div>
					<div class="row">Психиатр</div>
					<div class="row">Психолог</div>
					<div class="row">Пульмонолог</div>
					<div class="row">
						<b>Р</b>
					</div>
					<div class="row">Равматолог</div>
					<div class="row">Рентгенолог</div>
					<div class="row">
						<b>С</b>
					</div>
					<div class="row">Сосудистый хирург</div>
					<div class="row">Стоматолог</div>
				</div>
				<div class="col-xl-3 col-md-6 col-sm-6">
					<div class="row">
						<b>Т</b>
					</div>
					<div class="row">Терапевт</div>
					<div class="row">Травматолог-ортопед</div>
					<div class="row">Трихолог</div>
					<div class="row">
						<b>У</b>
					</div>
					<div class="row">Уролог</div>
					<div class="row">
						<b>Ф</b>
					</div>
					<div class="row">Фтизиатр</div>
					<div class="row" style="margin-top: 20px">
						<b>Х</b>
					</div>
					<div class="row">Хирург</div>
					<div class="row">Хирург лазерный</div>
					<div class="row" style="margin-top: 10px">
						<b>Э</b>
					</div>
					<div class="row">Эндокринолог</div>
					<div class="row">Эндоскопист</div>
				</div>
			</div>

			<div class="row justify-content-between page-row-middle all-specialists">
				<h2 class="page-title specialists-inner__title all-our-specialists__title">Быстрая онлайн-запись к врачу</h2>
			</div>
			
			<div class="row all-specialists">
				<div class="col-3">
					<div class="row">
						<div class="specialists-filter__item">
							<label for="specialization" class="specialists-filter-name">Специальность*</label>
							<select name="" id="specialization">
								<option value="">Любая</option>
								<option value="77">Аллерголог-иммунолог</option>
								<option value="1667">Анестезиолог</option>
								<option value="79">Врач УЗИ</option>
								<option value="1412">Врач функциональной диагностики</option>
								<option value="78">Гастроэнтеролог</option>
								<option value="1383">Гематолог</option>
								<option value="76">Гинеколог</option>
								<option value="1659">Гинеколог-эндокринолог</option>
								<option value="93">Дерматолог</option>
								<option value="94">Инструктор по плаванию</option>
								<option value="1385">Инфекционист</option>
								<option value="81">Кардиолог</option>
								<option value="1393">Клинический психолог</option>
								<option value="1391">Колопроктолог</option>
								<option value="1413">Маммолог</option>
								<option value="82">Невролог</option>
								<option value="1559">Нейрохирург</option>
								<option value="1392">Нефролог</option>
								<option value="1414">Нутрициолог</option>
								<option value="1394">Онколог</option>
								<option value="1660">Онколог-маммолог</option>
								<option value="1395">Отоларинголог</option>
								<option value="1396">Офтальмолог</option>
								<option value="1394">Педиатр</option>
								<option value="1665">Психиатр</option>
								<option value="1398">Психолог</option>
								<option value="1399">Пульмонолог</option>
								<option value="1400">Равматолог</option>
								<option value="1401">Рентгенолог</option>
								<option value="1410">Сосудистый хирург</option>
								<option value="1402">Стоматолог</option>
								<option value="1403">Терапевт</option>
								<option value="1404">Травматолог-ортопед</option>
								<option value="1609">Трихолог</option>
								<option value="1405">Уролог</option>
								<option value="1406">Фтизиатр</option>
								<option value="1407">Хирург</option>
								<option value="1409">Хирург лазерный</option>
								<option value="1408">Эндокринолог</option>
								<option value="1411">Эндоскопист</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="specialists-filter__item">
							<label for="specialization" class="specialists-filter-name">Услуга*</label>
							<select name="" id="service" disabled>
								<option value="">Любая</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="specialists-filter__item">
							<label for="specialization" class="specialists-filter-name">Врач</label>
							<select name="" id="doctor" disabled>
								<option value="">Любой</option>
								<option value="110" >Детский</option>
								<option value="111" >Взрослый</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="specialists-filter__item">
							<label for="specialization" class="specialists-filter-name">Адрес</label>
							<select name="" id="clinic" disabled>
								<option value="">Все клиники</option>
								<option value="108" >ул. Жукова, д.11</option>
								<option value="109" >ул. Доменщиков, д.8a</option>
								<option value="117" >ул. 50 лет Магнитки, 35/1</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-9" id="schedule-doctors">
					<?
					$calendar=new wk00FF\Calendar($month, $age);
					echo $calendar->getInterval();
					echo "<script>calendarInit()</script>";
					?>
				</div>
			</div>

		</div>
		
	</section>
	<!-- ALL SPECIALISTS END -->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");