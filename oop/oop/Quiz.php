<?php

abstract class a{
    abstract static public function b();
}
class c extends a{
    // static public function b() {
    //     echo 'MORE MORE JUMP';
    // }
    c::b();
}

$a = new c();
$a->b();