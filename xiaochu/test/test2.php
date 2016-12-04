<?php

$results = array(
    1=>array("coin"=>10,"pcc"=>"USD|EUR|CNY|JPY|GBP|CHF|CAD|HKD|SEK|AUD|RUB|NZD|BRL|INR",
        "money"=>"0.99|0.79|5.99|120|0.59|0.99|1.09|7.49|6.99|1.09|50|1.19|2.5|60"),
    2=>array("coin"=>20,"pcc"=>"USD|EUR|CNY|JPY|GBP|CHF|CAD|HKD|SEK|AUD|RUB|NZD|BRL|INR",
    "money"=>"0.99|0.79|5.99|120|0.59|0.99|1.09|7.49|6.99|1.09|50|1.19|2.5|60")
);


foreach($results as $key => &$value){

    $pccstr = $value["pcc"];
    $moneystr = $value["money"];

    $pccarr = explode("|", $pccstr);
    $moneyarr = explode("|", $moneystr);
    $result = array_combine($pccarr,$moneyarr);
    $value["curreny"] = $result;
    unset($value["pcc"]);
    unset($value["money"]);
}


var_dump($results);
?>