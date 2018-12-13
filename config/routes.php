<?php

return [
    '/' => ['controller' => 'Task', 'action' => 'index', 'name' => 'index'],
    '/new_task' => ['controller' => 'Task', 'action' => 'newTask', 'name' => 'newTask'],
    '/edit_task' => ['controller' => 'Task', 'action' => 'editTask', 'name' => 'editTask'],
    '/delete_task' => ['controller' => 'Task', 'action' => 'deleteTask', 'name' => 'deleteTask'],
    '/login' => ['controller' => 'Auth', 'action' => 'login', 'name' => 'login'],
    '/logout' => ['controller' => 'Auth', 'action' => 'logout', 'name' => 'logout'],
];