<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/2
 * Time: 14:32
 */
class BagModel
{
    //道具id
    public $id;
    //道具数量
    public $num;

    public function setType(){
        $this->id = intval($this->id);
        $this->num = intval($this->num);
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