<?php


namespace core;


class Route
{
    static public function init()
    {
        $path = $_SERVER['REQUEST_URI'];
        $urlComponents = explode('/', $path);
        array_shift($urlComponents);
        if (count($urlComponents) > 4) {
            self::notFound();
        }
        $folderName = 'index';
        if (!empty($urlComponents[0])) {
            $folderName = strtolower($urlComponents[0]);
        }
        $controllerName = 'index';
        if (!empty($urlComponents[1])) {
            $controllerName = strtolower($urlComponents[1]);
        }elseif($urlComponents[0]=='admin'){
            self::redirect(self::url('admin','articles','index'));
        }
        $actionName = 'index';
        if (!empty($urlComponents[2])) {
            $actionName = strtolower($urlComponents[2]);
        }
        $controllerClass = 'controllers\\' . ucfirst($controllerName);
        var_dump($controllerClass);
        if (!class_exists($controllerClass)) {

          // self::notFound();

        }
        $controller = new $controllerClass;
        if (!empty($urlComponents[3])) {
            $actionOptions = $urlComponents[3];
            self::actionCaller($controller,$actionName,$actionOptions);
        }else{
            self::actionCaller($controller,$actionName);
        }

    }

    static private function actionCaller(controllerInterface $controller, string $action,string $actionOptions=null){
        if (!method_exists($controller, $action)) {
            self::notFound();
        }
        $controller->$action($actionOptions);
    }

    static public function notFound()
    {
        http_response_code(404);
        exit();
    }

    static public function url(string $folder = null,string $controller = null, string $action = null,string $actionOption = null)
    {
        $url = '/';
        if (!empty($folder)) {
            $url .= strtolower($folder);
            if (!empty($controller)) {
                $url .= '/' . strtolower($controller);
                if (!empty($action)) {
                    $url .= '/' . strtolower($action);
                    if (!empty($actionOption)) {
                        $url .= '/' . $actionOption;
                    }
                }
            }
        }
        return $url;
    }
    static public function redirect(string $url = ''){
        header('Location: '.$url);
        exit();
    }
}
