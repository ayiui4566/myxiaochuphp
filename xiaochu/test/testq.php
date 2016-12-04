<?php
require_once '../Amfphp/app/constants.php';
require_once '../Amfphp/app/Mpdo.class.php';
require_once '../Amfphp/app/StringUtil.class.php';
require_once '../Amfphp/app/UserOtherModel.class.php';

$userOtherDao = new UserOtherDao();
$vv = $userOtherDao->getOtherInfo2("2005");

var_dump($vv);

//echo($vv->bnum);
//echo($vv->alldresses);

?>