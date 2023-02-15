<?php
use \Bitrix\Main\Loader;

Loader::registerAutoloadClasses(
    'madcolor.spargo',
    array(
        'MadColor\\Spargo\\CSpargo' => 'classes/cspargo.php',
    )
);