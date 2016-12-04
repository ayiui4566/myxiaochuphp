<?php
require_once "ApiInfo2.class.php";
require_once "../Amfphp/app/util/Logs.class.php";
require_once "../Amfphp/app/util/MMysql.class.php";
require_once "../Amfphp/app/UserLevelInfoModel.class.php";

$api = new ApiInfo2($_GET['openid'],$_GET['openkey'],$_GET['pf'],$_GET['pfkey']);
$myinfo= $api->getMyInfo();
var_dump($myinfo);



?>