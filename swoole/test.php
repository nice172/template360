<?php
class test {
    
    private $host = '0.0.0.0';
    
    private function run(){
        self::$host;
    }
    
    protected static function ui(){
        echo 'ui';
    }
    
    protected function show(){
        echo 'show';
    }
    
}
$test = new test();
$test->run();
