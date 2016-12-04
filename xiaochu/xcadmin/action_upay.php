<?php
//error_reporting(E_ALL);
require_once "../Amfphp/app/util/Logs.class.php";
include_once "../Amfphp/app/GameConfig.class.php";
include_once "../Amfphp/app/util/MMysql.class.php";

$db = new MMysql();
$std = new stdClass();
$totalpayNum = $db->doSql('select count(*) as num from u_pay');
$res1 = $db->doSql('select distinct openid from u_pay');
$totalpayNum= $totalpayNum[0]['num'];

$amts = $db->doSql('select sum(amt) as amts from u_pay');
$std->amts = $amts[0]['amts'];
$std->totalpayNum = $totalpayNum;
$std->usersnum = count($res1);


$db->close();
echo json_encode($std);;
?>
