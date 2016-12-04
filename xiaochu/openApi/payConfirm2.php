<?php
require_once "ApiInfo.class.php";
require_once "../Amfphp/app/util/Logs.class.php";
require_once "../Amfphp/app/util/MMysql.class.php";

$tokenId = $_GET['tokenId'];
$pf = $_GET['pf'];
$db = new MMysql();
$res = $db->where(array('token'=>$tokenId))->select("u_pay");
//echo $db->getLastSql();
if(count($res) != 0){

    $data = array(
        'pf'=>$pf
    );
    $db->where(array('token'=>$tokenId))->update('u_pay', $data);
}
$db->close();

?>