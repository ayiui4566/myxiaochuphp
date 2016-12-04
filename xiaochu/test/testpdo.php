<?php
//增加数据
$sql_insert = 'Insert INTO wp_options(blog_id,option_name,option_value,autoload) VALUES (0,'.time().rand(1,100).','.time().rand(1,100).',\'no\')';
$back = $DBH->exec($sql_insert); //返回 bool 的true or fal
$lastInsertId = $DBH->lastInsertId();
//删除数据
$sql_delete = 'Delete FROM wp_options Where option_id='.$lastInsertId;
$back = $DBH->exec($sql_delete); //返回 bool 的true or fal
$lastInsertId = $DBH->lastInsertId();
//更新数据
$sql_update = 'Update wp_options SET option_name = \''.time().rand(1,100).'\' Where option_id='.$lastInsertId;
$lastUpdateId = $DBH->lastInsertId(); //返回的对应的操作的id
//查询数据
$sql_select = 'Select option_id FROM wp_options orDER BY option_id DESC LIMIT 4 ';
$back = $DBH->query($sql_select); //返回一个对象 这个对象可以用foreach 直接遍历循环 循环的为查询的结果集
$back = $DBH->query($sql_select)->fetch(); //返回一条数据结果 这个对象可以用foreach 直接遍历循环 循环的为查询的结果集
$back = $DBH->query($sql_select)->fetchAll(); //返回一个数组 这个对象可以用foreach 直接遍历循环 循环的为查询的结果集
$back = $DBH->query($sql_select)->fetchColumn(0); //返回一个字段字符串，这个字符串是返回的记录的第一条记录的第一个字段
?>