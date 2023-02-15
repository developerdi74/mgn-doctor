<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
?>

<div class="pagin-row page-navigation">

    <? if ($arResult["bDescPageNumbering"] === true) : ?>
        <div class="nav-pages">

            <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) : ?>
                <? if ($arResult["bSavePage"]) : ?>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>"><?= GetMessage("nav_begin") ?></a>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">&laquo;</a>
                <? else : ?>
                    <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= GetMessage("nav_begin") ?></a>
                    <? if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"] + 1)) : ?>
                        <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">&laquo;</a>
                    <? else : ?>
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">&laquo;</a>
                    <? endif ?>
                <? endif ?>
            <? endif ?>

            <? while ($arResult["nStartPage"] >= $arResult["nEndPage"]) : ?>
                <? $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1; ?>

                <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]) : ?>
                    <span class="nav-current-page">&nbsp;<?= $NavRecordGroupPrint ?>&nbsp;</span>&nbsp;
                <? elseif ($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false) : ?>
                    <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $NavRecordGroupPrint ?></a>&nbsp;
                <? else : ?>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $NavRecordGroupPrint ?></a>&nbsp;
                <? endif ?>

                <? $arResult["nStartPage"]-- ?>
            <? endwhile ?>

            <? if ($arResult["NavPageNomer"] > 1) : ?>
                <a class="previouspostslink" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>">&raquo;</a>
                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"><?= GetMessage("nav_end") ?></a>&nbsp;
            <? endif ?>

        <? else : ?>


            <div class="wp-pagenavi" role="navigation">
                <? if ($arResult["NavPageNomer"] > 1) : ?>
                    <? if ($arResult["bSavePage"]) : ?>
                        <a class="previouspostslink" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>">&laquo;</a>
                    <? else : ?>
                        <? if ($arResult["NavPageNomer"] > 2) : ?>
                            <a class="previouspostslink" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>">&laquo;</a>
                        <? else : ?>
                            <a class="previouspostslink"  href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">&laquo;</a>
                        <? endif ?>
                    <? endif ?>
                <? endif ?>

                <? while ($arResult["nStartPage"] <= $arResult["nEndPage"]) : ?>
                    <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]) : ?>
                        <span class="current">&nbsp;<?= $arResult["nStartPage"] ?>&nbsp;</span>&nbsp;
                    <? elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false) : ?>
                        <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $arResult["nStartPage"] ?></a>&nbsp;
                    <? else : ?>
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $arResult["nStartPage"] ?></a>&nbsp;
                    <? endif ?>
                    <? $arResult["nStartPage"]++ ?>
                <? endwhile ?>


                <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) : ?>
                    <a class="nextpostslink" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">&raquo;</a>
                <? endif ?>

            <? endif ?>


            <? if ($arResult["bShowAll"]) : ?>
                <noindex>
                    <? if ($arResult["NavShowAll"]) : ?>
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>SHOWALL_<?= $arResult["NavNum"] ?>=0" rel="nofollow"><?= GetMessage("nav_paged") ?></a>&nbsp;
                    <? else : ?>
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>SHOWALL_<?= $arResult["NavNum"] ?>=1" rel="nofollow"><?= GetMessage("nav_all") ?></a>&nbsp;
                    <? endif ?>
                </noindex>
            <? endif ?>

            </div>

        </div>