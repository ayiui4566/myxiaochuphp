<?php 
	/** file: mod.inc.php 图书修改表单 */ 
	include "conn.inc.php";
	/* 通过ID查找指定的一行记录 */
	$sql = "SELECT * FROM customers WHERE id='{$_GET["id"]}'";
	$result = mysql_query($sql);
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	if(!$line) {
		die("没有找到需要修改的客户");
	}
?>
<h3>修改客户:</h3>
<div class="div_border">
<form class="form_add" action="customer.php?action=update" method="POST">
  编号：<input type="text" class="inp_srh" name="id" value="<?php echo $line['id'];?>" readonly="readonly" />
	全名：<input type="text" class="inp_srh" name="fullname" value="<?php echo $line['fullname'];?>" />
	性别： <select name="sex" id="tudiType" value="<?php echo $line['sex'];?>">
      <option value="男" <?php if($line['sex']=='男'){echo "selected";};?>>男</option>
      <option value="女" <?php if($line['sex']=='女'){echo "selected";};?>>女</option>
 </select>
	年龄：<input type="text" class="inp_srh2" name="age" value="<?php echo $line['age'];?>" />
    配镜日期：<input class="Wdate" type="text" name="peijingDate" onClick="WdatePicker()" value="<?php echo $line['peijingDate'];?>"><br>
	手机：<input type="text" class="inp_srh" name="telphone" value="<?php echo $line['telphone'];?>"/>
    通信地址：<input type="text" class="inp_srh4" name="address" value="<?php echo $line['address'];?>"/><br>
    <br />
    裸眼视力（右）：<input type="text" class="inp_srh5" name="r-luoyanshili" value="<?php echo $line['r-luoyanshili'];?>"/>
    球镜（右）：<input type="text" class="inp_srh5" name="r-qiujing" value="<?php echo $line['r-qiujing'];?>"/>
    柱镜（右）：<input type="text" class="inp_srh5" name="r-zhujing" value="<?php echo $line['r-zhujing'];?>"/>
    轴向（右）：<input type="text" class="inp_srh5" name="r-zhouxiang" value="<?php echo $line['r-zhouxiang'];?>"/>
    矫正视力（右）：<input type="text"  class="inp_srh5" name="r-jiaozhengshili" value="<?php echo $line['r-jiaozhengshili'];?>"/><br>
    裸眼视力（左）：<input type="text" class="inp_srh5" name="l-luoyanshili" value="<?php echo $line['l-luoyanshili'];?>"/>
    球镜（左）：<input type="text"  class="inp_srh5" name="l-qiujing" value="<?php echo $line['l-qiujing'];?>"/>
    柱镜（左）：<input type="text" class="inp_srh5" name="l-zhujing" value="<?php echo $line['l-zhujing'];?>"/>
    轴向（左）：<input type="text" class="inp_srh5" name="l-zhouxiang" value="<?php echo $line['l-zhouxiang'];?>"/>
    矫正视力（左）：<input type="text" class="inp_srh5" name="l-jiaozhengshili" value="<?php echo $line['l-jiaozhengshili'];?>"/><br><br />
    远用瞳距：<input type="text" class="inp_srh5" name="yuanyongtongju" value="<?php echo $line['yuanyongtongju'];?>"/>
    用途：<select name="yongtu" id="yongtu" value="<?php echo $line['yongtu'];?>">
      <option value="视远">视远</option>
      <option value="视近">视近</option>
      <option value="两用">两用</option>
      <option value="多用">多用</option>
 </select>
    消费金额：<input type="text" class="inp_srh5" name="price" value="<?php echo $line['price'];?>"/>
    购买次数：<input type="text" class="inp_srh5" name="buytime" value="<?php echo $line['buytime'];?>"/>
    简拼：<input type="text"  class="inp_srh5" name="jianpin" value="<?php echo $line['jianpin'];?>"/><br>
    备注：<textarea name='desc' cols='100' rows='3' style='font-size:12px;resize: none;margin-bottom:-5px;'><?php echo $line['desc'];?></textarea><br /><br />
    <input type="submit" name="add" value="修改" />&nbsp;&nbsp; <input type="button" name="cancel" value="取消" onclick="gotolist()" />
</form>
</div>
<?php
	mysql_free_result($result);           //释放结果集
	mysql_close($link);                   //关闭数据库的连接
?>