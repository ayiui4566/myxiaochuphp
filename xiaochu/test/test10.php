<?php
$code = md5(uniqid('n',true));
echo $code .'<Br>';
echo strlen($code);

echo '<Br>';
$people = array("Bill", "Steve", "Mark", "David",'23');

if (in_array("mark", $people))
{
    echo "匹配已找到";
}
else
{
    echo "匹配未找到";
}
echo '<Br>';
if (in_array(23,$people))
{
    echo "匹配已找到<br>";
}
else
{
    echo "匹配未找到<br>";
}

?>