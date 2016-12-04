<?php
//error_reporting(E_ALL);

session_start();
include("conn.inc.php");
include_once("libs/common.php");

//data:{username:username,userpwd:userpwd,email:email,address:address},
if(!isset($_POST['t_passward']))
{
	echo 0;
	return;
}
$t_passward = str_replace(" ", "", $_POST['t_passward']);
$t_passward = mysql_real_escape_string($t_passward);
$t_passward = md5($t_passward);

$ip = GetClientIP();
$ctime = GetCurrentDateTime();
$sql = "UPDATE admins SET t_passward = '$t_passward' WHERE t_username = 'admin'";
$result = mysql_query($sql) or die("修改管理员密码失败");
if(mysql_affected_rows() == 1)
{
	$status = 1;
	unset($_SESSION['adminLogin']);
}
close_db_link();
echo $status;
?>
