<?php
require_once "ApiInfo.class.php";
require_once "../Amfphp/app/util/Logs.class.php";
require_once "../Amfphp/app/util/MMysql.class.php";

$api = new ApiInfo($_GET['openid'],$_GET['openkey'],$_GET['pf'],$_GET['pfkey']);
$tokenId = $_GET['tokenId'];
$pf = $_GET['pf'];
$db = new MMysql();
$res = $db->where(array('token'=>$tokenId))->select("u_pay");
//echo $db->getLastSql();
if(count($res) != 0){
    $tx_res = $api->confirm_delivery($res[0]['payitem'],$res[0]['token'],
        $res[0]['billno'],$res[0]['zoneid'],0,$res[0]['amt'],$res[0]['payamt_coins'],
        $res[0]['amt']*10,$res[0]['payamt_coins']);

    $data = array(
        'pf'=>$pf
    );
    $db->where(array('token'=>$tokenId))->update('u_pay', $data);
}
$db->close();

?>