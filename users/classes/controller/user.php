<?php

namespace Users;

class Controller_User extends \Helper\Dashboard
{

    public function action_create()
    {
        if (parent::is_access('users', 'user', 'create'))
        {
            $lang = \Lang::load('users::'.\Session::get('set_lang'));
            \Breadcrumb::set("مدیریت کاربران", \Uri::create('dashboard/users/index.html'), '2');
            \Breadcrumb::set('ایجاد کاربر', '', '3');
            if (parent::is_access('users', 'user', 'create') === true)
            {
                $data["address"]  = 'dashboard/users/user';
                $data["group_id"] = \Arr::pluck(\Acl\Model_Group::find("all"), "name", "id");
                $data['modules']  = \Acl\Model_Module::query()->where('is_active', 1)->order_by('order')->get();
                return \Theme::instance()
                                ->get_template()
                                ->set('title', 'ایجاد کاربر')
                                ->set('menu', array('users', 'user', 'create'))
                                ->set('content', \Theme::instance()->view('user/create', $data));
            }
        }
    }

    public function action_createa()
    {
        if (parent::is_access('users', 'user', 'create'))
        {
            $validate = \Myclasses\Validate::forge();
            $validate->add('username', \Input::get('username'), 'نام کاربری', array('req', 'min[6]', 'max[16]', 'uniq' => array('username', \Acl\Model_User::table())));
            $validate->add('email', \Input::get('email'), 'پست الکترونیک', array('req', 'email', 'uniq' => array('username', \Acl\Model_User::table())));
            $validate->add('password', \Input::get('password'), 'کلمه عبور', array('req', 'password'));
            $validate->add('first', \Input::get('first'), 'نام', array('req'));
            $validate->add('last', \Input::get('last'), 'نام خانوادگی', array('req'));
            if ($validate->isValid())
            {
                if (!\Acl\Model_User::is_duplicate(\Input::post('username'), \Input::post('email')))
                {
                    $user             = \Acl\Model_User::forge();
                    $user->username   = \Input::get('username');
                    $user->email      = \Input::get('email');
                    $user->password   = \Input::get('password');
                    $user->group_id   = \Input::get('group_id');
                    $user->is_locked  = \Input::get('is_locked');
                    $user->is_active  = \Input::get('is_active');
                    $user->is_confirm = \Input::get('is_confirm');
                    $user->unsuccess  = 0;
                    if ($user->save())
                    {
                        $profile             = \Acl\Model_Profile::forge();
                        $profile->user_id    = $user->id;
                        $profile->first      = \Input::get('first');
                        $profile->last       = \Input::get('last');
                        $profile->pic        = \Input::get('pic');
                        $profile->cell       = \Input::get('cell');
                        $profile->customs_id = \Input::get('customs_id');
                        if ($profile->save())
                        {
                            $group_field_save    = \DB::insert()
                                    ->table(\Acl\Model_Group_Field_Values::table())
                                    ->columns(array('user_id', 'field_id', 'value', 'created_at', 'created_by'));
                            $created_by          = \Acl\Acl::current_user_id();
                            $created_at          = \Myclasses\FNC::currentdbtime();
                            $is_group_field_save = false;
                            foreach (\Input::get() as $name => $value)
                            {
                                if (substr($name, 0, 4) == 'ufld' && $value)
                                {
                                    $field_type = \Acl\Model_Group_Field::find(\Myclasses\FNC::str2num($name));
                                    if ($field_type->type_id != 4)
                                    {
                                        $is_group_field_save = true;
                                        $group_field_save->values(array($user->id, \Myclasses\FNC::str2num($name), $value, $created_at, $created_by));
                                    }
                                }
                            }
                            if ($is_group_field_save)
                            {
                                if ($group_field_save->execute())
                                {
                                    $access_list = $this->newuseraccess(\Input::get('actions'));
                                    \Acl\Access::new_access($user->id, $access_list[0], $access_list[1], $access_list[2]);
                                    \Messages::success('کاربر با موفقیت ثبت شد');
                                }
                                else
                                {
                                    $user->delete();
                                    \Messages::error('فیلد های گروه کاربری ثبت نشد، مجدد اقلام کنید');
                                }
                            }
                            else
                            {
                                $access_list = $this->newuseraccess(\Input::get('actions'));
                                \Acl\Access::new_access($user->id, $access_list[0], $access_list[1], $access_list[2]);
                                \Messages::success('کاربر با موفقیت ثبت شد');
                            }
                        }
                        else
                        {
                            $user->delete();
                            \Messages::error('پروفایل کاربر ذخیره نشد');
                        }
                    }
                    else
                    {
                        \Messages::error('خطایی پیش آمده، با مدیر سیستم تماس بگیرید');
                    }
                }
                else
                {
                    \Messages::error('نام کاربری یا ایمیل تکراری است');
                }
            }
            else
            {
                echo $validate->getError(false);
            }
            \Response::redirect(\Uri::create('dashboard/users/user/create'));
        }
    }

    public function action_groupfields($group_id)
    {
        $fields = \Acl\Fields::create_user_field($group_id, 12);
        return $fields ? $fields.'<p>&nbsp;</p>' : '<p class="text-red">برای این گروه کاربری فیلدی تعریف نشده</p>';
    }

    private function newuseraccess($accesses)
    {
        $modules     = array();
        $controllers = array();
        $actions     = array();
        foreach ($accesses as $row)
        {
            $sep           = explode('-', $row);
            //$modules[$sep[0]][$sep[1]][] = $sep[2];
            $modules[]     = $sep[0];
            $controllers[] = $sep[1];
            $actions[]     = $sep[2];
        }
        return array(\Arr::unique($modules), \Arr::unique($controllers), $actions);
    }

    public function action_search()
    {
        if (parent::is_access('users', 'user', 'search'))
        {
            \Breadcrumb::set('مدیریت کاربران', \Uri::create('dashboard/users/index.html'), '2');
            \Breadcrumb::set('جستجوی کاربر', '', '3');
            $data["address"]  = 'dashboard/users/user';
            $data["group_id"] = \Arr::pluck(\Acl\Model_Group::find("all"), "name", "id", ['0', 'همه']);
            return \Theme::instance()
                            ->get_template()
                            ->set('title', 'جستجوی کاربر')
                            ->set('menu', array('users', 'user', 'search'))
                            ->set('content', \Theme::instance()->view('user/search', $data));
        }
    }

    public static function action_searchResult($page = 1)
    {
        if (parent::is_access('users', 'user', 'search'))
        {
            $count_query = \Acl\Model_User::query();
            $res_query   = \Acl\Model_User::query();
            if (\Input::get('group_id'))
            {
                $count_query->where('group_id', \Input::get('group_id'));
                $res_query->where('group_id', \Input::get('group_id'));
                if ($fieldsubquery = self::groupfieldsearch())
                {
                    $count_query->where('id', 'IN', $fieldsubquery->get_query(false));
                    $res_query->where('id', 'IN', $fieldsubquery->get_query(false));
                }
            }
            if (\Input::get('username'))
            {
                $count_query->where('username', \Input::get('username'));
                $res_query->where('username', \Input::get('username'));
            }
            if (\Input::get('email'))
            {
                $count_query->where('email', \Input::get('email'));
                $res_query->where('email', \Input::get('email'));
            }
            if (\Input::get('first'))
            {
                $profilefirtssubquery = \Acl\Model_Profile::query()
                        ->select('user_id')
                        ->where('first', 'LIKE', '%'.\Input::get('first').'%');
                $count_query->where('id', 'IN', $profilesubquery->get_query(false));
                $res_query->where('id', 'IN', $profilesubquery->get_query(false));
            }
            if (\Input::get('last'))
            {
                $profilefirtssubquery = \Acl\Model_Profile::query()
                        ->select('user_id')
                        ->where('last', 'LIKE', '%'.\Input::get('last').'%');
                $count_query->where('id', 'IN', $profilesubquery->get_query(false));
                $res_query->where('id', 'IN', $profilesubquery->get_query(false));
            }
            if (\Input::get('is_active') && \Input::get('is_active') != 2)
            {
                $count_query->where('is_active', \Input::get('is_active'));
                $res_query->where('is_active', \Input::get('is_active'));
            }
            if (\Input::get('is_locked') && \Input::get('is_locked') != 2)
            {
                $count_query->where('is_locked', \Input::get('is_locked'));
                $res_query->where('is_locked', \Input::get('is_locked'));
            }
            if (\Input::get('is_confirm') && \Input::get('is_confirm') != 2)
            {
                $count_query->where('is_confirm', \Input::get('is_confirm'));
                $res_query->where('is_confirm', \Input::get('is_confirm'));
            }
            $count      = $count_query->count();
            $config     = array(
                "pagination_url" => "",
                "total_items"    => $count,
                "per_page"       => 20,
                "uri_segment"    => 1,
                "show_first"     => true,
                "show_last"      => true,
                "current_page"   => $page
            );
            $pagination = \Pagination::forge("userSearch", $config);
            $res_query->rows_limit($pagination->per_page);
            $res_query->rows_offset($pagination->offset);
            $records    = $res_query->get();
            $pages      = $pagination->render(true);
            $return     = '<table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" width="50">ردیف</th>
                                <th class="text-center">نام و نام خانوادگی</th>
                                <th class="text-center">گروه کاربری</th>
                                <th class="text-center">وضعیت تایید</th>
                                <th class="text-center">وضعیت ورود</th>
                                <th class="text-center">ویرایش</th>
                                <th class="text-center">حذف</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>';
            //echo \DB::last_query();
            if ($records)
            {
                $counter = $pagination->offset + 1;
                foreach ($records as $user)
                {
                    $return .= '
                        <tr>
                            <td>'.\Myclasses\FNC::pen($counter++).'</td>
                            <td>'.$user->profile->first.' '.$user->profile->last.'</td>
                            <td class="text-center">'.$user->group->name.'</td>
                            <td class="text-center">'.($user->is_confirm ? 'تایید شده' : 'تایید نشده').'</td>
                            <td class="text-center">'.($user->unsuccess > 12 ? 'عدم ورود' : 'ورود').'</td>
                            <td class="text-center"><span class="btn btn-flat btn-danger btn-xs" onclick="deleteUser('.$user->id.')">حذف</span></td>
                            <td class="text-center"><a class="btn btn-flat btn-warning btn-xs" href="'.\Uri::create('dashboard/users/user/edit/'.$user->id).'" target="_bllank">ویرایش</a></td>
                            <td class="text-center"><span class="btn btn-flat btn-primary btn-xs" onclick="actionUser('.$user->id.')">عملیات</span></td>
                        </tr>
                ';
                }
            }
            else
            {
                $return .= '<tr class="text-center"><td colspan="7">جستجوی شما نتیجه ای نداشت</td></tr>';
            }
            $return .= "<tbody></table>";
            if ($count > 20)
            {
                $return .= '<div class="text-center">'.\Myclasses\FNC::ajaxPaginationLink($pages, "goTopage").'</div><input type="hidden" value="'.$page.'" id="currentPage">';
            }
            return $return;
        }
    }

    protected static function groupfieldsearch()
    {
        $subquery = \Acl\Model_Group_Field_Values::query()->select('user_id');
        $is_have  = false;
        foreach (\Input::get() as $name => $value)
        {
            if (substr($name, 0, 4) == 'ufld' && $value)
            {
                $is_have = true;
                // find field
                $subquery->or_where_open()
                        ->where('field_id', \Myclasses\FNC::str2num($name))
                        ->where('value', 'LIKE', '%'.$value.'%')
                        ->or_where_close();
            }
        }
        $subquery->group_by('user_id');
        return $is_have ? $subquery : false;
    }

    public function action_edit($user_id)
    {
        if (parent::is_access('users', 'user', 'edit'))
        {
            \Breadcrumb::set('مدیریت کاربران', \Uri::create('dashboard/users/index.html'), '2');
            \Breadcrumb::set('ویرایش کاربر', '', '3');
            $data["address"]  = 'dashboard/users/user';
            $data["group_id"] = \Arr::pluck(\Acl\Model_Group::find("all"), "name", "id");
            $data['modules']  = \Acl\Model_Module::query()
                    ->where('is_active', 1)
                    ->order_by('order')
                    ->get();
            $data['user']     = \Acl\Model_User::find($user_id);
            $useractionlist   = \Acl\Model_Access_Action::query()
                    ->where('user_id', $user_id)
                    ->order_by('action_id')
                    ->get();
            if ($useractionlist)
            {
                foreach ($useractionlist as $al)
                {
                    $data['access_actions'][] = $al->action_id;
                }
            }
            return \Theme::instance()
                            ->get_template()
                            ->set('title', 'ویرایش کاربر')
                            ->set('menu', array('users', 'user', 'search'))
                            ->set('content', \Theme::instance()->view('user/edit', $data));
        }
    }

    public function action_usereditfields($user_id)
    {
        if (parent::is_access('users', 'user', 'edit'))
        {
            return \Acl\Fields::user_edit_fields($user_id);
        }
    }

    public function action_update($user_id)
    {
        if (parent::is_access('users', 'user', 'edit'))
        {
            $validate = \Myclasses\Validate::forge();
            $validate->add('username', \Input::get('username'), 'نام کاربری', array('req', 'min[6]', 'max[16]'));
            $validate->add('email', \Input::get('email'), 'پست الکترونیک', array('req', 'email'));
            $validate->add('first', \Input::get('first'), 'نام', array('req'));
            $validate->add('last', \Input::get('last'), 'نام خانوادگی', array('req'));
            if ($validate->isValid())
            {
                if (!\Acl\Model_User::is_duplicate(\Input::post('username'), \Input::post('email'), $user_id))
                {
                    $user           = \Acl\Model_User::find($user_id);
                    $user->username = \Input::get('username');
                    $user->email    = \Input::get('email');
                    if (\Input::get('password'))
                    {
                        $user->password = \Input::get('password');
                    }
                    $user->group_id   = \Input::get('group_id');
                    $user->is_locked  = \Input::get('is_locked');
                    $user->is_active  = \Input::get('is_active');
                    $user->is_confirm = \Input::get('is_confirm');
                    if ($user->save())
                    {
                        $profile             = \Acl\Model_Profile::find_by_user_id($user_id);
                        $profile->first      = \Input::get('first');
                        $profile->last       = \Input::get('last');
                        $profile->customs_id = \Input::get('customs_id');
                        if ($profile->save())
                        {
                            // delete old field 
                            \Acl\Model_Group_Field_Values::query()->where('user_id', $user_id)->delete();
                            $group_field_save    = \DB::insert()
                                    ->table(\Acl\Model_Group_Field_Values::table())
                                    ->columns(array('user_id', 'field_id', 'value', 'created_at', 'created_by'));
                            $created_by          = \Acl\Acl::current_user_id();
                            $created_at          = \Myclasses\FNC::currentdbtime();
                            $is_group_field_save = false;
                            foreach (\Input::get() as $name => $value)
                            {
                                if (substr($name, 0, 4) == 'ufld' && $value)
                                {
                                    $field_type = \Acl\Model_Group_Field::find(\Myclasses\FNC::str2num($name));
                                    if ($field_type->type_id != 4)
                                    {
                                        $is_group_field_save = true;
                                        $group_field_save->values(array($user->id, \Myclasses\FNC::str2num($name), $value, $created_at, $created_by));
                                    }
                                }
                            }
                            if ($is_group_field_save)
                            {
                                if ($group_field_save->execute())
                                {
                                    \Acl\Access::del_access($user->id);
                                    $access_list = $this->newuseraccess(\Input::get('actions'));
                                    \Acl\Access::new_access($user->id, $access_list[0], $access_list[1], $access_list[2]);
                                    \Messages::success('کاربر با موفقیت ویرایش شد');
                                }
                                else
                                {
                                    $user->delete();
                                    \Messages::error('فیلد های گروه کاربری ثبت نشد، مجدد اقلام کنید');
                                }
                            }
                            else
                            {
                                \Acl\Access::del_access($user->id);
                                $access_list = $this->newuseraccess(\Input::get('actions'));
                                \Acl\Access::new_access($user->id, $access_list[0], $access_list[1], $access_list[2]);
                                \Messages::success('کاربر با موفقیت ثبت شد');
                            }
                        }
                        else
                        {
                            $user->delete();
                            \Messages::error('پروفایل کاربر ذخیره نشد');
                        }
                    }
                    else
                    {
                        \Messages::error('خطایی پیش آمده، با مدیر سیستم تماس بگیرید');
                    }
                }
                else
                {
                    \Messages::error('نام کاربری یا ایمیل تکراری است');
                }
            }
            else
            {
                echo $validate->getError(false);
            }
            \Response::redirect(\Uri::create('dashboard/users/user/edit/'.$user_id));
        }
    }

}
