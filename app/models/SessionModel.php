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
    public function setUserSession($id){
        self::start();
        $sql = "SELECT login FROM users WHERE id = {$id}";
        $result = $this->db->query($sql);
        $login = mysqli_fetch_assoc($result);
        $_SESSION['login'] = $login['login'];
    }
    public static function delUserSession(){
        $_SESSION = array();
        session_destroy();
    }
}
