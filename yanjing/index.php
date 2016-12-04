<?php
require("config.inc.php") ;
include_once("admin_login_check.php"); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Frameset//EN">
<html>
<head>
<title>眼镜店管理系统</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta http-equiv=Pragma content=no-cache>
<meta http-equiv=Cache-Control content=no-cache>
<meta http-equiv=Expires content=-1000>
</head>
<frameset rows="100,*">
  <frame name="header" src="head.php" noresize="noresize"/>
  <frame name="content" src="customer.php" noresize="noresize"/>
</frameset>
<noframes>
</noframes>
</html>
