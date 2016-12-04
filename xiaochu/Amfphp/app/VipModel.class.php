<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/2
 * Time: 14:32
 */
class VipModel
{
    //vip等级 1-10
    public $level;
    //今日是否领取
    public $isDayGet;

    public function __construct($level=0,$isDayGet=0)
    {
        $this->level = $level;
        $this->isDayGet = $isDayGet;
    }

    public function setType(){
        $this->level = intval($this->level);
        $this->isDayGet = intval($this->isDayGet);
    }

    public static function create($attributes){
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