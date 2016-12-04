<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>客户管理</title>
<style>
.form_add{
	font-size:12px;	
}
body{
	font-size:12px;
}
.div_border{
	border:1px dotted gray;
	padding:10px;
}
.inp_srh { width:150px; border:1px solid #cbcbcb;}	
.inp_srh2 { width:50px; border:1px solid #cbcbcb;}
.inp_srh3 { width:180px; height:17px; border:1px solid #cbcbcb;}
.inp_srh4{ width:400px; height:17px; border:1px solid #cbcbcb;}
.inp_srh5 { width:75px; border:1px solid #cbcbcb;}
table .caption {
	background:#B0B0FF;
	color:#FFFFFF;
	test-align:left;
}
.s { 
	background:#999; 
	color:#000; 
}
</style>
<script type="text/javascript" src="libs/js/morecity.js"></script>
<script type="text/javascript" src="libs/js/my97/WdatePicker.js"></script>
<script type="text/javascript" src="libs/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#yongtu').val("");
});
var seclectId;
function deleteCustomer()
{
	if(!seclectId)
	{
		return;
	}
	if(confirm('你确定要删除编号为'+seclectId+'的客户吗?'))
	{
		//alert(true);
		$.get("customer.php?action=del",{id:seclectId},
			function (data){
				if(data = "success"){
					alert("删除成功");
					location.href="customer.php?action=list";
				}
				
			}
		);
	}
}
function updateCustomer(a)
{
	if(!seclectId)
	{
		return;
	}
	a.href = "customer.php?action=mod&id="+seclectId;
}
function gotolist()
{
	location.href = "customer.php?action=list";
}
</script>
</head>
<body>
<p>
				<a href="customer.php?action=add">添加客户</a> ||
				<a href="customer.php?action=list">客户列表</a> ||
                <a href="#" onclick="updateCustomer(this)">修改客户</a> ||
                <a href="javascript:deleteCustomer();">删除客户</a> ||
				<a href="customer.php?action=ser">搜索客户</a> ||
				<a href="customer.php?action=daochu">导出所有客户手机号码</a> ||
				<a href="http://www.shangxintong.cc" target="blank">短信群发</a>
</p>
<?php
				
				if($_GET["action"] == "add") {
					include "customer_add.inc.php";
					
				} else if ($_GET["action"] == "insert") {
					include "conn.inc.php";
					
					$age = intval($_POST["age"]);
					$yuanyongtongju = intval($_POST["yuanyongtongju"]);
					$price = intval($_POST["price"]);
					$buytime = intval($_POST["buytime"]);
					/* 根据用户通过POST提交的数据组合插入数据库的SQL语句 */
					$sql = "INSERT INTO customers(`id`,`fullname`, `sex`, `age`, `peijingDate`, `telphone`, `address`, `r-luoyanshili`, `l-luoyanshili`, `r-qiujing`, `l-qiujing`, `r-zhujing`, `l-zhujing`, `r-zhouxiang`, `l-zhouxiang`, `r-jiaozhengshili`, `l-jiaozhengshili`, `yuanyongtongju`, `yongtu`, `price`, `buytime`, `jianpin`, `desc`)  VALUES({$_POST["id"]},'{$_POST["fullname"]}', '{$_POST["sex"]}', {$age}, '{$_POST["peijingDate"]}', '{$_POST["telphone"]}','{$_POST["address"]}','{$_POST["r-luoyanshili"]}','{$_POST["l-luoyanshili"]}','{$_POST["r-qiujing"]}','{$_POST["l-qiujing"]}','{$_POST["r-zhujing"]}','{$_POST["l-zhujing"]}','{$_POST["r-zhouxiang"]}','{$_POST["l-zhouxiang"]}','{$_POST["r-jiaozhengshili"]}','{$_POST["l-jiaozhengshili"]}',{$yuanyongtongju},'{$_POST["yongtu"]}',{$price},{$buytime},'{$_POST["jianpin"]}','{$_POST["desc"]}')";
					/* 执行INSERT语句 */
					$result = mysql_query($sql);
					/* 如果INSERT语句执行成功，并对数据表books有行数影响，则插入数据成功 */
					if($result && mysql_affected_rows() > 0 ) {
						echo "插入一条数据成功!";
					}else {
						echo "数据录入失败!$sql";
					}
					/* 用完后关闭数据库的连接 */
					mysql_close($link);
				} else if($_GET["action"] == "mod") {
					include "customer_mod.inc.php";
				} else if($_GET["action"] == "update") {
					include "conn.inc.php";
					
					$age = intval($_POST["age"]);
					$yuanyongtongju = intval($_POST["yuanyongtongju"]);
					$price = intval($_POST["price"]);
					$buytime = intval($_POST["buytime"]);
                                        
					$sql = "UPDATE `customers` SET `fullname`='{$_POST["fullname"]}',`sex`='{$_POST["sex"]}',`age`={$age},`peijingDate`='{$_POST["peijingDate"]}',`telphone`='{$_POST["telphone"]}',`address`='{$_POST["address"]}',`r-luoyanshili`='{$_POST['r-luoyanshili']}',`l-luoyanshili`='{$_POST['l-luoyanshili']}',`r-qiujing`='{$_POST['r-qiujing']}',`l-qiujing`='{$_POST['l-qiujing']}',`r-zhujing`='{$_POST['r-zhujing']}',`l-zhujing`='{$_POST['l-zhujing']}',`r-zhouxiang`='{$_POST['r-zhouxiang']}',`l-zhouxiang`='{$_POST['l-zhouxiang']}',`r-jiaozhengshili`='{$_POST['r-jiaozhengshili']}',`l-jiaozhengshili`='{$_POST['l-jiaozhengshili']}',`yuanyongtongju`=$yuanyongtongju,`yongtu`='{$_POST['yongtu']}',`price`={$price},`buytime`={$buytime},`jianpin`='{$_POST['jianpin']}',`desc`='{$_POST['desc']}' WHERE `id`={$_POST['id']}";
					
					$result = mysql_query($sql);
					if($result && mysql_affected_rows() > 0 ) {
						echo "记录修改成功!";
					}else {
						echo "数据修改失败!";
					}
					mysql_close($link);
					
				} else if($_GET["action"] == "del") {
					include "conn.inc.php";
					$result = mysql_query("DELETE FROM customers WHERE id='{$_GET["id"]}'");
					if($result && mysql_affected_rows() > 0 ) {
						
						/* 删除记录后跳转回到原来的URL */
						echo "success";
					}else {
						echo "数据删除失败";
					}
		
					mysql_close($link);
				} else if($_GET["action"] == "ser"){
					include "customer_ser.inc.php";
				} else if($_GET["action"] == "daochu"){
					include "conn.inc.php";
					$result = mysql_query("SELECT * FROM customers ORDER BY id DESC");
					if($result) {
						$phoneStr = "";
						while($row = mysql_fetch_assoc($result))
						{
							$phoneStr.=$row["telphone"]."\r\n";
						}
						$path = "data/backup/";
						$fileName=$path."telphone.txt"; 
						if(file_exists($fileName)) { 
				             unlink($fileName); 
				        } 
				        $fp=fopen($fileName,"w+"); 
				        if(fwrite($fp,$phoneStr)){
							echo "导出电话号码成功";
						} else {
							echo "导出电话号码失败";
						}
					}else {
						echo "数据查询失败";
					}
		
					mysql_close($link);
				}else
				{
					include "customer_list.inc.php";
				}
			?>
</body>
</html>