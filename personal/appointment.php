<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem;

global $USER;

Bitrix\Main\Loader::includeModule("sale");
Bitrix\Main\Loader::includeModule("catalog");


$address = $_POST['ADDRESS'];
$age = $_POST['AGE'];
$ID = $_POST['SERVICE'];
$specialization = $_POST['SPECIALIZATION'];
$doctor = $_POST['DOCTOR'];
$time =  $_POST['DATE'] . ' ' . $_POST['TIME'];

$email = $_POST['EMAIL'];
$phone = $_POST['PHONE'];
$surname = $_POST['SURNAME'];
$name = $_POST['NAME'];
$patronymic = $_POST['PATRONYMIC'];


$siteId = Context::getCurrent()->getSite();
$currencyCode = CurrencyManager::getBaseCurrency();


// Создаёт новый заказ
$order = Order::create($siteId, $USER->isAuthorized() ? $USER->GetID() : 2);
$order->setPersonTypeId(1);
$order->setField('CURRENCY', $currencyCode);
$order->setField('USER_DESCRIPTION', "Семейный доктор");


// Создаём корзину с одним товаром
$basket = Basket::create($siteId);
$item = $basket->createItem('catalog', $ID);
$item->setFields(array(
    'QUANTITY' => 1,
    'CURRENCY' => $currencyCode,
    'LID' => $siteId,
    'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
));
$basket->save();

$order->setBasket($basket);


// Создаём одну отгрузку и устанавливаем способ доставки - "Без доставки" (он служебный)
$shipmentCollection = $order->getShipmentCollection();
$shipment = $shipmentCollection->createItem();
$service = Delivery\Services\Manager::getById(Delivery\Services\EmptyDeliveryService::getEmptyDeliveryServiceId());
$shipment->setFields(array(
    'DELIVERY_ID' => $service['ID'],
    'DELIVERY_NAME' => $service['NAME'],
));
$shipmentItemCollection = $shipment->getShipmentItemCollection();
$shipmentItem = $shipmentItemCollection->createItem($item);
$shipmentItem->setQuantity($item->getQuantity());


// Создаём оплату со способом #1
$paymentCollection = $order->getPaymentCollection();
$payment = $paymentCollection->createItem();
$paySystemService = PaySystem\Manager::getObjectById(3);
$payment->setFields(array(
    'PAY_SYSTEM_ID' => $paySystemService->getField("PAY_SYSTEM_ID"),
    'PAY_SYSTEM_NAME' => $paySystemService->getField("NAME"),
));


$propertyCollection = $order->getPropertyCollection();
$phoneProp = $propertyCollection->getPhone();
$phoneProp->setValue($phone);

$nameProp = $propertyCollection->getPayerName();
$nameProp->setValue($surname . ' ' . $name . ' ' . $patronymic);

$nameAddress = $propertyCollection->getAddress();
$nameAddress->setValue($address);

//$propertyCollection = $order->getPropertyCollection();
$somePropValue = $propertyCollection->getItemByOrderPropertyId(2);
$somePropValue->setValue($email);

$somePropValue = $propertyCollection->getItemByOrderPropertyId(20);
$somePropValue->setValue($doctor);

$somePropValue = $propertyCollection->getItemByOrderPropertyId(21);
$somePropValue->setValue($age);

$somePropValue = $propertyCollection->getItemByOrderPropertyId(23);
$somePropValue->setValue($specialization);

$somePropValue = $propertyCollection->getItemByOrderPropertyId(24);
$somePropValue->setValue('001');

$somePropValue = $propertyCollection->getItemByOrderPropertyId(22);
$somePropValue->setValue($time);



$order->doFinalAction(true);
$result = $order->save();
$orderId = $order->getId();


if (!$result->isSuccess()) {
    $result->getErrors();
}
