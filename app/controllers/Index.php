<?php


namespace controllers;


use core\AbstractController;
use core\View;
use models\ArticleModel;

class Index extends AbstractController
{
    /**
     * constructor
     */
    public function __construct()
    {
        $this->view = new View();
        $this->model = new ArticleModel();
    }

    /**
     * controller main page index
     */
    public function index()
    {
        $articles = $this->model->all();
        $this->view->render('index_index',[
            'articles' => $articles,
        ]);
    }

    /**
     * action read article
     */
    public function read(){
        $id = $_REQUEST['actionOptions'];
        $article = $this->model->selectArticle($id);
        $this->view->render('index_article',$article);
    }
}