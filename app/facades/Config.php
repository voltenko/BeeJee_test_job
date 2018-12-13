<?php

namespace app\facades;

/**
 * Доступ к конфигурации.
 * @package app\facades
 */
class Config
{
    private static $config;

    /**
     * Иницифлизация.
     * @param array $config
     */
    public static function setConfig(array $config): void
    {
        self::$config = $config;
    }


    /**
     * Получаем знаыение настройки по ее имени.
     * @param string $configName
     * @return string
     */
    public static function get(string $configName): string
    {
        return self::$config[$configName] ?? '';
    }
}