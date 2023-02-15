<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);?>

			<div class="row all-specialists">
					<?$bukva="X";
					$arrCount = -1;
					$firstLine=0;?>
					<?foreach ($arResult['SECTIONS'] as &$arSection):?>
					<?$activeElements=null;
						$arFilter = Array(
						"IBLOCK_ID"=>25,
						"SECTION_ID" => $arSection['ID'],
						"PROPERTY_AGE" => AGE, //фильтр возраста
						);

						$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, Array("ID"));
						if($count = $res->fetch()){
							$activeElements[] = $count;
						}
						if(count($activeElements)==none){
							continue;
						}

					?>
						<? $firstLetter = mb_substr($arSection["NAME"],0,1);
						if($bukva==$firstLetter){
							$bukva = $bukva;
						}else{
							$bukva = $firstLetter;
							$smena = 1;
							$arrCount++;

						}?>
						<?if($bukva!="Э"):?>
							<?if($arrCount==5): $arrCount=0; $pom=1;?></div><?endif;?>
							<?if($arrCount==0): if($arrCount==0){$arrCount++;}?><div class="col-xl-3 col-md-6 col-sm-6"><?endif;?>
						<?endif;?>
						<?if($smena == 1): $smena = 0;//закрыть тег .block_list_vr?>
							<?if($firstLine!=0){ ?><div class='delitel_vr'></div><?}else {$firstLine++;}?>
								<div class="row">
									<b><?=$bukva?></b>
								</div>
							<?endif;?>
							<?
									$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
									$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
							?>
							<? if($arSection["ELEMENT_CNT"]>0){ ?>
								<div id="<?=$this->GetEditAreaId($arSection['ID']);?>" class="row">
									<a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><?=$arSection["NAME"];?><?//=$arSection["ELEMENT_CNT"]?></a></div>
							<?}?>

					<?endforeach;?>
			</div>

