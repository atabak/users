<?php

namespace Users;

class Controller_Profile extends \Helper\Front
{

    public function before()
    {
        parent::before();
        if (!\Acl\Acl::is_login())
        {
            \Response::redirect('login.html');
        }
    }

    public function action_index()
    {
        \Breadcrumb::set('خانه', \Uri::create('index.html'), '1');
        \Breadcrumb::set('پروفایل کاربری', '', '2');
        \Lang::load('profile');
        $data['user']      = \Acl\Acl::current_user();
        $data['side_menu'] = \View::forge('profile/menu', ['side_active_menu' => 'profile']);
        return \Theme::instance()
                        ->get_template()
                        ->set('title', \Lang::get('profile_page_title'))
                        ->set('activeMenu', 'profile')
                        ->set('content', \Theme::instance()->view('profile/profile', $data, false));
    }

    public function action_settings()
    {
        \Breadcrumb::set('خانه', \Uri::create('index.html'), '1');
        \Breadcrumb::set('پروفایل کاربری', '', '2');
        \Breadcrumb::set('تنظیمات', '', 3);
        \Lang::load('profile');
        $data['user']      = \Acl\Acl::current_user();
        $data['side_menu'] = \View::forge('profile/menu', ['side_active_menu' => 'settings']);
        return \Theme::instance()
                        ->get_template()
                        ->set('title', \Lang::get('profile_settings_page_title'))
                        ->set('content', \Theme::instance()->view('profile/settings', $data, false));
    }

    public function action_photos()
    {
        \Breadcrumb::set('خانه', \Uri::create('index.html'), '1');
        \Breadcrumb::set('پروفایل کاربری', '', '2');
        \Breadcrumb::set('تصاویر من', '', 3);
        \Lang::load('profile');
        $data['user']      = \Acl\Acl::current_user();
        $data['side_menu'] = \View::forge('profile/menu', ['side_active_menu' => 'photos']);
        return \Theme::instance()
                        ->get_template()
                        ->set('title', \Lang::get('profile_photos_page_title'))
                        ->set('content', \Theme::instance()->view('profile/photos', $data, false));
    }

    public function action_booking()
    {
        \Breadcrumb::set('خانه', \Uri::create('index.html'), '1');
        \Breadcrumb::set('پروفایل کاربری', '', '2');
        \Breadcrumb::set('سوابق', '', 3);
        \Lang::load('profile');
        $data['user']      = \Acl\Acl::current_user();
        $data['side_menu'] = \View::forge('profile/menu', ['side_active_menu' => 'booking']);
        return \Theme::instance()
                        ->get_template()
                        ->set('title', \Lang::get('profile_booking_page_title'))
                        ->set('content', \Theme::instance()->view('profile/booking', $data, false));
    }

    public function action_cards()
    {
        \Breadcrumb::set('خانه', \Uri::create('index.html'), '1');
        \Breadcrumb::set('پروفایل کاربری', '', '2');
        \Breadcrumb::set('حساب ها', '', 3);
        \Lang::load('profile');
        $data['user']      = \Acl\Acl::current_user();
        $data['side_menu'] = \View::forge('profile/menu', ['side_active_menu' => 'cards']);
        return \Theme::instance()
                        ->get_template()
                        ->set('title', \Lang::get('profile_cards_page_title'))
                        ->set('content', \Theme::instance()->view('profile/cards', $data, false));
    }

    public function action_wishlist()
    {
        \Breadcrumb::set('خانه', \Uri::create('index.html'), '1');
        \Breadcrumb::set('پروفایل کاربری', '', '2');
        \Breadcrumb::set('علاقه مندی ها', '', 3);
        \Lang::load('profile');
        $data['user']      = \Acl\Acl::current_user();
        $data['side_menu'] = \View::forge('profile/menu', ['side_active_menu' => 'wishlist']);
        return \Theme::instance()
                        ->get_template()
                        ->set('title', \Lang::get('profile_wishlist_page_title'))
                        ->set('content', \Theme::instance()->view('profile/wishlist', $data, false));
    }

}
