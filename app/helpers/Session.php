<?php

namespace helpers;

class Session
{
    /**
     * start user session
     */
    static public function start(){
        session_start();
    }

    /**
     * @param array $user
     * set session with info about user
     */
     static public function setUserSession(array $user){
        if (!isset($_SESSION['login'])){
            self::start();
        }
        $_SESSION['login'] = $user['login'];
        $_SESSION['user_id'] = $user['id'];
    }

    /**
     * destroy session
     */
    public static function delUserSession(){
        session_destroy();
    }
}
