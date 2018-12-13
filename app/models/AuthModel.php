<?php

namespace app\models;

use app\lib\db\DB;

/**
 * Class AuthModel
 * @package app\models
 */
class AuthModel extends Model
{
    /**
     * Получаем данные админа.
     * @param string $login
     * @param string $password
     * @return array
     */
    public function checkUser(string $login, string $password): array
    {
        $db = new DB();

        $password = md5($password);
        $sql = "SELECT * FROM `users` WHERE  `name` = :login AND `password` = :password";
        $user = $db->row($sql, ['login' => $login, 'password' => $password]);
        return $user;
    }
}