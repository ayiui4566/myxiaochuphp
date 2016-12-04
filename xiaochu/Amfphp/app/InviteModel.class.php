<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/2
 * Time: 14:32
 */
class InviteModel
{
    //今日已领奖次数
    public $lingNum;
    //今日邀请的好友数量
    public $yaoNum;

    public function __construct($lingnum=0,$yaonum=0)
    {
        $this->lingNum = $lingnum;
        $this->yaoNum = $yaonum;
    }

    public function setType(){
        $this->lingNum = intval($this->lingNum);
        $this->yaoNum = intval($this->yaoNum);
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