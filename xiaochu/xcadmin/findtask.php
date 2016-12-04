<?php
//error_reporting(E_ALL);
header('Content-Type:text/html;charset=utf-8');
require_once "../Amfphp/app/util/Logs.class.php";
include_once "../Amfphp/app/GameConfig.class.php";
include_once "../Amfphp/app/util/MMysql.class.php";

$db = new MMysql();

$sql = 'select * from d_user_other';
$res = $db->doSql($sql);
echo "正在执行。。<br>";
$num = 0;
foreach($res as $value){
    $str= $value['btask'];
    $ary = explode('|',$str);
    if($ary[0]>24){
        $num++;
//        $sql1 = 'update d_user_other set btask="23|0",bstarTask="23|0" where uid='."'".$value['uid']."'";
//        $sql2 = 'update u_user set gems=10,gold=5000 where uid='."'".$value['uid']."'";
//        $db->doSql($sql1);
//        $db->doSql($sql2);
        echo $value['uid'].'<br>';
    }
}
$db->close();
echo "$num 个不正常账号执行结束。。<br>";
?>
