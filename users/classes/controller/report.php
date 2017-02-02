<?php

namespace Users;

class Controller_Report extends \Helper\Dashboard
{

    public function action_index()
    {
        \Breadcrumb::set('مدیریت کاربران', '', 2);
        \Breadcrumb::set('گزارشات کاربران', '', 3);
        $data['total_user']     = \Acl\Model_User::count();
        $data['user_in_groups'] = \DB::select(array('t0.name', 'name'), array(\DB::expr("(select count(id) from ".\Acl\Model_User::table()." where group_id = t0.id)"), 'num'))->from(array(\Acl\Model_Group::table(), 't0'))->as_object()->execute();
        $groups                 = \Acl\Model_Group::find('all');
        $data['group_id']['0']              = 'همه گروه ها';
        foreach ($groups as $group)
        {
            $data['group_id'][$group->id] = $group->name;
        }
        return \Theme::instance()
                        ->get_template()
                        ->set('title', 'گزارشات کاربران')
                        ->set('menu', array('users', 'user', 'index'))
                        ->set('content', \Theme::instance()->view('user/report', $data));
    }

}
