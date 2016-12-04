<?php
$input = array("red", "green", "blue", "yellow");
array_splice($input,2,1);

var_dump($input);

$input = array("a"=>"red", "b"=>"green", "c"=>"blue", "d"=>"yellow");
array_splice($input,2,1);

var_dump($input);

$str = "2016|gold";
$ary1 = explode(",",$str);
$ary = array();
$ary[$ary1[0]] = 1;
var_dump($ary);
?>