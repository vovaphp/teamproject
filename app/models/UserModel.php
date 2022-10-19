<?php

namespace models;

class UserModel
{
    /**
     * mysql db
     */
    protected $db;
    /**
     * name of db with which model working
     * @var string
     */
    public $table = 'users';

    /**
     * @param array $user
     * add user into db
     * @return mixed
     */
    public function add(array $user){
        $sql = "INSERT INTO {$this->table} (login, `e-mail`, password) VALUES ('{$user['login']}', '{$user['e-mail']}', '{$user['password']}')";
        return $this->db->query($sql);
    }

    /**
     * selected all users
     * @return array
     */
    public function all(){
        $sql = "SELECT * FROM {$this->table}";
        $result = $this->db->query($sql);
        if (!$result){
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * @param int $id
     * delete user by id
     */
    public function delete(int $id){
        $sql = "DELETE FROM {$this->table} WHERE id = {$id}";
        return $this->db->query($sql);
    }

    /**
     * edit user by id
     */
    public function rewrite($user){
        $sql = "UPDATE {$this->table} SET `login` = '{$user['login']}', `e-mail` = '{$user['e-mail']}', `password` = '{$user['password']}' WHERE id = '{$user['id']}'";
        return $this->db->query($sql);
    }

    /**
     * return userId by session
     * @return int or null
     */
    public function getUserId(): ?int
    {
        $sql = "SELECT id FROM `users` WHERE login = {$_SESSION['login']}";
        $id = $this->db->query($sql);
        if (!$id){
            return null;
        }
        return $id;
    }
}