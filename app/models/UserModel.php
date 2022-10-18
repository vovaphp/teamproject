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
        $sql = "INSERT INTO {$this->table} (login, `e-mail`, md5_hash_password) VALUES ('{$user['login']}', '{$user['e-mail']}', '{$user['md5_hash_password']}')";
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
        $sql = "DELETE FROM users WHERE `users`.`id` = {$id}";
    }

    /**
     * edit user by id
     */
    public function rewrite(){
        $sql = "UPDATE {$this->table} SET `login` = '{$_POST['login']}', `e-mail` = '{$_POST['e-mail']}', `md5_hash_password` = '{$_POST['md5_hash_password']}' WHERE id = '{$_POST['id']}'";
        return $this->db->query($sql);
    }
}