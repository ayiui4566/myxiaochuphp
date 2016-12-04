<?php
//error_reporting(E_ALL);
require_once "../Amfphp/app/util/Logs.class.php";
include_once "../Amfphp/app/GameConfig.class.php";
include_once "../Amfphp/app/util/MMysql.class.php";

$db = new MMysql();

$res = $db->select('u_losecause');

$totalUsersNum = $db->doSql('select count(*) as num from u_user');
$totalUsersNum= $totalUsersNum[0]['num'];

if (empty($res)) {
    echo -1;
} else {

    $std = new stdClass();
    $std->total = count($res);

    $res1 = array();
    $lastUsers = $totalUsersNum;
    foreach($res as $value){

        $row = array();
        $row['level'] = $value['level'];

        $totalPassNum = $db->doSql('SELECT count(*) as num FROM `d_user_levelinfo` where level='.$value['level']);
        $totalPassNum= $totalPassNum[0]['num'];


        $row['passusers'] = $totalPassNum;
        $row['subusers'] = $totalPassNum - $lastUsers;
        $row['total'] = $value['total'];
        $row['percent'] = strval(round($value['lose']/$value['total'],2)*100).'%';
        $row['reason'] = $value['loseType'];
        $res1[] = $row;

        $lastUsers = $totalPassNum;
    }
    $std->rows = $res1;
    $std->usersno = $totalUsersNum;

    echo json_encode($std);

}

$db->close();
?>
