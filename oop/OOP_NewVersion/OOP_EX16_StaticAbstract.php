<?php
define('EOL', "\n");
abstract class StaticAbstract {
    // static in abstract
    static function AFooA(){
        echo 'AFooA' . EOL;
    }
    // abstract static no body
    abstract static function StaticAbs();
   
}

class Other extends StaticAbstract {
    // Overiding Static function 
    static function StaticAbs(){
        echo 'Static in Abstract' . EOL;
    }
}
$other = new Other();
$other->AFooA();// AFooA
$other->StaticAbs();// Static in Abstract