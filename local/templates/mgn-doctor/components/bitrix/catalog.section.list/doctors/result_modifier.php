<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(AGE==111){
    foreach ($arResult['SECTIONS'] as $key => $arSection):
        if ($arSection['ID'] == 1397) {
            unset($arResult['SECTIONS'][$key]);
            break;
        }
    endforeach;
}