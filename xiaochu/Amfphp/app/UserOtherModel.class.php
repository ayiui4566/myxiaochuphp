<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/1
 * Time: 6:38
 */
class UserOtherModel
{
    public $uid;
    public $alldresses;
    public $bag;

    public $block;
    /**
     * 比如已经通过了第3个场景的block，则bnum=4，
     * 即正在通过第几个场景的block
     */
    public $bnum;
    public $curdress;
    public $drs;
    //黄钻每日礼包是否领取的标志1 为领取 0 为未领取
    public $yellowdaypresent;
    //黄钻新手礼包是否领取的标志 只领取一次，领完就没有了 1 为领取 0 为未领取
    public $yellownewpresent;
    //蓝钻每日礼包是否领取的标志1 为领取 0 为未领取
    public $bluedaypresent;
    //蓝钻新手礼包是否领取的标志 只领取一次，领完就没有了 1 为领取 0 为未领取
    public $bluenewpresent;
    //3366每日礼包是否领取的标志 只领取一次，领完就没有了 1 为领取 0 为未领取
    public $vip3366daypresent;
    //首充flag
    public $firstpackage;
    public $notify;
    public $pl;
    public $baoxiang;
    public $sendlife;
    public $invite;
    public $vipinfo;
    public $totalstar;
    //当前任务对象
    public $btask;
    //当前星星任务id
    public $bstarTask;
    //当前bluevip任务对象
    public $blue_btask;
    //当前bluevip任务对象
    public $blue_bstarTask;
    //当前店信息
    public $dianInfo;

    public function __construct()
    {
        $this->bnum = intval($this->bnum);
        $this->curdress = intval($this->curdress);
        $this->drs = intval($this->drs);
        $this->firstpackage = intval($this->firstpackage);
        $this->pl = intval($this->pl);
        $this->totalstar = intval($this->totalstar);


        if($this->alldresses !=""){
            $this->alldresses = explode("|",$this->alldresses);;
        }else{
            $this->alldresses = array();
        }

        if($this->bag != ""){
            $this->bag = StringUtil::strToClassArray($this->bag,"BagModel");
        }else{
            $this->bag = array();
        }

        if($this->notify != ""){
            $this->notify = StringUtil::strToClassArray($this->notify,"NotifyModel");
        }else{
            $this->notify = array();
        }

        if($this->sendlife!="") {
            $this->sendlife = StringUtil::strToClassArray($this->sendlife,"SendLifeModel");
        }else{
            $this->sendlife = array();
        }

        if($this->block!=""){
            $this->block = StringUtil::strToClassArray($this->block,"UserBlockModel");
        }else{
            $this->block = array();
        }

        if($this->baoxiang!="") {
            $this->baoxiang = StringUtil::strToClassArray($this->baoxiang,"BaoModel");
        }else{
            $this->baoxiang = array();
        }

        if($this->btask !=""){
            $this->btask = StringUtil::strToClass($this->btask,"TaskModel");
        }else{
            $this->btask = new TaskModel();
        }

        if($this->bstarTask !=""){
            $this->bstarTask = StringUtil::strToClass($this->bstarTask,"TaskModel");
        }else{
            $this->bstarTask = new TaskModel();
        }
        if($this->blue_btask !=""){
            $this->blue_btask = StringUtil::strToClass($this->blue_btask,"TaskModel");
        }else{
            $this->blue_btask = new TaskModel();
            $this->blue_btask->init();
        }

        if($this->blue_bstarTask !=""){
            $this->blue_bstarTask = StringUtil::strToClass($this->blue_bstarTask,"TaskModel");
        }else{
            $this->blue_bstarTask = new TaskModel();
            $this->blue_bstarTask->init();
        }

        if($this->dianInfo !=""){
            $this->dianInfo = StringUtil::strToClass($this->dianInfo,"DianModel");
        }else{
            $this->dianInfo = new DianModel();
            $this->dianInfo->init(1);
        }

        if($this->invite!=""){
            $this->invite = StringUtil::strToClass($this->invite,"InviteModel");
        }else{
            $this->invite = new InviteModel();
        }

        if($this->vipinfo!=""){
            $this->vipinfo = StringUtil::strToClass($this->vipinfo,"VipModel");
        }else{
            $this->vipinfo = new VipModel();
        }
    }

    /**
     * sendlife对象转换成字符串
     * @param $parm
     * @return string
     */
    public static function sendliftToStr($parm){
        $str = "";
        foreach($parm as $key=>$value){
            $str.=$key.",";
        }
        $str = substr($str,0,-1);
        return $str;
    }
    /**
     * 得到obj.d 没有的话则插入一条新数据
     * @param $uid
     * @return array
     */
    public static function getById($uid){

        $uid = (string)$uid;
        $key = md5(__CLASS__.$uid).'UserOtherModel:uid='.$uid;

        if(MMysql::$production){
            $data = MMysql::getMemcache()->get($key);
            if(!$data){

                $data = self::_getById($uid);

                MMysql::getMemcache()->add($key,$data);

            }else{
                Logs::getInstance()->setLog("key=" . $key . "的数据从缓存中取得");
            }
        }else{
            $data = self::_getById($uid);
        }

        return $data;
    }
    public static function _getById($uid){
        $uid = (string)$uid;

        $pdo = MMysql::getConnection();
        $sql = "select * from d_user_other where uid=?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1,$uid,PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchObject(__CLASS__);
        if(!$data){
            self::insert($uid);
            return self::_getById($uid);
        }
        Logs::getInstance()->pushSqlStr("select * from d_user_other where uid=$uid");
        return $data;
    }
    /**
     * 插入数据 用于初始化
     * @param $uid
     * @return array
     */
    public static function insert($uid){
        try {
            $pdo = MMysql::getConnection();
            $tsql = "INSERT INTO d_user_other( uid, alldresses, bag, block, bnum, curdress, drs, yellowdaypresent, yellownewpresent, bluedaypresent, bluenewpresent, vip3366daypresent, firstpackage, notify, pl, baoxiang, sendlife, invite, vipinfo, totalstar, btask, bstarTask, blue_btask, blue_bstarTask, dianInfo)";
                            $tsql .= " VALUES(:uid,:alldresses,:bag,:block,:bnum,:curdress,:drs,:yellowdaypresent,:yellownewpresent,:bluedaypresent,:bluenewpresent,:vip3366daypresent,:firstpackage,:notify,:pl,:baoxiang,:sendlife,:invite,:vipinfo,:totalstar,:btask,:bstarTask,:blue_btask,:blue_bstarTask,:dianInfo)";

            $stmt = $pdo->prepare($tsql);
            $stmt->bindValue(':uid',$uid);
            $stmt->bindValue(':alldresses', "");
            $stmt->bindValue(':bag', "");
            $stmt->bindValue(':block', "");
            $stmt->bindValue(':bnum', 0);
            $stmt->bindValue(':curdress', 0);
            $stmt->bindValue(':drs', 0);
            $stmt->bindValue(':yellowdaypresent', 0);
            $stmt->bindValue(':yellownewpresent', 0);
            $stmt->bindValue(':bluedaypresent', 0);
            $stmt->bindValue(':bluenewpresent', 0);
            $stmt->bindValue(':vip3366daypresent', 0);
            $stmt->bindValue(':firstpackage', 0);
            $stmt->bindValue(':notify', "dress|0,task|0");
            $stmt->bindValue(':pl', 0);
            $stmt->bindValue(':baoxiang', "");
            $stmt->bindValue(':sendlife', "");
            $stmt->bindValue(':invite', "0|0");
            $stmt->bindValue(':vipinfo', "0|0");
            $stmt->bindValue(':totalstar', 0);
            $stmt->bindValue(":btask","1|0");
            $stmt->bindValue(":bstarTask","1|0");
            $stmt->bindValue(":blue_btask","1|0");
            $stmt->bindValue(":blue_bstarTask","1|0");
            $stmt->bindValue(":dianInfo","1|0|200|1");
            return $stmt->execute();
        } catch (PDOException $e) {
            $error = date("Y-m-d g:i:s a T") . "\tGame::initOtherInfo\tError: (" . $e->getCode . ") " . $e->getMessage;
            throw new Exception($error);
        }

        Logs::getInstance()->pushSqlStr($tsql);
    }
    public function update(){
        $key = md5(__CLASS__.$this->uid).'UserOtherModel:uid='.$this->uid;

        if(MMysql::$production){
            $data = MMysql::getMemcache()->get($key);
            if($data){
                MMysql::getMemcache()->set($key,$this);
                Logs::getInstance()->setLog("更新缓存".$key);
                $this->_update();
                return true;
            }else{
                Logs::getInstance()->setLog("更新的时候缓存中没有找到".$key);
            }
        }else{
            $this->_update();
        }
    }
    private function _update(){
        $db = new MMysql();
        $data = array();
        foreach ($this as $key => $value) {
            $data[$key] = $value;
        }


        $data["alldresses"] = implode("|",$this->alldresses);
        $data["bag"] = StringUtil::classArrayToStr($this->bag);
        $data["notify"] = StringUtil::classArrayToStr($this->notify);
        $data["sendlife"] = StringUtil::classArrayToStr($this->sendlife);
        $data["block"] = StringUtil::classArrayToStr($this->block);
        $data["baoxiang"] = StringUtil::classArrayToStr($this->baoxiang);
        $data["btask"] = StringUtil::classToStr($this->btask);
        $data["bstarTask"] = StringUtil::classToStr($this->bstarTask);
        $data["blue_btask"] = StringUtil::classToStr($this->blue_btask);
        $data["blue_bstarTask"] = StringUtil::classToStr($this->blue_bstarTask);
        $data["dianInfo"] = StringUtil::classToStr($this->dianInfo);
        $data["invite"] = StringUtil::classToStr($this->invite);
        $data["vipinfo"] = StringUtil::classToStr($this->vipinfo);


        return $db->where(array('uid' => $this->uid))->update('d_user_other', $data);
    }




    //---------------------------------------------------------------------------------------
    public function getBagModel($itemid){
        foreach($this->bag as $bagModel){
            if($bagModel->id == $itemid){
                return $bagModel;
            }
        }
    }

    public function setSendLife($uid,$gt){
        $this->sendlife[] = SendLifeModel::create(array($uid,$gt));
    }

    /**
     * 更新背包
     * updateBg('2005','2000',1);updateBg('2005','2000',-1);updateBg('2005','2000',1);updateBg('2005','2001',2);
     */
    public function updateBags2($itemid,$num){
        $have = false;
        foreach($this->bag as $bagModel){
            if($bagModel->id == $itemid){
                $bagModel->num = $bagModel->num + $num;
                $have = true;
                break;
            }
        }
        if(!$have){
            $this->bag[] = BagModel::create(array($itemid,$num));
        }

        return  $this->bag;
    }

    public function updateFirstBuy2($itemids,$nums){

        for($i=0;$i<count($itemids);$i++){

            $this->updateBags2($itemids[$i],$nums[$i]);

        }
        $this->firstpackage = 1;

        return $this->bag;
    }

    public static function updateBlock($uid){

        $info = UserOtherModel::getById($uid);
        $info->block[] = UserBlockModel::create(array(-1,"1.jpg","noname"));

        $info->update();
    }
    public static function updateBlock2($uid,$blockModel){

        $info = UserOtherModel::getById($uid);
        $info->block[] = $blockModel;

        $info->update();
    }
    public static function updateBnum($uid){

        $info = UserOtherModel::getById($uid);
        $info->bnum++;
        $info->block = "";

        $info->update();

    }


}
