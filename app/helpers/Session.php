<?php

namespace helpers;

class Session
{
    static public function start(){
        session_start();
    }
     static public function setUserSession($login){
        self::start();
        $_SESSION['login'] = $login['login'];
    }
    public static function delUserSession(){
        session_destroy();
    }
}
