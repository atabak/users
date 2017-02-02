<?php

namespace Users;

class Controller_Ajax extends \Controller
{

    public function action_test()
    {
        $select_subquery = \DB::select(\DB::expr('count(id)'))->from(\Acl\Model_Group::table())->where('id', \DB::expr('u.group_id'));
        $main_query = \DB::select('u.id', 'u.username', [$select_subquery, 'cnt'])
                ->from([\Acl\Model_User::table(), 'u'])
                ->execute();
        echo \DB::last_query().'<br>';
        /*
        $subquery = \DB::select()->from(\Acl\Model_Group::table());
        $query    = \DB::select('id', 'name', [\DB::select(['count(id)', 'cnt'])->from(\Acl\Model_Group::table())->where('id', 'u.group_id'), 'cnt'])
                ->from([\Acl\Model_User::table(), 'u'])
                ->join([$subquery, 'g'], 'left')
                ->on('g.id', '=', 'u.group_id')
                ->execute();
        /*
        
        $a        = \DB::select()
                ->from([\Acl\Model_User::table(), 'u'])
                ->join([\DB::expr('SELECT * FROM acl_users_groups'), 'g'], 'left')
                ->on('g.id', '=', 'u.group_id')
                ->execute();
        echo \DB::last_query();*/
    }

    public function action_creategroupfields($group_id)
    {
        $return = '';
        if ($group_id == 5)
        {
            $return .= Fields::create_doc_fields(6);
        }
        if ($group_id == 3)
        {
            $return .= Fields::create_pharmacy_fields(6);
        }
        return $return;
    }

    public function action_pharmacyFields($user_id = null)
    {
        
    }

    public function action_unconfirmuserslist($page = 1)
    {
        $count = \Acl\Model_User::query()->where('is_confirm', '!=', true)->count();
        if ($count)
        {
            $config     = [
                "pagination_url" => "",
                "total_items"    => $count,
                "per_page"       => 10,
                "uri_segment"    => 1,
                "show_first"     => true,
                "show_last"      => true,
                "current_page"   => $page
            ];
            $pagination = \Pagination::forge("unconfirmuser_pagination", $config);
            $result     = \Acl\Model_User::query()
                    ->where('is_confirm', '!=', true);
            $result->rows_limit($pagination->per_page);
            $result->rows_offset($pagination->offset);
            $users      = $result->get();
            $pages      = $pagination->render(true);
            $list       = [];
            foreach ($users as $user)
            {
                $list[$user->id] = [$user->profile->first.' '.$user->profile->last, \Myclasses\FNC::int_to_persian($user->info->created_at), '<span class="btn btn-success btn-xs btn-flat" onclick="confirm_user('.$user->id.')">تایید</span>'];
            }
            $response = new \Response();
            $response->set_header('Content-Type', 'application/json');
            $response->body(\Format::forge()->to_json([$list, '<div class="text-center">'.\Myclasses\FNC::ajaxPaginationLink($pages, "goTopage").'</div><input type="hidden" value="'.$page.'" id="currentPage">']));
            return $response;
        }
        else
        {
            $response = new \Response();
            $response->set_header('Content-Type', 'application/json');
            $response->body(\Format::forge()->to_json(['<p class="text-center">تمام کاربران تایید شده اند</p>', 'no']));
            return $response;
        }
    }

    public function action_confirmuser($user_id)
    {
        $user             = \Acl\Model_User::find($user_id);
        $user->is_confirm = 1;
        $user->save();
        $info             = \Acl\Model_Info::find_by_user_id($user_id);
        $info->confirm_by = \Acl\Acl::current_user_id();
        $info->confirm_at = \Myclasses\FNC::currentdbtime();
        $info->save();
    }

    public function action_blockedrslist($page = 1)
    {
        $count = \Acl\Model_User::query()->where('is_block', true)->count();
        if ($count)
        {
            $config     = [
                "pagination_url" => "",
                "total_items"    => $count,
                "per_page"       => 10,
                "uri_segment"    => 1,
                "show_first"     => true,
                "show_last"      => true,
                "current_page"   => $page
            ];
            $pagination = \Pagination::forge("unconfirmuser_pagination", $config);
            $result     = \Acl\Model_User::query()
                    ->where('is_confirm', '!=', true);
            $result->rows_limit($pagination->per_page);
            $result->rows_offset($pagination->offset);
            $users      = $result->get();
            $pages      = $pagination->render(true);
            $list       = [];
            foreach ($users as $user)
            {
                $list[$user->id] = [$user->profile->first.' '.$user->profile->last, \Myclasses\FNC::int_to_persian($user->info->created_at), '<span class="btn btn-success btn-xs btn-flat" onclick="unblocked_user('.$user->id.')">باز کردن</span>'];
            }
            $response = new \Response();
            $response->set_header('Content-Type', 'application/json');
            $response->body(\Format::forge()->to_json([$list, '<div class="text-center">'.\Myclasses\FNC::ajaxPaginationLink($pages, "goTopage").'</div><input type="hidden" value="'.$page.'" id="currentPage">']));
            return $response;
        }
        else
        {
            $response = new \Response();
            $response->set_header('Content-Type', 'application/json');
            $response->body(\Format::forge()->to_json(['<p class="text-center">تمامی حساب های کاربری باز است</p>', 'no']));
            return $response;
        }
    }

    public function action_searchuser($page = 1)
    {
        // first, last, mc, address, cell , phone, code, email, username
        $users_count = \Acl\Model_User::query()
                ->where('group_id', \Input::post('group_id'));
        $result      = \Acl\Model_User::query()
                ->where('group_id', \Input::post('group_id'));
        if (\Input::post('search'))
        {
            $users_count->and_where_open()->or_where('username', 'LIKE', \Input::post('search')."%")->or_where('email', 'LIKE', \Input::post('search')."%");
            $result->and_where_open()->or_where('username', 'LIKE', \Input::post('search')."%")->or_where('email', 'LIKE', \Input::post('search')."%");
            $subQuery = \Acl\Model_Profile::query()
                    ->select('user_id')
                    ->or_where('first', 'LIKE', \Input::post('search')."%")
                    ->or_where('last', 'LIKE', \Input::post('search')."%")
                    ->or_where('mc', 'LIKE', \Input::post('search')."%")
                    ->or_where('code', 'LIKE', \Input::post('search')."%")
                    ->or_where('phone', 'LIKE', \Input::post('search')."%")
                    ->or_where('cell', 'LIKE', \Input::post('search')."%")
                    ->or_where('address', 'LIKE', \Input::post('search')."%");
            $users_count->or_where('id', 'IN', $subQuery->get_query(true))->and_where_close();
            $result->or_where('id', 'IN', $subQuery->get_query(true))->and_where_close();
        }
        $count      = $users_count->count();
        $config     = ["pagination_url" => "", "total_items" => $count, "per_page" => 20, "uri_segment" => 1, "show_first" => true, "show_last" => true, "current_page" => $page];
        $pagination = \Pagination::forge("unconfirmuser_pagination", $config);
        $result->rows_limit($pagination->per_page);
        $result->rows_offset($pagination->offset);
        $users      = $result->get();
        $pages      = $pagination->render(true);
        $return     = [];
        if ($users)
        {
            $counter = $pagination->offset + 1;
            foreach ($users as $user)
            {
                $return[$user->id] = [\Myclasses\FNC::pen($counter++), $user->profile->first, $user->profile->last, $user->group->name, '<a href="'.\Uri::create('dashboard/users/user/edit/'.$user->id).'" class="btn btn-block btn-success btn-flat btn-xs">ویرایش</a>'];
            }
        }
        $response = new \Response();
        $response->set_header('Content-Type', 'application/json');
        $response->body(\Format::forge()->to_json([$return, '<div class="text-center">'.\Myclasses\FNC::ajaxPaginationLink($pages, "goTopage").'</div><input type="hidden" value="'.$page.'" id="currentPage">']));
        return $response;
    }

    public function action_docspeacialities($group_id)
    {
        return \Form::select('doc_speaciality_id', null, \Arr::pluck(\Acl\Model_Doc_Speaciality::query()->where('type_id', $group_id)->order_by('name')->get(), 'name', 'id'), array('class' => 'form-control'));
    }

}
