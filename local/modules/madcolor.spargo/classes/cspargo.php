<?php

namespace Madcolor\Spargo;

IncludeModuleLangFile(__FILE__);

class CSpargo
{

    private $token;

    public $arrDepartments = array();

    public $arrRootSection = array();
    public $arrSection = array();


    function __construct()
    {
        $this->GetToken();
    }
    
    /**
     * Получение токена
    */
    private function GetToken()
    {

        $auth = [
            "login" => "famdoc",
            "password" => "famdoc"
        ];

        $data_string = json_encode($auth, JSON_UNESCAPED_UNICODE);
        $ch = curl_init('https://api.f3bus.ru/user/auth');

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        ));

        $response = json_decode(curl_exec($ch));
        curl_close($ch);

        // echo $response->token;

        $this->$token = $response->token;
    }

    public function GetDepartments()
    {
        $curl = curl_init('https://api.f3bus.ru/User/departments');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'accept: application/json',
            'Authorization: Bearer ' . $this->$token
        ));
        $resp = curl_exec($curl);
        curl_close($curl);

        $this->arrDepartments = json_decode($resp, true);
    }

    public function GetGoodsGroup($sourceId, $rv = null)
    {
        $curl = curl_init();

        if (is_null($rv))
            curl_setopt($curl, CURLOPT_URL, "https://api.f3bus.ru/GoodsGroup?sourceId=" . $sourceId);
        else
            curl_setopt($curl, CURLOPT_URL, "https://api.f3bus.ru/GoodsGroup?sourceId=" . $sourceId . '&rv=' . $rv);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'accept: application/json',
            'Authorization: Bearer ' . $this->$token
        ));

        $resp = curl_exec($curl);
        curl_close($curl);

        $arrGoodsGroup = json_decode($resp, true);

        foreach($arrGoodsGroup as $section){
            if($section['parentGroupId'] == "" && $section['deletedDate'] == ""){
                $this->arrRootSection[] = $section;
            } 
        } 
        
        $this->arrSection = $this->arrSection + $arrGoodsGroup;

        $rv = array_pop($arrGoodsGroup);

        return $rv['rv'];
    }

    public function GetRootSection(){

        $sourseId = $this->arrDepartments[0]['source']['id'];

        $rv =  $this->GetGoodsGroup($sourseId);

        while($rv){
            $rv =  $this->GetGoodsGroup($sourseId, $rv);
        }

    }
}
