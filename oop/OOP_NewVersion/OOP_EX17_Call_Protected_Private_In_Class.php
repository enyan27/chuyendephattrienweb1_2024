<?php
define('EOL', "\n");
abstract class CallAbstractProtected {
    // method protected 
    protected function AFooA(){
        echo 'Foo';
    }
    // method protected abstract 
    abstract protected function Foo();
  
}

class EX017 extends CallAbstractProtected {

    protected function AFooA(){
        echo 'Test Protected'.EOL;
    }
    protected function Foo(){
        echo 'Test Protected Abs'.EOL;
    }
}

$foo = function(){
    return $this->AFooA();
};
$bar = function(){
    return $this->Foo();
};
$ex017 = new EX017();
$foo->call($ex017);// ex017 Protected
$bar->call($ex017);// ex017 Protected Abs

