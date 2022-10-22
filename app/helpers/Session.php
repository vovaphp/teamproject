<?php

namespace helpers;

class Session
{
    static public function start(){
        session_start();
    }
     static public function setUserSession(array $user){
        if (!isset($_SESSION['login'])){
            self::start();
        }
        $_SESSION['login'] = $user['login'];
        $_SESSION['user_id'] = $user['id'];
    }
    public static function delUserSession(){
        session_destroy();
    }
}
