<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
CModule::IncludeModule('iblock');
CModule::IncludeModule('highloadblock');
?>
	<?
	//$arSelect = Array("ID", "NAME", "PROPERTY_STAZH","PROPERTY_SERVICE", "PROPERTY_CLINIC", "PROPERTY_SPECIALIZATION");

	//$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", );
	$arFilter = Array("IBLOCK_ID"=>25, "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>151), $arSelect);
	while($ob = $res->GetNextElement()){
		$arrDoc=null;
		$text=null;
		 $arFields = $ob->GetFields();
		 //prnt($arFields);
   		 $arProps = $ob->GetProperties(); // свойства элемента
		 //prnt($arProps);
		 $arrDoc["ID"] = $arFields['ID'];
		 $arrDoc["NAME"] = $arFields['NAME'];

		 $text = htmlspecialchars(strip_tags(trim($arFields['PREVIEW_TEXT'])));
		 //prnt($text);
		 $arrDoc["DESCIPTION"] = $text;
		 $arrDoc["DESCIPTION"] = null;

		 $arrDoc["DETAIL_PAGE_URL"] = "https://mgn-doctor.ru".$arFields['DETAIL_PAGE_URL'];
		 $arrDoc["IBLOCK_SECTION_ID"] = $arFields['IBLOCK_SECTION_ID'];
		 $arrDoc['PICTURE'] = "https://mgn-doctor.ru".CFile::GetPath($arFields["PREVIEW_PICTURE"]);

		 $clinics=null;
		 foreach($arProps['CLINIC']['VALUE'] as $clin){
		 	$clinics = $clinics.$clin.", ";
		 }
		 $arrDoc['CLINIC'] = substr($clinics,0,-2);




		 //Получаем цену первичного приема по ID услуги
		 $min_price=1000000;
		 $arrDoc['PRICE']=0;
		 foreach ($arProps['SERVICE']['VALUE'] as $value) {
		 		$serv = CIBlockElement::GetList(Array(), array("IBLOCK_ID"=>24,"ID"=>$value), false, Array());
		 		$ob2 = $serv->GetNextElement();
		 		$arFields2 = $ob2->GetFields();
		 		$arProps2 = $ob2->GetProperties();
		 		//Сравнение разделов врача и его услуг
		 		if($arProps2['SPECIALIZATION']['VALUE'] == $arrDoc["IBLOCK_SECTION_ID"]){
			 		if(mb_stripos($arFields2['NAME'],"первичный")){
			 			$price = CPrice::GetBasePrice($arFields2['ID']);
			 			if($min_price>$price['PRICE']){
			 				$min_price = $price['PRICE'];
			 				$arrDoc['PRICE'] = round($min_price);
			 			}
			 		}
		 		}
		 }

		 		$arrDoc['RUR'] = "Первичный прием";
		 		if($arrDoc['PRICE']==0){
		 			$arrDoc['PRICE'] = 0;
		 			$arrDoc['RUR'] = "Цена неизвестна";
		 		}
		 //Получаем название специализаций
		    $hlblock = HL\HighloadBlockTable::getById(6)->fetch(); // id highload блока
			$entity = HL\HighloadBlockTable::compileEntity($hlblock);
			$entityClass = $entity->getDataClass();

			$arrDoc['SPECIALIZATION']=null;
		 foreach($arProps['SPECIALIZATION']['VALUE'] as $value){
			   $res3 = $entityClass::getList(array(
			       'select' => array('*'),
			       //'order' => array('ID' => 'ASC'),
			       'filter' => array('UF_XML_ID' => $value)
			   ));

			$row3 = $res3->fetch();
			//$arrDoc['SPECIALIZATION'][] = $row3['UF_NAME'];
			$arrDoc['SPECIALIZATION'] = $arrDoc['SPECIALIZATION'].$row3['UF_NAME'].", ";
		}
		$arrDoc['SPECIALIZATION'] = substr($arrDoc['SPECIALIZATION'],0,-2);

		//Получение привязанных разделов
			$item4 = $arFields['IBLOCK_SECTION_ID'];
			$arFilter4 = Array('IBLOCK_ID'=>25,'ID'=>$item4);
			$res4 = CIBlockSection::GetList(Array(), $arFilter4);
			while($ob4 = $res4->GetNextElement()){
				$arFields4 = $ob4->GetFields();
				$arrDoc['SECTION'] = array('ID'=>$arFields4['ID'], 'NAME'=>$arFields4['NAME'],'CODE'=>$arFields4['CODE'],'SECTION_PAGE_URL'=>$arFields4['SECTION_PAGE_URL']);
			}
			//prnt($arrDoc['SECTION']);

		//Получение привязанных разделов к врачу
			$list_group="";
			$db_old_groups = CIBlockElement::GetElementGroups($arFields['ID'], true, array("ID","CODE","NAME"));
			while($ar_group = $db_old_groups->Fetch()){
				if($list_group==""){
					$list_group = $ar_group["CODE"];
				}else{
			   		$list_group = $list_group.", ".$ar_group["CODE"];
				}
			}
			$arrDoc['SECTION']['CODE'] = $list_group;



		//Стаж
			$str = $arProps['STAZH']['VALUE'];
			$result = preg_replace("/[^,.0-9]/", '', $str);

		 $arrDoc['STAZH'] = $result;
		 if(empty($arrDoc['STAZH'])){
		 	$arrDoc['STAZH']=0;
		 }

		 if($arProps['AGE']['VALUE_ENUM_ID'][0] == 110 || $arProps['AGE']['VALUE_ENUM_ID'][0] == 110){
		 	$arrDoc['AGE'] = 1;
		 }

		 $DOCS[] = $arrDoc;
	}


		//Получение привязанных разделов
				//prnt($value);
				$arFilter = Array('IBLOCK_ID'=>25,);
				$res4 = CIBlockSection::GetList(Array(), $arFilter);
				while($ob = $res4->GetNextElement()){
					$arFields = $ob->GetFields();
					if($arFields['ID']==1393 or $arFields['ID']==1398 or $arFields['ID']==1659 or $arFields['ID']==94){
						continue;
					}
					$CATEGORYES[] = array("ID"=>$arFields['ID'],"NAME"=>$arFields['NAME'],"LINK"=>"https://mgn-doctor.ru".$arFields['SECTION_PAGE_URL'],"CODE"=>$arFields['CODE']);
				}

	//prnt($CATEGORYES);
?>
<?
echo count($CATEGORYES);
	$dom = new domDocument("1.0", "utf-8");
	//$name = strval("yml_catalog date=".date("Y-m-dTH:m:s+3:00"));
	$root = $dom->createElement("yml_catalog");
	$root->setAttribute('date',date("Y-m-d H:m:s"));
	$shop = $dom->createElement("shop");

	$name = $dom->createElement("name", "Семейный Доктор");
	$shop->appendChild($name);
	$url = $dom->createElement("url", "https://mgn-doctor.ru/");
	$shop->appendChild($url);
	$email = $dom->createElement("email", "info@mgn-doctor.ru");
	$shop->appendChild($email);
	$picture = $dom->createElement("picture", "https://mgn-doctor.ru/local/templates/mgn-doctor/img/main_logo.svg");
	$shop->appendChild($picture);
	$description = $dom->createElement("description", "Каталог врачей");
	$shop->appendChild($description);

	$currencies = $dom->createElement("currencies");
	$currencie = $dom->createElement("currency");
	$currencie->setAttribute('id','RUR');
	$currencie->setAttribute('rate','1');
	$currencies->appendChild($currencie);
	$shop->appendChild($currencies);

	$categories = $dom->createElement("categories");
	$categori = $dom->createElement("category","Врач");
	$categori->setAttribute('id',1);
	$categories->appendChild($categori);
	// foreach($CATEGORYES as $item){
	// 	$categori = $dom->createElement("category",$item["NAME"]);
	// 	$categori->setAttribute('id',$item["ID"]);
	// 	$categories->appendChild($categori);
	// }
	$shop->appendChild($categories);

	$sets = $dom->createElement("sets");
	foreach($CATEGORYES as $item){
		$set = $dom->createElement("set");
		$set->setAttribute('id',$item["CODE"]);
		$name = $dom->createElement("name",$item["NAME"]);
		$url = $dom->createElement("url",$item["LINK"]);
		$set->appendChild($name);
		$set->appendChild($url);
		$sets->appendChild($set);
	}
	$shop->appendChild($sets);

	$offers = $dom->createElement("offers");
		$group_id=0;
	foreach($DOCS as $item){
		$group_id++;
		if($item['SECTION']['ID']==1393 || $item['SECTION']['ID']==1398|| $item['SECTION']['ID']==94){
			continue;
		}
		$offer = $dom->createElement("offer");
			$offer->setAttribute('id',$item["ID"]);
			$offer->setAttribute('group_id',$group_id);

			$name = $dom->createElement("name",$item["NAME"]);
			$offer->appendChild($name);

			$url = $dom->createElement("url",$item["DETAIL_PAGE_URL"]);
			$offer->appendChild($url);

			$price = $dom->createElement("price",$item["PRICE"]);
			$price->setAttribute('from','true');
			$offer->appendChild($price);

			$currenciid = $dom->createElement("currencyId","RUR");
			$offer->appendChild($currenciid);

			$sales_notes = $dom->createElement("sales_notes",$item['RUR']);
			$offer->appendChild($sales_notes);
			$sets_id = $dom->createElement("set-ids", $item['SECTION']['CODE']);
			$offer->appendChild($sets_id);

			$picture = $dom->createElement("picture", $item['PICTURE']);
			$offer->appendChild($picture);

			if($item['DESCIPTION']){
			$description = $dom->createElement("description", $item['DESCIPTION']);
			$offer->appendChild($description);
			}

			//$categoriid = $dom->createElement("categoryId", $item['SECTION']['ID']);
			$categoriid = $dom->createElement("categoryId", 1);
			$offer->appendChild($categoriid);

			$name_clinic = $dom->createElement("param", "Семейный доктор");
			$name_clinic->setAttribute('name',"Название клиники");
			$offer->appendChild($name_clinic);

			if($item['CLINIC']){
				$params = $dom->createElement("param", $item['CLINIC']);
				$params->setAttribute('name',"Адрес клиники");
				$offer->appendChild($params);
			}

			$stazh = $dom->createElement("param", $item['STAZH']);
			$stazh->setAttribute('name',"Годы опыта");
			$offer->appendChild($stazh);

			if($item['AGE']==1){
				$age = $dom->createElement("param", "true");
				$age->setAttribute('name',"Детский врач");
				$offer->appendChild($age);
			}
			if($item['SPECIALIZATION']){
				$specilization = $dom->createElement("param", $item['SPECIALIZATION']);
				$specilization->setAttribute('name',"Специализация");
				$offer->appendChild($specilization);
			}

			$phone = $dom->createElement("param", "+7 (3519) 581-111");
			$phone->setAttribute('name',"Телефон для записи");
			$offer->appendChild($phone);

			$city = $dom->createElement("param", "Магнитогорск");
			$city->setAttribute('name',"Город");
			$offer->appendChild($city);

			$link_detail = $dom->createElement("param", $item["DETAIL_PAGE_URL"]);
			$link_detail->setAttribute('name',"Ссылка на профиль врача");
			$offer->appendChild($link_detail);

			$rew = $dom->createElement("param", "1");
			$rew->setAttribute('name',"Число отзывов");
			$offer->appendChild($rew);

			$rew2 = $dom->createElement("param", "1.0");
			$rew2->setAttribute('name',"Средняя оценка");
			$offer->appendChild($rew2);

			$saving = $dom->createElement("param", "true");
			$saving->setAttribute('name',"Возможность записи");
			$offer->appendChild($saving);

			$saving2 = $dom->createElement("param", "true");
			$saving2->setAttribute('name',"Онлайн-расписание");
			$offer->appendChild($saving2);

		$offers->appendChild($offer);
	}
	$shop->appendChild($offers);



	$root->appendChild($shop);
	$dom->appendChild($root);
 	$dom->save("doctors.xml");
?>
	<a href='doctors.xml'>ssss</a>
<?

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>