<?php


namespace controllers;

use core\AbstractController;
use core\Route;
use core\View;
use models\ArticleModel;
use models\UserModel;
use models\SessionModel;
use models\ValidationModel;

class Adminarticle extends AbstractController
{
    private $userModel;
    private $SessionModel;
    private $imagesStorPath = 'images/articles/';

    public function __construct()
    {

        $this->view = new  View('admin');
        $this->model = new ArticleModel();
        $this->userModel = new UserModel();
        $this->SessionModel = new SessionModel();
    }

    /**
     * show main page
     */
    public function index()
    {
        // TODO: Implement index() method.
        $articles = $this->model->all();
        $this->view->render('admin_index', [
            'articles' => $articles
        ]);
    }

    /**
     * show create article page
     */
    public function create()
    {
        $this->view->render('admin_create');
    }

    /**
     * store article handler
     */
    public function store()
    {
        $imageFileName = $_FILES['imageFile'];
        $imagePath = $this->imagesStorPath . $imageFileName['name'];
        move_uploaded_file($imageFileName['tmp_name'], $imagePath);
        $request = filter_input_array(INPUT_POST);
        //TODO validate
        $article = [
            'title' => $request['title'],
            'text' => $request['text'],
            'url' => '/' . $imagePath,
        ];

        $userId = $this->userModel->getUserId($_SESSION['login']); // id залогиненого пользователя

        $this->model->add($article, $userId);
        Route::redirect(Route::url('adminarticle', 'index'));
    }

     /**
     * show edit article page
     */
    public function edit()
    {
        if(!$_POST){
            Route::notFound();
        }
        $id = filter_input(INPUT_POST, 'id');
        $article = $this->model->show($id);
        $this->view->render('admin_edit', [
            'article' => $article,
        ]);
    }

    /**
     * update article handler
     */
    public function update()
    {
        $request = filter_input_array(INPUT_POST);

        if ($_FILES['imageFile']['name']) {
            $imageFileName = $_FILES['imageFile'];
            $imagePath = $this->imagesStorPath . $imageFileName['name'];
            move_uploaded_file($imageFileName['tmp_name'], $imagePath);
            $imagePath = '/' . $imagePath;
        } else {
            $imagePath = $request['newImageFile'];
        }

        $article = [
            'title' => $request['title'],
            'text' => $request['text'],
            'url' => $imagePath,
        ];

        $articleId = $request['id'];
        $userId = $this->userModel->getUserId($_SESSION['login']);//id залогиненого пользователя

        $this->model->update($article, $articleId, $userId);
        Route::redirect(Route::url('adminarticle', 'index'));
    }

    /**
     * delete article handler
     */
    public function destroy()
    {
        $id = filter_input(INPUT_POST, 'id');
        $this->model->destroy($id);
        Route::redirect(Route::url('adminarticle', 'index'));
    }
}