<?php

class foo {
    private $a;
    public $b;
    public $c;
    private $d;
    static $e;

    public function test() {
        var_dump(get_object_vars($this));
    }
}

$test = new foo;
$obj = get_object_vars($test);
var_dump($obj);
//var_dump($obj->c);

$test->test();

?>
