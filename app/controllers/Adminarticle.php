<?php


namespace controllers;

use core\AbstractController;
use core\Route;
use core\View;
use helpers\Validation;
use models\ArticleModel;
use helpers\Session;

class Adminarticle extends AbstractController
{

    private $imagesStorPath = 'images/articles/';

    public function __construct()
    {
        Session::didAuthorized();
        $this->view = new  View('admin');
        $this->model = new ArticleModel();
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
        if(!$_POST){
            Route::notFound();
        }
        $imageFileName = $_FILES['imageFile'];
        $imagePath = $this->imagesStorPath . $imageFileName['name'];
        move_uploaded_file($imageFileName['tmp_name'], $imagePath);
        $request = filter_input_array(INPUT_POST);

        if(Validation::validateArticle($request)){
            $this->view->render('admin_create', ['errors' => Validation::validateArticle($request)]);
            exit();
        }

        $article = [
            'title' => $request['title'],
            'text' => $request['text'],
            'url' => '/' . $imagePath,
        ];

        Session::start();
        $userId = $_SESSION['user_id'];

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
        $articleId = filter_input(INPUT_POST, 'id');
        $article = $this->model->show($articleId);
        $this->view->render('admin_edit', [
            'article' => $article,
        ]);
    }

    /**
     * update article handler
     */
    public function update()
    {
        if(!$_POST){
            Route::notFound();
        }
        $request = filter_input_array(INPUT_POST);
        $articleId = $request['articleId'];

        if(Validation::validateArticle($request)){
            $errorsArray=Validation::validateArticle($request);
            $article = $this->model->show($articleId);
            $this->view->render('admin_edit', [
                'article' => $article,
                'errors' => $errorsArray,
            ]);
            exit();
        }

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

        Session::start();
        $userId = $_SESSION['user_id'];

        $this->model->update($article, $articleId, $userId);
        Route::redirect(Route::url('adminarticle', 'index'));
    }

    /**
     * delete article handler
     */
    public function destroy()
    {
        if(!$_POST){
            Route::notFound();
        }
        $id = filter_input(INPUT_POST, 'id');
        $this->model->destroy($id);
        Route::redirect(Route::url('adminarticle', 'index'));
    }
}