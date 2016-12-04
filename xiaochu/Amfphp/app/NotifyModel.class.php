<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/2
 * Time: 14:32
 * 通知
 */
class NotifyModel
{
    const DRESSTYPE = "dress";
    const TASKTYPE = "task";
    //道具id
    public $type;
    //道具数量
    public $status;

    public function setType(){
        $this->type = strval($this->type);
        $this->status = intval($this->status);
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