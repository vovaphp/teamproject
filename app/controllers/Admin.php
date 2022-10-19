<?php

namespace controllers;

use core\AbstractController;
use core\Route;
use models\SessionModel;
use models\UserModel;
use models\ValidationModel;

class Admin extends AbstractController
{
    /**
     * mysql db
     */
    protected $db;
    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        // TODO: Implement index method.
    }
    public function createUser(){
        $this->view->render('admin_registration');
    }

    public function authorisation(){
        $this->view->render('admin_authorisation');
    }
    public function signIn(){
        $password = "SELECT password FROM users WHERE login = {$_POST['login']}";
        if (password_verify($_POST['password'], $password) == true){
            $id = "SELECT id FROM `users` WHERE login = {$_POST['login']}";
            SessionModel::setUserSession("$id");
            Route::redirect('teamproject/index');
        }
        Route::redirect('teamproject/admin/authorisation');
    }
    public function saveUser(){
        if (ValidationModel::fieldsUser($_POST) == true){
            $user = $_POST;
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
            $this->model->add($user);
            $id = "SELECT id FROM `users` WHERE login = {$user['login']}";
            SessionModel::setUserSession("$id");
            Route::redirect('teamproject/index');
        }
            Route::redirect('teamproject/admin/registration');
    }

    public function deleteUser(){
        $id = filter_input( INPUT_POST, 'id');
        $this->model->delete($id);
        Route::redirect('teamproject/index');
    }
    public function exitUser(){
        SessionModel::delUserSession();
        Route::redirect('teamproject/index');
    }
}