<?php

namespace Users;

class Users
{

    public static function user_in_group_list($group_id, $is_empty = false)
    {
        $users = \Acl\Model_Profile::query()
                ->related('user')
                ->where('user.group_id', $group_id);
        if ($group_id == 3)
        {
            $users->order_by('pharmacy_common_name');
        }
        else
        {
            $users->order_by('last')
                    ->order_by('first');
        }
        $users = $users->get();
        $return = [];
        if ($users)
        {
            foreach ($users as $user)
            {
                if ($group_id == 3)
                {
                    $return[$user->user_id] = $user->pharmacy_common_name;
                }
                else
                {
                    $return[$user->user_id] = $user->last.' '.$user->first;
                }
            }
        }
        return $return;
    }

}
