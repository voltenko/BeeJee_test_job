<?php

namespace app\facades;

use app\kernel\Router;
use app\lib\Route as RouteObject;

/**
 * Доступ ко всему, что связано с маршрутами.
 * @package app\facades
 */
class Route
{
    private static $router;

    /**
     * Инициализация.
     * @param Router $router
     */
    public static function setRouter(Router $router): void
    {
        self::$router = $router;
    }


    /**
     * Возаращает объект текущего маршрута.
     * @return RouteObject
     */
    public static function getCurrentRoute(): RouteObject
    {
        return self::$router->getCurrentRoute();
    }


    /**
     * Возвращает путь от корня.
     * @param string $routeName
     * @return string
     */
    public static function getUri(string $routeName): string
    {
        return self::$router->getUri($routeName);
    }


    /**
     * Возвращает поный путь.
     * @param string $routeName
     * @return string
     */
    public static function getUrl(string $routeName): string
    {
        return self::$router->getUrl($routeName);
    }


    /**
     * 301 редирект по имени маршрута.
     * @param string $routeName
     */
    public static function redirect(string $routeName): void
    {
        self::$router->redirect($routeName);
    }
}