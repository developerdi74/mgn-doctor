<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?
if(count($arResult['ITEMS'])>0):?>
    <div>
        <b><span style="color: #3e6617;">ОТКРЫТЫЕ ВАКАНСИИ:</span></b><br><br>
    </div>

	<?foreach($arResult['ITEMS'] as $item):?>
    <div class="item-vac">
        <div class="title-vac">
            <?=$item['NAME']?>
        </div>
        <div>
            <?=$item['~DETAIL_TEXT']?>
        </div>
        <div>
            <b><?=$item['PREVIEW_TEXT']?></b>
        </div>
    </div>
    <?endforeach;?>
<? endif;?>
