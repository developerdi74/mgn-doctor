<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true); ?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if ($INPUT_ID == '')
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if ($CONTAINER_ID == '')
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if ($arParams["SHOW_INPUT"] !== "N") : ?>

	<div id="<? echo $CONTAINER_ID ?>" class="inline-search-block search-block ">
		<div class="container">
			<div class="col-md-12">
				<div class="search-wrapper">
					<div id="title-search">
						<form action="<? echo $arResult["FORM_ACTION"] ?>" class="search">
							<div class="search-input-div">
								<input id="<? echo $INPUT_ID ?>" class="search-input" placeholder="Поиск" type="text" name="q" value="" size="20" maxlength="50" autocomplete="off" />
							</div>
							<div class="search-button-div">
								<button class="btn btn-search search-block__btn" type="submit" name="s" value="Найти">Найти</button>
								<span class="close-block inline-search-hide"><span class="svg svg-close close-icons"></span></span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>




<? endif ?>



<script>
	BX.ready(function() {
		new JCTitleSearch({
			'AJAX_PAGE': '<? echo CUtil::JSEscape(POST_FORM_ACTION_URI) ?>',
			'CONTAINER_ID': '<? echo $CONTAINER_ID ?>',
			'INPUT_ID': '<? echo $INPUT_ID ?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>