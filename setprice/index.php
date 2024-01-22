<?php
require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
if(!$USER->IsAdmin()){
    echo "Закрыто";
    exit;
}  

CModule::IncludeModule("catalog");
//http://192.168.19.90/api/dop/services/
//https://dev2.mgn-doctor.ru/setprice/
$chance = 59;
//dd(getDataMedialog('services','dop'));
$new = getDataMedialog('services','dop');

//$sections = getSections();
$sections = [];
//dd($new[0]);

$exclude=['Прием (осмотр, консультация)',
'прием','Прием','-',' - ','врача','акушера',
'  ','   ','1-й триместр','2-й триместр',
'3-й триместр','Рентгенологическое исследование',
'Внутривенное капельное введение',
];
    
/*
[0]=>
  array(7) {
    [0]=>
    string(9) "Узи50*"
    [1]=>
    string(5) "18795"
    [2]=>
    string(37) "Эластометрия печени"
    [3]=>
    string(9) "2500.0000"
    [4]=>
    string(23) "2023-12-26 00:00:00.000"
    [5]=>
    string(1) "1"
    [6]=>
    string(51) "Ультразвуковая диагностика"
  }*/
$old = getServiceIblock(24);
$del=0;
foreach ($old as $key=>$item){
    foreach ($new as $nom=>$n){
        /*if($n[3]-$item['CATALOG_PRICE_1']>500 || $n[3]-$item['CATALOG_PRICE_1']<-500){
            continue;
        }*/
        if(!empty($item['PROPERTY_FM_SERV_ID']) && $n[1] == $item['PROPERTY_FM_SERV_ID']){
            $pre="";
            if($n[3]>$item['CATALOG_PRICE_1']){
                setPrice($item['ID'], $n[3]);
                echo $pre."Изменена цена для <a href='/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=24&type=mgn_doctor_service&lang=ru&ID=".$item['ID']."'>".$item['NAME']."</a>";
                echo "<br>";
            }else{
                $pre="НЕ ";
            }
            unset($old[$key]);
            unset($new[$nom]);
            $del++;
            break;
        }else{
            $a=trim(str_replace($exclude," ",$item['NAME']));
            $b=trim(str_replace($exclude," ",$n[2]));
            $restext = similar_text($a,$b,$perc);
            if($perc >= $chance){
                $old[$key]['SIMILAR'][]=$n;
            }
        }
    }
}
vd($del);
?>
<script
    src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
<table border="1">
    <tr>
        <td>#</td>
        <td>ID</td>
        <td>Название на сайте</td>
        <td>Текущая цена</td>
        <?/*<td>FM_SERV_ID</td>*/?>
        <td>Схожие услуги</td>
    </tr>
    <? foreach ($old as $key=>$item):
        break;
    ?>
        <?if(isset($item['SIMILAR']) || $chance==99):?>
        <tr>
            <td><?=$key?></td>
            <td><?=$item['ID']?></td>
            <td><a href="/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=24&type=mgn_doctor_service&lang=ru&ID=<?=$item['ID']?>"><?=$item['NAME']?></a></td>
            <td><?=$item['CATALOG_PRICE_1']?></td>
            <?/*<td><?=$item['PROPERTY_FM_SERV_ID']?></td>*/?>
            <td>
                <table border="1">
                    <tr>
                        <td>FM_SERV_ID</td>
                        <td>название</td>
                        <td>Цена(м-г)</td>
                        <td>Выбор</td>
                    </tr>
                    <? foreach ($item['SIMILAR'] as $sim):?>
                        <tr>
                            <td><?=$sim[1]?></td>
                            <td><?=$sim[2]?></td>
                            <td><?=$sim[3]?></td>
                            <td><span href="" class="setprice" data="?id=<?=$item['ID']?>&servid=<?=$sim[1]?>&price=<?=$sim[3]?>">Установить</span></td>
                        </tr>
                    <? endforeach;?>
                </table>
            </td>
        </tr>
        <?endif;?>
    <? endforeach; ?>
</table>
<? vd(count($new)); ?>
<table border="1">
    <tr>
        <td>#</td>
        <td>FM_SERV_ID</td>
        <td>Названи</td>
        <td>Текущая цена</td>
        <td>Раздел</td>
        <td>Раздел на сайте</td>
        <td>Действия</td>
    </tr>
<? foreach($new as $key=>$n):?>
    <tr class="closest">
        <td><?=$key?></td>
        <td class="serv-id"><?=$n[1]?></td>
        <td class="title"><?=$n[2]?></td>
        <td class="price"><?=$n[3]?></td>
        <td ><?=$n[6]?></td>
        <td>
            <input type="text" class='inputsect'>
            <select name="" class="select-sect">
                <?foreach ($sections as $sect):?>
                    <option value="<?=$sect['ID']?>"><?=$sect['NAME']?></option>
                <?endforeach;?>
            </select>
        </td>
        <td>
            <button class="addserv">ДОБАВИТЬ</button>
        </td>
    </tr>
<? endforeach;?>
</table>
<? ?>



    <?
    function getServiceIblock($id){
        $arSelect = Array("ID", "IBLOCK_ID", "NAME","CATALOG_PRICE_1","PROPERTY_FM_SERV_ID");
        $arFilter = Array(
            //"%NAME"=>"Медицинский",
            "IBLOCK_ID"=>IntVal($id),
            //"!PROPERTY_FM_SERV_ID"=>false,
            "ACTIVE"=>"Y"
        );
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1500,'iNumPage'=>1), $arSelect);
        while($ob = $res->GetNextElement()){
            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();
            $data[] = [
                "ID" => $arFields['ID'],
                "NAME" => $arFields['NAME'],
                "CATALOG_PRICE_1" => $arFields['CATALOG_PRICE_1'],
                "PROPERTY_FM_SERV_ID" => $arProps['FM_SERV_ID']['VALUE']
            ];
        }
        return $data;
    }

    function getSections(){
        $arFilter = Array('IBLOCK_ID'=>24);
        $db_list = CIBlockSection::GetList(Array('NAME'=>"asc"), $arFilter,false,Array('ID','NAME'));
        while($ar_result = $db_list->GetNext()) {
            $data[]=$ar_result;
        }
        return $data;
    }



    ?>
    <script>
        $('.setprice').click(function (){
            console.log('asdsadsad');
            let get = $(this).attr('data');
            $.ajax({
                url: '/setprice/setprice.php'+get,         /* Куда отправить запрос */
                method: 'get',             /* Метод запроса (post или get) */
                dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
                success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
                    $(this).html('ОТПРАВЛЕНО');
                }
            });
            return false;
        });

        $('.addserv').click(function (){
            let parent=$(this).closest('.closest');
            let servid=parent.find('.serv-id').html();
            let title=parent.find('.title').html();
            let price=parent.find('.price').html();
            let sect = parent.find('.inputsect').val();
            let get = "?title="+title+"&servid="+servid+"&price="+price+"&sect="+sect;

            console.log(get);

            $.ajax({
                url: '/setprice/addservice.php'+get,         /* Куда отправить запрос */
                method: 'get',             /* Метод запроса (post или get) */
                dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
                success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
                    $(this).html('ОТПРАВЛЕНО');
                }
            });
            return false;
        })
    </script>
    <style>
        .setprice{
            cursor: pointer;
        }
    </style>