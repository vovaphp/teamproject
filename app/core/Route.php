<?php


namespace core;


class Route
{
    static public function init()
    {
        $path = $_SERVER['REQUEST_URI'];
        $urlComponents = explode('/', $path);
        array_shift($urlComponents);
        if (count($urlComponents) > 3) {
            self::notFound();
        }
        $controllerName = 'index';
        if (!empty($urlComponents[0])) {
            $controllerName = strtolower($urlComponents[0]);
        }
        $actionName = 'index';
        if (!empty($urlComponents[1])) {
            $actionName = strtolower($urlComponents[1]);
        }
        $controllerClass = 'controllers\\' . ucfirst($controllerName);
        if (!class_exists($controllerClass)) {
            self::notFound();
        }
        $controller = new $controllerClass;
        if (!empty($urlComponents[2])) {
            $actionOptions = $urlComponents[2];
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

    static public function notFound(){
        http_response_code(404);
        header("Location: /app/source/views/pages/not-found-page.php");
        exit();
    }

    static public function url(string $controller = null, string $action = null,string $actionOption = null)
    {
        $url = '/';
        if (!empty($controller)) {
            $url .= strtolower($controller);
            if (!empty($action)) {
                $url .= '/' . strtolower($action);
                if (!empty($actionOption)) {
                    $url .= '/' . $actionOption;
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
