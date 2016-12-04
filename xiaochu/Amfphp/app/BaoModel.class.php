<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/2
 * Time: 14:32
 */
class BaoModel
{
    //场景id 1,2,3等
    public $sceneId;
    //1为已开，2为已领
    public $status;
    //前台第几个道具
    public $frame;
    //奖励数量 如果是金币则随机1000 到 3000奖励
    public $num;

    public function setType(){
        $this->sceneId = intval($this->sceneId);
        $this->status = intval($this->status);
        $this->frame = intval($this->frame);
        $this->num = intval($this->num);
    }

    public function getItemId(){
        $itemid = 0;
        switch($this->frame){
            case 4:
                $itemid = GameConfig::ITEM_Dessert_ID;
                break;
            case 5:
                $itemid = GameConfig::ITEM_Add5Moves_ID;
                break;
            case 6:
                $itemid = GameConfig::ITEM_DoubleScoop_ID;
                break;
            case 7:
                $itemid = GameConfig::ITEM_BoardShuffle_ID;
                break;
            case 8:
                $itemid = GameConfig::ITEM_TakeOut_ID;
                break;
            case 9:
                $itemid = GameConfig::ITEM_WarmingUp_ID;
                break;
            case 10:
                $itemid = GameConfig::ITEM_CremeBrulee_ID;
                break;
            case 11:
                $itemid = GameConfig::ITEM_Nudge_ID;
                break;
        }
        return $itemid;
    }

    /**
     * 设置奖励已经数量  相当于配置
     */
    public function setFrame(){
        //帧数从2到11为奖励
        $allGoldeds = array(100,100,100,150,200);
        $frame = 2;
        $this->frame = $frame;
        if($frame == 2){//金币
            $this->num = $allGoldeds[rand(0,4)];
        }elseif($frame == 3){//钻石
            $this->num = 1;
        }else{//道具
            $this->num = 1;
        }
    }
    /**
     * 设置奖励已经数量  相当于配置
     * 邀请好友的奖励 不赠送道具了
     */
    public function setFrame2(){
        //帧数从2到11为奖励
        $allGoldeds = array(100,100,100,150,200);
        $frame = 2;
        $this->frame = $frame;
        if($frame == 2){//金币
            $this->num = $allGoldeds[rand(0,4)];
        }elseif($frame == 3){//钻石
            $this->num = 1;
        }else{//道具
            $this->num = 1;
        }
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