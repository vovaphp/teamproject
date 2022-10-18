<?php


namespace controllers;


use core\AbstractController;
use core\Route;
use core\View;
use models\ArticleModel;

class Admin extends AbstractController
{

private $imagePath = '/images/articles/';

public function  __construct(){

    $this->view = new  View('admin');
    $this->model = new ArticleModel();

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

        $userId= 1;//Todo здесь должен быть id залогиненого пользователя

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
        $userId= 1;//Todo здесь должен быть id залогиненого пользователя

        $this->model->update($article, $articleId, $userId);
        Route::redirect(Route::url('admin', 'index'));
    }

    public function deleteArticle()
    {
        $id = filter_input(INPUT_POST, 'id');
        $this->model->delete($id);
        Route::redirect(Route::url('admin', 'index'));
    }


}