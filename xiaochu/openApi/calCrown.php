<?php
/**
 * 每天0点计算排行榜数据
 * 每天0点计算是否给第一名增加皇冠数量
 */
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

$rank_data = GameConfig::getRankList();

$rank = -1;
$ary = $rank_data->data1;
//把第一名存入数据库
$data1 = array();
$data1['uid'] = $ary[0]['uid'];
$data1['level'] = $ary[0]['level'];
$data1['nick'] = $ary[0]['nick'];
$data1['rank'] = 0;

$db = new MMysql();
$res = $db->select('u_rank');


$flag = false;
if(count($res) > 0) {
    //非空的话是上一次的第一名,对比这次的第一名，如果不是同一个人则给新的第一名加皇冠数量，同时更新
    $lastRankdata = $res[0];
    $uid = $lastRankdata['uid'];

    if($data1['uid'] != $uid){
        $flag = true;
    }
}else{//空的话直接给第一名加皇冠数量
    $flag = true;
}

if($flag){
    $user = UserModel::getById($data1['uid']);
    $user->crownNum ++;
    $user->update();

    $db->where('1=1')->delete('u_rank');
    $res = $db->insert('u_rank', $data1);
    if($res){
        //写入log
        echo('更新u_rank成功'.date("Y-m-d H:i:s")."\n");
    }
}else{
    echo('第一名没变，无需更新'.date("Y-m-d H:i:s")."\n");
}

$db->close();

function glog($msg){
    $myfile = fopen("/var/www/html/newfile.txt", "a+");
    //or die("Unable to open file!!");
    fwrite($myfile, $msg.date("Y-m-d H:i:s")."\n");
    fclose($myfile);
}

