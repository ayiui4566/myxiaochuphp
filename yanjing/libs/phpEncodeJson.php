<?php
header('Content-Type:text/html;charset=utf-8');
$json = iconv('gbk','utf-8', file_get_contents('libs/BaiduMap_cityCenter.txt'));
$json = preg_replace('@([0-9a-zA-Z_\.]+):@i', '"$1":', $json); //PHP中JSON数据key必须加上引号.
$json = substr($json, 0, -3); //去掉JSON数据后多余的字符
var_dump(json_decode($json));
?>
