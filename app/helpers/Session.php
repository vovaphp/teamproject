<?php

namespace helpers;

use core\Route;

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
        $_SESSION =array();
        session_destroy();
    }

    /**
     * check authorisation user and redirect if he don`t authorized
     */
    public static function didAuthorized(){
        if (!isset($_SESSION['login'])){
            Route::redirect('/adminusers/authorisation');
        }
    }

    /**
     * if errors set - echo errors
     */
    public static function getErrors(){
        self::start();
        echo $_SESSION['errors'];
        unset($_SESSION['errors']);
    }
}
