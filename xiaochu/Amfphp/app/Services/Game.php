<?php
require_once dirname(__FILE__) . '/../../app/util/MMysql.class.php';
require_once dirname(__FILE__) . '/../../app/util/StringUtil.class.php';
require_once dirname(__FILE__) . '/../../app/util/Logs.class.php';
require_once dirname(__FILE__) . '/../../app/GameConfig.class.php';
require_once dirname(__FILE__) . '/../../app/LevelConfig.class.php';
require_once dirname(__FILE__) . '/../../app/UserModel.class.php';
require_once dirname(__FILE__) . '/../../app/UserLevelInfoModel.class.php';
require_once dirname(__FILE__) . '/../../app/UserMailModel.class.php';
require_once dirname(__FILE__) . '/../../app/UserOtherModel.class.php';
require_once dirname(__FILE__) . '/../../app/UserBlockModel.class.php';
require_once dirname(__FILE__) . '/../../app/BagModel.class.php';
require_once dirname(__FILE__) . '/../../app/DianModel.class.php';
require_once dirname(__FILE__) . '/../../app/NotifyModel.class.php';
require_once dirname(__FILE__) . '/../../app/SendLifeModel.class.php';
require_once dirname(__FILE__) . '/../../app/TaskModel.class.php';
require_once dirname(__FILE__) . '/../../app/BaoModel.class.php';
require_once dirname(__FILE__) . '/../../app/InviteModel.class.php';
require_once dirname(__FILE__) . '/../../app/VipModel.class.php';
require_once dirname(__FILE__) . '/../../app/MsgModel.class.php';
require_once dirname(__FILE__) . '/../../app/LoseCause.class.php';

class Game{

	public function __construct()
	{
		$log_path = "../";
		$log_file_name = 'debug.log';
		Logs::getInstance();
		Logs::getInstance()->setParm($log_path,$log_file_name);
        Logs::getInstance()->setLog("service启动");
	}

    /**
     * 游戏初始化协议
     * @param $parms
     * @return array|bool
     * @throws Exception
     */
    public function init($parms)
	{
        $parms = (object)$parms;
		if(!$parms->uid){
            return "参数错误";
        }
        Logs::getInstance()->setLog("玩家：".$parms->uid." Game.init");
        //查询数据库
        $result = array();
        $user = UserModel::getById($parms->uid);
        $user->openkey = $parms->openkey;
        $userOther = UserOtherModel::getById($parms->uid);

        //计算日日奖励
        $this->dayLogin($user,$userOther);
        $user->addHeart();

        $result["u"] = $user;
        $result["u"]->cdtime = $user->cdtime;
        $result["u"]->logincountTemp = $user->logincountTemp;

        $result["c"]["block"] = GameConfig::getBlockConfig();
        $result["c"]["yellowvip"] = GameConfig::getYellowVipDayPresent();
        $result["c"]["bluevip"] = GameConfig::getBlueVipDayPresent();
        $result["c"]["vip3366"] = GameConfig::get3366VipConfig();
        $result["c"]["vipRewardConfig"] = GameConfig::getVipTeQuanConfig();
        $result["c"]["vipGemsConfig"] = GameConfig::getVipGemsConfig();
        $result["c"]["currency"] = GameConfig::getShopConfig();
        $result["c"]["dayreward"] = GameConfig::getDayRewardConfig();
        $result["c"]["yuekadayreward"] = GameConfig::getYueKaDayConfig();
        $result["c"]["dresses"] = GameConfig::getDressesConfig();
        $result["c"]["hdfont"] = GameConfig::getHuodongFont();
        $result["c"]["maxscene"] = GameConfig::MAX_SCEENNOS;
        $result["c"]["nextupdate"] = GameConfig::NEXT_UPDATE;
        $result["c"]["zanGold"] = GameConfig::ZAN_GOLD;
        $result["c"]["props"] = GameConfig::getPropsConfig();
        $result["c"]["tshops"] = GameConfig::getTianShopConfig();
        $result["c"]["taskMain"] = GameConfig::getTaskMainConfig();
        $result["c"]["taskStar"] = GameConfig::getTaskStarConfig();

        $result["c"]["alllevelconfig"] = LevelConfig::load(0);


        $userOther->vipinfo->level = GameConfig::getUserVipLevel($parms->uid);
        $user->maxlife =  GameConfig::getMaxLife1($userOther->vipinfo->level);
        $user->maxlife2 =  GameConfig::getMaxLife2($userOther->vipinfo->level);
        $user->checklife2();

        $user->isPay = GameConfig::getIsPay($parms->uid);
        $result["d"] = $userOther;

        $result["d"]->mailbox = UserMailModel::getById($parms->uid);

        $obj = UserLevelInfoModel::getUserLevelInfo($parms->uid);
        $result["d"]->ls = $obj['res'];
        $user->compelteLv = $obj['num'];
        $userOther->totalstar = $obj['totalstars'];
        $this->checkTask($user,$userOther);

        if($parms->fids !=null && count($parms->fids)!=0) {
            $result["d"]->friends_ls = UserLevelInfoModel::getFriendLevelInfo($parms->fids);
        }

        $rank_data = GameConfig::getRankList();

        $user->update();
        $userOther->update();

        $result["c"]["ranklist"] = $rank_data;

        return $this->finalReturn($result,__FUNCTION__);
	}
    /**
     * 检查任务
     */
    private function checkTask($user,$userOther){
        $tconfigs = GameConfig::getTaskMainConfig();
        $sconfigs = GameConfig::getTaskStarConfig();
        //0
        $tconfig = (object)$tconfigs[$userOther->btask->id];
        if($user->compelteLv >= $tconfig->level){
            $userOther->btask->status = 1;

        }else{
            $userOther->btask->status = 0;
        }

        //1
        $sconfig = (object)$sconfigs[$userOther->bstarTask->id];
        if($userOther->totalstar >= $sconfig->star){
            $userOther->bstarTask->status = 1;

        }else{
            $userOther->bstarTask->status = 0;
        }

        //2
        $tconfig = (object)$tconfigs[$userOther->blue_btask->id];
        if($user->compelteLv >= $tconfig->level){
            $userOther->blue_btask->status = 1;

        }else{
            $userOther->blue_btask->status = 0;
        }

        //3
        $sconfig = (object)$sconfigs[$userOther->blue_bstarTask->id];
        if($userOther->totalstar >= $sconfig->star){
            $userOther->blue_bstarTask->status = 1;

        }else{
            $userOther->blue_bstarTask->status = 0;
        }
    }
    /**
     * 计算日日奖励
     */
    private function dayLogin($user,$userOther){

        $a_date = date('Y-m-d',$user->login);
        $b_date = date('Y-m-d');

        //如果是月卡用户，登录的时候判断是否过期
        if($user->yuevip == 1){
            $intval = StringUtil::dateDifference($user->vipbuytime,time());
            if($intval >= 30){
                $user->yuevip = 0;
                $user->vipbuytime='';
                $user->dayvip=0;
            }else{
                $user->vipdays = $intval;
            }
        }

        if($b_date == $a_date){//是今天

        }else{//是昨天以前 第二天了
            //给予奖励 第一天logincount=0
            $user->getreward = 0;

            $user->daydo = '';
            $user->dayvip = 0;

            //vip领取清零
            $userOther->vipinfo->isDayGet = 0;
            //黄钻每日礼包清零
            $userOther->yellowdaypresent = 0;
            $userOther->bluedaypresent = 0;
            $userOther->vip3366daypresent = 0;
            //给好友送礼也要清零，每天只能送一个
            $userOther->sendlife = array();
            //邀请好友奖励信息要清零
            $userOther->invite = new InviteModel();
            //初始化计算甜店
            $userOther->dianInfo->init($userOther->dianInfo->dianlevel,$user->yuevip);



            //邮箱中type为asklife的清空
            UserMailModel::deleteAskLife($user->uid);
        }
        //记录这次登录时间
        $user->login = time();
        $user->loginTime++;
        //更新bum
        if($user->level % GameConfig::SCENE_LEVEL == 0){
            $userOther->bnum = $user->level / 10;
        }else{
            $userOther->bnum = intval($user->level / 10) + 1;
        }
    }
    /**
     * 保存玩家nick，pic
     */
    public function saveNickPic($parm){
        $uid = $parm->uid;
        $pic = $parm->pic;
        $nick = $parm->nick;
        $sex = $parm->sex;

        $user = UserModel::getById($uid);
        if($user->isSaveNick==0) {
            $user->pic = $pic;
            $user->nick = $nick;
            $user->sex = $sex;
            $user->isSaveNick = 1;
            $user->update();
        }else{
            if($user->nick != $nick || $user->pic != $pic){
                $user->pic = $pic;
                $user->nick = $nick;
                $user->update();
            }
        }

        $re = array('pic'=>$user->pic,'nick'=>$user->nick,'sex'=>$user->sex);
        return $this->finalReturn($re,__FUNCTION__);
    }
    /**
     * 保存玩家nick，pic
     */
    public function saveNickPic_self($parm){
        $uid = $parm->uid;
        $pic = $parm->pic;
        $nick = $parm->nick;
        $sex = $parm->sex;

        $user = UserModel::getById($uid);
        if($user->isSaveNick==0) {
            $user->pic2 = $pic;
            $user->nick2 = $nick;
            $user->sex = $sex;
            $user->isSaveNick = 1;
            $user->update();
        }else{
            if($user->nick2 != $nick || $user->pic2 != $pic){
                $user->pic2 = $pic;
                $user->nick2 = $nick;
                $user->update();
            }
        }

        $re = array('pic'=>$user->pic2,'nick'=>$user->nick2,'sex'=>$user->sex);
        return $this->finalReturn($re,__FUNCTION__);
    }
    /**
     * 添加好友，单方面操作，只要添加就能成功，不用对方同意和拒绝
     */
    public function addFriend($parm){
        $uid = $parm->uid;
        $fuid = $parm->fid;
        $user = UserModel::getById($uid);
        if(empty($user->friendIds)){
            $user->friendIds = $user->friendIds.$fuid;
        }else{
            $ary = explode(',',$user->friendIds);
            if(!in_array($fuid,$ary)) {
                $user->friendIds = $user->friendIds . ',' . $fuid;
            }
        }

        $user2 = UserModel::getById($fuid);
        if(empty($user2->friendIds)){
            $user2->friendIds = $user2->friendIds.$uid;
        }else{
            $ary = explode(',',$user2->friendIds);
            if(!in_array($uid,$ary)) {
                $user2->friendIds = $user2->friendIds . ',' . $uid;
            }
        }

        $user2->update();
        $user->update();

        $re = array('success'=>1);
        return $this->finalReturn($re,__FUNCTION__);
    }
    /**
     * gamestart
     * @param $parm
     * @return array
     */
    public function start($parm){

        $uid = $parm->uid;
        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.start");
        //$lv = $parm->lv;
        //用的金币道具，扣金币
        $goldItmids = $parm->powers;

        $userModel = UserModel::getById($uid);
        if($userModel->openkey!=$parm->openkey){
            return $this->reloadError(__FUNCTION__);
        }

        $propsConfig = GameConfig::getPropsConfig();

        $nowGold = $userModel->gold;
        if(count($goldItmids) > 0) {
            foreach ($goldItmids as $key => $value) {
                $data = $propsConfig[$value];
                $gold = $data["gold"];
                $nowGold = $nowGold - $gold;
            }
            if($nowGold<0){
                return $this->errorReturn("金币不足",__FUNCTION__);
            }else{
                $userModel->gold = $nowGold;
                $userModel->update();
            }
        }


        $re = array();
        $re["u"]["level"] = $userModel->level;
        return $this->finalReturn($re,__FUNCTION__);
    }

    /**
     * uid,level,golditemids
     * @param $parm
     * @return levelinfo
     */
    public function level($parm){
        $lv = $parm->lv;

        $lvinfo = LevelConfig::load($lv);

        return $this->finalReturn($lvinfo,__FUNCTION__);
    }

    /**
     * 某个场景所有关卡信息
     */
    public function sceneLevels($parm){
        $nowscene = $parm->nowscene;
        $lvinofs = array();
        for($i=0;$i<10;$i++){
            $lvinofs[] = LevelConfig::load(($nowscene-1)*10 + i+1);
        }

        return $this->finalReturn($lvinofs,__FUNCTION__);
    }
    /**
     * 小喇叭内容
     * @param $parm
     * @return array
     */
    public function getMsg($parm){
        $res = MsgModel::getAll();
        return $this->finalReturn($res,__FUNCTION__);
    }
    /**
     * game end
     * @param $parm
     * @return array
     */
    public function end($parm){
        $uid = $parm->uid;
        $lv = $parm->lv;
        $iswin = $parm->result;
        $score = $parm->score;
        $star = $parm->star;

        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.end");

        $user = UserModel::getById($uid);


        $result = array();
        $std = new stdClass();
        if($iswin == 1) {//通关
            //更新d_user_levelinfo表
            $obj = UserLevelInfoModel::updateLevelInfo($parm);
            $userOther = UserOtherModel::getById($uid);
            //成功了才返回关卡信息
            $result['d']['ls'][$lv] = array("sc" => $obj['sc'], "st" => $obj['st']);
            //玩家最大关卡+1
            if ($lv == $user->level) {
                if($lv>=GameConfig::BLOCK_START*GameConfig::SCENE_LEVEL && $lv%GameConfig::SCENE_LEVEL == 0) {
                    //如果是场景的最后一关，先不加level，等block解锁了再加1
                    //更新bum
                    if($user->level % GameConfig::SCENE_LEVEL == 0){
                        $userOther->bnum = $user->level / 10;
                    }else{
                        $userOther->bnum = intval($user->level / 10) + 1;
                    }
                    //通过600关后得一个皇冠
                    if($lv == 600){
                        $user->crownNum ++;
                        $user->update();
                    }

                }else{

                    if(GameConfig::$pf == '6533'){
                        $nick = $user->nick2;
                    }else{
                        $nick = $user->nick;
                    }
                    MsgModel::insert($user->uid,$nick,$userOther->vipinfo,'刚刚通过了第'.$user->level.'关',time());
                    $user->level = $user->level + 1;
                    $user->update();

                }
                $userOther->totalstar+=$star;

            }else{//玩的以前的关卡
                $userOther->totalstar = $obj['totalstars'];
            }
            $user->compelteLv = $obj['num'];
            $this->checkTask($user,$userOther);
            $result['d']['btask'] = $userOther->btask;
            $result['d']['blue_btask'] = $userOther->blue_btask;
            $result['d']['bstarTask'] = $userOther->bstarTask;
            $result['d']['blue_bstarTask'] = $userOther->blue_bstarTask;
            $result['d']['totalstar'] = $userOther->totalstar;
            $userOther->update();

        }else{//失败
            //命减1,先减life2，life2没了再减life
            if($user->life2 > 0){
                $user->life2--;
            }else{
                $user->subheart();
            }

            $user->update();
            $std->cdtime = $user->cdtime;
        };

        $r = $parm->track;
        $lc = LoseCause::getByLevel($lv);
        $lc->total++;
        if(!empty($r)){
            $lc->lose++;
            foreach($r as $t){
                if(array_key_exists($t,$lc->loseType)){
                    $lc->loseType[$t]++;
                }else{
                    $lc->loseType[$t] = 1;
                }
            }
        }
        $lc->update();


        $std->gold = $user->gold;
        $std->level = $user->level;
        $std->life = $user->life;
        $std->life2 = $user->life2;
        $result['u'] = $std;
        $result['ogs'] = array();

        return $this->finalReturn($result,__FUNCTION__);

    }

    /**
     * 请求加心，一次加满，扣钻石
     */
    public function refill($parm){
        $parm = (object)$parm;
        $uid = $parm->uid;

        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.refill");

        $user = UserModel::getById($uid);
        if($user->openkey!=$parm->openkey){
            return $this->reloadError(__FUNCTION__);
        }

        if($user->gems >= GameConfig::REFILL_PRICE){
            $user->life = $user->maxlife;
            $user->cd = 0;
            $user->gems = $user->gems-GameConfig::REFILL_PRICE;
            $user->update();
            $result = array();
            $result['u']['gems'] = $user->gems;
            $result['u']['life'] = $user->life;
            $result['u']['cdtime'] = 0;

            return $this->finalReturn($result,__FUNCTION__);
        }else{

            return $this->errorReturn("钻石不足",__FUNCTION__);
        }
    }

    /**
     * 半小时加一次命 倒计时结束请求加心
     */
    public function recover($parm){
        $parm = (object)$parm;
        $uid = $parm->uid;
        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.recover");

        $user = UserModel::getById($uid);
        if($user->openkey!=$parm->openkey){
            return $this->reloadError(__FUNCTION__);
        }
        $user->addHeart();
        $user->update();
        $result = array();
        $result['u']['life'] = $user->life;
        $result['u']['cdtime'] = $user->cdtime;
        return $this->finalReturn($result,__FUNCTION__);
    }
    /**
     *邮箱
     */
    public function mailbox($parm){
        $parm = (object)$parm;
        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.mailbox");
        return $this->finalReturn(UserMailModel::getById($parm->uid),__FUNCTION__);
    }


    /**
     * 打开宝箱 返回2,3,4,5,6 帧数
     * 4|1|1|2000    场景id|已开|未领   0表示未领取
     * 4|1|5|1    场景id|已开|已领
     */
    public function openBao($parm){
        $uid = $parm->uid;
        $sceneId = $parm->sceneId;
        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.openBao");

        $data = UserOtherModel::getById($uid);


        $have = false;
        foreach($data->baoxiang as $obj){
            if($obj->sceneId == $sceneId){
                $have = true;
                $obj->status = 1;
            }
        }
        //如果没有则标记为已开，未领取
        if($have == false){
            $model = new BaoModel();
            $model->sceneId = $sceneId;
            $model->status = 1;
            $model->setFrame();

            $data->baoxiang[] = $model;

            $data->update();

        }

        return $this->finalReturn($data->baoxiang,__FUNCTION__);
    }

    /**
     * 宝箱领取奖励
     */
    public function getBao($parm){
        $uid = $parm->uid;
        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.getBao");

        $sceneId = $parm->sceneId;
        $data = UserOtherModel::getById($uid);

        $have = false;
        foreach($data->baoxiang as $obj){
            if($obj->sceneId == $sceneId){
                $have = true;
                //标记为已领取
                $obj->status = 2;

                $result = array();
                if($obj->frame == 2) {
                    $user = UserModel::getById($uid);
                    $user->gold += $obj->num;
                    $user->update();

                    $result['u']['gold'] = $user->gold;
                }elseif($obj->frame == 3){
                    $user = UserModel::getById($uid);
                    $user->gems += $obj->num;
                    $user->update();
                    $result['u']['gems'] = $user->gems;

                }else{

                    $result['d']['bag'] = $data->updateBags2($obj->getItemId(),$obj->num);
                }


                $data->update();
                break;
            }
        }

        if($have == false){
            return $this->errorReturn("此宝箱还没有打开",__FUNCTION__);
        }else{
            return $this->finalReturn($result,__FUNCTION__);
        }
    }

    /**
     * 领取邀请好友奖励
     */
    public function getInviteReward($parm){
        $uid = $parm->uid;
        $bao = new BaoModel();
        $bao->setFrame2();
        $result = array();
        $data = UserOtherModel::getById($uid);
        if($bao->frame == 2) {
            $user = UserModel::getById($uid);
            $user->gold += $bao->num;
            $user->update();

            $result['u']['gold'] = $user->gold;
        }elseif($bao->frame == 3){
            $user = UserModel::getById($uid);
            $user->gems += $bao->num;
            $user->update();
            $result['u']['gems'] = $user->gems;

        }else{
            $result['d']['bag'] = $data->updateBags2($bao->getItemId(),$bao->num);
        }
        $data->invite->lingNum++;
        $result['d']['invite'] = $data->invite;
        $result['d']['bao'] = $bao;

        $data->update();
        return $this->finalReturn($result,__FUNCTION__);
    }
    /**
     * 邀请完好友，传过来邀请的数量
     */
    public function addInviteFdNum($parm){
        $uid = $parm->uid;
        $num = $parm->num;
        $data = UserOtherModel::getById($uid);
        $result = array();
        $data->invite->yaoNum += $num;
        $data->update();
        $result['d']['invite'] = $data->invite;
        return $this->finalReturn($result,__FUNCTION__);
    }

    /**
     * 月卡特权礼包每日
     */
    public function getYueVipDayReward($parm){
        $uid = $parm->uid;
        $vipcfig = GameConfig::getYueKaDayConfig();
        $user = UserModel::getById($uid);
        $user->gems += $vipcfig["gems"];
        $user->gold += $vipcfig["gold"];
        $userOther = UserOtherModel::getById($uid);
        $userOther->updateBags2(2017,$vipcfig["itemsNum1"]);
        $userOther->updateBags2(2016,$vipcfig["itemsNum2"]);
        $user->dayvip = 1;
        //初始化计算甜店
        $userOther->dianInfo->init($userOther->dianInfo->dianlevel,$user->yuevip);
        $lastDianInfo = clone $userOther->dianInfo;
        $userOther->dianInfo->getNext();

        $result['d']['dianInfo'] = $userOther->dianInfo;
        $result['d']['lastDianInfo'] = $lastDianInfo;

        $user->update();
        $userOther->update();

        $result['u']['dayvip'] = $user->dayvip;
        $result['u']['gold'] = $user->gold;
        $result['u']['gems'] = $user->gems;
        $result['d']['bag'] = $userOther->bag;
        return $this->finalReturn($result,__FUNCTION__);
    }
    /**
     * 领取任务奖励
     */
    public function getTaskReward($parm){
        $uid = $parm->uid;
        $type = $parm->type;
        $id = $parm->id;


        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.getTaskReward");
        $user = UserModel::getById($uid);
        $obj = UserLevelInfoModel::getUserLevelInfo($uid);
        $user->compelteLv = $obj['num'];

        if($user->openkey!=$parm->openkey){
            return $this->reloadError(__FUNCTION__);
        }

        $userOther = UserOtherModel::getById($uid);
        $result = array();
        if($type == 0){
            $mainTaskId = $id;
            $clist = GameConfig::getTaskMainConfig();
            $obj = $clist[$mainTaskId];
            if(!$obj){
                return $this->reloadError(__FUNCTION__);
            }
            $user->gold += $obj["gold"];
            $user->update();

            $result["success"] = true;
            $userOther->updateBags2($obj["itemid"],$obj["num"]);
            $result['d']['bag'] = $userOther->bag;
            $userOther->btask->id++;
            $this->checkTask($user,$userOther);
            $result['d']['btask'] = $userOther->btask;
            $result['u']['gold'] = $user->gold;

            $userOther->update();
        }elseif($type == 1){
            $starTaskId = $id;
            $clist = GameConfig::getTaskStarConfig();
            $obj = $clist[$starTaskId];
            if(!$obj){
                return $this->reloadError(__FUNCTION__);
            }
            $user->gems += $obj["gems"];
            $user->update();
            $result["success"] = true;
            $result['u']['gems'] = $user->gems;
            $userOther->bstarTask->id++;
            $this->checkTask($user,$userOther);
            $result['d']['bstarTask'] = $userOther->bstarTask;

            $userOther->update();

        }elseif($type == 2){
            $mainTaskId = $id;
            $clist = GameConfig::getTaskMainConfig();
            $obj = $clist[$mainTaskId];
            if(!$obj){
                return $this->reloadError(__FUNCTION__);
            }
            $user->gold += $obj["gold"]/2;

            $userOther->blue_btask->id++;
            $this->checkTask($user,$userOther);
            $result["success"] = true;
            $result['d']['blue_btask'] = $userOther->blue_btask;
            $result['u']['gold'] = $user->gold;

            $user->update();
            $userOther->update();
        }elseif($type == 3){
            $starTaskId = $id;
            $clist = GameConfig::getTaskStarConfig();
            $obj = $clist[$starTaskId];
            if(!$obj){
                return $this->reloadError(__FUNCTION__);
            }
            $user->gems += $obj["blue_gems"];

            $userOther->blue_bstarTask->id++;
            $this->checkTask($user,$userOther);
            $result["success"] = true;
            $result['u']['gems'] = $user->gems;
            $result['d']['blue_bstarTask'] = $userOther->blue_bstarTask;

            $user->update();
            $userOther->update();
        }
        return $this->finalReturn($result,__FUNCTION__);
    }
    /**
     * 收银，
     */
    public function getYin($parm){
        $uid = $parm->uid;
        $type = $parm->type;

        $result = array();
        $user = UserModel::getById($uid);
        if($user->openkey!=$parm->openkey){
            return $this->reloadError(__FUNCTION__);
        }

        $userOther = UserOtherModel::getById($uid);
        $goldplus = $userOther->dianInfo->goldNum;
        if($type == 0) {
            $user->gold += $goldplus;
            $user->addLife2($userOther->dianInfo->heartNum);
        }else{
            $goldplus = $goldplus*$userOther->dianInfo->oTime;
            $user->gold += $goldplus;
            $userOther->dianInfo->oTime = 0;
            $user->addLife2($userOther->dianInfo->heartNum);

        }

        $lastDianInfo = clone $userOther->dianInfo;
        $userOther->dianInfo->getNext();

        $result['u']['addGold'] = $goldplus;
        $result['u']['gold'] = $user->gold;
        $result['u']['life2'] = $user->life2;
        $result['d']['dianInfo'] = $userOther->dianInfo;
        $result['d']['lastDianInfo'] = $lastDianInfo;

        $user->update();
        $userOther->update();

        return $this->finalReturn($result,__FUNCTION__);
    }
    /**
     * 侻换金币
     */
    public function tuihuan($parm){
        $uid = $parm->uid;
        $result = array();
        $user = UserModel::getById($uid);
        if($user->openkey!=$parm->openkey){
            return $this->reloadError(__FUNCTION__);
        }

        if($user->gems >= 10){
            $user->gems-= 10;
            $user->gold += 1000;
            $user->update();
        }
        $result['u']['gold'] = $user->gold;
        $result['u']['gems'] = $user->gems;

        return $this->finalReturn($result,__FUNCTION__);
    }

    /**
     * cdkey兑换码
     * 加5步*2,刷新棋盘*2,甜品夹子*2,强制交换*2,甜品炸弹*2
     * 2011,2012,2016,2015,2018
     */
    public function getCD_key($parm){
        $uid = $parm->uid;
        $code = $parm->code;

        $db = new MMysql();
        $res = $db->where(array('code'=>$code))->select('d_cdkcode');
        $result = array();

        if($res){
            $userOther = UserOtherModel::getById($uid);
            $userOther->updateBags2(2011,2);
            $userOther->updateBags2(2012,2);
            $userOther->updateBags2(2016,2);
            $userOther->updateBags2(2015,2);
            $userOther->updateBags2(2018,2);
            $result['d']['bag'] = $userOther->bag;
            $userOther->update();
            $db->where(array('id'=>$res[0]['id']))->delete('d_cdkcode');
        }else{
            return $this->errorReturn("兑换码不存在或者已经使用了",__FUNCTION__);
        }

        return $this->finalReturn($result,__FUNCTION__);
    }
    /**
     * 点赞
     */
    public function dianzan($parm){
        $uid = $parm->uid;
        $touid=$parm->touid;
        $user = UserModel::getById($uid);
        if($user->daydo==''){
            $user->daydo .= "$touid";
        }else{
            $user->daydo .= "|$touid";
        }
        $user->gold+=GameConfig::ZAN_GOLD;
        $user->update();
        $to = UserModel::getById($touid);
        $to->zanNum++;
        $to->update();
        $result['u']['gold'] = $user->gold;
        $result['u']['daydo'] = $user->daydo;

        return $this->finalReturn($result,__FUNCTION__);
    }
    /**
     * 接受礼物，
     * 礼物类型:asklife,life,gold,block
     */
    public function receive($parm){
        //fid:this.data.from,name:pd.nick,pic:pd.pic,type:Core.LIFE

        $parm = (object)$parm;
        $uid = $parm->uid;
        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.receive");

        $mailId = $parm->mailId;
        $mail = UserMailModel::getByMailId($mailId);
        $num = $mail['num'];
        $type = $parm->gt;
        $from = $parm->fid;
        $name = $parm->name;
        $pic = $parm->pic;

        $user = UserModel::getById($uid);
        if($user->openkey!=$parm->openkey){
            return $this->reloadError(__FUNCTION__);
        }

        $result = array();

        if($type == GameConfig::LIFE) {
            $user->addLife2($num);
            $user->update();

            UserMailModel::deleteById($mailId);
            $result['u']['life2'] = $user->life2;
            $result['u']['cdtime'] = $user->cdtime;

        }elseif($type == GameConfig::GOLD){
            $user->gold += $num;
            $user->update();

            UserMailModel::deleteById($mailId);
            $result['u']['gold'] = $user->gold;

        }elseif($type == GameConfig::ASKBLOCK){
            UserMailModel::deleteById($mailId);

            if($pic == ''){
                $pic = "1.jpg";
            }
            $model = UserBlockModel::create(array($uid,$pic,$name));
            UserOtherModel::updateBlock2($from,$model);

        }elseif($type == GameConfig::GEM){
            UserMailModel::deleteById($mailId);
            $user->gems+=$num;
            $result['u']['gems'] = $user->gems;
            $user->update();
        }

        return $this->finalReturn($result,__FUNCTION__);
    }
    /**
     * 给好友送礼物，
     * 每天只能送一个 ，0点清零 这里没做控制，前端控制了
     * 礼物类型:asklife,life,gold,block
     */
    public function sendgift($parm){

        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.sendgift");

        UserMailModel::insertMail($parm);
        $from = $parm->uid;
        $to = $parm->fid;



        if(!is_array($to)){
            $tos = array();
            $tos[] = $to;
        }else{
            $tos = $to;
        }
        foreach($tos as $uid){
            $gt = $parm->gt;
            $data = UserOtherModel::getById($from);
            $data->setSendLife($uid,$gt);

            $data->update();

        }

        return $this->finalReturn($data->sendlife,__FUNCTION__);
    }
    /**
     * 使用道具
     */
    public function useitem($parm){
        $parm = (object)$parm;
        $uid = $parm->uid;
        $itemid = $parm->itemid;
        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.useitem");

        $info = UserOtherModel::getById($uid);

        $result = array();
        //如果道具数量不为0，则减数量
        if($info->getBagModel($itemid)->num >= 1){
            $result['d']['bag'] = $info->updateBags2($itemid,-1);
            $info->update();
        }else{//扣钻石
            $propsConfig = GameConfig::getPropsConfig();
            $model = $propsConfig[$itemid];
            $price = $model['gems'];
            $user = UserModel::getById($uid);
            if($user->gems>= $price){
                $user->gems-=$price;
                $user->update();
                $result['u']['gems']=$user->gems;
            }else{
                return $this->errorReturn("钻石不足",__FUNCTION__);
            }
        }

        return $this->finalReturn($result,__FUNCTION__);
    }

    /**
     * 同步金币，钻石，生命，背包,block解锁信息
     * @param $parm
     */
    public function rsync($parm){
        $parm = (object)$parm;
        $uid = $parm->uid;
        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.rsync");
        $user = UserModel::getById($uid);

        $userOther = UserOtherModel::getById($uid);
        $result = array();
        $result['u']['life'] = $user->life;
        $result['u']['gems'] = $user->gems;
        $result['u']['yuevip'] = $user->yuevip;
        $result['u']['gold'] = $user->gold;
        $result['d']["bag"] = $userOther->bag;
        $result['d']["block"] = $userOther->block;

        return $this->finalReturn($result,__FUNCTION__);
    }
    /**
     * 分享获得金币
     * @param $parm
     */
    public function sharecoin($parm){
        $parm = (object)$parm;
        $uid = $parm->uid;
        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.sharecoin");
        $user = UserModel::getById($uid);
        $user->gold+=GameConfig::SHARE_GOLD;
        $user->update();
        $result = array();
        $result['u']['gold'] = $user->gold;
        return $this->finalReturn($result,__FUNCTION__);
    }

    /**
     * 钻石购买block单元
     * @param $parm
     */
    public function buyblock($parm){
        $parm = (object)$parm;
        $uid = $parm->uid;
        if($uid == null){
            return "参数错误";
        }
        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.buyblock");
        $user = UserModel::getById($uid);

        UserOtherModel::updateBlock($uid);

        if($user->gems>=GameConfig::BLOCKE_ITEM_GEM){
            $user->gems-=GameConfig::BLOCKE_ITEM_GEM;
            $user->update();
            $result = array();
            $result["d"]["block"] = UserOtherModel::getById($uid)->block;
            $result["u"]["gems"] = $user->gems;

            return $this->finalReturn($result,__FUNCTION__);
        }else {
            return $this->errorReturn("钻石不够", __FUNCTION__);
        }
    }


    /**
     * 解锁block，更新bnum
     */
    public function unblock($parm){
        $parm = (object)$parm;
        $uid = $parm->uid;
        if($uid == null){
            return "参数错误";
        }
        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.unblock");
        $result = array();
        $result["d"]["block"] = array();

        $user = UserModel::getById($uid);
        $userother = UserOtherModel::getById($uid);

        $userother->bnum++;
        $userother->block = "";

        $user->level++;

        MsgModel::insert($user->uid,$user->nick,$userother->vipinfo,'刚刚解锁了第'.$userother->bnum.'张地图',time());
        $user->update();
        $userother->update();

        $result["d"]["bnum"] = $userother->bnum;
        $result["u"]["level"] = $user->level;

        return $this->finalReturn($result,__FUNCTION__);
    }
    /**
     * 升级店，更新bnum
     */
    public function upgradeDian($parms){
        $parm = (object)$parms;
        $uid = $parm->uid;
        if($uid == null){
            return "参数错误";
        }
        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.buy");
        $shopId = $parm->id;
        $user = UserModel::getById($uid);
        $userOther = UserOtherModel::getById($uid);
        $dianConfig = GameConfig::getTianShopConfig();
        if($shopId == 202){//中级店
            $dc = $dianConfig[2]["gems"];
            if($user->gems>= $dc){
                $user->gems-=$dc;
                $userOther->dianInfo->dianlevel = 2;
                $userOther->dianInfo->init(2);
                $result['dianUpgridOk'] = true;
                $result['u']['gems']=$user->gems;
                $result['d']['dianInfo'] = $userOther->dianInfo;
            }else{
                return $this->errorReturn("钻石不足",__FUNCTION__);
            }


        }elseif($shopId == 203){//高级店
            $dc = $dianConfig[3]["gems"];
            if($user->gems>= $dc){
                $user->gems-=$dc;
                $userOther->dianInfo->dianlevel = 3;
                $userOther->dianInfo->init(3);
                $result['dianUpgridOk'] = true;
                $result['u']['gems']=$user->gems;
                $result['d']['dianInfo'] = $userOther->dianInfo;
            }else{
                return $this->errorReturn("钻石不足",__FUNCTION__);
            }

        }
        $user->update();
        $userOther->update();
        return $this->finalReturn($result,__FUNCTION__);
    }

    /**
     * 人民币购买接口，外部js调用
     * @param $shopId 从0开始
     */
    public function buy($parms){
        $parm = (object)$parms;
        $uid = $parm->uid;
        if($uid == null){
            return "参数错误";
        }
        Logs::getInstance()->setLog("玩家：".$parm->uid." Game.buy");
        $result = array();
        $shopId = $parm->id;
        $user = UserModel::getById($uid);

        if($shopId == 101){//首充礼包
            $userOther = UserOtherModel::getById($uid);
            $user->gems+= 21;
            $userOther->updateFirstBuy2(array(GameConfig::ITEM_Add5Moves_ID,GameConfig::ITEM_Dessert_ID,GameConfig::ITEM_BoardShuffle_ID),array(1,1,1));
            $userOther->update();
        }else{

            $config = GameConfig::getShopConfig();
            $obj = $config[$shopId];
            $gold = $obj["coin"];
            $gems = $obj["cash"];


            if (intval($gold) != 0) {
                $user->gold += $gold;
            }
            if (intval($gems) != 0) {
                $user->gems += $gems;
            }
        }
        $user->update();

        return $this->finalReturn($result,__FUNCTION__);
    }
    /**领取日日奖励*/
    public function getDayReward($parm){
        $parm = (object)$parm;
        $uid = $parm->uid;

        $ary = GameConfig::getDayRewardConfig();
        $user = UserModel::getById($uid);
        $userOther = UserOtherModel::getById($uid);

        $user->logincount++;
        if( $user->logincount> 30){
            $user->logincount = 1;
        }

        $obj = $ary[$user->logincount];
        if(array_key_exists("gold",$obj)){
            $user->gold+= $obj["gold"];
        }
        if(array_key_exists("gems",$obj)){
            $user->gems+= $obj["gems"];
        }

        if(array_key_exists("powers",$obj)){
            $iteminfo =  explode("-",$obj["powers"]);

            $userOther->updateBags2($iteminfo[0],$iteminfo[1]);
        }
        $user->getreward = 1;
        $user->update();
        $userOther->update();

        $result['u']['logincount'] = $user->logincount;
        $result['u']['getreward'] = $user->getreward;
        $result['u']['gold'] = $user->gold;
        $result['u']['gems']=$user->gems;
        $result['d']["bag"] = $userOther->bag;
        return $this->finalReturn($result,__FUNCTION__);
    }
    public function get3366Reward($parm){
        $parm = (object)$parm;
        $uid = $parm->uid;
        $id = $parm->id;

        $user = UserModel::getById($uid);
        $userOther = UserOtherModel::getById($uid);
        $config = GameConfig::get3366VipConfig();
        $obj = $config[$id];
        $userOther->vip3366daypresent = 1;
        $user->gold += $obj['gold'];
        $user->addLife2($obj['heart']);
        $user->update();
        $userOther->update();

        $result['u']['gold'] = $user->gold;
        $result['u']['life2'] = $user->life2;
        $result['d']['vip3366daypresent'] = $userOther->vip3366daypresent;
        return $this->finalReturn($result,__FUNCTION__);
    }
    public function getVipReward($parm){
        $parm = (object)$parm;
        $uid = $parm->uid;
        $id = $parm->id;

        $user = UserModel::getById($uid);
        $userOther = UserOtherModel::getById($uid);
        $config = GameConfig::getVipTeQuanConfig();
        $obj = $config[$id];
        $userOther->vipinfo->isDayGet = 1;
        $user->gold += $obj['gold'];
        $user->addLife2( $obj['heart']);
        $user->update();
        $userOther->update();

        $result['u']['gold'] = $user->gold;
        $result['u']['life2'] = $user->life2;
        $result['d']['vipinfo'] = $userOther->vipinfo;
        return $this->finalReturn($result,__FUNCTION__);
    }

    /**
     * 领取黄钻礼包
     * @param $parm
     */
    public function yellow_vip_lingqu($parm){

        $parm = (object)$parm;
        $uid = $parm->uid;
        $new = $parm->isnew;
        $viplevel = $parm->viplevel;
        $user = UserModel::getById($uid);
        $userOther = UserOtherModel::getById($uid);
        $config = GameConfig::getYellowVipDayPresent();
        $result = array();

        if($new==1){
            $obj = $config[0];
            $userOther->yellownewpresent = 1;
        }else{
            $obj = $config[$viplevel];
            $userOther->yellowdaypresent = 1;
        }

        $user->gold += $obj['gold'];
        $user->addLife2( $obj['heart']);
        $user->update();
        $userOther->update();

        $result['u']['gold'] = $user->gold;
        $result['u']['life2'] = $user->life2;
        $result['d']['yellownewpresent'] = $userOther->yellownewpresent;
        $result['d']['yellowdaypresent'] = $userOther->yellowdaypresent;

        return $this->finalReturn($result,__FUNCTION__);
    }
    /**
     * 领取蓝钻礼包
     * @param $parm
     */
    public function blue_vip_lingqu($parm){

        $parm = (object)$parm;
        $uid = $parm->uid;
        $new = $parm->isnew;
        $blue_vip_level = $parm->blue_vip_level;
        $is_super_blue_vip = $parm->is_super_blue_vip;
        $is_blue_year_vip = $parm->is_blue_year_vip;

        $user = UserModel::getById($uid);
        $userOther = UserOtherModel::getById($uid);
        $config = GameConfig::getBlueVipDayPresent();
        $result = array();

        if($new==1){
            $obj = $config[0];
            $userOther->bluenewpresent = 1;
        }else{
            $obj = $config[$blue_vip_level];
            if($is_super_blue_vip == 1){
                $obj2 = $config[8];
                $user->gold += $obj2['gold'];
                $user->addLife2( $obj2['heart']);
            }
            if($is_blue_year_vip == 1){
                $obj2 = $config[9];
                $user->gold += $obj2['gold'];
                $user->addLife2( $obj2['heart']);
            }
            $userOther->bluedaypresent = 1;
        }

        $user->gold += $obj['gold'];
        $user->addLife2( $obj['heart']);
        $user->update();
        $userOther->update();

        $result['u']['gold'] = $user->gold;
        $result['u']['life2'] = $user->life2;
        $result['d']['bluenewpresent'] = $userOther->bluenewpresent;
        $result['d']['bluedaypresent'] = $userOther->bluedaypresent;

        return $this->finalReturn($result,__FUNCTION__);
    }
    private function finalReturn($array,$method){
        $finalv = array();
        $finalv["code"] = 1;
        $finalv["rdata"] = $array;
        $finalv["method"] = __CLASS__.".".$method;

        MMysql::closeConnection();

        return $finalv;
    }

    private function reloadError($method){
        $finalv = array();
        $finalv["code"] = -1;
        $finalv["rdata"] = "出错了";
        $finalv["method"] = __CLASS__.".".$method;

        MMysql::closeConnection();

        return $finalv;
    }
    private function errorReturn($msg,$method){
        $finalv = array();
        $finalv["code"] = 2;
        $finalv["msg"] = $msg;
        $finalv["method"] = __CLASS__.".".$method;
        MMysql::closeConnection();
        return $finalv;
    }
}
?>