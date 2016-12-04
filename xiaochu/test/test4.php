<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/21
 * Time: 1:03
 */
class User{
    private $id;
    private $name = "jiangbo";

    public function __get($property_name)
    {
        if(isset($this->$property_name))
        {
            if($property_name == "cd"){
                return $this->_cdtime;
            }
            return($this->$property_name);
        }
        else
        {
            return("no find");
        }
    }
    //__set()方法用来设置私有属性
    public function __set($property_name, $value)
    {
        $this->$property_name = $value;
    }
}

$user = new User();
echo $user->cd;

function updateBg(&$ary,$itemid,$num){
    $ary[$itemid] = $ary[$itemid] + $num;
}

//$ary = array('1999'=>2);
updateBg($ary,'2000',1);
updateBg($ary,'2000',-1);
updateBg($ary,'2000',1);
updateBg($ary,'2001',2);
var_dump($ary);

echo "===================";
$result = array();
$result["d"]['bag'] = 0;
var_dump($result);
?>