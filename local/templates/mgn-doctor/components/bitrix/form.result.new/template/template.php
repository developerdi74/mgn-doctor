<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if($arResult["isFormErrors"]=="Y"){?>
	<? $arResult["FORM_ERRORS_TEXT"]; ?>
<?}?>
<?if($_GET['success']==1){ //после успешного выполнения перезагрузка страницы для отображения записи принятых данных?>
	<h4 class="popup__title"><?=$arResult["FORM_TITLE"]?></h4>
	<div class="popup__subtitle" style = "display:block">Ваши данные приняты. Для подтверждения записи ожидайте звонка оператора.</div>
<?}else{?>
<?$arResult["FORM_NOTE"]?>
<h4 class="popup__title"><?=$arResult["FORM_TITLE"]?></h4>
<div class="popup__subtitle">Ваши данные приняты. Для подтверждения записи ожидайте звонка оператора.</div>
<div class="popup__form">
	<?=$arResult["FORM_HEADER"]?>
	<?foreach($arResult["QUESTIONS"] as $FIELD_SID=>$arQuestion){
		if($arQuestion['STRUCTURE'][0]['FIELD_TYPE']=='hidden'){
			echo $arQuestion["HTML_CODE"];
		}
		else{?>
			<? if($arQuestion["CAPTION"]=="Согласен на обработку персональных данных."){ ?>
				<div class="popup-item">
					<div class="form-accept">
						<span><?=$arQuestion["HTML_CODE"]?></span>
						<span class="checkbox-text"><?=$arQuestion["CAPTION"]?> <noindex><a href="/personal/privaci.php" target="_blank">Политика конфиденциальности</a></noindex></span>
					</div>
				</div>
			<?}else{?>
				<div class="popup-item">
					<label>
						<?=$arQuestion["CAPTION"]?>
						<?if($arQuestion["REQUIRED"]=="Y"){?> *<?}?>
						<span class="form-control-wrap your-name"><?=$arQuestion["HTML_CODE"]?></span>
					</label>
				</div>
			<?}
		}
	}?>
	<div class="popup-item">
		<input class="btn-submit btn btn-green popup-btn" <?=(intval($arResult["F_RIGHT"])<10?"disabled=\"disabled\"":"");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"])==''?GetMessage("FORM_ADD"):$arResult["arForm"]["BUTTON"]);?>"/>
	</div>
	<?=$arResult["FORM_FOOTER"]?>
	<?if($arResult["isUseCaptcha"]=="Y"){}?>
</div>
<?}?>