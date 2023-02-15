<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$aMenu = array(
    array(
        'parent_menu' => 'global_menu_madcolor',
        'sort' => 150,
        'text' => "Madcolor",
        'title' => "madcolor интеграция",
        'items_id' => 'menu_madcolor',
        'items' => array(
            array(
                'text' => "Параметры",
                'title' => "Интеграция с аптекой",
                'url' => '/bitrix/admin/madcolor.spargo_options.php',
            ),
        )
    )
);

return $aMenu;
