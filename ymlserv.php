<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
CModule::IncludeModule('iblock');
CModule::IncludeModule('highloadblock');?>
<pre>
<?php

	$arSelect=['ID','NAME', 'IBLOCK_NAME', 'IBLOCK_NAME', 'IBLOCK_SECTION_ID', 'IBLOCK_NAME', 'IBLOCK_NAME', 'IBLOCK_NAME'];
	$arFilter = Array(
		"IBLOCK_ID"=>24,
		"ACTIVE"=>"Y",
		'?NAME' => "%первич% | %узи% | %рентген% | %комис%",
		);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1151), $arSelect);
	while($ob = $res->GetNextElement()){

		$item = $ob->fields;
		$id_sect = $ob->fields['IBLOCK_SECTION_ID'];

		$price = CPrice::GetBasePrice($item['ID']);
		$min_price =  round($price['PRICE']);

		$id_sectp = getParentSections($id_sect)[0];
		if($id_sectp == 1355){
			continue;
		}
		$ressection = CIBlockSection::GetByID($id_sectp);
		if($ar_resS = $ressection->GetNext())
			$name_section = $ar_resS['NAME'];

		$categories_section[$id_sectp] = [
			"ID" => $id_sectp,
			"NAME" => $name_section,
		];
		$services[] = [
			"SERV" => $item,
			"PRICE" => $min_price,
			"SECTION_PARENT" => [
				"ID" => $id_sectp,
				"NAME" => $name_section,
			]
		];
	}
//print_r($categories_section);

function getParentSections($section_id){

	$result = array();

	$nav = CIBlockSection::GetNavChain(false, $section_id);
	while($v = $nav->GetNext()) {

		if($v['ID']) {
			Bitrix\Main\Diag\Debug::writeToFile('ID => ' . $v['ID']);
			Bitrix\Main\Diag\Debug::writeToFile('NAME => ' . $v['NAME']);
			Bitrix\Main\Diag\Debug::writeToFile('DEPTH_LEVEL => ' . $v['DEPTH_LEVEL']);
			$result[] = $v['ID'];
		}
	}

	return $result;
}
?>
<?

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
	foreach ($categories_section as $category){
		$categori = $dom->createElement("category", $category['NAME']);
		$categori->setAttribute('id',$category['ID']);
		$categories->appendChild($categori);
	}
	$shop->appendChild($categories);


	$offers = $dom->createElement("offers");
		$group_id=0;
	foreach($services as $item){
		//print_r($item);
		$group_id++;
		$offer = $dom->createElement("offer");
			$offer->setAttribute('id',$item['SERV']["ID"]);
		$offer->setAttribute('available','true');

			$name = $dom->createElement("name",$item['SERV']["NAME"]);
			$offer->appendChild($name);

			$price = $dom->createElement("price",$item["PRICE"]);
			$price->setAttribute('from','true');
			$offer->appendChild($price);

			$currenciid = $dom->createElement("currencyId","RUR");
			$offer->appendChild($currenciid);

			$categoriid = $dom->createElement("categoryId", $item['SECTION_PARENT']["ID"]);
			$offer->appendChild($categoriid);

		$offers->appendChild($offer);
	}
	$shop->appendChild($offers);



	$root->appendChild($shop);
	$dom->appendChild($root);
 	$dom->save("services.xml");
?>
	<a href='services.xml'>ssss</a>
<?

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>