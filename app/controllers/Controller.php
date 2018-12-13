<?php

namespace app\controllers;

use app\kernel\Render;
use app\lib\http\Request;
use app\models\Model;
use app\lib\Validator;

/**
 * Базовый контроллер
 * @package app\controllers
 */
class Controller
{
    protected $render;
    protected $request;
    protected $model;
    protected $validator;

    /**
     * Controller constructor.
     * @param Request $request
     * @param Render $render
     */
    public function __construct(Request $request, Render $render)
    {
        $this->render = $render;
        $this->request = $request;
        $this->validator = new Validator();
    }


    /**
     * Выводит страницу ошибок.
     * @param string $errorText
     * @param int|null $code
     */
    public function errorAction(string $errorText = '', int $code = null):void
    {
        $this->render('error', ['errorText' => $errorText, 'errorCode' => $code]);
    }


    /**
     * Отображает нужное представление.
     * @param string $view
     * @param array $data
     */
    protected function render(string $view, array $data = []): void
    {
        $this->render->view($view, $data);
    }
}