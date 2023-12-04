<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<div class="other-doc-cnt">
    <? if($arResult['ITEMS']): ?>
    <div class="bg-text">
        Извините, у данного врача нет свободной записи в ближайшее время. Предлагаем Вам записаться к другим специалистам:
    </div>
    <div class="dop-doc-list ">
        <? foreach ($arResult['ITEMS'] as $item): ?>
            <div class="dop-doc-item">
                <div class="dop-doc-img">
                    <img height="70" width="70" src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="">
                </div>
                <div class="dop-doc-name">
                    <div>
                        <a href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a>
                    </div>
                    <div>
                        <?
                        $str="";
                        if(is_array($item["DISPLAY_PROPERTIES"]["SPECIALIZATION"]["DISPLAY_VALUE"])){
                            foreach ($item["DISPLAY_PROPERTIES"]["SPECIALIZATION"]["DISPLAY_VALUE"] as $end=>$sp){
                                if($end == count($item["DISPLAY_PROPERTIES"]["SPECIALIZATION"]["DISPLAY_VALUE"])-1){
                                    $str .= $sp;
                                }else{
                                    $str .= $sp.", ";
                                }
                            }
                        }else{
                            $str = $item["DISPLAY_PROPERTIES"]["SPECIALIZATION"]["DISPLAY_VALUE"];
                        }
                        echo $str;
                         ?>
                    </div>
                    <span></span>
                </div>
            </div>
        <? endforeach;?>
    </div>
    <? else:?>
        <div class="bg-text">
            Извините, у данного врача нет свободной записи в ближайшее время.
        </div>
    <? endif; ?>
</div>
<?// dd($arResult['ITEMS'][2]);?>
