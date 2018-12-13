<?php

use app\facades\Config;
use app\facades\Route;
use app\facades\Auth;

function config(string $configName): string
{
    return Config::get($configName);
}


function uri(string $routeName): string
{
    return Route::getUri($routeName);
}


function url(string $routeName): string
{
    return Route::getUrl($routeName);
}


function currentRoute(): string
{
    return Route::getCurrentRoute();
}


function redirect($routeName): void
{
    Route::redirect($routeName);
}


function isAuth(): bool
{
    return Auth::check();
}