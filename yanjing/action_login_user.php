<?php
//error_reporting(E_ALL);
session_start();
include("conn.inc.php");
include_once("libs/common.php");
$status = 0;
if(!isset($_POST['t_username']) && !isset($_POST['t_passward']))
{
	echo $status;
	return;
}
$username = str_replace(" ", "", $_POST['t_username']);
//防止sql注入，数据库攻击
$username = mysql_real_escape_string($username);
$sql = "select t_passward from admins where t_username='$username'";
$result = mysql_query($sql) or die("sql1语句错误");
$row = mysql_fetch_array($result);


if (strcmp(md5($_POST['t_passward']), $row['t_passward']) == 0) {
	$ip = GetClientIP();
	$time = GetCurrentDateTime();
	//ctime最后一次登录时间，num登录次数
	mysql_query("update admins set ip='$ip',ctime='$time',num=num+1 where t_username='$username'") or die("sql2语句错误");
	$_SESSION['adminLogin'] = $username;
	$status = 1;
} else {
	$status = 0;
}
close_db_link();
echo $status;
?>
