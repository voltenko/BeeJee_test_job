<?php

namespace app\facades;

use app\lib\http\Request;

/**
 * Доступ ко всему, что касается авторизации.
 * Class Auth
 * @package app\facades
 */
class Auth
{
    private static $request;

    /**
     * Инициализация.
     * @param Request $request
     */
    public static function init(Request $request): void
    {
        self::$request = $request;
    }


    /**
     * Провкряет вошёл ли админ.
     * @return bool
     */
    public static function check(): bool
    {
        return (bool) self::$request->session('auth');
    }


    /**
     * Если передаем true, то авторизуем админа, false - разлогиниваем.
     * @param bool $auth
     */
    public static function auth(bool $auth)
    {
        if($auth) {
            self::$request->session('auth', true);
        } else {
            self::$request->session()->unset('auth');
            self::$request->session()->destroy();
        }
    }
}