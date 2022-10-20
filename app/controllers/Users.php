<?php


namespace controllers;


use core\AbstractController;
use core\Route;
use core\View;
use models\ArticleModel;
use models\UserModel;
use models\SessionModel;
use models\ValidationModel;
class Users extends AbstractController
{
private $userModel;
private $SessionModel;
private $imagesStorPath = 'images/articles/';

public function  __construct(){

    if(empty($_SESSION['login'])){
        Route::redirect('/');
    }
    $this->view = new  View('admin');
    $this->model = new ArticleModel();
    $this->userModel = new UserModel();
    $this->SessionModel = new SessionModel();
}

    public function index()
    {
        // TODO: Implement index() method.
        $articles = $this->model->all();
        $this->view->render('admin_index', [
            'articles' => $articles
        ]);
    }


    /**
     * registration action
     */
    public function createUser(){
        $this->view->render('admin_registration');
    }

    public function users(){
        $users = $this->userModel->all();
        $this->view->render('admin_users', [
            'users' => $users,
        ]);
    }


    /**
     * check validation, save user in db and starting his session
     */
    public function saveUser(){
        if (ValidationModel::fieldsUser($_POST) == true){
            $user = $_POST;
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
            $this->userModel->add($user);
            $id = $this->userModel->getUserId($_POST['login']);
            $this->SessionModel->setUserSession($id);
            Route::redirect('/admin/users/users');
        }
        Route::redirect('/admin/users/createUser');
    }
    /**
     * deleting user and redirect on main page
     */
    public function deleteUser(){
        $id = filter_input( INPUT_POST, 'id');
        if ($id == $this->userModel->getUserId($_SESSION['login'])){
            $this->userModel->delete($id);
            SessionModel::delUserSession();
            Route::redirect('/');
        }
        $this->userModel->delete($id);
        Route::redirect(Route::url('admin','users', 'users'));
    }
    public function editUser(){
        $users = $this->userModel->all();
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
    public function editUserSave(){
        $user = filter_input_array(INPUT_POST);
        $this->userModel->rewrite($user);
        $this->SessionModel->setUserSession($user['id']);
        Route::redirect('/admin/users/users');
    }
    /**
     * end user session and redirect on main page
     */
    public function exitUser(){
        SessionModel::delUserSession();
        Route::redirect('/');
    }
}