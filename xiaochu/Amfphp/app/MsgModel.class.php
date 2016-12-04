<?php

/**
 * 广播model，只取当前两个小时内的数据
 */
class MsgModel
{
    public static function insert($uid,$nick,$vipinfo,$msg,$timestr){
        $data1 = array(
            'uid'=>$uid,
            'nick'=>$nick,
            'vipinfo'=>$vipinfo,
            'msg'=>$msg,
            'timestr'=>$timestr
        );

        $db = new MMysql();
        $db->insert('u_msg',$data1);
    }

    /**
     * 每次getAll都删除1个小时外的数据
     * @return array
     */
    public  static function getAll(){
        date_default_timezone_set('PRC'); //设置本地时区
        $db = new MMysql();

        $res = $db->select('u_msg');
        foreach($res as $i=>$obj){
            $intval = StringUtil::dateDifference_i($obj['timestr'],time(),'%h');
            if($intval>1){
                $db->where(array('id'=>$obj['id']))->delete('u_msg');
                unset($res[$i]);
            }
        }
        $res = array_values($res);
        return $res;
    }
}