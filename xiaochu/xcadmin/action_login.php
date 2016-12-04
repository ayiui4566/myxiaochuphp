<?php
//error_reporting(E_ALL);
session_start();
$status = 0;
if(!isset($_POST['t_username']) && !isset($_POST['t_passward']))
{
    echo $status;
    return;
}

$username = str_replace(" ", "", $_POST['t_username']);
$passward = str_replace(" ", "", $_POST['t_passward']);
//防止sql注入，数据库攻击
if($username == "admin" && $passward == "jiangbo51wan"){
    $_SESSION['adminLogin'] = $username;
    $status = 1;
}else{
    $status = 0;
}


echo $status;
?>
