<?php
require_once "ApiInfo.class.php";
require_once "../Amfphp/app/util/Logs.class.php";
require_once "../Amfphp/app/GameConfig.class.php";
require_once "../Amfphp/app/util/MMysql.class.php";
require_once "../Amfphp/app/UserLevelInfoModel.class.php";

$pf = $_GET['pf'];
$openid = $_GET['openid'];
if($pf == '6533'){
    $db = new MMysql();
    $res = $db->where(array('uid'=>$openid))->select("u_user");
    if($res[0]) {
        //ret=0为正常
        $myinfo = array('ret'=>0,'nickname' => $res[0]['nick2'], 'gender' => $res[0]['sex'], 'figureurl' => $res[0]['pic2']);
    }else{
        $myinfo = array('ret'=>1);
    }

    $friendsids = array();
    $friends_ls = array();
    $friendsinfo = array();
    if($res[0]['friendIds']){
        $friendsids = explode(',',$res[0]['friendIds']);
        if(count($friendsids)!=0)
        {
            $friendsinfo['items'] = array();
            foreach($friendsids as $value)
            {
                $res = $db->where(array('uid'=>$value))->select("u_user");
                $item = array('openid'=>$res[0]['uid'],'nickname'=>$res[0]['nick2'],'gender'=>$res[0]['sex'],'figureurl'=>$res[0]['pic2']);
                $friendsinfo['items'][] = $item;
            }
            $friendsinfo['ret'] = 0;
            $friends_ls = UserLevelInfoModel::getFriendLevelInfo($friendsids);
        }
    }

    $re = new stdClass();
    $re->friendsinfo = $friendsinfo;
    $re->myinfo = $myinfo;
    $re->friends_ls = $friends_ls;

    MMysql::closeConnection();
    echo json_encode($re);

}else{

    $api = new ApiInfo($_GET['openid'],$_GET['openkey'],$_GET['pf'],$_GET['pfkey']);
    $friendsinfo= $api->getFriendInfos();
    $friendsinfo = (object)$friendsinfo;

    //$friendsinfo = json_decode(getfriends());

    if($friendsinfo->ret==0){
        $openids = array();
        foreach($friendsinfo->items as $item){
            if(is_array($item)){
                $openids[] = $item['openid'];
            }else{
                $openids[] = $item->openid;
            }
        }
        $friends_ls = UserLevelInfoModel::getFriendLevelInfo($openids);
    }
    $myinfo = $api->getMyInfo();

    //$myinfo = json_decode(getplayer());

    $re = new stdClass();
    $re->friendsinfo = $friendsinfo;
    $re->myinfo = $myinfo;
    $re->friends_ls = $friends_ls;

    MMysql::closeConnection();
    echo json_encode($re);
}
function getfriends(){
    $result = '{"ret":0,"is_lost":0,"items":[{"openid":"1471CCA71C53D2332E1772A32437E2CB","nickname":"hifree","figureurl":"http:\/\/thirdapp1.qlogo.cn\/qzopenapp\/84efbcf7faca4c85b5c2c3820df97e62b1a9e1361195f91fb9a4eeca03316366\/50","is_yellow_vip":0,"is_yellow_year_vip":0,"yellow_vip_level":0,"is_yellow_high_vip":0,"gender":"\u7537","city":"\u4e1c\u57ce","province":"\u5317\u4eac","country":"\u4e2d\u56fd"}]}';
    return $result;
}
function getplayer(){
    $result = '{"ret":0,"is_lost":0,"nickname":"hifuture","gender":"\u7537","country":"\u4e2d\u56fd","province":"\u5317\u4eac","city":"\u660c\u5e73","figureurl":"http:\/\/thirdapp0.qlogo.cn\/qzopenapp\/e1bf14f30edae71bfc8a00789fb35a33a7439d4ac972efc54533aa365f6c36a6\/50","is_yellow_vip":0,"is_yellow_year_vip":0,"yellow_vip_level":0,"is_yellow_high_vip":0}';
    return $result;
}
?>