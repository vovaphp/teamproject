<?php

namespace models;

class SessionModel
{
    protected $db;

    public function __construct()
    {
        $this->db = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error != 0) {
            throw new \Exception($this->db->connect_error);
        }
    }
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
