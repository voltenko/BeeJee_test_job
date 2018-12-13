<?php

namespace app\kernel;

/**
 * @package app\kernel
 */
class Render
{
    /**
     * Отображает нужное представление, передает ему данные.
     * @param string $view
     * @param array $data
     */
    public function view(string $view, array $data = [])
    {
        require_once "{$_SERVER['DOCUMENT_ROOT']}/public/views/{$view}.php";
    }
}