<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.11.2022
 * Time: 13:40
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/specialists/Calendar.php');
$calendar=new wk00FF\Calendar($_REQUEST['month']?$_REQUEST['month']:0, $_REQUEST['age']?$_REQUEST['age']:111, $_REQUEST['specialization'], $_REQUEST['service'], $_REQUEST['doctor'], $_REQUEST['clinic']);
echo $calendar->getInterval();
echo "<script>calendarInit()</script>";
