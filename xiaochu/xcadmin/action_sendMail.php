<?php
error_reporting(E_ALL);
require_once "../Amfphp/app/util/Logs.class.php";
include_once "../Amfphp/app/GameConfig.class.php";
include_once "../Amfphp/app/util/MMysql.class.php";


session_start();
$status = 0;

if(!isset($_POST['operate']))
{
    echo $status;
    return;
}

$u_id = _post("u_Id");
$operate = _post("operate");

$num = _post("num");

$db = new MMysql();
if($operate == "gem") {

    if($num<=0) {
        error('数量不能为零');
    }

    $data1 = array(
        'to'=>$u_id,
        'from'=>"GM",
        'name'=>"客服小张",
        'pic'=>"1.jpg",
        't'=>time(),
        'type'=>"gem",
        'num'=>$num
    );

    $res = $db->insert('d_user_mailbox',$data1);
    success($res);
}elseif($operate == 'life'){

    if($num<=0) {
        error('数量不能为零');
    }

    $data1 = array(
        'to'=>$u_id,
        'from'=>"GM",
        'name'=>"客服小张",
        'pic'=>"1.jpg",
        't'=>time(),
        'type'=>"life",
        'num'=>$num
    );

    $res = $db->insert('d_user_mailbox',$data1);
    success($res);
}elseif($operate == 'gem_all'){
    if($num<=0) {
        error('数量不能为零');
    }

    $sql1 = "select uid from u_user";
    $alluids = $db->doSql($sql1);
    foreach($alluids as $value){
        $a_uid = $value['uid'];
        $data1 = array(
            'to'=>$a_uid,
            'from'=>"GM",
            'name'=>"客服小张",
            'pic'=>"1.jpg",
            't'=>time(),
            'type'=>"gem",
            'num'=>$num
        );

        $res = $db->insert('d_user_mailbox',$data1);
    }

    success();
}elseif($operate == 'generateCode'){

    if($num<=0) {
        error('数量不能为零');
    }

    //批量插入数据
    $ary = array();
    for($i = 0;$i<$num;$i++){
        $code = md5(uniqid('n',true));

        $str = "('$code',0)";
        $ary[] = $str;

    }
    $str2 = implode(',',$ary);
    $sql = 'insert into d_cdkcode (code,status) values '.$str2.';';
    $res = $db->doSql($sql);
    success($res);
}elseif($operate == 'gotxt'){

}elseif($operate == 'clearall'){

    $db = new MMysql();
    $db->where('1=1')->delete('u_user');
    $db->where('1=1')->delete('u_pay');
    $db->where('1=1')->delete('u_msg');
    $db->where('1=1')->delete('u_losecause');
    $db->where('1=1')->delete('d_user_other');
    $db->where('1=1')->delete('d_user_mailbox');
    $db->where('1=1')->delete('d_user_levelinfo');

    success();
}
$db->close();


function _post($str){
    $val = isset($_POST[$str]) ? $_POST[$str] : null;
    return $val;
}
function error($msg){
    $obj = new stdClass();
    $obj->status = -1;
    $obj->msg = $msg;
    echo json_encode($obj);
    die;
}
function success($msg=''){
    $obj = new stdClass();
    $obj->status = 1;
    $obj->msg = $msg;
    echo json_encode($obj);
}
?>
