<?php

namespace app\lib;

/**
 * Класс маршрута.
 * @package app\lib
 */
class Route
{
    private $name;
    private $uri;
    private $url;
    private $controllerName;
    private $controllerPath;
    private $actionName;
    private $action;

    /**
     * Route constructor.
     * @param string $name
     * @param string $uri
     * @param string $url
     * @param string $controllerName
     * @param string $actionName
     */
    public function __construct(string $name, string $uri, string $url, string $controllerName, string $actionName)
    {
        $this->name = $name;
        $this->uri = $uri;
        $this->url = $url;
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
    }


    /**
     * Устанавлевает путь к контроллеру
     * @param string $path
     */
    public function setControllerPath(string $path): void
    {
        $this->controllerPath = $path;
    }


    /**
     * Устанавливает имя экшена.
     * @param string $action
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }


    /**
     * Возвращает имя маршрута.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * Возвращает путь от корня.
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }


    /**
     * Возвращает полный путь.
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }


    /**
     * Возвращает имя контроллера.
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->controllerName;
    }


    /**
     * Возвращает путь к классу контроллеру.
     * @return mixed
     */
    public function getControllerPath()
    {
        return $this->controllerPath;
    }


    /**
     * Возвращает имя экшена.
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }


    /**
     * @return string
     */
    public function getActionNmae(): string
    {
        return $this->actionName;
    }


}