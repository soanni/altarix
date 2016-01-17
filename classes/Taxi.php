<?php

class Taxi{
    private $_licenseNum;
    private $_licenseDate;
    private $_name;
    private $_ogrnNum;
    private $_ogrnDate;
    private $_brand;
    private $_model;
    private $_regNum;
    private $_year;
    private $_blankNum;
    private $_info;

    protected static $_instance;

    private function __construct(){}

    private function __clone(){}

    public function __get($name){
        $name = '_' . lcfirst($name);
        return $this->$name;
    }

    public static function getInstance(){
        if(null === self::$_instance){
            $stamp = new self();
            $stamp->_licenseNum = '02651';
            $stamp->_licenseDate = '08.08.2011 0:00:00';
            $stamp->_name = 'ООО "НЖТ-ВОСТОК"';
            $stamp->_ogrnNum = '1107746402246';
            $stamp->_ogrnDate = '17.05.2010 0:00:00';
            $stamp->_brand = 'FORD';
            $stamp->_model = 'FOCUS';
            $stamp->_regNum = 'ЕМ33377';
            $stamp->_year = '2011';
            $stamp->_blankNum = '002695';
            $stamp->_info = '';
            self::$_instance = $stamp;
        }

        return self::$_instance;
    }

    public static function compareWithPattern(Array $arr){
        if(!empty($arr)){
            $pattern = self::getInstance();
            foreach($arr as $key => $value){
                if($pattern->{$key} != $value){
                    return false;
                }
            }
            return true;
        }
        return false;
    }
}