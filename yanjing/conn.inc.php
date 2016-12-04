<?php
include_once "config.inc.php";
header('Content-Type:text/html;charset=utf-8');
//set_time_limit(0);

/**
 *连接数据库
 */

$link = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die("连接数据库出错");
mysql_select_db(DB_NAME,$link) or die("选择数据库出错");
mysql_query("set names '$code'");

function close_db_link()
{
	global $link;
	mysql_close($link);
}