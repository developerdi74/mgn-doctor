<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<div class="container form-load-ankets">
<?php
if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><? endif; ?>
    <?if($arResult['FORM_NOTE']):?>
        <div class="success_message_file_load">
            Спасибо! Ваша анкета принята!
            <?//= $arResult["FORM_NOTE"] ?>
        </div>
    <?endif;?>
<? if ($arResult["isFormNote"] != "Y") {?>
    <?= $arResult["FORM_HEADER"] ?>
    <table>
        <?
        if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y") {?>
            <tr>
                <td><?
                    if ($arResult["isFormTitle"]) {?>
                        <h3><?= $arResult["FORM_TITLE"] ?></h3>
                        <? }
                    if ($arResult["isFormImage"] == "Y") {
                        ?>
                        <a href="<?= $arResult["FORM_IMAGE"]["URL"] ?>" target="_blank"
                           alt="<?= GetMessage("FORM_ENLARGE") ?>">
                            <img src="<?= $arResult["FORM_IMAGE"]["URL"] ?>" <? if ($arResult["FORM_IMAGE"]["WIDTH"] > 300): ?>width="300"
                                                                        <? elseif ($arResult["FORM_IMAGE"]["HEIGHT"] > 200): ?>height="200"<? else:?><?= $arResult["FORM_IMAGE"]["ATTR"] ?><? endif;
                            ?> hspace="3" vscape="3" border="0"/></a>
                        <?}?>

                    <p><?= $arResult["FORM_DESCRIPTION"] ?></p>
                </td>
            </tr>
            <? }?>
    </table>
    <br/>
    <table class="form-table data-table">
        <tbody>
        <?
        foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
            if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
                echo $arQuestion["HTML_CODE"];
            } else {?>
                <tr>
                    <td class="text-right">
                        <? if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
                            <span class="error-fld" title="<?= htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID]) ?>"></span>
                        <?endif; ?>
                        <?= $arQuestion["CAPTION"] ?><? if ($arQuestion["REQUIRED"] == "Y"):?><?= $arResult["REQUIRED_SIGN"]; ?><?endif; ?>
                        <?= $arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />" . $arQuestion["IMAGE"]["HTML_CODE"] : "" ?>
                    </td>
                    <? $input = str_ireplace(".", "", $arQuestion["HTML_CODE"]) ?>
                    <? $input = str_ireplace("<br />", "", $input) ?>
                    <td><?=$input?></td>
                </tr>
                <?
            }
        }
        if ($arResult["isUseCaptcha"] == "Y") {
            ?>
            <tr>
                <td class="text-right"><?= GetMessage("FORM_CAPTCHA_FIELD_TITLE") ?><?= $arResult["REQUIRED_SIGN"]; ?></td>
                <td><input type="hidden" name="captcha_sid"
                           value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>"/><img
                            src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>"
                            width="180" height="40"/>
                    <input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext"/></td>
            </tr>
            <?
        } // isUseCaptcha
        ?>
        </tbody>
        <tfoot>
        <tr>
            <th colspan="2" class="text-center">
                <input <?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : ""); ?> type="submit" name="web_form_submit" value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>"/>
                <?/* if ($arResult["F_RIGHT"] >= 15):?>
                    <input type="hidden" name="web_form_apply" value="Y"/>
                    <input type="submit" name="web_form_apply" value="<?= GetMessage("FORM_APPLY") ?>"/>
                <? endif; */?>
                &nbsp;<input type="reset" value="<?= GetMessage("FORM_RESET"); ?>"/>
            </th>
        </tr>
        </tfoot>
    </table>
    <p class="text-center">
        <?= $arResult["REQUIRED_SIGN"]; ?> - <?= GetMessage("FORM_REQUIRED_FIELDS") ?>
    </p>
    <?= $arResult["FORM_FOOTER"] ?>
    <?
} //endif (isFormNote)?>
</div>
