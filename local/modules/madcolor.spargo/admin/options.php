<?php
use Madcolor\Spargo\CSpargo;

use Bitrix\Main\HttpApplication;
use Bitrix\Main\Config\Option;

if (!CModule::IncludeModule("madcolor.spargo"))
        return false;

IncludeModuleLangFile(__FILE__);
$module_id = 'madcolor.spargo';

require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/".$module_id."/include.php"); 



// подключим языковой файл


// сформируем список закладок
$aTabs = array(
    array("DIV" => "edit1", "TAB" => GetMessage("MC_TUB_OPTIONS"), "ICON"=>"main_user_edit", "TITLE"=>GetMessage("MC_TUB_OPTIONS_TITLE")),
    array("DIV" => "edit2", "TAB" => GetMessage("rub_tab_generation"), "ICON"=>"main_user_edit", "TITLE"=>GetMessage("rub_tab_generation_title")),
  );
$tabControl = new CAdminTabControl("tabControl", $aTabs);


//------------------

$Spargo = new CSpargo();

$Spargo->GetDepartments();
$Spargo->GetRootSection();

//-----------------


require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_after.php');
?>


<form method="post" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=urlencode($module_id)?>&amp;lang=<?=LANGUAGE_ID?>">

<?
// отобразим заголовки закладок
$tabControl->Begin();
?>
<form action="<? echo($APPLICATION->GetCurPage()); ?>?mid=<? echo($module_id); ?>&lang=<? echo(LANG); ?>" method="post">

<?
// первая закладка - 
$tabControl->BeginNextTab();
?>
<tr>
    <td width="40%">Импорт разделов:</td>
    <td width="60%"><input type="checkbox" name="ACTIVE" value="Y"<?if($str_ACTIVE == "Y") echo " checked"?>></td>
</tr>

<tr>
    <td width="40%">Раздел для экспорта:</td>
    <td width="60%"><input type="checkbox" name="ACTIVE" value="Y"<?if($str_ACTIVE == "Y") echo " checked"?>></td>
</tr>

<tr>
    <td width="40%">Логин:</td>
    <td width="60%"><input type="checkbox" name="ACTIVE" value="Y"<?if($str_ACTIVE == "Y") echo " checked"?>></td>
</tr>

<tr>
    <td width="40%">Пароль:</td>
    <td width="60%"><input type="checkbox" name="ACTIVE" value="Y"<?if($str_ACTIVE == "Y") echo " checked"?>></td>
</tr>

<tr class="heading"><td colspan="2">Депортамент</td></tr>

<?
foreach( $Spargo->arrDepartments as $Departments){
?>    
<tr>
    <td width="40%"><?=$Departments['department']['name'];?></td>
    <td width="60%">id: <?=$Departments['department']['id'];?></td>
</tr>
<tr>
    <td width="40%">Источник даных:</td>
    <td width="60%"><?=$Departments['source']['id'];?></td>
</tr>
<?    
}
?>

<tr class="heading"><td colspan="2">Разделы</td></tr>
<tr>
    <td width="40%">Раздел для экспорта:</td>
    <td width="60%">
    <select name="exportSection">
        <?
            foreach( $Spargo->arrRootSection as $Section){
                echo '<option value=' . $Section["groupId"] . '>['.$Section["groupId"].'] '.$Section["name"].'</option>';
            }
        ?>   
    </select>
    </td>
</tr>

<tr>
    <td width="40%">Раздел для импорта:</td>
    <td width="60%">
    <select name="importSection">
        <?
            $res = CIBlock::GetList(Array(), Array('SITE_ID'=>'s1'), true);
            while($ar_res = $res->Fetch()){
                echo '<option value=' . $ar_res["ID"] . '>['.$ar_res["ID"].'] '.$ar_res['NAME'].'</option>';
            }
        ?>   
    </select>
    </td>
</tr>



<?
$tabControl->BeginNextTab();
?>
<tr>
    <td width="40%">22222222</td>
    <td width="60%"><input type="checkbox" name="ACTIVE" value="Y"<?if($str_ACTIVE == "Y") echo " checked"?>></td>
</tr>

<?$tabControl->Buttons();?>
<input type="submit" name="apply" value="Применить" class="adm-btn-save" />


<?
echo(bitrix_sessid_post());
?>
</form>


<?
$tabControl->End();
$tabControl->ShowWarnings("post_form", $message);
?>

<pre>
<?print_r($_REQUEST);?>
        </pre>

<? require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php"); ?>