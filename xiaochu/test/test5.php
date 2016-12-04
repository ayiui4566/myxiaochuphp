<?php
require_once '../Amfphp/app/util/StringUtil.class.php';


$str = '2014,2016,2015,2019';
$ary = explode(',',$str);
var_dump($ary);


die;

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

?>
