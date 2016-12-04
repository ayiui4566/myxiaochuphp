<?php
class A{
    function __construct()
    {
        echo get_class($this);
    }

    static function name(){
        echo "<br>.name.";
        echo get_called_class();
    }
}
class B extends A{

}

$objb = new B();
B::name();


$input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
$rand_keys = array_rand($input, 2);
var_dump($rand_keys);
echo $input[$rand_keys[0]] . "\n";
echo $input[$rand_keys[1]] . "\n";

echo "=========";
$arr = array(0=>array("id"=>1,"name"=>'jiangbo'),1=>array("id"=>2,"name"=>'jiangbo2'));
var_dump($arr);
$arr2= arrayChangeKey($arr,'id');
var_dump($arr2);

function arrayChangeKey($arr,$key1){

    if(is_array($arr) && !empty($arr)) {
        $result = array();
        foreach ($arr as $val) {
            $new_key = $val[$key1];
            unset($val[$key1]);
            $result[$new_key] = $val;

        }
        return $result;
    }
    return null;
}

?>