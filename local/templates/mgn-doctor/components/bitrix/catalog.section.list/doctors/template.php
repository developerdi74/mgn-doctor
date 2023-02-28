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

			<div class="row row-all-specialists">
					<?$bukva="X";
					$arrCount = -1;
					$firstLine=0;
					$cntSec = count($arResult['SECTIONS']);
					$intSec=(int)($cntSec/4);?>
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
						if(count($activeElements)==null){ //Изменено при переходе с none
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


							<?if($smena == 1): $smena = 0;?>
							<?if($arrCount != 0){ echo "</div>"; $arrCount++;} //Закрытие block_row_vr?>
								<div class="block_row_vr">
								<div>
									<b><?=$bukva?></b>
								</div>
							<?endif;?>
							<?
									$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
									$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
							?>
							<? if($arSection["ELEMENT_CNT"]>0){ ?>
								<div id="<?=$this->GetEditAreaId($arSection['ID']);?>" class="">
									<a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><?=$arSection["NAME"];?><?//=$arSection["ELEMENT_CNT"]?></a></div>
							<?}?>

					<?endforeach;?>
					</div> <?//закрытие block_row_vr?>

			</div>