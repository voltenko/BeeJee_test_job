<?php

namespace app\controllers;

use app\models\TaskModel;

/**
 * Контроллер задач.
 * @package app\controllers
 */
class TaskController extends Controller
{
    /**
     * Вывод главной страницы со списком задач.
     */
    public function indexAction(): void
    {
        $order = $this->request->order ?? '';
        $currentPageNum = (int) $this->request->num ?? 0;

        $taskModel = new TaskModel();
        $data = $taskModel->getTasksPagination($order, $currentPageNum);

        $this->render('index', [
            'taskList'       => $data['tasks'],
            'pagesCount'     => $data['pagesCount'],
            'currentPageNum' => $currentPageNum,
            'order'          => $order
        ]);
    }


    /**
     * Создание новой задачи.
     * @throws \app\exceptions\ValidateException
     */
    public function newTaskAction(): void
    {
        if($this->request->isMethod('post')) {
            $userName  = (string) trim($this->request->user_name);
            $userEmail = (string) trim($this->request->user_email);
            $taskText  = (string) trim($this->request->task_text);

            $this->validator->newTaskValidate($userName, $userEmail, $taskText);

            $img = $this->request->getUploadFiles('task_img');

            $taskModel = new TaskModel();
            $taskModel->add(
                $userName,
                $userEmail,
                $taskText,
                $img
            );

            redirect('index');
        }
        $this->render('newTask');
    }


    /**
     * Редактирование задачи.
     *
     * @throws \app\exceptions\ModelException
     * @throws \app\exceptions\ValidateException
     */
    public function editTaskAction(): void
    {
        if(!isAuth()) {
            redirect('index');
        }

        $taskId = (int) $this->request->id;

        $taskModel = new TaskModel();
        if($this->request->isMethod('post')) {
            $taskText = (string) trim($this->request->task_text);
            $this->validator->taskTextValidate($taskText);

            $status = (bool) $this->request->status;
            $taskModel->updateTask($taskId, $taskText, $status);

            redirect('index');
        }

        $task = $taskModel->getTaskById($taskId);

        if(empty($task)) {
            redirect('index');
        }

        $this->render('editTask', ['task' => $task]);
    }


    /**
     * Удаление задачи
     */
    public function deleteTaskAction(): void
    {
        if(!isAuth()) {
            redirect('index');
        }

        $taskId = (int) $this->request->id;

        $taskModel = new TaskModel();
        $taskModel->deleteTask($taskId);

        redirect('index');
    }
}