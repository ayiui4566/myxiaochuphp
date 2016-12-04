<?php
header('Content-Type:text/html;charset=utf-8');

echo "今天:".date("Y-m-d")."<br>";
echo "昨天:".date("Y-m-d H:i:s",strtotime("-1 day")), "<br>";
echo "明天:".date("Y-m-d",strtotime("+1 day")). "<br>";
echo "一周后:".date("Y-m-d",strtotime("+1 week")). "<br>";
echo "一周零两天四小时两秒后:".date("Y-m-d G:H:s",strtotime("+1 week 2 days 4 hours 2 seconds")). "<br>";
echo "下个星期四:".date("Y-m-d",strtotime("next Thursday")). "<br>";
echo "上个周一:".date("Y-m-d",strtotime("last Monday"))."<br>";
echo "一个月前:".date("Y-m-d",strtotime("last month"))."<br>";
echo "一个月后:".date("Y-m-d",strtotime("+1 month"))."<br>";
echo "十年后:".date("Y-m-d",strtotime("+10 year"))."<br>";

echo "now的时间戳:".time()."<br>";
$t = '1463295039';


if (date('Y-m-d') == date('Y-m-d',strtotime("-1 day"))) {
    echo 'y';
}else{
    echo "n";
}

echo "===========================<br>";

/**
 * PHP判断一个日期是不是今天
 */
// 拟设一个日期
$a = '2016-08-15 10:10:10';
// 转换为时间戳
$a_ux = strtotime($a);
$now = time();
$dt = new DateTime("@$a_ux");
$now_dt = new DateTime("@$now");
// 转换为 YYYY-MM-DD 格式
$a_date = date('Y-m-d',$a_ux);
// 获取今天的 YYYY-MM-DD 格式
$b_date = date('Y-m-d');
// 使用IF当作字符串判断是否相等
if($a_date==$b_date){
    echo '是今天';
}else{
    echo '不是今天';
}
echo '<br>';
$interval = date_diff($dt, $now_dt);
echo $interval->format('%a');
echo "<Br>";

/**
 * @param $date_1 timestamp 时间戳
 * @param $date_2 timestamp 时间戳
 * @param string $differenceFormat 相隔天数
 * @return string
 */
function dateDifference($timestamp1 , $timestamp2 , $differenceFormat = '%a' )
{
    $datetime1 = date_create("@$timestamp1");
    $datetime2 = date_create("@$timestamp2");

    $interval = date_diff($datetime1, $datetime2);

    return $interval->format($differenceFormat);

}
echo dateDifference("1469846323",time());
echo "<br>";
echo date('Y-m-d','1469846323');
?>