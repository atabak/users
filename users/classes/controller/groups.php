<?php

namespace Users;

class Controller_Groups extends \Helper\Dashboard
{

    protected $lang;

    public function before()
    {
        $this->lang = \Lang::load('users');
        parent::before();
    }

    public function action_index()
    {
        \Breadcrumb::set('مدیریت کاربران', '', 2);
        \Breadcrumb::set('گروه های کاربری', '', 3);
        \Breadcrumb::set('مدیریت گروه ها', '', 4);
        $data ["address"]   = 'dashboard/users/groups';
        $data['group_lang'] = 'k';
        return \Theme::instance()
                        ->get_template()
                        ->set('title', 'مدیریت گروه ها')
                        ->set('menu', array('users', 'groups', 'index'))
                        ->set('content', \Theme::instance()->view('groups', $data));
    }

    public function action_search($page = 1)
    {
        $count_search = \Acl\Model_Group::query()->related('users');
        $result       = \Acl\Model_Group::query()->related('users');
        if (\Input::post("search"))
        {
            $count_search->or_where("name", "LIKE", "%".\Input::post("search")."%");
            $result->or_where("name", "LIKE", "%".\Input::post("search")."%");
        }
        $count      = $count_search->count();
        $config     = array("pagination_url" => "", "total_items" => $count, "per_page" => 20, "uri_segment" => 1, "show_first" => true, "show_last" => true, "current_page" => $page);
        $pagination = \Pagination::forge("Model_Groups_pagination", $config);
        $result->rows_limit($pagination->per_page);
        $result->rows_offset($pagination->offset);
        $records    = $result->get();
        $pages      = $pagination->render(true);
        $return     = '<table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" width="50">ردیف</th>
                                <th class="text-center">نام گروه</th>
                                <th class="text-center">تعداد کاربر</th>
                                <th class="text-center">تعداد فیلد</th>
                                <th class="text-center">مدیریت</th>
                            </tr>
                        </thead>
                        <tbody>';
        $counter    = $pagination->offset + 1;
        if ($records)
        {
            foreach ($records as $record)
            {
                $return .= '    <tr>
                                    <td>'.\Myclasses\FNC::pen($counter++).'</td>
                                    <td class="text-center">'.$record->name.'</td>
                                    <td>'.\Myclasses\FNC::pen(count($record->users)).'</td>
                                    <td>'.\Myclasses\FNC::pen(count($record->fields)).'</td>
                                    <td class="text-center" width="160">
                                        <span class="btn btn-xs btn-success btn-flat" onclick="editRec('.$record->id.')">ویرایش</span>
                                        <span class="btn btn-xs btn-danger btn-flat" onclick="cdec('.$record->id.')">حذف</span>
                                    </td>
                                </tr>';
            }
        }
        else
        {
            $return .= '        <tr class="text-center"><td colspan="8">'.$this->lang['no_result'].'</td></tr>';
        }
        $return .= "    <tbody>
                    </table>";
        if ($count > 20)
        {
            $return .= '<div class="text-center">'.\Myclasses\FNC::ajaxPaginationLink($pages, "goTopage").'</div><input type="hidden" value="'.$page.'" id="currentPage">';
        }
        echo $return;
    }

    public function action_create()
    {
        $validate = \Myclasses\Validate::forge();
        $validate->add('name', \Input::post('name'), 'نام گروه', array('req', 'uniq' => array('name', \Acl\Model_Group::table())));
        if ($validate->isValid())
        {
            $entry       = \Acl\Model_Group::forge();
            $entry->name = \Input::post('name');
            return $entry->save() ? 'ok' : 'no';
        }
        else
        {
            return $validate->getError(false);
        }
    }

    public function action_edit($id)
    {
        $edit   = \Acl\Model_Group::find($id);
        $return = '<form id="editForm" class="col-md-12">
                    <div class="col-md-8">
                        <div class="control-group">
                            '.\Form::label("نام گروه", "name", array("class" => "control-label")).'
                            <div class="controls">
                                '.\Form::input("name", $edit->name, array("class" => "form-control")).'
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="control-group" >'.\Form::label("&nbsp;", "btn", array("class" => "control-label")).'
                            <div class="controls">
                                <span class="btn btn-primary btn-block btn-flat" onclick="updateRec('.$edit->id.')">ویرایش</span>
                            </div>
                        </div>
                    </div>
                </form>';
        return $return;
    }

    public function action_update($id)
    {
        $validate = \Myclasses\Validate::forge();
        $validate->add("name", \Input::post("name"), "نام گروه", array('req', 'uniq' => array('name', \Acl\Model_Group::table(), array('id', $id))));
        if ($validate->isValid())
        {
            $entry       = \Acl\Model_Group::find($id);
            $entry->name = \Input::post('name');
            return $entry->save() ? 'ok' : 'no';
        }
        else
        {
            return $validate->getError(false);
        }
    }

    public function action_delete($id)
    {
        if ($id == 1)
        {
            return 'حذف این گروه ها امکان پذیر نیست';
        }
        $delete = \Acl\Model_Group::find($id);
        if (count($delete->users))
        {
            return 'ابتدا باید کلیه کاربران گروه را حذف کنید';
        }
        else
        {
            return $delete->delete() ? 'ok' : 'no';
        }
    }

}

?>
