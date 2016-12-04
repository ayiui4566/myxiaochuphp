<?php
header('Content-Type:text/html;charset=utf-8');
require("../Amfphp/app/util/Logs.class.php");
date_default_timezone_set('PRC'); //设置本地时区

require_once '../Amfphp/app/util/StringUtil.class.php';

//echo time()."<br>";
//echo strtotime("now");
//echo "<br>";
//echo intval(3700/1800);
//echo "<br>";
//echo 3700%1800;
//$log_path = dirname(__FILE__);
//$log_path = "../";
//$log_file_name = 'debug.log';
//$log_obj = new Logs($log_path, $log_file_name);
//$log_obj->setLog("param is:userid:jiangbo, account:300");

echo date("Y-m-d 23:59:59",time());echo "<br>";
echo date("Y-m-d H:i:s",1474947051);echo "<br>";
echo date("Y-m-d H:i:s",time());echo "<br>";
echo date("Y-m-d H:i:s");echo "<br>";
echo StringUtil::dateDifference_i(1474947051,time(),'%h');echo "f<br>";

$now = time();
$over = strtotime(date("y-m-d 23:59:59",$now));

$dif = $over - $now;
echo $dif;

echo "==============<br>";
for($i=0;$i<100;$i++){
    echo rand(0, 4) . "&nbsp;";
}

echo "==========<Br>";

$str1 = "小明";
$ary = array("小明","小李","小张");
if( in_array($str1,$ary)){
    echo "在";
}
echo "=================<br>";

$str = 'asklife';
echo "'$str'";

//$openId = strval('0000000000000000000000001A2EFFFC');
$openId = '0000000000000000000000001A2EFFFC';
echo is_string($openId);

?>