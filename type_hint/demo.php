<?php
declare(strict_types=1);
include 'I.php';
include 'C.php';
include 'A.php';
include 'B.php';

define('EOL',"<br>");

class Demo {
    // public function typeXReturnY(): X {
    //     echo __FUNCTION__ . EOL;
    //     return new Y(); 
    // }

    // A
    public function typeAReturnA(): A {
        echo __FUNCTION__ . EOL;
        return new A(); 
    }

    public function typeAReturnB(): A {
        echo __FUNCTION__ . EOL;
        return new B();
    }

    public function typeAReturnC(): A {
        echo __FUNCTION__ . EOL;
        return new C(); 
    }

    public function typeAReturnI(): A {
        echo __FUNCTION__ . EOL;
        return new I(); 
    }

    public function typeAReturnNull(): A {
        echo __FUNCTION__ . EOL;
        return null; 
    }

    //B 
    public function typeBReturnA(): B {
        echo __FUNCTION__ . EOL;
        return new A(); 
    }

    public function typeBReturnB(): B {
        echo __FUNCTION__ . EOL;
        return new B(); 
    }

    public function typeBReturnC(): B {
        echo __FUNCTION__ . EOL;
        return new C(); 
    }

    public function typeBReturnI(): B {
        echo __FUNCTION__ . EOL;
        return new I(); 
    }

    public function typeBReturnNull(): B {
        echo __FUNCTION__ . EOL;
        return null; 
    }

    // C
    public function typeCReturnA(): C {
        echo __FUNCTION__ . EOL;
        return new A(); 
    }

    public function typeCReturnB(): C {
        echo __FUNCTION__ . EOL;
        return new B(); 
    }

    public function typeCReturnC(): C {
        echo __FUNCTION__ . EOL;
        return new C(); 
    }

    public function typeCReturnI(): C {
        echo __FUNCTION__ . EOL;
        return new I(); 
    }

    public function typeCReturnNull(): C {
        echo __FUNCTION__ . EOL;
        return null;
    }

    // I
    public function typeIReturnA(): I {
        echo __FUNCTION__ . EOL;
        return new A(); 
    }

    public function typeIReturnB(): I {
        echo __FUNCTION__ . EOL;
        return new B(); 
    }

    public function typeIReturnC(): I {
        echo __FUNCTION__ . EOL;
        return new C(); 
    }

    public function typeIReturnI(): I {
        echo __FUNCTION__ . EOL;
        return new I(); 
    }

    public function typeIReturnNull(): I {
        echo __FUNCTION__ . EOL;
        return null;
    }

    // Null
    public function typeNullReturnA(): null {
        echo __FUNCTION__ . EOL;
        return new A(); 
    }

    public function typeNullReturnB(): null {
        echo __FUNCTION__ . EOL;
        return new B(); 
    }

    public function typeNullReturnC(): null {
        echo __FUNCTION__ . EOL;
        return new C(); 
    }

    public function typeNullReturnI(): null {
        echo __FUNCTION__ . EOL;
        return new I(); 
    }

    public function typeNullReturnNull(): null {
        echo __FUNCTION__ . EOL;
        return null;
    }
}

$demo = new Demo();
$demo->typeNullReturnNull();