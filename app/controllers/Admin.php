<?php


namespace controllers;


use core\AbstractController;
use core\Route;
use core\View;
use models\ArticleModel;
use models\UserModel;
use models\SessionModel;
use models\ValidationModel;
class Admin extends AbstractController
{
private $userModel;
private $SessionModel;
private $imagesStorPath = 'images/articles/';

public function  __construct(){

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

    public function newArticle()
    {
        $this->view->render('admin_create');
    }

    public function createArticle()
    {
        $imageFileName = $_FILES['imageFile'];
        $imagePath = $this->imagesStorPath.$imageFileName['name'];
        move_uploaded_file($imageFileName['tmp_name'],$imagePath);
        $request = filter_input_array(INPUT_POST);
        //TODO validate
        $article = [
            'title' => $request['title'],
            'text' => $request['text'],
            'url' => '/'.$imagePath,
        ];

        $userId= $this->userModel->getUserId( $_SESSION['login']); // id залогиненого пользователя

        $this->model->add($article, $userId);
        Route::redirect(Route::url('admin', 'index'));
    }

    public function editing()
    {
        $id = filter_input(INPUT_POST, 'id');
        $article = $this->model->show($id);
        $this->view->render('admin_edit', [
            'id'=>$article['id'],
            'title'=>$article['title'],
            'text'=>$article['text'],
            'imagePath'=>$article['image'],
        ]);
    }


    public function editArticle()
    {
        $request = filter_input_array(INPUT_POST);

        if ($_FILES['imageFile']['name']){
            $imageFileName = $_FILES['imageFile'];
            $imagePath = $this->imagesStorPath.$imageFileName['name'];
            move_uploaded_file($imageFileName['tmp_name'],$imagePath);
            $imagePath='/'.$imagePath;
        }else{
            $imagePath = $request['newImageFile'];
        }

        //TODO validate
        $article = [
            'title' => $request['title'],
            'text' => $request['text'],
            'url' => $imagePath,
        ];

        $articleId = $request['id'];
        $userId= $this->userModel->getUserId( $_SESSION['login']);//id залогиненого пользователя

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

    public function users(){
        $users = $this->userModel->all();
        $this->view->render('admin_users', [
            'users' => $users,
        ]);
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
        $password = $this->userModel->getUserPass($_POST['login']);
        if (password_verify($_POST['password'], $password['password']) == true){
            $id = $this->userModel->getUserId($_POST['login']);
            $this->SessionModel->setUserSession($id);
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
            $id = $this->userModel->getUserId($_POST['login']);
            $this->SessionModel->setUserSession($id);
            Route::redirect('/index');
        }
        Route::redirect('/admin/createUser');
    }
    /**
     * deleting user and redirect on main page
     */
    public function deleteUser(){
        $id = filter_input( INPUT_POST, 'id');
        $this->userModel->delete($id);
        Route::redirect('/admin/users');
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
        Route::redirect('/admin/users');
    }
    /**
     * end user session and redirect on main page
     */
    public function exitUser(){
        SessionModel::delUserSession();
        Route::redirect('/index');
    }
}