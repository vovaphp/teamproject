<?php


namespace controllers;


use core\AbstractController;
use core\Route;
use core\View;
use models\ArticleModel;
use models\UserModel;
use models\SessionModel;

class Index extends AbstractController
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new ArticleModel();
        $this->userModel = new UserModel();
        $this->SessionModel = new SessionModel();
    }

    public function index()
    {
        $articles = $this->model->all();
        $this->view->render('index_index',[
            'articles' => $articles,
        ]);
    }
    public function read(string $actionOption){
        $id = $actionOption;
        $article = $this->model->selectArticle($id);
        $this->view->render('index_article',$article);
    }
    /**
     * authorisation action
     */
    public function authorisation(){
        $this->view->render('index_authorisation');
    }
    /**
     * checking user param and sign-in
     */
    public function signIn(){
        $password = $this->userModel->getUserPass($_POST['login']);
        if (password_verify($_POST['password'], $password['password']) == true){
            $id = $this->userModel->getUserId($_POST['login']);
            $this->SessionModel->setUserSession($id);
            Route::redirect('/admin/index');
        }
        Route::redirect('/index/authorisation');
    }
}