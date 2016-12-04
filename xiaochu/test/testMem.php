<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/9
 * Time: 22:00
 */
$memcache = new Memcache();
$memcache->connect('localhost',11211);

$add1 = $memcache->set('lamp',array("a","b","c"));

$add2 = $memcache->get("lamp");
var_dump($add2);

$memcache->close();

?>