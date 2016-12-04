<?php
$json = "{ \"ret\": 0, \"is_lost\": 0, \"items\": [ { \"openid\": \"1471CCA71C53D2332E1772A32437E2CB\", \"nickname\": \"hifree\", \"figureurl\": \"http:\/\/thirdapp1.qlogo.cn\/qzopenapp\/84efbcf7faca4c85b5c2c3820df97e62b1a9e1361195f91fb9a4eeca03316366\/50\", \"is_yellow_vip\": 0, \"is_yellow_year_vip\": 0, \"yellow_vip_level\": 0, \"is_yellow_high_vip\": 0, \"gender\": \"男\", \"city\": \"东城\", \"province\": \"北京\", \"country\": \"中国\" } ] }";
$ary = json_decode($json);
var_dump($ary);
?>
