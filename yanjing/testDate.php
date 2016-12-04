<?php
$time1=strtotime("2010-7-18");
echo $time1."<br>";

$str = "2010-109.sql";
$path_parts = pathinfo($str);
echo $path_parts["dirname"] . "\n";
echo $path_parts["basename"] . "\n";
echo $path_parts["extension"] . "\n";

?>