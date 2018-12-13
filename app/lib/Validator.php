<?php

namespace app\lib;

use app\exceptions\ValidateException;

/**
 * Валидатор форм. Валидация и красивый вывод реализован на JS,
 * Со стороны сервера выводим только общую ошибку, на случай попытки обхода JS валидатора.
 * @package app\lib
 */
class Validator
{
    /**
     * Проверяем поля задачи.
     * @param string $name
     * @param string $email
     * @param string $text
     * @throws ValidateException
     */
    public function newTaskValidate(string $name, string $email, string $text): void
    {
        if(!$name || strlen($name) > 10) {
            throw new ValidateException(\Constants::INVALID_NAME);
        }

        if(!$email || strlen($email) > 20) {
            throw new ValidateException(\Constants::INVALID_EMAIL);
        }

        $this->taskTextValidate($text);
    }


    /**
     * Проверяем текст задачи.
     * @param string $text
     * @throws ValidateException
     */
    public function taskTextValidate(string $text): void
    {
        if(!$text) {
            throw new ValidateException(\Constants::INVALID_TEXT);
        }
    }
}