<?php

namespace controllers;

use core\AbstractController;
use core\Route;
use models\UserModel;
use helpers\Session;
use helpers\Validation;
use models\ArticleModel;
class Adminusers extends AbstractController
{
    /**
     * set model UserModel
     */
    public function __construct(){
        $this->model = new UserModel();
    }

    /**
     * Adminuser index page
     */
    public function index(){
        $users = $this->model->all();
        $this->view->render('admin_users', [
            'users' => $users,
        ]);
    }
    /**
     * registration action
     */
    public function createUser(){
        $this->view->render('admin_registration');
    }
    /**
     * authorisation action
     */
    public function authorisation(){
        $this->view->render('admin_authorisation');
    }
    /**
     * checking user param and sign-in
     */
    public function signIn(){
        $user = $_POST;
        $password = $this->model->getUserPass($user['login']);
        if (password_verify($user['password'], $password['password']) == true){
            Session::setUserSession($user);
            Route::redirect('/adminusers/index');
        }
        Route::redirect('/adminusers/authorisation');
    }
    /**
     * check validation, save user in db and starting his session
     */
    public function saveUser(){
        if (Validation::fieldsUser($_POST) == true){
            $user = $_POST;
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
            $this->model->add($user);
            Session::setUserSession($user);
            Route::redirect('/adminusers/users');
        }
        Route::redirect('/adminusers/createUser');
    }
    /**
     * deleting user and redirect on main page
     */
    public function deleteUser(){
        $id = filter_input( INPUT_POST, 'id');
        if (ArticleModel::getCountArticlesByUserId($id) != null){
            Session::start();
            $_SESSION['errors'] = 'Вы не можете удалить пользователя у которого есть статьи';
            Route::redirect('/adminusers/index');
        }
        if ($id == ($_SESSION['user_id'])){
            $this->model->delete($id);
            Session::delUserSession();
            Route::redirect('/index');
        }
        $this->model->delete($id);
        Route::redirect('/adminusers/index');
    }

    /**
     * editUser action
     */
    public function editUser(){
        $users = $this->model->all();
        $request = filter_input(INPUT_POST, 'id');
        foreach ($users as $user) {
            $searchUser = array_search($request, $user);
            if ($searchUser === 'id') {
                $this->view->render('admin_editUser', [
                    'user' => $user,
                ]);
            }
        }
    }

    /**
     * save changes about user
     */
    public function editUserSave(){
        $user = filter_input_array(INPUT_POST);
        $this->model->rewrite($user);
        Session::setUserSession($user);
        Route::redirect('/adminusers/index');
    }
    /**
     * end user session and redirect on main page
     */
    public function exitUser(){
        Session::delUserSession();
        Route::redirect('/index');
    }
}