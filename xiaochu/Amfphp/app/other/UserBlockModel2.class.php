<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/1
 * Time: 5:42
 */

class UserBlockModel2 extends DataObject{

    public function __construct()
    {
        $this->_tableInfo = array('name' => 'd_user_block', 'pk' => 'id');
        $this->_propertyList = array('auid' => 'uid', 'afid' => 'fid', 'apic' => 'pic','fname'=>'name');
    }

    /**
     * 已经解锁block单元的信息
     * uid,pic,name
     * uid=-1的时候是钻石购买
     * 否则为朋友帮助
     * 查询用户block解锁信息
     * @param $uid
     */
    public static function getById($uid){
        $db = new MMysql();
        $res = $db->field(array('fid','name','pic'))->where(array('uid'=>$uid))->select('d_user_block');
        return $res;
    }
    public function getBy(){
        global $dbh;
        $sql = 'SELECT * FROM Users WHERE UserName = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array('admin'));
        $admin_user = $stmt->fetchObject('User');
    }
    public static function GetAll(){
        global $dbh;
        $sql = 'SELECT * FROM Users';
        $stmt = $dbh->query($sql);
        $users = array();
        while ($user = $stmt->fetchObject(__CLASS__)) {
            $users[] = $user;
        }
        return $users;
    }

    public function update(){

    }
    public function insert(){
        $dbkeys = array_values(self::$_propertyList);
        $data = array();
        foreach($dbkeys as $value){
            $data[$value] = $this->$value;
        }

        $db = new MMysql();
        $res = $db->insert('d_user_block',$data);
        return $res;
    }

    public function test(){

    }

    /**
     * 插入block解锁信息
     */
    public function insert222($parm){
        $parm = (object)$parm;
        $myuid = $parm->uid;
        if($myuid == null){
            return "参数错误";
        }

        $name = isset($parm->name)?$parm->name:"noname";
        $pic = isset($parm->pic)?$parm->pic:"1.jpg";
        $fid = isset($parm->fid)?$parm->fid:"-1";

        $data1 = [
            'uid'=>$myuid,
            'fid'=>$fid,
            'pic'=>$pic,
            'name'=>$name
        ];

        $db = new MMysql();
        $res = $db->insert('d_user_block',$data1);
        return $res;
    }
    /**
     * 删除block解锁信息
     */
    public static function deleteByuid($uid){
        $db = new MMysql();
        $res = $db->where(array('uid'=>$uid))->delete('d_user_block');
        return $res;
    }
}