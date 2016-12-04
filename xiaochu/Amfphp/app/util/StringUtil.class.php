<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/1
 * Time: 9:41
 */
class StringUtil
{
    /**
     * "2012|1,2013|2,2017|0"
     * key|value
     * 尽量别用"2010|1"作为key，amfphp会出错
     * 转换为array字典
     * @param $str
     * @return array
     */
    public static function strToArray($str){
        $result = array();
        $ary1 =  explode(",",$str);
        foreach($ary1 as $value){
            $ary2 =  explode("|",$value);
            $result[$ary2[0]] = $ary2[1];
        }
        return $result;
    }

    public static function arrayToStr($arry){
        if(empty($arry)) return "";

        foreach($arry as $key=>$value){
            $result[] = $key.'|'.$value;
        }
        return implode(',',$result);
    }
    /**
     * $str = "2012|1|5,2013|2|0,2017|0|4"
     * 类名 作为value挨个赋值
     * 尽量别用"2010|1"作为key，amfphp会出错
     * 字符串转换为对象数组
     * @param $str
     * @return array
     */
    public static function strToClassArray($str,$className){
        $result = array();
        foreach(explode(",",$str) as $objstrvalue){
            $obj = new $className();
            $info = get_object_vars($obj);

            $objvalues = explode("|",$objstrvalue);
            $i = 0;
            foreach($info as $k => $v){
                $obj->$k = $objvalues[$i];
                $i++;
            }

            $obj->setType();
            $result[] = $obj;
        }
        return $result;
    }
    /**
     * $str = "2012|1|5,2013|2|0,2017|0|4"
     * $ary = array(0=>("id"=>2012,"stats"=>1,"frame"=>5),);;
     * 尽量别用"2010|1"作为key，amfphp会出错
     * 对象数组转换为字符串
     * @param $str
     * @return array
     */
    public static function classArrayToStr($ary){
        if(count($ary) == 0){
            return "";
        }
        $result = array();
        foreach((array)$ary as $value){
            $first = array();
            foreach((array)$value as $key2 => $value2){
                $first[] = $value2;
            }
            $onestr = implode('|',$first);
            $result[] = $onestr;
        }
        return implode(',',$result);
    }
    /**
     * $str = "2012|1|5"
     * 类名 作为value挨个赋值
     * 尽量别用"2010|1"作为key，amfphp会出错
     * 字符串转换为对象
     * @param $str,$className
     * @return $obj
     */
    public static function strToClass($str,$className){
        $obj = new $className();
        $info = get_object_vars($obj);

        $objvalues = explode("|",$str);
        $i = 0;
        foreach($info as $k => $v){
            $obj->$k = $objvalues[$i];
            $i++;
        }

        $obj->setType();
        return $obj;
    }
    /**
     * $str = "2012|1|5"
     * 类名 作为value挨个赋值
     * 尽量别用"2010|1"作为key，amfphp会出错
     * 字符串转换为对象
     * @param $obj
     * @return $str
     */
    public static function ClassToStr($obj){
        $first = array();
        foreach($obj as $value2){
            $first[] = $value2;
        }
        $onestr = implode('|',$first);
        return $onestr;
    }


    /***
     * 改变key值
     * [0=>{id=2,name='jiangbo',age=10},1=>{id=3,name='jiangbo3',age=10}]
     * [2=>{name="jiangbo",age=10},3=>{name='jiangbo3',age=10}]
     * 空值取消掉
     * arrayChangeKey($arr,'id');
     * @param $arr
     * @param $key
     */
    public static function arrayChangeKey($arr,$key1,$isdelEmpty=true){

        if(is_array($arr) && !empty($arr)) {
            $result = array();
            foreach ($arr as $val) {
                $new_key = $val[$key1];
                unset($val[$key1]);
                if($isdelEmpty) {
                    foreach ($val as $key2 => $value2) {
                        if (empty($value2)) {
                            unset($val[$key2]);
                        }
                    }
                }
                $result[$new_key] = $val;

            }
            return $result;
        }
        return null;
    }
    /***
     * 删除数组对象中的key值，空值delte掉
     * [{id=2,name='',age=10,gems=0},{id=3,name='jiangbo3',age='',gems=3}]
     * $key1 = "id";去掉id字段,如果字段为空值也去掉
     * [0=>{age=10},1=>{name='jiangbo3',gems=3}]
     * 并且空值取消掉
     */
    public static function deleteKeyEmptyVal($arr,$key1){

        if(is_array($arr) && !empty($arr)) {
            $result = array();
            foreach ($arr as $val) {
                unset($val[$key1]);
                foreach($val as $key2=>$value2){
                    if(empty($value2)){
                        unset($val[$key2]);
                    }
                }
                $result[] = $val;

            }
            return $result;
        }
        return null;
    }
    /***
     * 删除数组对象中的key值
     * [0=>{id=2,name='jiangbo',age=10},1=>{id=3,name='jiangbo3',age=12}]
     * [0=>{age=10},1=>{age=12}]
     * $key1 = array("id","name");去掉多个key
     * 空值不取消掉
     */
    public static function deleteKey($arr,$keys){

        if(!is_array($arr) && empty($arr))  return null;

        $result = array();
        foreach ($arr as $val) {
            foreach($keys as $keys_val) {
                unset($val[$keys_val]);
            }
            $result[] = $val;
        }
        return $result;

    }

    /**
     * 根据权重得
     * 1->20
     * 2->30
     * 3->20
     * 从1到70，随机到20就是第一个，随机到20-30就是第二个
     * @param dict
     * @return key
     */
    public static function simpleRandom($dict)
    {
        $sum = 0;
        foreach($dict as $value)
        {
            $sum+= $value;
        }

        $seed = rand(1,$sum);
        $count = 0;
        foreach ($dict as $key=>$value2)
        {
            $count+= $value2;
            if($seed<=$count)
            {
                return intval($key);
            }
        }
        throw new Error("无返回值");
    }
    /**
     * 根据几率，得到是否随机到
     * percent = 20;20%几率是否能随机到
     * @return
     */
    public static function getIsRandom($percent)
    {
        $dict = array();
        $dict[1] = $percent;
        $dict[2] = 100 - $percent;
        $Key = self::simpleRandom($dict);
        if($Key == 1){
            return true;
        }
        return false;
    }
    public static function testSimpleRandom()
    {
        $cdict = array();
        $cdict[1] = 0;
        $cdict[2] = 0;
        $cdict[3] = 0;
        $cdict[4] = 0;
        $cdict[5] = 0;
        $cdict[6] = 0;

        $dict = array();
        $dict[1] = 20;
        $dict[2] = 20;
        $dict[3] = 20;
        $dict[4] = 40;
        $dict[5] = 0;
        $dict[6] = 0;
        for($i = 0;$i<10000;$i++)
        {
            $type = StringUtil::simpleRandom($dict);
            $cdict[$type]++;
        }
        foreach($cdict as $key=>$value)
        {
            echo("key:".$key." times:".$value."<br>");
        }
    }

    /**
     * @param $date_1 timestamp 时间戳
     * @param $date_2 timestamp 时间戳
     * @param string $differenceFormat 相隔天数
     * @return string
     */
    public static function dateDifference($timestamp1 , $timestamp2 , $differenceFormat = '%a' )
    {
        $datetime1 = date_create("@$timestamp1");
        $datetime2 = date_create("@$timestamp2");

        $interval = date_diff($datetime1, $datetime2);

        return $interval->format($differenceFormat);

    }
    /**
     * @param $date_1 timestamp 时间戳
     * @param $date_2 timestamp 时间戳
     * @param string $differenceFormat 相隔分钟
     * @return string
     */
    public static function dateDifference_i($timestamp1 , $timestamp2 , $differenceFormat = '%i' )
    {
        $datetime1 = date_create("@$timestamp1");
        $datetime2 = date_create("@$timestamp2");

        $interval = date_diff($datetime1, $datetime2);

        return $interval->format($differenceFormat);

    }
}