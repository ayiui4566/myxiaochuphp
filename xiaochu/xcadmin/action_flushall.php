<?php
//error_reporting(E_ALL);
$memcache_obj = new Memcache;
$memcache_obj->connect('localhost', 11211);
$memcache_obj->flush();
?>
