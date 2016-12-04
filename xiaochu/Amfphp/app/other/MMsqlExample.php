<?php


$mysql = new MMysql($configArr);


//插入
$data = array(
    'sid'=>101,
    'aa'=>123456,
    'bbc'=>'aaaaaaaaaaaaaa',
);
$mysql->insert('t_table',$data);
$sql = "update table set a=a+1";
//查询 *
$res = $mysql->where("uid='2005'")->select("u_user");
//查询 字段
$res = $mysql->field(array('sid','aa','bbc'))
    ->order(array('sid'=>'desc','aa'=>'asc'))
    ->where(array('sid'=>"101",'aa'=>array('123455','>','or')))
    ->limit(1,2)
    ->select('t_table');
$res = $mysql->field('sid,aa,bbc')
    ->order('sid desc,aa asc')
    ->where('sid=101 or aa>123455')
    ->limit(1,2)
    ->select('t_table');
//获取最后执行的sql语句
$sql = $mysql->getLastSql();
//直接执行sql语句
$sql = "show tables";
$res = $mysql->doSql($sql);
//事务
$mysql->startTrans();
$mysql->where(array('sid'=>102))->update('t_table',array('aa'=>666666));
$mysql->where(array('sid'=>103))->update('t_table',array('bbc'=>'呵呵8888呵呵'));
$mysql->where(array('sid'=>104))->delete('t_table');
$mysql->commit();

function updateLevelplus1($uid)
{
    $uid = (string)$uid;
    $db = new MMysql();
    $sql = "update u_user set level=level+1 where uid=" . $uid;
    return $db->doSql($sql);
}
?>