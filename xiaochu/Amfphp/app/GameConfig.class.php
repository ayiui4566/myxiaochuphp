<?php

class GameConfig{
    public static $config_tx = array("host"=>'10.66.109.58',"port"=>"3306","user"=>"root","passwd"=>"jiangbo123","dbname"=>"xiaochu");
    public static $config_6533 = array("host"=>'10.66.109.58',"port"=>"3306","user"=>"root","passwd"=>"jiangbo123","dbname"=>"xiaochu6533");
    public static $config_localhost = array("host"=>'localhost',"port"=>"3306","user"=>"root","passwd"=>"wdf123","dbname"=>"xiaochu");

    public static $pf = 'localhost';

    public static function getDB_config(){
        switch(self::$pf){
            case 'tx':
                return self::$config_tx;
            case 'localhost':
                return self::$config_localhost;
            case '6533':
                return self::$config_6533;
        }
    }
    /*当前最大地图数量*/
    const MAX_SCEENNOS = 60;
    const NEXT_UPDATE = "画家们正在努力制作下一张地图";
    //基础行动力
    public static $MAX_LIFE = 5;
    public static $MAX_LIFE2 = 10;
    //点赞加金币数
    const ZAN_GOLD = 5;
    //场景关卡数量
    const SCENE_LEVEL = 10;
    //从那一个场景开始有block
    const BLOCK_START = 5;
    //一次加心扣多少钻石
    const REFILL_PRICE = 15;
    //送礼物的类型
    const ASKLIFE = "asklife";
    const ASKBLOCK = "askblock";

	const LIFE = "life";
	const GOLD = "gold";
	const GEM = "gem";
    //给好友送金币一次送1000
    const MAILTOFRIEND_GOLD = 100;
    //分享获得金币
    const SHARE_GOLD = 100;
    //解锁一个block单元需要几个钻石
    const BLOCKE_ITEM_GEM = 3;

    //收费道具id
    /**甜品夹子*/
    const ITEM_Dessert_ID = 2016;
    /**炸弹*/
    const ITEM_CremeBrulee_ID = 2018;
    /**横和竖扫 双勺子*/
    const ITEM_DoubleScoop_ID = 2017;
    /**消除同一种基础模块*/
    const ITEM_TakeOut_ID = 2013;
    /**加5步*/
    const ITEM_Add5Moves_ID = 2011;
    /**刷新棋盘*/
    const ITEM_BoardShuffle_ID = 2012;
    /**增温 太阳*/
    const ITEM_WarmingUp_ID = 2014;
    /**勉强移动*/
    const ITEM_Nudge_ID = 2015;


    /**
     * block配置 跟着场景走 ，第一个场景 id=1,第二个id=3
     * @return array
     */
    public static function getBlockConfig(){
        $arry = array();

        $arry[self::BLOCK_START] = 1;
        $arry[self::BLOCK_START+1] = 2;
        $arry[self::BLOCK_START+2] = 3;
        for($i = 8;$i<100;$i++){
            $arry[$i] = 3;
        }

        return $arry;
    }

    /**
     * 商店表配置
     * @return array
     */
    public static function getShopConfig(){

        $db = new MMysql();
        $res = $db->select("c_shop",true);

        return StringUtil::arrayChangeKey($res,'id');
    }
    /**
     * 主线任务表配置
     * @return array
     */
    public static function getTaskMainConfig(){
        $db = new MMysql();
        $res = $db->select("c_tasks_main",true);
        return StringUtil::arrayChangeKey($res,'id');
    }
    /**
     * 星星任务表配置
     * @return array
     */
    public static function getTaskStarConfig(){
        $db = new MMysql();
        $res = $db->select("c_tasks_star",true);
        return StringUtil::arrayChangeKey($res,'id');
    }

    /**
     * 日日奖励配置
     * @return array
     */
    public static function getDayRewardConfig(){
        $db = new MMysql();
        $res= $db->select("c_dayreward",true);

        $ary = StringUtil::arrayChangeKey($res,'id');
        return $ary;
    }

    /**
     *
     * 裙子配置表
     * @return array
     */
    public static function getDressesConfig(){
        $db = new MMysql();
        $result = $db->select("c_dresses",true);
        $rr = array();
        foreach ($result as $key=>$value){
            $rr[$key] = $value;
        }
        return $rr;
    }

    /**
     *道具配置表
     */
    public static function getPropsConfig(){
        $db = new MMysql();
        $res = $db->select("c_props",true);
        return StringUtil::arrayChangeKey($res,'id',false);
    }

    /***
     * 月卡每日礼包配置
     */
    public static function getYueKaDayConfig(){
        return array("gems"=>12,"gold"=>4000,"itemsNum1"=>2,"itemsNum2"=>2);
    }
    /**
     *甜品店配置表
     * 初级店每天可产3300 ，关卡前道具1个
     * 中级店每天可产9600，关卡前道具3个
     * 高级店每天可产26400，关卡前道具8.8个
     */
    public static function getTianShopConfig(){
        $ary = array(
            "1"=>array("times"=>8,"cdTime"=>20,"gold"=>200,"increase"=>10,"heart"=>20,"name"=>"初级店","ugold"=>10000,"gems"=>0),
            "2"=>array("times"=>15,"cdTime"=>7,"gold"=>1200,"increase"=>50,"heart"=>100,"name"=>"中级店","ugold"=>10000,"gems"=>900),
            "3"=>array("times"=>25,"cdTime"=>5,"gold"=>2400,"increase"=>100,"heart"=>100,"name"=>"高级店","ugold"=>10000,"gems"=>2500)
        );
        return $ary;
    }
    /**
     *3366等级礼包配置表
     */
    public static function get3366VipConfig(){
        $ary = array(
            "1"=>array("gold"=>100,"heart"=>1),
            "2"=>array("gold"=>200,"heart"=>2),
            "3"=>array("gold"=>300,"heart"=>2),
            "4"=>array("gold"=>400,"heart"=>3),
            "5"=>array("gold"=>500,"heart"=>3),
            "6"=>array("gold"=>550,"heart"=>3)
        );
        return $ary;
    }
    /**
     *vip特权配置表
     */
    public static function getVipTeQuanConfig(){
        $ary = array(
            "0"=>array("gold"=>0,   "lifemax1"=>5, "lifemax2"=>10,"heart"=>0,"addStep"=>0),
            "1"=>array("gold"=>3500,"lifemax1"=>10,"lifemax2"=>25,"heart"=>4,"addStep"=>1),
            "2"=>array("gold"=>5000,"lifemax1"=>10,"lifemax2"=>25,"heart"=>5,"addStep"=>2),
            "3"=>array("gold"=>6000,"lifemax1"=>10,"lifemax2"=>25,"heart"=>6,"addStep"=>3),
            "4"=>array("gold"=>8000,"lifemax1"=>15,"lifemax2"=>30,"heart"=>7,"addStep"=>4),
            "5"=>array("gold"=>10000,"lifemax1"=>15,"lifemax2"=>30,"heart"=>8,"addStep"=>5),
            "6"=>array("gold"=>12000,"lifemax1"=>15,"lifemax2"=>30,"heart"=>9,"addStep"=>5)
        );
        return $ary;
    }
    public static function getMaxLife1($viplevel){
        $config = self::getVipTeQuanConfig();
        return $config[$viplevel]['lifemax1'];
    }
    public static function getMaxLife2($viplevel){
        $config = self::getVipTeQuanConfig();
        return $config[$viplevel]['lifemax2'];
    }
    /**
     *VIP再充值多少钻石配置 ，一共vip1-vip6
     */
    public static function getVipGemsConfig(){
        $ary = array(0,200,500,1000,1500,2000,3000);
        return $ary;
    }
    /**
     *VIP再充值多少钻石配置 ，看玩家AMT充值总额在哪个区间，判断level
     */
    public static function calVipLevel($amt){
        $res = array();
        $ary = self::getVipGemsConfig();
        $total = 0;
        for($i=0;$i<count($ary);$i++){
            $total += $ary[$i];
            $res[$i] = $total;
        }
        //res=[0,100,600,1600,3100,5100,8100];
        for($i=count($ary)-1;$i>=0;$i--)
        {
            if($amt>=$res[$i]) return $i;
        }
    }
    public static function getUserVipLevel($uid){
        $db = new MMysql();
        $res = $db->doSql("select sum(addgems) as all1 from u_pay where openid='$uid'");
        return self::calVipLevel($res[0]['all1']);
    }

    /**
     * 是否是付费玩家
     * @param $uid
     * @return int
     */
    public static function getIsPay($uid){
        $db = new MMysql();
        $res1 = $db->doSql('select distinct openid from u_pay');
        $openids = array();
        foreach($res1 as $value){
            $openids[] = $value['openid'];
        }
        if(in_array($uid,$openids)){
            return 1;
        }else{
            return 0;
        }
    }
    /**
     *黄钻每日礼包配置表
     * 0是新手礼包
     * 以后的是vip1，vip2等
     */
    public static function getYellowVipDayPresent(){
        $ary = array(
            "0"=>array("gold"=>200,"heart"=>2),
            "1"=>array("gold"=>100,"heart"=>1),
            "2"=>array("gold"=>200,"heart"=>2),
            "3"=>array("gold"=>300,"heart"=>2),
            "4"=>array("gold"=>400,"heart"=>3),
            "5"=>array("gold"=>500,"heart"=>3),
            "6"=>array("gold"=>520,"heart"=>3),
            "7"=>array("gold"=>530,"heart"=>3),
            "8"=>array("gold"=>550,"heart"=>3)
        );
        return $ary;
    }
    /**
     *蓝钻每日礼包配置表
     * 0是新手礼包 8是豪华版，9是年费
     * 以后的是vip1，vip2等
     */
    public static function getBlueVipDayPresent(){
        $ary = array(
            "0"=>array("gold"=>200,"heart"=>2),
            "1"=>array("gold"=>100,"heart"=>1),
            "2"=>array("gold"=>200,"heart"=>2),
            "3"=>array("gold"=>300,"heart"=>2),
            "4"=>array("gold"=>400,"heart"=>3),
            "5"=>array("gold"=>500,"heart"=>3),
            "6"=>array("gold"=>520,"heart"=>3),
            "7"=>array("gold"=>530,"heart"=>3),
            "8"=>array("gold"=>540,"heart"=>3),
            "9"=>array("gold"=>550,"heart"=>3)
        );
        return $ary;
    }
    /**
     *活动内容配置
     */
    public static function getHuodongFont(){
        $ary1 = array(
            "1"=>"1，好评送钻活动开始了，点击游戏上方的详情给甜品消消一个五星好评，立即赠送<font color='#289A06'><b>2</b></font>钻石哦，每个玩家仅限一次，详情请查看论坛，亲~真的不费劲，只需要几秒钟即可收获钻石，just do it",
            "2"=>"2，游戏分享奖励继续双倍，赶快点分享按钮吧,荣誉榜上点击昵称点赞可以获得金币哦~",
            "3"=>"3，累计充值200钻石即可成为vip,每日礼包,永久增加生命值上限，移动步数，通关神器哇~",
            "4"=>"4，逢年过节不收礼，送礼就送甜品消消vip，送好友，送爸妈，送长辈,进qq群：198450331，立即送<font color='#289A06'><b>5</b></font>钻石~"
        );
        $ary2 = array(
            "1"=>"1，累计充值200钻石即可成为vip,每日礼包,永久增加生命值上限，移动步数，通关神器哇~",
        );
        if(self::$pf == 'tx'){
            return $ary1;
        }else {
            return $ary2;
        }
        return null;
    }

    /**
     * $page 第几页
     * 荣耀排行榜 前三百名，前端分页,每天凌晨更新缓存服务器，memcached
     *得到全服排行榜列表
     * 名次，昵称，最大关卡 $type=1
     * 名次，昵称，星星数量 $type=2
     * 名次，昵称，金币数量 $type=3
     */
    public static function getRankList(){
        $db = new MMysql();
        $std = new stdClass();

        //前三百名，前端分页,
        $pageSize = 300;

        $sql1 = "select u.uid,u.nick,u.nick2,u.pic,u.pic2,u.loginTime,u.isSaveNick,u.zanNum,u.yuevip,u.level,u.crownNum,d.vipinfo from u_user as u left join d_user_other as d on u.uid=d.uid order by u.level desc,u.zanNum desc ";

        $_limit = "limit 0,".$pageSize;
        $sql1.=$_limit;

        $res1 = $db->doSql($sql1);

        //echo $db->getLastSql();
        $std->data1 = $res1;

        $sql2 = "select u.uid,u.nick,u.nick2,u.pic,u.pic2,u.loginTime,u.isSaveNick,u.zanNum,u.yuevip,u.crownNum,d.totalstar,d.vipinfo from u_user as u left join d_user_other as d on u.uid=d.uid order by d.totalstar desc ";

        $_limit = "limit 0,".$pageSize;
        $sql2.=$_limit;

        $res2 = $db->doSql($sql2);

        $std->data2 = $res2;
        //echo $db->getLastSql();
        return $std;
    }

    public static function getRankList2(){
        $db = new MMysql();
        $std = new stdClass();

        //前三百名，前端分页,
        $pageSize = 30;

        $res1 = $db->field(array('uid','nick','pic',level,zanNum,yuevip))
            ->order(array('level' => 'desc'))
            ->limit(1, $pageSize)
            ->select('u_user');

        echo $db->getLastSql();
        $std->data1 = $res1;

        $sql = "select u.uid,u.nick,u.pic,u.zanNum,u.yuevip,d.totalstar from u_user as u left join d_user_other as d on u.uid=d.uid order by totalstar desc ";

        $_limit = "limit 0,".$pageSize;
        $sql.=$_limit;

        $res2 = $db->doSql($sql);

        $std->data2 = $res2;
//        echo $db->getLastSql();
        return $std;
    }
    public static function testbug(){
        $db = new MMysql();
        $res = $db->limit(1, 30)->select('u_user');
        echo $db->getLastSql();
        return $res;
    }

}