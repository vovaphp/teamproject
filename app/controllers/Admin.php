<?php


namespace controllers;


use core\AbstractController;
use core\Route;
use core\View;
use models\ArticleModel;
use models\UserModel;

class Admin extends AbstractController
{
private $userModel;

private $imagePath = '/images/articles/';

public function  __construct(){

    $this->view = new  View('admin');
    $this->model = new ArticleModel();
    $this->userModel = new UserModel();
}

    public function index()
    {
        // TODO: Implement index() method.
        $articles = $this->model->all();
        $this->view->render('admin_index', [
            'articles' => $articles
        ]);
    }

    public function newArticle()
    {
        $this->view->render('admin_create');
    }

    public function createArticle()
    {
        $imageFileName = $_FILES['imageFile'];
        $request = filter_input_array(INPUT_POST);
        //TODO validate
        $article = [
            'title' => $request['title'],
            'text' => $request['text'],
            'url' => $this->imagePath.$imageFileName,
        ];

        $userId= $this->userModel->getUserId(); // id залогиненого пользователя

        $this->model->add($article, $userId);
        Route::redirect(Route::url('admin', 'index'));
    }

    public function editing()
    {
        $id = filter_input(INPUT_POST, 'id');
        $article = $this->model->show($id);
        $this->view->render('admin_edit', $article);
    }


    public function editArticle()
    {
        $imageFileName = $_FILES['imageFile'];
        $request = filter_input_array(INPUT_POST);
        //TODO validate
        $article = [
            'title' => $request['title'],
            'text' => $request['text'],
            'url' => $this->imagePath.$imageFileName,
        ];
        $articleId = $request['id'];
        $userId= $this->userModel->getUserId();//id залогиненого пользователя

        $this->model->update($article, $articleId, $userId);
        Route::redirect(Route::url('admin', 'index'));
    }

    public function deleteArticle()
    {
        $id = filter_input(INPUT_POST, 'id');
        $this->model->delete($id);
        Route::redirect(Route::url('admin', 'index'));
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
        $password = "SELECT password FROM users WHERE login = {$_POST['login']}";
        if (password_verify($_POST['password'], $password) == true){
            $id = "SELECT id FROM `users` WHERE login = {$_POST['login']}";
            SessionModel::setUserSession("$id");
            Route::redirect('/admin/index');
        }
        Route::redirect('/admin/authorisation');
    }

    /**
     * check validation, save user in db and starting his session
     */
    public function saveUser(){
        if (ValidationModel::fieldsUser($_POST) == true){
            $user = $_POST;
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
            $this->userModel->add($user);
            $id = "SELECT id FROM `users` WHERE login = {$user['login']}";
            SessionModel::setUserSession("$id");
            Route::redirect('teamproject/index');
        }
        Route::redirect('teamproject/admin/registration');
    }
    /**
     * deleting user and redirect on main page
     */
    public function deleteUser(){
        $id = filter_input( INPUT_POST, 'id');
        $this->userModel->delete($id);
        Route::redirect('teamproject/admin/users');
    }
    public function editUser(){
        $users = $this->userModel->all();
        $request = filter_input(INPUT_POST, 'id');
        foreach ($users as $user) {
            $searchArticle = array_search($request, $user);
            if ($searchArticle === 'id') {
                $this->view->render('admin_editUser', [
                    'user' => $user,
                ]);
            }
        }
    }
    public function editUserSave(){
        $user = filter_input_array(INPUT_POST);
        $this->userModel->rewrite($user);
        Route::redirect('teamproject/admin/users');
    }
    /**
     * end user session and redirect on main page
     */
    public function exitUser(){
        SessionModel::delUserSession();
        Route::redirect('teamproject/index');
    }
}