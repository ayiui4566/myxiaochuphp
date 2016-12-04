<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/2
 * Time: 14:32
 */
class TaskModel
{
    //任务或者星级id
    public $id;
    //0为不可领取，1为可领取(任务完成)，2为已领取 领取完自动进入下一个任务
    public $status;

    public function setType(){
        $this->id = intval($this->id);
        $this->status = intval($this->status);
    }
    public function init(){
        $this->id = 1;
        $this->status = 0;
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