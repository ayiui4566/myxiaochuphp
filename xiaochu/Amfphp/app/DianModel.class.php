<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/2
 * Time: 14:32
 */
class DianModel
{
    //玩家当前店等级
    public $dianlevel;
    //剩余收银次数
    public $oTime;
    //本次可收银的金币数量
    public $goldNum;
    //本次可收银的心数量
    public $heartNum;

    public function __construct()
    {

    }

    public function setType(){
        $this->dianlevel = intval($this->dianlevel);
        $this->oTime = intval($this->oTime);
        $this->goldNum = intval($this->goldNum);
        $this->heartNum = intval($this->heartNum);
    }

    public function init($dianlevel,$isvip=0){
        $this->dianlevel = $dianlevel;
        $ary = GameConfig::getTianShopConfig();
        $dConfig = $ary[$this->dianlevel];
        $this->oTime=$dConfig['times'];
        if($isvip == 1){
            $this->oTime+=5;
        }

        $this->goldNum=$dConfig['gold']+$dConfig['increase']/100*$dConfig['gold'];
        $this->heartNum=StringUtil::getIsRandom($dConfig['heart'])?1:0;
    }
    public function getNext(){
        $ary = GameConfig::getTianShopConfig();
        $dConfig = $ary[$this->dianlevel];
        $this->oTime--;
        if($this->oTime<0){
            $this->oTime = 0;
        }
        $this->goldNum=$dConfig['gold']+$dConfig['increase']/100*$dConfig['gold'];
        $this->heartNum=StringUtil::getIsRandom($dConfig['heart'])?1:0;
    }


    public  static function  create($attributes){
        $class_name = get_called_class();
        $model = new $class_name();

        $i = 0;
        foreach($model as $key => $value) {
//            print "$key => $value\n";
            $model->$key = $attributes[$i];
            $i++;
        }

        return $model;
    }
}