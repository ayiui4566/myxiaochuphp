<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/1
 * Time: 5:42
 */
/**
 * 已经解锁block单元的信息
 * uid,pic,name
 * uid=-1的时候是钻石购买
 * 否则为朋友帮助
 * 查询用户block解锁信息
 * @param $uid
 */
class UserBlockModel{

    //好友的uid
    public $uid;
    //好友的头像地址
    public $pic;
    //好友的昵称
    public $name;


    public function setType(){

    }

    public  static function  create($attributes){
        $class_name = get_called_class();
        $model = new $class_name();

        $i = 0;
        foreach($model as $key => $value) {
            $model->$key = $attributes[$i];
            //不能出现打印的字样，否则amf会报错
            //print "$key => ".$model->$key."\n";
            $i++;
        }

        return $model;
    }
}