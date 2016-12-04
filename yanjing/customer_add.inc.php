<?php /** file: add.inc.php  图书添加表单 */ 
	$newId=0;
	include "conn.inc.php";
	$sql = "select id from customers ORDER BY id DESC";
	$result = mysql_query($sql) or die("查询最新ID失败");
	$row = mysql_fetch_array($result);
	$newId = $row['id'] + 1;
	mysql_close($link);
?>
<h3>添加客户:</h3>
<div class="div_border">
<form class="form_add" action="customer.php?action=insert" method="POST">
  编号：<input type="text" class="inp_srh" name="id" value="<?php echo $newId;?>" readonly="readonly" />
	全名：<input type="text" class="inp_srh" name="fullname" value="" />
	性别： <select name="sex" id="tudiType">
      <option value="男"  selected="selected">男</option>
      <option value="女">女</option>
 </select>
	年龄：<input type="text" class="inp_srh2" name="age" value="" />
    配镜日期：<input id="peijingDate" class="Wdate" type="text" name="peijingDate" onClick="WdatePicker()"><br>
	手机：<input type="text" class="inp_srh" name="telphone" value=""/>
    通信地址：<input type="text" class="inp_srh4" name="address" value=""/><br>
    <br />
    裸眼视力（右）：<input type="text" class="inp_srh5" name="r-luoyanshili" value=""/>
    球镜（右）：<input type="text" class="inp_srh5" name="r-qiujing" value=""/>
    柱镜（右）：<input type="text" class="inp_srh5" name="r-zhujing" value=""/>
    轴向（右）：<input type="text" class="inp_srh5" name="r-zhouxiang" value=""/>
    矫正视力（右）：<input type="text"  class="inp_srh5" name="r-jiaozhengshili" value=""/><br>
    裸眼视力（左）：<input type="text" class="inp_srh5" name="l-luoyanshili" value=""/>
    球镜（左）：<input type="text"  class="inp_srh5" name="l-qiujing" value=""/>
    柱镜（左）：<input type="text" class="inp_srh5" name="l-zhujing" value=""/>
    轴向（左）：<input type="text" class="inp_srh5" name="l-zhouxiang" value=""/>
    矫正视力（左）：<input type="text" class="inp_srh5" name="l-jiaozhengshili" value=""/><br><br />
    远用瞳距：<input type="text" class="inp_srh5" name="yuanyongtongju" value=""/>
    用途：<select name="yongtu" id="yongtu">
      <option value="视远">视远</option>
      <option value="视近">视近</option>
      <option value="两用">两用</option>
      <option value="多用">多用</option>
 </select>
    消费金额：<input type="text" class="inp_srh5" name="price" value=""/>
    购买次数：<input type="text" class="inp_srh5" name="buytime" value=""/>
    简拼：<input type="text"  class="inp_srh5" name="jianpin" value=""/><br>
    备注：<textarea name='desc' cols='100' rows='3' style='font-size:12px;resize: none;margin-bottom:-5px;'></textarea><br /><br />
    <input type="submit" name="add" value="添加" />&nbsp;&nbsp; <input type="button" name="cancel" value="取消" onclick="gotolist()" />
</form>
</div>
<script>
function setToday()
{
	var date = new Date();
	var y = date.getFullYear();
	var m = date.getMonth()+1;
	var d = date.getDate();	
	
	var mm,dd;
	if(m<10){
		mm="0"+m;
	}else{
		mm=m;
	}
	if(d<10){
		dd="0"+d;	
	}else{
		dd=d;	
	}
	var datestr = (y+"-"+mm+"-"+dd);
	$("#peijingDate").val(datestr);
	
}
setToday();
document.getElementById("yongtu").value='0';
</script>
