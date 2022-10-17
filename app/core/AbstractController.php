<?php


namespace core;


abstract class AbstractController implements controllerInterface
{
    /**
     * @var View view objects for rendering page
     */
    protected $view;

    protected $model;

    /**
     * Abstract controller constructor
     */

    public function __construct()
    {
        $this->view = new View();
    }
}