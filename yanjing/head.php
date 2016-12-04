
<!doctype html>
<html>
	<head>
		<title>眼镜店管理系统</title>
		<meta charset="utf-8" />
		<style>
			body {font-size:12px;}
			td {font-size:12px;}
			
		</style>
        
	<head>
	<body>
    	<table width="100%" style="margin:0px; padding:0px;"><tr>
			<td><h3>眼镜店管理系统</h3></td>
            <td width="250" style="text-align:right;">

	<?php
		session_start();
		if($_SESSION['adminLogin'])
		{?>
			<?php echo "当前管理员：".$_SESSION['adminLogin']; ?>&nbsp;&nbsp;
					<a href="action_unlogin_user.php">退出</a>&nbsp;&nbsp;
		<?php }else{ }?>

        </td></tr>
        </table>
        
        
			<div>
				<a href="customer.php" target="content">零售客户</a> ||
				<a href="javascript:void()" target="content">商品信息</a> ||
				<a href="sys_main.php" target="content">系统维护</a>
			</div>
	</body>
</html>