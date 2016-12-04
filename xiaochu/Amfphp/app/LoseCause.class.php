<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/4
 * Time: 19:32
 */
class LoseCause
{
    public $level;
    public $total;
    public $lose;
    public $loseType;

    public function __construct()
    {
        $this->level = intval($this->level);
        $this->total = intval($this->total);
        $this->lose = intval($this->lose);
        if($this->loseType != ""){
            $this->loseType = StringUtil::strToArray($this->loseType);
            foreach($this->loseType as &$value){
                $value = intval($value);
            }
        }else{
            $this->loseType = array();
        }
        unset ($value);
    }
    /**
     * 得到obj.d 没有的话则插入一条新数据
     * @param $uid
     * @return array
     */
    public static function getByLevel($level){

        $level = (int)$level;

        $pdo = MMysql::getConnection();
        $sql = "select * from u_losecause where level=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($level));
        $results = $stmt->fetchObject(__CLASS__);
        //$results = $stmt->fetchAll(PDO::FETCH_CLASS,__CLASS__);
//        return $results;
        if(!$results){
            self::insert($level);
            return self::getByLevel($level);
        }

        Logs::getInstance()->pushSqlStr($sql);
        return $results;
    }
    public function update()
    {
        $db = new MMysql();

        $data = array();
        foreach ($this as $key => $value) {
            $data[$key] = $value;
        }

        $str = StringUtil::arrayToStr($this->loseType);
        $data['loseType'] = $str;
        return $db->where(array('level' => $this->level))->update('u_losecause', $data);
    }
    /**
     * 插入数据 用于初始化
     * @param $uid
     * @return array
     * @throws Exception
     */
    public static function insert($level){

        $pdo = MMysql::getConnection();
        $tsql = "INSERT INTO u_losecause(level, total, lose, loseType)";
        $tsql .= " VALUES(:level, :total, :lose, :loseType)";

        $stmt = $pdo->prepare($tsql);
        $stmt->bindValue(':level',$level);
        $stmt->bindValue(':total', 0);
        $stmt->bindValue(':lose', 0);
        $stmt->bindValue(':loseType', "");

        Logs::getInstance()->pushSqlStr($tsql);
        return $stmt->execute();
    }
}