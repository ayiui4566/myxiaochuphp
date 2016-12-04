<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统维护</title>
<style>
body{
	font-size:12px;
}
</style>
</head>

<body>
<p>
<a href="updateAdminpwd.html" target="content">修改管理员密码</a> ||
<a href="sys_main.php?action=beifen" target="content">备份数据库</a> ||
<a href="sys_main.php?action=huifu" target="content">恢复数据库</a>
</p>
<?php
	include 'config.inc.php';
	include_once 'libs/db/MyDB.class.php';
	include_once 'libs/db/BaseLogic.class.php';
	include_once 'libs/db/Database.class.php';
	
	if($_GET["action"] == "huifu") {
		include "sys_huifuData.php";
		
	}else if ($_GET["action"] == "beifen"){
		/**date_default_timezone_set('PRC');
		include_once 'config.inc.php';
		
		$backcmd = "mysqldump -u$dbuser -p$dbpass yanjing";
		$file_name = dirname(__FILE__)."/backup/".date("Ymd-His").".sql";//备份文件名
		
		$backCMD = $backcmd.'>'.$file_name;
		//echo $backCMD."<br>";
		exec($backCMD,$arr,$i);//执行备份命令
		if($i == 0)
		{
			echo "备份成功";
		}else{
			echo "备份失败";
		}*/
		
		$db = new Database();
		$db -> backup_database();
		echo "备份成功";
		
	}else if ($_GET["action"] == "huifuaction") {
		// 我的数据库信息都存放到config.php文件中，所以加载此文件，如果你的不是存放到该文件中，注释此行即可； 
		/**if ( isset ( $_POST['sqlFile'] ) ) 
		{ 
			$file_name = "backup/".$_POST['sqlFile']; //要导入的SQL文件名 
			
			set_time_limit(0); //设置超时时间为0，表示一直执行。当php在safe mode模式下无效，此时可能会导致导入超时，此时需要分段导入 
			$fp = @fopen($file_name, "r") or die("不能打开SQL文件 $file_name");//打开文件 
			mysql_connect($dbhost, $dbuser, $dbpass) or die("不能连接数据库 $dbhost");//连接数据库 
			mysql_select_db($dbname) or die ("不能打开数据库 $dbname");//打开数据库 
			
			echo "<p>正在清空数据库,请稍等....<br>"; 
			$result = mysql_query("SHOW tables"); 
			while ($currow=mysql_fetch_array($result)) 
			{ 
				mysql_query("drop TABLE IF EXISTS $currow[0]"); 
				echo "清空数据表【".$currow[0]."】成功！<br>"; 
			} 
			echo "<br>清理MYSQL成功<br>"; 
			
			echo "正在执行导入数据库操作<br>"; 
			// 导入数据库的MySQL命令 
			//linux下
			//win下
			//$cmd = "source ".dirname(__FILE__)."/".$file_name.";";
			$cmd = "mysql -u$dbuser -p$dbpass $dbname < ".dirname(__FILE__)."/".$file_name;
			//echo $cmd;
			exec($cmd);
			//mysql_query($cmd);
			//echo mysql_error();
			
			echo "<br>导入完成！"; 
			mysql_close(); 
		} */
//		error_reporting(E_ALL);
		if(isset ( $_POST['sqlFile'] ))
		{
			$file_name = $_POST['sqlFile'];
			$path_parts = pathinfo($file_name);
			$file_name = $path_parts["basename"];
			$db = new Database();
			$db -> restore($file_name);
			echo "恢复成功";
		}
		

	}
?>
</body>
</html>
