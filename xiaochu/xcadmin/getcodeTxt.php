<?php
error_reporting(E_ALL);
require_once "../Amfphp/app/util/Logs.class.php";
include_once "../Amfphp/app/GameConfig.class.php";
include_once "../Amfphp/app/util/MMysql.class.php";

$num = $_GET['num'];

$db = new MMysql();

$res = $db->where(array('status'=>0))->limit($num)->select('d_cdkcode');
$count = count($res);
if($count!=0) {
    $phoneStr = "";
    foreach($res as $v){
        $phoneStr.=$v['code']."\r\n";
    }

    header("Content-Type: application/force-download");
    header("Content-Disposition: attachment; filename=code.txt");
//    $fopen = fopen('code.txt','w');
//    fputs($fopen,   $phoneStr);//向文件中写入内容;
//    fclose($fopen);
    echo $phoneStr;

//
//    $path = "data/";
//    $fileName=$path."code.txt";
//
//    var_dump($phoneStr);
//    die;
//
//    if(file_exists($fileName)) {
//        unlink($fileName);
//    }
//    $fp=fopen($fileName,"w+");
//
//    var_dump($fp);
//
//    die;
//
//    if(fwrite($fp,$phoneStr)){
//        echo "导出退换码成功";
//    } else {
//        echo "导出退换码失败";
//    }
}else {
    echo "数据查询失败";
}

$db->close();
?>