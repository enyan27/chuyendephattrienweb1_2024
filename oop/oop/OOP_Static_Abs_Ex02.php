<?php
define('EOL', "\n");
abstract class AbsA {
    // Khai báo  định nghĩa hàm
    static public function AFooA(){
        echo 'AFooA';
    }
    
   
}

interface IA {
    public function IFooA(); 
  }
  
interface IB{
    public function IFooB();
  
}
$dong = function(){
    return $this->Foo();
};
// Full OOP 
class Ex02 extends AbsA implements IA,IB {
  
    static public function AFooA(){
        echo 'AFooA'.EOL;
    }
    public function IFooA(){
        echo 'Interface FooA'.EOL;
    }
    public function IFooB(){
        echo 'Interface FooB'.EOL;
    }
   
}
$ex02 = new Ex02();
$ex02->AFooA();
$ex02->IFooA();
$ex02->IFooB();
