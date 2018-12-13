<?php

namespace app\kernel;

use app\lib\http\Request;
use app\facades\Auth;
use app\facades\Route;
use app\controllers\Controller;

/**
 * Основной класс приложения.
 * Class App
 * @package app\kernel
 */
class App
{
    private $controller;
    private $request;
    private $render;
    private $router;

    /**
     * Принимает массив конфигурации маршрутов.
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $request = new Request();
        $router = new Router($routes, $request);
        Route::setRouter($router);
        $this->request = $request;
        $this->router = $router;
        $this->render = new Render();
        Auth::init($request);
    }


    /**
     * Обрабатывает завпрос, создает нужный контроллер, вызывает нужный экшн.
     */
    public function handle(): void
    {
        try {
            $this->router->resolve();

            $controllerPath = $this->router->getCurrentRoute()->getControllerPath();
            $action = $this->router->getCurrentRoute()->getAction();

            $this->controller = new $controllerPath($this->request, $this->render);
            $this->controller->$action();
        } catch (\Exception $e) {
            $this->controller = new Controller($this->request, $this->render);
            $this->controller->errorAction($e->getMessage(), $e->getCode());
        }
    }
}