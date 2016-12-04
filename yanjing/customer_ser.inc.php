<?php /** file: ser.inc.php 图书搜索表单 */  ?>
<h3>客户查询：</h3>
<form action="customer.php?action=list" method="POST">
	客户编号：<input type="text" class="inp_srh" name="id" />
	客户全名：<input type="text" class="inp_srh" name="fullname" /><br>
	客户简拼：<input type="text" class="inp_srh" name="jianpin" />
	手机号码：<input type="text" class="inp_srh" name="telphone"/><br>
	配镜日期：<input class="Wdate" type="text" name="peijingDate1" onClick="WdatePicker()">至<input class="Wdate" type="text" name="peijingDate2" onClick="WdatePicker()"><br>
    <input type="submit" name="add" value="搜索" />&nbsp;&nbsp; 
    <input type="button" name="cancel" value="取消" onclick="gotolist()" />
</form>