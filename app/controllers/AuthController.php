<?php

namespace app\controllers;

use app\facades\Auth;
use app\models\AuthModel;

/**
 * Контроллер входа адммина.
 * @package app\controllers
 */
class AuthController extends Controller
{
    /**
     * Вход.
     */
    public function loginAction(): void
    {
        if(isAuth()) {
            redirect('index');
        }

        if($this->request->isMethod('post')) {
            $model = new AuthModel();

            $login = $this->request->login ?? '';
            $password = $this->request->password ?? '';
            $user = $model->checkUser($login, $password);

            if(!empty($user)) {
                Auth::auth(true);
                redirect('index');
            }
        }

        $this->render('login');
    }


    /**
     * Выход.
     */
    public function logoutAction():void
    {
        Auth::auth(false);
        redirect('index');
    }
}