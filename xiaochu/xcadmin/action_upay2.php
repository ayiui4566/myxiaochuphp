<?php
//error_reporting(E_ALL);
require_once "../Amfphp/app/util/Logs.class.php";
include_once "../Amfphp/app/GameConfig.class.php";
include_once "../Amfphp/app/util/MMysql.class.php";

$db = new MMysql();

$res1 = $db->doSql('select distinct openid from u_pay');

$openids = array();
foreach($res1 as $value){
    $openids[] = $value['openid'];
}
var_dump($openids);
die;


$db->close();
?>
