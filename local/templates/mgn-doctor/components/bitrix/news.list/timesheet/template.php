  <? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$this->setFrameMode(true);
?>

<?

$hlblockId = HL\HighloadBlockTable::getById(8)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblockId);
$entity_data_class = $entity->getDataClass();

?>


<?
$date = date('Y-m-d', time());
$dates[] = date("Y-m-d", strtotime('monday this week', strtotime($date)));
$dates[] =  date("Y-m-d", strtotime('tuesday this week', strtotime($date)));
$dates[] =  date("Y-m-d", strtotime('wednesday this week', strtotime($date)));
$dates[] =  date("Y-m-d", strtotime('thursday this week', strtotime($date)));
$dates[] =  date("Y-m-d", strtotime('friday this week', strtotime($date)));
$dates[] =  date("Y-m-d", strtotime('saturday this week', strtotime($date)));
$dates[] =  date("Y-m-d", strtotime('sunday this week', strtotime($date)));
?>





<div class="container">

  <?
  if ($_REQUEST["CLINIC"] == 1) {
    $clinic = "Жукова 11";
  } elseif ($_REQUEST["CLINIC"] == 2) {
    $clinic = "Доменщиков 8а";
  } elseif ($_REQUEST["CLINIC"] == 3) {
    $clinic = "50 лет магнитки 35";
  } elseif ($_REQUEST["CLINIC"] == '') {
    $clinic = "Жукова 11";
  }
  ?>

  <div class="row row-contacts-tabs">
    <ul class="nav nav-tabs nav-tabs-contacts">
      <li class="nav-item <? if ($_REQUEST["CLINIC"] == "1" || $_REQUEST["CLINIC"] == "") echo "active" ?> ">
        <a class="nav-link " href="?CLINIC=1">
          <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 0.0078125C2.0142 0.0078125 0 1.95819 0 4.37406C0 8.55131 4.5 13.9991 4.5 13.9991C4.5 13.9991 9 8.55044 9 4.37406C9 1.95906 6.9858 0.0078125 4.5 0.0078125ZM4.5 6.78994C3.1572 6.78994 2.07 5.73206 2.07 4.42744C2.07 3.12281 3.1572 2.06494 4.5 2.06494C5.841 2.06494 6.9291 3.12281 6.9291 4.42744C6.9291 5.73206 5.841 6.78994 4.5 6.78994Z" fill="white"></path>
          </svg>
          ул. Жукова, д.11
        </a>
      </li>
      <li class="nav-item <? if ($_REQUEST["CLINIC"] == "2") echo "active" ?>">
        <a class="nav-link" href="?CLINIC=2">
          <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 0.0078125C2.0142 0.0078125 0 1.95819 0 4.37406C0 8.55131 4.5 13.9991 4.5 13.9991C4.5 13.9991 9 8.55044 9 4.37406C9 1.95906 6.9858 0.0078125 4.5 0.0078125ZM4.5 6.78994C3.1572 6.78994 2.07 5.73206 2.07 4.42744C2.07 3.12281 3.1572 2.06494 4.5 2.06494C5.841 2.06494 6.9291 3.12281 6.9291 4.42744C6.9291 5.73206 5.841 6.78994 4.5 6.78994Z" fill="white"></path>
          </svg>
          ул. Доменщиков, д.8а
        </a>
      </li>
      <li class="nav-item <? if ($_REQUEST["CLINIC"] == "3") echo "active" ?>">
        <a class="nav-link" href="?CLINIC=3">
          <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 0.0078125C2.0142 0.0078125 0 1.95819 0 4.37406C0 8.55131 4.5 13.9991 4.5 13.9991C4.5 13.9991 9 8.55044 9 4.37406C9 1.95906 6.9858 0.0078125 4.5 0.0078125ZM4.5 6.78994C3.1572 6.78994 2.07 5.73206 2.07 4.42744C2.07 3.12281 3.1572 2.06494 4.5 2.06494C5.841 2.06494 6.9291 3.12281 6.9291 4.42744C6.9291 5.73206 5.841 6.78994 4.5 6.78994Z" fill="white"></path>
          </svg>
          ул. 50 лет Магнитки, д.35/1
        </a>
      </li>
    </ul>
  </div>


  <br><br>

  <?/*
  global $USER;
  if ($USER->IsAdmin()) {*/
  ?>
    <div class="schedule">

      <div class="schedule__photo">
      <h6>График работы медицинского центра</h6>
        <? if ($_REQUEST["CLINIC"] == "1" || $_REQUEST["CLINIC"] == ""): ?>
          <img src="/upload/iblock/d87/ugbf9aj92t9q0xyb3fgkdbrcaxonv9kr.jpg" alt="">
        <? endif;?>

        <? if ($_REQUEST["CLINIC"] == "2"): ?>
          <img src="/upload/iblock/a0f/m13qsnvu19pn51ahn8i7xix5mujgw7ro.jpg" alt="">
        <? endif;?>

        <? if ($_REQUEST["CLINIC"] == "3"): ?>
          <img src="/upload/iblock/3ba/yjq6z8rb92aflvwmqmo3539jddhq5u5v.jpg" alt="">
        <? endif;?>

        </br></br>
        <table class="schedule__table1">
        <tbody>
        <? if ($_REQUEST["CLINIC"] == "1" || $_REQUEST["CLINIC" || $_REQUEST["CLINIC"] == "2"] == ""): ?>
        <tr><td>Понедельник - пятница</td><td>07:00-21:00</td></tr>
        <tr><td>Суббота - воскресенье</td><td>08:00-18:00</td></tr>
        <? endif;?>

        <? if ($_REQUEST["CLINIC"] == "3"): ?>
        <tr><td>Понедельник - пятница</td><td>08:00-20:00</td></tr>
        <tr><td>Суббота - воскресенье</td><td>08:00-14:00</td></tr>
        <? endif;?>
        </tbody>
        </table>
      </div>

      <div>
      <h6>График работы кабинетов</h6>
        <table class="schedule__table">
          <thead>
            <tr><th>Название кабинета</th><th>ПН</th><th>ВТ</th><th>СР</th><th>ЧТ</th><th>ПТ</th><th>СБ</th><th>ВС</th></tr>
          </thead>

          <? if ($_REQUEST["CLINIC"] == "1" || $_REQUEST["CLINIC"] == ""): ?>
          <tbody>
            <tr class="main"><td>Кабинет забора крови из пальца</td><td>08:00-11:00</td><td>08:00-11:00</td><td>08:00-11:00</td><td>08:00-11:00</td><td>08:00-11:00</td><td>08:00-11:00</td><td> - </td></tr>
            <tr><td>Кабинет функциональной диагностики<br> <span>- холтер, СМАД</span><br></td><td> 08:30-17:15 </td><td> 08:30-16:15 </td><td> 08:30-17:15 </td><td> 08:30-16:15 </td><td> 08:30-17:15 </td><td> - </td><td> - </td></tr>
            <tr><td><span>- ЭЭГ</span></td><td> 08:30-17:15 </td><td> 08:30-16:15<br> 16:40-20:00 </td><td> 08:30-17:15 </td><td> 08:30-16:15<br> 16:40-20:00 </td><td> 08:30-17:15 </td><td> - </td><td> - </td></tr>
            <tr><td><span>- ЭКГ</span></td><td> 07:00-21:00 </td><td> 07:00-21:00 </td><td> 07:00-21:00 </td><td> 07:00-21:00 </td><td> 07:00-21:00 </td><td> 08:00-18:00 </td><td> 08:00-18:00 </td></tr>
            <tr class="main"><td>Процедурный кабинет</td><td> 07:00-21:00 </td><td> 07:00-21:00 </td><td> 07:00-21:00 </td><td> 07:00-21:00 </td><td> 07:00-21:00 </td><td> 07:00-18:00 </td><td> 08:00-18:00 </td></tr>
            <tr><td>Рентгенкабинет <br><span> - рентген</span></td><td> 08:00-20:00 </td><td> 08:00-20:00 </td><td> 08:00-20:00 </td><td> 08:00-20:00 </td><td> 08:00-20:00</td><td> 09:00-13:00 </td><td> - </td></tr>
            <tr><td><span>- маммография</span></td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td></tr>
            <tr><td><span>- рентгеноскопия желудка/пищевода</span></td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td></tr>
            <tr><td><span>- ирригоскопия</span></td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td></tr>
            <tr class="main"><td>Физиокабинет</td><td> 07:00-20:00 </td><td>  07:00-20:00 </td><td>  07:00-20:00 </td><td>  07:00-20:00 </td><td>  07:00-20:00 </td><td>  08:00-18:00 </td><td>  08:00-18:00 </td></tr>
            <tr class="main"><td>Детский бассейн (от 0 до 4 лет)</td><td> 08:00-20:00 </td><td> 08:00-20:00 </td><td> 08:00-20:00 </td><td> 08:00-20:00 </td><td> 08:00-20:00 </td><td> 10:00-13:00 </td><td> - </td></tr>
          </tbody>
          <? endif;?>

          <? if ($_REQUEST["CLINIC"] == "2"): ?>
          <tbody>
            <tr><td>Кабинет забора крови из пальца</td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td></tr>
            <tr><td>Кабинет функциональной диагностики<br><span> - холтер, СМАД</span><br><span> </span></td><td> 08:00-16:00 </td><td>  08:00-16:00 </td><td>  08:00-16:00 </td><td>  08:30-16:00 </td><td>  08:00-16:00 </td><td> - </td><td> - </td></tr>
            <tr><td><span>- ЭЭГ</span></td><td> 09:00-16:00 </td><td> 09:00-16:00 </td><td> 09:00-16:00 </td><td> 09:00-16:00 </td><td> 09:00-16:00 </td><td> - </td><td> - </td></tr>
            <tr><td><span>- ЭКГ</span></td><td> 08:00-19:00 </td><td> 08:00-19:00 </td><td> 08:00-19:00 </td><td> 08:00-19:00 </td><td> 08:00-19:00 </td><td> 08:00-18:00 </td><td> 08:00-14:00 </td></tr>
            <tr><td>Процедурный кабинет</td><td> 07:00-19:00 </td><td> 07:00-19:00 </td><td> 07:00-19:00 </td><td> 07:00-19:00 </td><td> 07:00-19:00 </td><td> 08:00-18:00 </td><td> 08:00-14:00 </td></tr>
            <tr><td>Рентгенкабинет <br><span> - рентген</span></td><td>  08:00-20:00 </td><td> 08:00-20:00 </td><td> 08:00-20:00 </td><td> 08:00-20:00 </td><td> 08:00-20:00  </td><td> 09:00-13:00 </td><td> - </td></tr>
            <tr><td><span>- маммография</span></td><td>  08:00-20:00 </td><td>  08:00-20:00 </td><td> 08:00-20:00 </td><td>  08:00-20:00 </td><td>  08:00-20:00 </td><td> 09:00-13:00 </td><td> - </td></tr>
            <tr><td><span>- рентгеноскопия желудка/пищевода</span></td><td> 16:00-17:40 </td><td> 16:00-17:40 </td><td> 16:00-17:40 </td><td> 16:00-17:40 </td><td> 16:00-17:40 </td><td> 11:00-12:40 </td><td> - </td></tr>
            <tr><td><span>- ирригоскопия</span></td><td> 16:00-17:40 </td><td> 16:00-17:40 </td><td> 16:00-17:40 </td><td> 16:00-17:40 </td><td> 16:00-17:40 </td><td> 11:00-12:40 </td><td> - </td></tr>
            <tr><td>Физиокабинет</td><td> 08:00-20:00 </td><td> 08:00-20:00 </td><td> 08:00-20:00 </td><td> 08:00-20:00 </td><td> 08:00-20:00 </td><td> 09:00-13:00 </td><td> - </td></tr>
            <tr><td>Детский бассейн (от 0 до 4 лет)</td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td></tr>
          </tbody>
          <? endif;?>

          <? if ($_REQUEST["CLINIC"] == "3"): ?> 
          <tbody>
            <tr><td>Кабинет забора крови из пальца</td><td>08:00-11:00</td><td>08:00-11:00</td><td>08:00-11:00</td><td>08:00-11:00</td><td>08:00-11:00</td><td>08:00-11:00</td><td> - </td></tr>
            <tr><td>Кабинет функциональной диагностики<br><span> - холтер, СМАД</span><br><span> - ЭЭГ</span></td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td></tr>
            <tr><td><span>- ЭЭГ</span></td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td></tr>
            <tr><td><span>- ЭКГ</span></td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td></tr>
            <tr><td>Процедурный кабинет</td><td>08:00-16:00</td><td>08:00-16:00</td><td>08:00-16:00</td><td>08:00-16:00</td><td>08:00-16:00</td><td> - </td><td> - </td></tr>
            <tr><td>Рентгенкабинет <br><span>- рентген</span></td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td></tr>
            <tr><td><span>- маммография</span></td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td></tr>
            <tr><td><span>- рентгеноскопия желудка/пищевода</span></td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td></tr>
            <tr><td><span>- ирригоскопия</span></td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td></tr>
            <tr><td>Физиокабинет</td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td></tr>
            <tr><td>Детский бассейн (от 0 до 4 лет)</td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td><td> - </td></tr>
          </tbody>
          <? endif;?>
        </table>
      </div> 

    </div>
  <? /*} */?>

  <br><br>
  <h6>Расписание врачей</h6>

  <div class="all-timesheet all-timesheet--head">
    <div class="all-timesheet__head"></div>
    <div class="all-timesheet__head">Понедельник</div>
    <div class="all-timesheet__head">Вторник</div>
    <div class="all-timesheet__head">Среда</div>
    <div class="all-timesheet__head">Четверг</div>
    <div class="all-timesheet__head">Пятница</div>
    <div class="all-timesheet__head">Суббота</div>
    <div class="all-timesheet__head">Воскресенье</div>
  </div>

  <? foreach ($arResult["ITEMS"] as $arSectItem) : ?>

    <div class="all-timesheet">
      <div class="all-timesheet__title"><? echo $arSectItem['NAME'] ?></div>
      <div class="all-timesheet__block">
        <? foreach ($arSectItem['ELEMENTS'] as $arItem) : ?>

          <?
          $arWeek = array();
          foreach ($dates as $itDate) {
            $rsData = $entity_data_class::getList(array(
              "select" => array("*"),
              "order" => array("ID" => "ASC"),
              "filter" => array(
                "UF_NAME" => preg_replace('/\s+/', ' ', $arItem["NAME"]),
                "UF_CLINIC"  => $clinic,
                ">=UF_BEGIN" => date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), strtotime($itDate . " 1:0:0")),
                "<=UF_BEGIN" => date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), strtotime($itDate . " 23:0:0")),
              )
            ));
            while ($arData = $rsData->Fetch()) {
              $timeBegin =  $arData['UF_BEGIN']->format("H:i");
              $timeEnd =  $arData['UF_END']->format("H:i");
              $arWeek[] = $timeBegin . " - " . $timeEnd;
            }
          }
          ?>



          <div class="all-timesheet__flex">

            <? if ($arWeek[0]) : ?>
              <div class="all-timesheet__item" onclick="location.href='<?= $arItem['DETAIL_PAGE_URL']; ?>';">
                <div class="all-timesheet__head--mobile">Понедельник</div>
                <?
                $m = explode(' ',  $arItem["NAME"]);
                echo $m[0] . ' ' . substr($m[1], 0, 2) . '. ' . substr($m[2], 0, 2) . '.';
                ?>
                <div class="all-timesheet__time"> <?= $arWeek[0] ?> </div>
              </div>
            <? endif; ?>

            <? if ($arWeek[1]) : ?>
              <div class="all-timesheet__item" onclick="location.href='<?= $arItem['DETAIL_PAGE_URL']; ?>';">
                <div class="all-timesheet__head--mobile">Вторник</div>
                <?
                $m = explode(' ',  $arItem["NAME"]);
                echo $m[0] . ' ' . substr($m[1], 0, 2) . '. ' . substr($m[2], 0, 2) . '.';
                ?>
                <div class="all-timesheet__time"> <?= $arWeek[1] ?> </div>
              </div>
            <? endif; ?>

            <? if ($arWeek[2]) : ?>

              <div class="all-timesheet__item" onclick="location.href='<?= $arItem['DETAIL_PAGE_URL']; ?>';">
                <div class="all-timesheet__head--mobile">Среда</div>
                <?
                $m = explode(' ',  $arItem["NAME"]);
                echo $m[0] . ' ' . substr($m[1], 0, 2) . '. ' . substr($m[2], 0, 2) . '.';
                ?>
                <div class="all-timesheet__time"><?= $arWeek[2] ?> </div>
              </div>
            <? endif; ?>

            <? if ($arWeek[3]) : ?>

              <div class="all-timesheet__item" onclick="location.href='<?= $arItem['DETAIL_PAGE_URL']; ?>';">
                <div class="all-timesheet__head--mobile">Четверг</div>
                <?
                $m = explode(' ',  $arItem["NAME"]);
                echo $m[0] . ' ' . substr($m[1], 0, 2) . '. ' . substr($m[2], 0, 2) . '.';
                ?>
                <div class="all-timesheet__time"> <?= $arWeek[3] ?> </div>
              </div>
            <? endif; ?>

            <? if ($arWeek[4]) : ?>
              <div class="all-timesheet__item" onclick="location.href='<?= $arItem['DETAIL_PAGE_URL']; ?>';">
                <div class="all-timesheet__head--mobile">Пятница</div>
                <?
                $m = explode(' ',  $arItem["NAME"]);
                echo $m[0] . ' ' . substr($m[1], 0, 2) . '. ' . substr($m[2], 0, 2) . '.';
                ?>
                <div class="all-timesheet__time"> <?= $arWeek[4] ?> </div>
              </div>
            <? endif; ?>

            <? if ($arWeek[5]) : ?>
              <div class="all-timesheet__item" onclick="location.href='<?= $arItem['DETAIL_PAGE_URL']; ?>';">
                <div class="all-timesheet__head--mobile">Суббота</div>
                <?
                $m = explode(' ',  $arItem["NAME"]);
                echo $m[0] . ' ' . substr($m[1], 0, 2) . '. ' . substr($m[2], 0, 2) . '.';
                ?>
                <div class="all-timesheet__time"> <?= $arWeek[5] ?> </div>
              </div>
            <? endif; ?>

            <? if ($arWeek[6]) : ?>
              <div class="all-timesheet__item" onclick="location.href='<?= $arItem['DETAIL_PAGE_URL']; ?>';">
                <div class="all-timesheet__head--mobile">Воскресенье</div>
                <?
                $m = explode(' ',  $arItem["NAME"]);
                echo $m[0] . ' ' . substr($m[1], 0, 2) . '. ' . substr($m[2], 0, 2) . '.';
                ?>
                <div class="all-timesheet__time"> <?= $arWeek[6] ?></div>
              </div>
            <? endif; ?>

          </div>
        <? endforeach ?>
      </div>
    </div>


  <? endforeach; ?>


</div>