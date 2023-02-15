    <?

    $APPLICATION->IncludeComponent(
            "bitrix:catalog.store.list", "main", Array(
        "CACHE_TIME" => "36000",
        "CACHE_TYPE" => "A",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO",
        "MAP_TYPE" => "0",
        "PATH_TO_ELEMENT" => "/stores/#store_id#/",
        "PHONE" => "Y",
        "SCHEDULE" => "Y",
        "SET_TITLE" => "N",
        "TITLE" => "",
        "STORES" => $arParams['STORES']
            )
    );
    ?>