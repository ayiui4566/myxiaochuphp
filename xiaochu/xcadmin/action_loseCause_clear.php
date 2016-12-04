<?php
//error_reporting(E_ALL);
require_once "../Amfphp/app/util/Logs.class.php";
include_once "../Amfphp/app/GameConfig.class.php";
include_once "../Amfphp/app/util/MMysql.class.php";

$db = new MMysql();

$res = $db->where("1=1")->delete('u_losecause');

echo $db->getLastSql();
$db->close();

?>
