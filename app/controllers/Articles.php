<?php


namespace controllers;


use core\AbstractController;
use core\Route;
use core\View;
use models\ArticleModel;
use models\UserModel;
use models\SessionModel;
use models\ValidationModel;
class Articles extends AbstractController
{

private $imagesStorPath = 'images/articles/';

public function  __construct(){

    if(empty($_SESSION['login'])){
        Route::redirect('/');
    }
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
        $imagePath = $this->imagesStorPath.$imageFileName['name'];
        move_uploaded_file($imageFileName['tmp_name'],$imagePath);
        $request = filter_input_array(INPUT_POST);
        //TODO validate
        $article = [
            'title' => $request['title'],
            'text' => $request['text'],
            'url' => '/'.$imagePath,
        ];

        $userId=$this->userModel->getUserId($_SESSION['login']);

        $this->model->add($article, $userId);
        Route::redirect(Route::url('admin','articles', 'index'));
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
        $userId= $this->userModel->getUserId($_SESSION['login']);

        $this->model->update($article, $articleId, $userId);
        Route::redirect(Route::url('admin','article', 'index'));
    }

    public function deleteArticle()
    {
        $id = filter_input(INPUT_POST, 'id');
        $this->model->delete($id);
        Route::redirect(Route::url('admin','article', 'index'));
    }

}