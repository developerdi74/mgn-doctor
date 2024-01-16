<?php
require ($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
CModule::IncludeModule("catalog");
//http://192.168.19.90/api/dop/services/
//https://dev2.mgn-doctor.ru/setprice/
$chance = 90;
//dd(getDataMedialog('services','dop'));
$new = getDataMedialog('services','dop');
$exclude=['Прием (осмотр, консультация)','прием','Прием','-'];
//dd($new);
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
foreach ($old as $key=>$item){
    foreach ($new as $n){
        if(!empty($item['PROPERTY_FM_SERV_ID']) && $n[1] == $item['PROPERTY_FM_SERV_ID']){
            $pre="";
            if($n[3]>$item['CATALOG_PRICE_1']){
                setPrice($item['ID'], $n[3]);
            }else{
                $pre="НЕ ";
            }
            echo $pre."Изменена цена для <a href='/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=24&type=mgn_doctor_service&lang=ru&ID=".$item['ID']."'>".$item['NAME']."</a>";
            echo "<br>";
            unset($old[$key]);
            break;
        }else{
            $a=trim(str_replace($exclude,"",$item['NAME']));
            $b=trim(str_replace($exclude,"",$n[2]));
            $restext = similar_text($a,$b,$perc);
            if($perc >= $chance){
                $old[$key]['SIMILAR'][]=$n;
            }
        }
    }
}

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
    <? foreach ($old as $key=>$item):?>
        <?if(isset($item['SIMILAR'])):?>
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

    <?
    function getServiceIblock($id){
        $arSelect = Array("ID", "IBLOCK_ID", "NAME","CATALOG_PRICE_1","PROPERTY_FM_SERV_ID");
        $arFilter = Array(
            //"%NAME"=>"прием",
            "IBLOCK_ID"=>IntVal($id)
        );
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>800,'iNumPage'=>1), $arSelect);
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

    function setPrice($PRODUCT_ID, $price){
        $arFields = Array(
            "PRODUCT_ID" => $PRODUCT_ID,
            "PRICE" => $price,
        );
        $res = CPrice::GetList(
            array(),
            array(
                "PRODUCT_ID" => $PRODUCT_ID,
            )
        );
        if ($arr = $res->Fetch()){
            CPrice::Update($arr["ID"], $arFields);
        }else{
            CPrice::Add($arFields);
        }

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
        })
    </script>
    <style>
        .setprice{
            cursor: pointer;
        }
    </style>