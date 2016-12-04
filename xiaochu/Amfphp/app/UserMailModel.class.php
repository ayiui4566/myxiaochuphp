<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/1
 * Time: 5:42
 */

class UserMailModel{

    /**
     * 查询用户邮箱
     * @param $uid
     * @return bool
     * @throws Exception
     */
    public static function getById($uid){
        $uid = (string)$uid;
        $db = MMysql::getConnection();
        $sql = "select * from d_user_mailbox where `to`=:uid";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':uid', $uid,PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Logs::getInstance()->pushSqlStr($sql);
        return StringUtil::deleteKey($results,array("to"));
    }


    /**
     * 插入邮箱
     */
    public static function insertMail($parm){
        $parm = (object)$parm;
        $from = $parm->uid;
        if($from == null){
            return "参数错误";
        }
        $name = $parm->name;
        $pic = $parm->pic;
        $gt = $parm->gt;
        $to = $parm->fid;
        $num = $parm->num;
        if(!is_array($to)){
            $tos = array();
            $tos[] = $to;
        }else{
            $tos = $to;
        }

        foreach($tos as $value){
            $data1 = array(
                'to'=>$value,
                'from'=>$from,
                'name'=>$name,
                'pic'=>$pic,
                't'=>time(),
                'type'=>$gt,
                'num'=>$num
            );

            $db = new MMysql();
            $res = $db->insert('d_user_mailbox',$data1);
        }
        return $res;
    }
    public static function getByMailId($mailid){
        $db = new MMysql();
        $res = $db->where(array('id'=>$mailid))->select('d_user_mailbox');
        if(count($res)!=0){
            return $res[0];
        }
    }
    /**
     * 删除邮箱
     */
    public static function deleteById($id){
        $db = new MMysql();
        $res = $db->where(array('id'=>$id))->delete('d_user_mailbox');
        return $res;
    }
    public static function deleteAskLife($to){
        $db = new MMysql();
        $res = $db->where(array('to'=>$to,'type'=>'asklife'))->delete('d_user_mailbox');
        return $res;
    }
}