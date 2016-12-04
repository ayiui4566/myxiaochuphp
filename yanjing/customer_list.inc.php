<?php
		/** file: list.inc.php 图书列表显示脚本，包括搜索加分页的功能 */
		
		/* 判断用户是通过表单POST提交，还是使用URL的GET提交,都将内容交给$ser处理 */
		date_default_timezone_set('PRC');
		$ser = !empty($_POST) ? $_POST : $_GET;                    
		
        $where = array();            								 //声明WHERE从句的查询条件变量
        $param = "";               									 //声明分页参数的组合变量
		$title = "";                 								 //声明本页的标题变量
		
        if(!empty($ser["id"])) {                               
            $where[] = "id = {$ser["id"]}";
			$param .= "&id={$ser["id"]}";
			
        }
        if(!empty($ser["fullname"])) {
            $where[] = "fullname like '%{$ser["fullname"]}%'";
			$param .= "&fullname={$ser["fullname"]}";
	
        }
        if(!empty($ser["jianpin"])) {
            $where[] = "jianpin like '%{$ser["jianpin"]}%'";
			$param .= "&jianpin={$ser["jianpin"]}";
			
        }
		if(!empty($ser["telphone"])) {
            $where[] = "telphone like '%{$ser["telphone"]}%'";
			$param .= "&telphone={$ser["telphone"]}";
			
        }
		/**if(!empty($ser["peijingDate1"])) {      
            $where[] = "peijingDate >= {$ser["peijingDate1"]}";
			$param .= "&peijingDate1={$ser["peijingDate1"]}";
			
        }
		if(!empty($ser["peijingDate2"])) {
			
			$where[] = "peijingDate <= {$ser["peijingDate2"]}";
			$param .= "&peijingDate2={$ser["peijingDate2"]}";
			
        }*/
		if(!empty($ser["peijingDate1"])) {      
            $begintime = strtotime($ser["peijingDate1"]);
            $where[] = "UNIX_TIMESTAMP(`peijingDate`) >= {$begintime}";
			$param .= "&peijingDate1={$ser["peijingDate1"]}";
			
        }
		if(!empty($ser["peijingDate2"])) {
			$endtime = strtotime($ser["peijingDate2"]);
            $where[] = "UNIX_TIMESTAMP(`peijingDate`) <= {$endtime}";
			$param .= "&peijingDate2={$ser["peijingDate2"]}";
			
        }
		
		/* 处理是否有搜索的情况 */
        if(!empty($where)){
            $where = "WHERE ".implode(" and ", $where);
			$title = "搜索：";
        }else {
			$where = "";
			$title = "客户列表:";
		}
		echo '<h3>'.$title.'</h3>';
?>
<div>
<table width="2000px;" id="table">
	<tr align="left" bgcolor="#cccccc" class="caption">
		<th>编号</th><th>全名</th> <th>性别</th> <th>年龄</th> <th>配镜日期</th> <th>手机</th> <th>通信地址</th><th>裸眼视力（右）</th><th>裸眼视力（左）</th><th>球镜（右）</th><th>球镜（左）</th><th>柱镜（右）</th><th>柱镜（左）</th><th>轴向（右）</th><th>轴向（左）</th><th>矫正视力（右）</th><th>矫正视力（左）</th><th>远用瞳距</th><th>用途</th><th>消费金额</th><th>购买次数</th><th>简拼</th>
        <th>备注</th>
	</tr>
	<?php
		include "conn.inc.php";                              	//包含数据库连接文件，连接数据库
		include "page.class.php";                               //包含分页类文件，加数据分页功能
		
		$sql = "SELECT count( * ) FROM customers {$where}";           //按条件获取数据表记录总数  
		$result = mysql_query($sql) or die("查询sql有问题".$sql);
		//echo $sql;
		list($total) = mysql_fetch_row($result);
		
		$page = new Page($total, 20, $param);                   //创建分页类对象
		/* 编写查询语句，使用$where组合查询条件， 使用$page->limit获取LIMIT从句,限制数据条数 */
		$sql = "SELECT * FROM customers {$where} ORDER BY id DESC {$page->limit}";
		/* 执行查询的SQL语句 */
		$result = mysql_query($sql);
		/*处理结果集，打印数据记录 */
		if($result && mysql_num_rows($result) > 0 ) {
			$i = 0;
			/* 循环数据，将数据表每行数据对应的列转为变量 */
			while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
				if($i++%2==0)
					echo '<tr bgcolor="#eeeeee">';
				else 
					echo '<tr>';
				echo '<td>'.$line['id'].'</td>';
				echo '<td>'.$line['fullname'].'</td>';
				echo '<td>'.$line['sex'].'</td>';
				echo '<td>'.$line['age'].'</td>';
				echo '<td>'.$line['peijingDate'].'</td>';
				echo '<td>'.$line['telphone'].'</td>';
				echo '<td>'.$line['address'].'</td>';
				echo '<td>'.$line['r-luoyanshili'].'</td>';
				echo '<td>'.$line['l-luoyanshili'].'</td>';
				echo '<td>'.$line['r-qiujing'].'</td>';
				echo '<td>'.$line['l-qiujing'].'</td>';
				echo '<td>'.$line['r-zhujing'].'</td>';
				echo '<td>'.$line['l-zhujing'].'</td>';
				echo '<td>'.$line['r-zhouxiang'].'</td>';
				echo '<td>'.$line['l-zhouxiang'].'</td>';
				echo '<td>'.$line['r-jiaozhengshili'].'</td>';
				echo '<td>'.$line['l-jiaozhengshili'].'</td>';
				echo '<td>'.$line['yuanyongtongju'].'</td>';
				echo '<td>'.$line['yongtu'].'</td>';
				echo '<td>￥'.number_format($line['price'], 2, '.', ' ').'</td>';
				echo '<td>'.$line['buytime'].'</td>';
				echo '<td>'.$line['jianpin'].'</td>';
				echo '<td>'.$line['desc'].'</td>';
				
				
				echo '</tr>';
			}
			echo '<tr><td colspan="6">'.$page->fpage().'</td></tr>';
		}else {
			echo '<tr><td colspan="6" align="center">没有客户被找到</td></tr>';
		}
		
		mysql_free_result($result);                            //释放结果集
		mysql_close($link);                                    //关闭数据库连接
	?>
<table>
</div>
<script>
	$("#table tr").click(function(){ 
		$('#table tr').siblings(".s").removeClass("s");
		$(this).addClass("s");
		seclectId = $(this).find("td").html();
		//$("p").find("span").first().text() 这句话等同于$("p").find("span").html();哦

	}) 
	$("#table tr").dblclick(function(){ 
		
		$('#table tr').siblings(".s").removeClass("s");
		$(this).addClass("s");
		seclectId = $(this).find("td").html();
		if(!seclectId)
		{
			return;
		}
		
		location.href = "customer.php?action=mod&id="+seclectId;
		//$("p").find("span").first().text() 这句话等同于$("p").find("span").html();哦

	}) 
</script>
