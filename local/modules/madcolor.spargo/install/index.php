<?php
use \Bitrix\Main\ModuleManager;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class madcolor_spargo extends CModule
{
   function __construct()
    {
        $this->MODULE_ID = 'madcolor.spargo';
        $this->MODULE_VERSION = "1.0.0";
        $this->MODULE_VERSION_DATE = "28.07.2021";
        $this->MODULE_NAME = loc::getMessage('MADCOLOR_SPARGO_NAME');
        $this->MODULE_DESCRIPTION = loc::getMessage('MADCOLOR_SPARGO_DESCRIPTION'); 

        $this->PARTNER_NAME  = loc::getMessage('MADCOLOR_SPARGO_PARTNER_NAME');
        $this->PARTNER_URI  = loc::getMessage('MADCOLOR_SPARGO_PARTNER_URI'); 
    }

    function DoInstall()
    {
        $this->InstallFiles();

        ModuleManager::registerModule($this->MODULE_ID);
        return true;

    }

    function DoUninstall()
    {
        
        $this->UnInstallFiles();

        ModuleManager::unRegisterModule($this->MODULE_ID);
        return true;
    }

    function InstallFiles()
    {
        CopyDirFiles(__DIR__.'/admin/', $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin', true);

        return true;
    }

    function UnInstallFiles()
    {
        DeleteDirFiles(__DIR__.'/admin/', $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin');
        return true;
    }
}

?>