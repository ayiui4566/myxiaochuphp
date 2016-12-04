<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/1
 * Time: 5:42
 */

class UserLevelInfoModel{

    public static function getFriendLevelInfo($uids){
        if(!$uids ||count($uids) == 0) return array();

        $result = array();
        foreach($uids as $value){
            $result[$value] = self::getUserLevelInfo($value);
        }
        return $result;
    }

    /**
     * 查询用户所有关卡
     * @param $uid
     * @return bool
     * @throws Exception
     */
    public static function getUserLevelInfo($uid) {
        $uid = (string)$uid;
        $db = new MMysql();
        $res = $db->where(array('uid'=>$uid))->select("d_user_levelinfo");

        $res2 = $db->field('yuevip')->where(array('uid'=>$uid))->select("u_user");
        $res3 = $db->field('vipinfo')->where(array('uid'=>$uid))->select("d_user_other");

        $result = array();
        $num = 0;//已经完成的关卡数
        $totalstars = 0;
        foreach($res as $key=>$value){
            $num++;
            $result[$value["level"]] = array(
                "sc"=>$value["sc"],
                "st"=>$value["st"]
            );
            $totalstars+=$value["st"];
        }
        return array("res"=>$result,"yuevip"=>$res2[0]['yuevip'],"vipinfo"=>$res3[0]['vipinfo'],"num"=>$num,"totalstars"=>$totalstars);
    }
    /**
     * 查询用户关卡 如果没有则插入
     */
    public static function updateLevelInfo($parm){
        $uid = $parm->uid;
        $lv = $parm->lv;
        $score = $parm->score;
        $star = $parm->star;

        $data = array(
            'sc'=>$score,
            'st'=>$star
        );
        $data1 = array(
            'level'=>$lv,
            'uid'=>$uid,
            'sc'=>$score,
            'st'=>$star
        );

        $db = new MMysql();
        $res = $db->where(array('uid'=>$uid,'level'=>$lv))->select("d_user_levelinfo");
        if(count($res) == 0){
            $db->insert('d_user_levelinfo',$data1);
        }else {
            if($res[0]['st']<$star) {//多次玩的话，星星超越了才保存
                $db->where(array('uid' => $uid, 'level' => $lv))->update('d_user_levelinfo', $data);
            }else{
                //旧数据
                $score = $res[0]['sc'];
                $star = $res[0]['st'];
            }
        }

        $result =  self::getUserLevelInfo($uid);
        $result['sc'] = $score;
        $result['st'] = $star;
        return $result;
    }
    /**
     * 查询用户关卡 如果有则不更新
     */
    public static function insertLevelInfo($parm){
        $uid = $parm->uid;
        $lv = $parm->lv;
        $score = $parm->score;
        $star = $parm->star;

        $data1 = array(
            'level'=>$lv,
            'uid'=>$uid,
            'sc'=>$score,
            'st'=>$star
        );

        $db = new MMysql();
        $res = $db->where(array('uid'=>$uid,'level'=>$lv))->select("d_user_levelinfo");
        if(count($res) == 0){
            $db->insert('d_user_levelinfo',$data1);
        }
    }
}