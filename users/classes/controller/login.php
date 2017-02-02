<?php

namespace Users;

class Controller_Login extends \Controller
{

    public function action_index()
    {
        if (!\Acl\Acl::is_login())
        {
            \Lang::load('login');
            $data['btn_direction'] = \Session::get('set_lang') == 'en' ? 'right' : 'left';
            return \View::forge('login/login', $data);
        }
        else
        {
            return \Response::redirect(\Uri::create('dashboard'));
        }
    }

    public function action_loginproccess()
    {
        $login = \Acl\Acl::login(\Input::get('username'), \Input::get('password'), \Input::get('remember'));
        if ($login === 'password')
        {
            echo 'کلمه عبور شما اشتباه است';
        }
        if ($login === 'locked')
        {
            echo 'حساب شما مسدود است';
        }
        if ($login === 'not_active')
        {
            echo 'حساب شما فعال نشده است';
        }
        if ($login === 'not_confirm')
        {
            echo 'حساب شما هنوز تایید نشده است';
        }
        if ($login === 'username')
        {
            echo 'نام کاربری شما اشتباه است';
        }
        if ($login === 'ok')
        {
            echo 'ok';
        }
    }

    public function action_logout()
    {
        \Acl\Acl::logout();
        \Response::redirect('');
    }

}
