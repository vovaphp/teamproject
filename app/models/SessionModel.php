<?php

namespace models;

class SessionModel
{
    static public function start(){
        session_start();
    }
    public static function setUserSession($id){
        self::start();
        $login = "SELECT login FROM users WHERE id = {$id}";
        $_SESSION['login'] = "$login";
    }
    public static function delUserSession(){
        $_SESSION = array();
        session_destroy();
    }
}
