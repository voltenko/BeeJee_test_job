<?php

namespace app\models;

use app\exceptions\ModelException;
use app\lib\db\DB;
use app\lib\http\UploadFile;

/**
 * Class TaskModel
 * @package app\models
 */
class TaskModel extends Model
{
    /**
     * Получаем задачу из БД.
     * @param int $id
     * @return array
     * @throws ModelException
     */
    public function getTaskById(int $id): array
    {
        $db = new DB();

        $sql = "SELECT * FROM `tasks` WHERE `id` = :id";
        $result = $db->row($sql, ['id' => $id]);

        if(!$result) {
            throw new ModelException(\Constants::ROW_NOT_FOUND, 501);
        }

        return $result[0];
    }


    /**
     * Обновляем задачу.
     * @param int $id
     * @param string $text
     * @param bool $status
     */
    public function updateTask(int $id, string $text, bool $status): void
    {
        $db = new DB();

        $status = $status ? 1 : 0;
        $sql = "UPDATE `tasks` SET `text` = :text, `status` = $status WHERE `id` = :id";
        $db->query($sql, ['id' => $id, 'text' => $text]);
    }


    /**
     * Получаем список задач с пагинацией.
     * @param string $sort
     * @param int $currentPageNum
     * @param int $perPage
     * @return array
     */
    public function getTasksPagination(string $sort, int $currentPageNum = 0, $perPage = 3): array
    {
        switch ($sort) {
            case 'name':
                $order = 'user_name';
                break;
            case 'email':
                $order = 'user_email';
                break;
            case 'status':
                $order = 'status';
                break;
            default:
                $order = 'id';
        }

        $db = new DB();

        $sql = "SELECT count(*) FROM tasks";
        $tasksCount = $db->col($sql);
        $pagesCount = ceil($tasksCount / $perPage);

        $offset = abs($currentPageNum * $perPage);
        $sql = "SELECT * FROM `tasks` ORDER BY $order LIMIT $offset, $perPage";

        return ['tasks' => $db->row($sql), 'pagesCount' => $pagesCount];
    }


    /**
     * Добавляем задачу.
     * @param string $userName
     * @param string $userEmail
     * @param string $taskText
     * @param UploadFile $img
     * @throws \Exception
     */
    public function add(string $userName, string $userEmail, string $taskText, UploadFile $img): void
    {
        if($img->getName()) {
            $img->upload();
        }

        $db = new DB();

        $sql = 'INSERT INTO `tasks` 
                (`user_name`, `user_email`, `text`, `img`) 
                VALUES 
                (:name, :email, :text, :img)';

        $db->query($sql, [
            'name'  => $userName,
            'email' => $userEmail,
            'text'  => $taskText,
            'img'   => $img->getName()? $img->getName() : ''
        ]);

    }


    /**
     * Удаляем задачу.
     * @param int $id
     */
    public function deleteTask(int $id): void
    {
        $db = new DB();

        $sql = "DELETE FROM `tasks` WHERE `id` = :id";
        $db->query($sql, ['id' => $id]);
    }
}