<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/1
 * Time: 5:42
 */

class UserModel
{

    public $uid;
    public $nick;
    public $nick2;
    //性别
    public $sex;
    public $pic;
    public $pic2;
    public $isSaveNick;

    public $charge;
    public $chargetime;
    public $gems;

    public $gold;
    public $level;
    public $life;
    //好友送的命，扣的时候先扣这个，为0则再扣life
    public $life2;
    //基础maxlife2为5，vip1为10
    public $maxlife;
    //基础maxlife2为10，vip1为25
    public $maxlife2;
    /**
     * 上次登陆时间戳
     */
    public $login;
    public $recover;
    public $register;
    public $xp;
    //每次登陆都更新openkey，客户端每次请求也带上来openkey，
    //做下对比，如果openkey不一样，表示一个账号打开了两个网页
    public $openkey;
//(:uid, :cd, :charge, :chargetime, :gems,:getreward,:gold,:level,:life,:login,:logincount,:maxlife,:recover,:register,:xp)
    //获得的赞数
    public $zanNum;
    //点赞字段
    public $daydo;
    //是否是月卡vip用户
    public $yuevip;
    //月卡vip购买时间戳
    public $vipbuytime;
    //今日是否领取了月卡每日礼包
    public $dayvip;

    private $cd;
    /**
     * 连续登陆天数，只要登陆就+1，30次清零0，重新开始
     * 用一个字段记录用户的最后登陆时间。假如最后登陆时间是昨天，就说明是第一次登陆；
     * 如果最后登录时间是今天，就意味着不是第一次登陆。
     * 连续登陆的天数，-1时候前台需要弹出日日奖励面板
     * 第一天logincount=1
     */
    public $logincount;
    /**是否已经领取了日日奖励 1 为领了，0 为未领取*/
    public $getreward;
    //已经完成的关卡数
    private $compelteLv;

    public $isGetDayReward;
    public $cdtime;
    public $friendIds;
    //登陆次数
    public $loginTime;
    //是否是付费玩家
    public $isPay;
    //皇冠数量 从不是第一名到第一名会数量++
    public $crownNum;


    public function __construct()
    {
        $this->uid = strval($this->uid);
        $this->isSaveNick = intval($this->isSaveNick);
        $this->cd = intval($this->cd);
        $this->charge = intval($this->charge);
        $this->chargetime = intval($this->chargetime);
        $this->gems = intval($this->gems);
        $this->getreward = intval($this->getreward);
        $this->gold = intval($this->gold);
        $this->level = intval($this->level);
        $this->life = intval($this->life);
        $this->life2 = intval($this->life2);
        $this->login = intval($this->login);
        $this->logincount = intval($this->logincount);
        $this->maxlife = intval($this->maxlife);
        $this->recover = intval($this->recover);
        $this->register = intval($this->register);
        $this->xp = intval($this->xp);
        $this->zanNum = intval($this->zanNum);
        $this->daydo = strval($this->daydo);
        $this->yuevip = intval($this->yuevip);
        $this->dayvip = intval($this->dayvip);
        $this->loginTime = intval($this->loginTime);
        $this->isPay = intval($this->isPay);
        $this->crownNum = intval($this->crownNum);

    }
    public function __get($property_name)
    {
        if(isset($this->$property_name))
        {
            return($this->$property_name);
        }
        else
        {
            return(NULL);
        }
    }
    public function __set($property_name, $value)
    {
        $this->$property_name = $value;
    }

    /**
     * 新建用户
     * @param $uid
     * @return bool
     * @throws Exception
     */
    public static function insert($uid)
    {
        try {
            $pdo = MMysql::getConnection();
            $tsql = "INSERT INTO u_user(uid, cd, charge, chargetime, gems, getreward, gold, level, life, life2, login, logincount, maxlife, maxlife2, recover, register, xp, openkey, zanNum, daydo, yuevip ,dayvip, isPay, crownNum)";
            $tsql .=          " VALUES(:uid,:cd,:charge,:chargetime,:gems,:getreward,:gold,:level,:life,:life2,:login,:logincount,:maxlife,:maxlife2,:recover,:register,:xp,:openkey,:zanNum,:daydo,:yuevip,:dayvip,:isPay,:crownNum)";

            $nowd = strtotime("now");
            $stmt = $pdo->prepare($tsql);
            $stmt->bindValue(':uid', $uid);
            $stmt->bindValue(':cd', 0);
            $stmt->bindValue(':charge', 0);
            $stmt->bindValue(':chargetime', 0);
            $stmt->bindValue(':gems', 10);
            $stmt->bindValue(':getreward', 0);
            $stmt->bindValue(':gold', 10000);
            $stmt->bindValue(':level', 1);
            $stmt->bindValue(':life', GameConfig::$MAX_LIFE);
            $stmt->bindValue(':life2', 0);
            $stmt->bindValue(':login', 0);
            $stmt->bindValue(':logincount', 0);
            $stmt->bindValue(':maxlife', GameConfig::$MAX_LIFE);
            $stmt->bindValue(':maxlife2', GameConfig::$MAX_LIFE2);
            $stmt->bindValue(':recover', 0);
            $stmt->bindValue(':register', $nowd);
            $stmt->bindValue(':xp', 0);
            $stmt->bindValue(':openkey', '');
            $stmt->bindValue(':zanNum', 0);
            $stmt->bindValue(':yuevip', 0);
            $stmt->bindValue(':dayvip', 0);
            $stmt->bindValue(':daydo', '');
            $stmt->bindValue(':isPay', 0);
            $stmt->bindValue(':crownNum', 0);
            return $stmt->execute();
        } catch (PDOException $e) {
            $error = date("Y-m-d g:i:s a T") . "\tGame::createUser\tError: (" . $e->getCode . ") " . $e->getMessage;
            throw new Exception($error);
        }
        Logs::getInstance()->pushSqlStr($tsql);
    }

    /**
     * 查询用户
     * @param $uid
     * @return bool
     * @throws Exception
     */
    public static function getById($uid)
    {
        $uid = (string)$uid;
        $key = md5(__CLASS__.$uid).'UserModel:uid='.$uid;

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
        $sql = "select * from u_user where uid=?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1,$uid,PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchObject(__CLASS__);
        if(!$data){//没有找到后新建用户
            self::insert($uid);
            $data = self::_getById($uid);
            return $data;
        }
        Logs::getInstance()->pushSqlStr("select * from u_user where uid='$uid'");
        return $data;
    }

    public function update()
    {
        $key = md5(__CLASS__.$this->uid).'UserModel:uid='.$this->uid;

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
        return $db->where(array('uid' => $this->uid))->update('u_user', $data);
    }
    /**
     * 计算排名和皇冠数量
     */
    function calCrown($rankdata){
        $rank = -1;
        $ary = $rankdata->data1;
        for($i=0;$i<count($ary);$i++){
            if($ary[$i]['uid'] == $this->uid){
                $rank = $i;
                break;
            }
        }
        //旧的rank不是第一，新的是第一,0是第一，-1表示初始化
        if($this->rank>0 && $rank ==0){
            $this->crownNum++;
        }elseif($this->rank==-1 && $rank ==0){
            $this->crownNum++;
        }
        $this->rank = $rank;
    }

    public function checklife2(){
        if($this->life2>$this->maxlife2){
            $this->life2=$this->maxlife2;
        }
    }
    public function addLife2($value){
        $this->life2+=$value;
        if($this->life2>$this->maxlife2){
            $this->life2=$this->maxlife2;
        }
    }
    /**
     * 减心操作
     * @return int
     */
    public function subHeart()
    {
        if ($this->life > 0) {
            $this->life--;
            if ($this->cd == 0) {
                $this->cd = time();
            }
        }

        $this->cdtime = 1800 - (time() - $this->cd);
    }

    /**
     * 加心操作
     * @return int
     */
    public function addHeart($force = false)
    {
        if ($this->cd == 0) {
            $this->life = $this->maxlife;
        }
        if ($this->life < $this->maxlife) {
            $intvalttime = time() - $this->cd;
            if (intval($intvalttime / 1800) > 0) {
                $this->life += intval($intvalttime / 1800);
                if ($this->life >= $this->maxlife) {
                    $this->cd = 0;
                    $this->cdtime = 0;
                    $this->life = $this->maxlife;
                } else {
                    $this->cd = time() - $intvalttime % 1800;
                    $this->cdtime = 1800 - $intvalttime % 1800;
                }
            } else {
                if ($force) {
                    $this->life += 1;
                    if ($this->life == $this->maxlife) {
                        $this->cd = 0;
                        $this->cdtime = 0;
                    } else {
                        $this->cd = time();
                        $this->cdtime = 1800;
                    }
                } else {
                    $this->cdtime = 1800 - $intvalttime;
                }
            }
        } else {
            $this->cd = 0;
            $this->cdtime = 0;
        }
    }
}
