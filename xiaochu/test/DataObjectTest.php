<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/16
 * Time: 0:18
 */
require_once "../Amfphp/app/util/MMysql.class.php";
require_once "../Amfphp/app/DataObject.class.php";
require_once "../Amfphp/app/UserBlockModel2.class.php";



$user = new UserBlockModel2();
$user->auid = 'oct1158';
$user->afid = '789012';
$user->apic = '1.jpg';
$user->fname = 'jiangbo';

if ($user->insert()) {
    echo 'New User ID: ', $user->uid, '<br>';

    // Update the row
    $user->password = '112233';
    $user->update();
} else {
    echo 'INSERT Failed<br>';
}
?>