<?php
error_reporting(E_ALL);
require_once "../Amfphp/app/util/Logs.class.php";
include_once "../Amfphp/app/GameConfig.class.php";
include_once "../Amfphp/app/util/MMysql.class.php";

session_start();
$status = 0;
if(!isset($_POST['u_Id']) || !isset($_POST['operate']))
{
    echo $status;
    return;
}

$u_id = _post("u_Id");
$operate = _post("operate");
$u_nick = _post("u_nick");
$u_level = _post("u_level");
$u_gold = _post("u_gold");
$u_gems = _post("u_gems");

$db = new MMysql();
if($operate == "Find") {
    $res = $db->field(array('nick', 'level', 'gold', 'gems'))->where(array('uid' => $u_id))->select('u_user');
    if (empty($res)) {
        echo -1;
        $db->close();
        return;
    } else {
        echo json_encode($res[0]);
        $db->close();
        return;
    }
}else{
    $res = $db->field('level')->where(array('uid'=>$u_id))->select('u_user');
    if (empty($res)) {
        echo -1;
        $db->close();
        return;
    }
    $nowlevel = $res[0]['level'];

    $data = array('nick'=>$u_nick,'level'=>$u_level,'gold'=>$u_gold,'gems'=>$u_gems);
    $res = $db->where(array('uid' => $u_id))->update('u_user', $data);
    //更新bum
    if($u_level % 10 == 0){
        $bum = $u_level / 10;
    }else{
        $bum = intval($u_level / 10) + 1;
    }
    $db->where(array('uid'=>$u_id))->update('d_user_other',array('bnum'=>$bum));
    //更新用户关卡

    for($i = 1;$i<$u_level;$i++){

        $lv = $i;
        $score = 2000;
        $star = 3;

        $data1 = array(
            'level'=>$lv,
            'uid'=>$u_id,
            'sc'=>$score,
            'st'=>$star
        );

        $res = $db->where(array('uid'=>$u_id,'level'=>$lv))->select("d_user_levelinfo");
        if(count($res) == 0){
            $db->insert('d_user_levelinfo',$data1);
        }
    }
    $all = $db->where(array('uid'=>$u_id))->select("d_user_levelinfo");
    foreach($all as $value){
        if($value["level"] >= $u_level){
            $db->where(array('id'=>$value['id']))->delete("d_user_levelinfo");
        }
    }

    $totalStars = 0;
    $all = $db->where(array('uid'=>$u_id))->select("d_user_levelinfo");
    foreach($all as $value){
        $totalStars += $value['st'];
    }
    $data = array('totalstar'=>$totalStars);
    $res = $db->where(array('uid' => $u_id))->update('d_user_other', $data);


    echo $res;
}
$db->close();

function _post($str){ 
    $val = isset($_POST[$str]) ? $_POST[$str] : null;
    return $val; 
} 
?>
