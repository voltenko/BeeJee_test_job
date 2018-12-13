<?php

namespace app\lib\http;

/**
 * Обертка сессии.
 * Class Session
 * @package app\lib\http
 */
class Session
{
    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
    }


    /**
     * Возвращает нужное значение по ключу.
     * @param string $name
     * @return string
     */
    public function __get(string $name): string
    {
        return $_SESSION[$name] ?? '';
    }


    /**
     * Устанавливает значение.
     * @param string $name
     * @param $value
     */
    public function __set(string $name, $value): void
    {
        $_SESSION[$name] = $value;
    }


    /**
     * Удаляет параметр.
     * @param string $name
     */
    public function unset(string $name): void
    {
        unset($_SESSION[$name]);
    }


    /**
     * Уничтожает сессию.
     */
    public function destroy()
    {
        session_destroy();
    }
}