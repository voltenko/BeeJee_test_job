<?php

namespace app\kernel;

use app\lib\http\Request;
use app\lib\Route;
use app\exceptions\PageNotFoundException;

/**
 * Маршрутизатор
 * @package app\kernel
 */
class Router
{
    private $routes;
    private $currentRoute;
    private $request;
    private $routesObjects = [];

    /**
     * Router constructor.
     * @param array $routes
     * @param Request $request
     */
    public function __construct(array $routes, Request $request)
    {
        $this->request = $request;
        $this->routes = $routes;
    }


    /**
     * Задает имя контроллера и экшена для текущего маршрута.
     * @throws PageNotFoundException
     */
    public function resolve(): void
    {
        $this->add($this->routes, $this->request);

        $controllerName = $this->currentRoute->getControllerName();
        $actionName = $this->currentRoute->getActionNmae();
        $controllerPath = "\app\controllers\\{$controllerName}Controller";

        $action = "{$actionName}Action";
        $this->currentRoute->setControllerPath($controllerPath);
        $this->currentRoute->setAction($action);
    }


    /**
     * Возвращает текущий маршрут.
     * @return Route
     */
    public function getCurrentRoute(): Route
    {
        return $this->currentRoute;
    }


    /**
     * Возвращает путь от корня по имени маршрута.
     * @param string $name
     * @return string
     */
    public function getUri(string $name): string
    {
        return $this->routesObjects[$name]->getUri();
    }


    /**
     * Возвращает полный путь по имени маршрута.
     * @param string $name
     * @return string
     */
    public function getUrl(string $name): string
    {
        return $this->routesObjects[$name]->getUrl();
    }


    /**
     * 301 редирект по имени маршрута.
     * @param string $name
     */
    public function redirect(string $name): void
    {
        $url = $this->getUri($name);
        header('HTTP/1.1 301 Moved Permanently');
        header("Location: $url");
    }


    /**
     * Разбирает УРЛ, ищит соответствие в конфигурации маршрутов,
     * создает объекты маршрутов, если не находит подходящий маршркт, то бросает исключение.
     * @param array $routes
     * @param Request $request
     * @throws PageNotFoundException
     */
    private function add(array $routes, Request $request): void
    {
        $uri = explode('?', $request->getUri())[0];

        foreach ($routes as $route => $params) {
            $routeName = $params['name'] ?? $route;
            $url = "{$_SERVER['HTTP_HOST']}$route";

            $routeObject = new Route($routeName, $route, $url, $params['controller'], $params['action']);
            $this->routesObjects[$routeObject->getName()] = $routeObject;

            if (preg_match("#^$route$#", $uri, $matches)) {
                $this->currentRoute = $routeObject;
            }
        }

        if(!$this->currentRoute) {
            throw new PageNotFoundException(\Constants::PAGE_404_MESSAGE, 404);
        }
    }
}