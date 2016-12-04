<?php
require_once "ApiInfo.class.php";
require_once "../Amfphp/app/util/Logs.class.php";
require_once "../Amfphp/app/util/MMysql.class.php";
require_once "../Amfphp/app/util/StringUtil.class.php";
require_once "../Amfphp/app/util/Logs.class.php";
require_once "../Amfphp/app/GameConfig.class.php";
require_once "../Amfphp/app/LevelConfig.class.php";
require_once "../Amfphp/app/UserModel.class.php";
require_once "../Amfphp/app/UserLevelInfoModel.class.php";
require_once "../Amfphp/app/UserMailModel.class.php";
require_once "../Amfphp/app/UserOtherModel.class.php";
require_once "../Amfphp/app/UserBlockModel.class.php";
require_once "../Amfphp/app/BagModel.class.php";
require_once "../Amfphp/app/DianModel.class.php";
require_once "../Amfphp/app/NotifyModel.class.php";
require_once "../Amfphp/app/SendLifeModel.class.php";
require_once "../Amfphp/app/TaskModel.class.php";
require_once "../Amfphp/app/BaoModel.class.php";
require_once "../Amfphp/app/InviteModel.class.php";
require_once "../Amfphp/app/LoseCause.class.php";

if(isset($_GET['pf']) && $_GET['pf']=='6533'){//6533平台发货接口
    $data1 = array();
    $data1['billno'] = $billno = $_GET['billno'];//订单号
    $data1['addgems'] = $addgems = $_GET['addgems'];
    $data1['openid'] = $openid = $_GET['openid'];//uid
    $data1['time'] = $time = $_GET['time'];
    $data1['amt'] = $amt = $_GET['amt'];//金额人民币毛
    $data1['sid'] = $sid = $_GET['sid'];//区服
    $db = new MMysql();
    $res = $db->insert('u_pay', $data1);

    $std = new stdClass();
    if($res){

        $user = UserModel::getById($openid);

        $user->gems += $data1['addgems'];

        $user->update();

        $std->ret = 0;
        $std->msg = "OK";
    }else{
        $std->ret = 1;
        $std->msg = "支付写入失败";
    }

    $db->close();
    echo json_encode($std);

}else {
    if (isset($_GET['token'])) {//发货Url 已经购买成功,腾讯调用
//    openid=0000000000000000000000001A2EFFFC&appid=1105455691&ts=4546666&payitem=1*50*2&token=5467913636&billno=123456789&version=v3&zoneid=0&providetype=0&amt=100&payamt_coins=0&pubacct_payamt_coins=0&sig=45566

        $data1 = array();
        $data1['openid'] = $openid = $_GET['openid'];
        $data1['appid'] = $appid = $_GET['appid'];
        $data1['ts'] = $ts = $_GET['ts'];
        //id*price*num
        $data1['payitem'] = $payitem = $_GET['payitem'];
        $data1['token'] = $token = $_GET['token'];
        //发货流水号
        $data1['billno'] = $billno = $_GET['billno'];
        $data1['version'] = $version = $_GET['version'];
        $data1['zoneid'] = $zoneid = $_GET['zoneid'];
        $data1['providetype'] = $providetype = $_GET['providetype'];
        //Q点/Q币消耗金额或财付通游戏子账户的扣款金额
        $data1['amt'] = $amt = $_GET['amt'] * 0.1;
        $data1['payamt_coins'] = $payamt_coins = $_GET['payamt_coins'];
        $data1['pubacct_payamt_coins'] = $pubacct_payamt_coins = $_GET['pubacct_payamt_coins'];
        $data1['sig'] = $sig = $_GET['sig'];

        $db = new MMysql();


        Logs::getInstance()->setLog("玩家：" . $openid . " 购买了" . $payitem . "扣款amt=" . $amt);

        if ($amt && $amt != 0) {//扣款不为0的时候发货

            $ary1 = explode("*", $payitem);

            $shopId = $ary1[0];
            $user = UserModel::getById($openid);

            if ($shopId == 101) {//首充礼包
                $userOther = UserOtherModel::getById($openid);
                $user->gems += 21;
                $userOther->updateFirstBuy2(array(GameConfig::ITEM_Add5Moves_ID, GameConfig::ITEM_Dessert_ID, GameConfig::ITEM_BoardShuffle_ID), array(1, 1, 1));
                $userOther->update();
                $data1['addgems'] = 21;
                $res = $db->insert('u_pay', $data1);
            }elseif ($shopId == 102){
                $userOther = UserOtherModel::getById($openid);
                $user->gems += 30;
                $userOther->updateFirstBuy2(array(GameConfig::ITEM_Add5Moves_ID, GameConfig::ITEM_Dessert_ID, GameConfig::ITEM_BoardShuffle_ID), array(2, 2, 2));
                $userOther->update();
                $data1['addgems'] = 30;
                $res = $db->insert('u_pay', $data1);
            }elseif ($shopId == 4) {
                $user->yuevip = 1;
                $user->vipbuytime = time();
                $user->dayvip = 0;
                $data1['addgems'] = 300;
                $res = $db->insert('u_pay', $data1);
            } else {

                $config = GameConfig::getShopConfig();
                $obj = $config[$shopId];
                $gems = $obj["cash"] * $ary1[2];
                if (intval($gems) != 0) {
                    $user->gems += $gems;
                    $data1['addgems'] = $gems;
                    $res = $db->insert('u_pay', $data1);
                }
            }
            $user->update();
        }

        $std = new stdClass();
        $std->ret = 0;
        $std->msg = "OK";

        $db->close();
        echo json_encode($std);


    } else {//请求购买接口 由flash调用,然后调用fusion2.dialog.buy

        $api = new ApiInfo($_GET['openid'], $_GET['openkey'], $_GET['pf'], $_GET['pfkey']);

        $res = $api->buy_goods($_GET['payitem'], $_GET['goodsmeta'], $_GET['goodsurl']);
        echo json_encode($res);
    }
}
?>