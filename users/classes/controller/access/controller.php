<?php

namespace Users;

class Controller_Access_Controller extends \Helper\Dashboard
{

    public function action_index()
    {
        \Breadcrumb::set('مدیریت کاربران', \Uri::create('dashboard/users/index.html'), '2');
        \Breadcrumb::set('مدیریت کنترلر ها', '', '3');
        $data ["address"]  = 'dashboard/users/access/controller';
        $data["module_id"] = \Arr::pluck(\Acl\Model_Module::query()->order_by('order')->get(), "name", "id");
        return \Theme::instance()
                        ->get_template()
                        ->set('title', 'مدیریت کنترلر ها')
                        ->set('menu', array('users', 'access', 'controller'))
                        ->set('content', \Theme::instance()->view('access/controller', $data));
    }

    public function action_search($page = 1)
    {
        $count_search = \Acl\Model_Controller::query();
        $result       = \Acl\Model_Controller::query();
        if (\Input::post("search"))
        {
            $count_search->or_where("module_id", "LIKE", "%".\Input::post("search")."%");
            $count_search->or_where("name", "LIKE", "%".\Input::post("search")."%");
            $count_search->or_where("url", "LIKE", "%".\Input::post("search")."%");

            $result->or_where("module_id", "LIKE", "%".\Input::post("search")."%");
            $result->or_where("name", "LIKE", "%".\Input::post("search")."%");
            $result->or_where("url", "LIKE", "%".\Input::post("search")."%");
        }
        $count      = $count_search->count();
        $config     = array("pagination_url" => "", "total_items" => $count, "per_page" => 20, "uri_segment" => 1, "show_first" => true, "show_last" => true, "current_page" => $page);
        $pagination = \Pagination::forge("Model_Controller_pagination", $config);
        $result->rows_limit($pagination->per_page)
                ->rows_offset($pagination->offset)
                ->order_by('module_id')
                ->order_by('order');
        $records    = $result->get();
        $pages      = $pagination->render(true);
        $return     = '<table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" width="50">ردیف</th>
                                <th class="text-center">ماژول</th>
                                <th class="text-center">کنترلر</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>';
        $counter    = $pagination->offset + 1;
        if ($records)
        {
            foreach ($records as $record)
            {
                $return .= '      <tr>
                    <td>'.\Myclasses\FNC::pen($counter++).'</td>
                    <td class="text-center">'.$record->module->name.'</td>
                    <td class="text-center">'.$record->name.'</td>
                    <td class="text-center" width="160">
                        <span class="btn btn-xs btn-success btn-flat" onclick="editRec('.$record->id.')">ویرایش</span>
                        <span class="btn btn-xs btn-danger btn-flat" onclick="cdec('.$record->id.')">حذف</span>
                    </td>
                </tr>';
            }
        }
        else
        {
            $return .= '<tr class="text-center"><td colspan="8">جستجوی شما نتیجه ای نداشت</td></tr>';
        } $return .= "<tbody></table>";
        if ($count > 20)
        {
            $return .= '<div class="text-center">'.\Myclasses\FNC::ajaxPaginationLink($pages, "goTopage").'</div><input type="hidden" value="'.$page.'" id="currentPage">';
        }
        return $return;
    }

    public function action_create()
    {
        $validate = \Myclasses\Validate::forge();
        $validate->add("module_id", \Input::post("module_id"), "ماژول", array('req'));
        $validate->add("name", \Input::post("name"), "کنترلر", array('req'));
        $validate->add("url", \Input::post("url"), "آدرس", array('req'));
        $validate->add("order", \Input::post("order"), "ترتیب", array('req'));
        if ($validate->isValid())
        {
            // checkd uplicate
            if (\Acl\Model_Controller::duplicate_check(\Input::post("module_id"), \Input::post("name")))
            {
                return 'نام کنترلر در این ماژول تکراری است';
            }
            else
            {
                $entry            = \Acl\Model_Controller::forge();
                $entry->module_id = \Input::post('module_id');
                $entry->name      = \Input::post('name');
                $entry->url       = \Input::post('url');
                $entry->order     = \Myclasses\FNC::str2num(\Myclasses\FNC::pen(\Input::post('order'), false));
                $entry->is_active = \Input::post('is_active');
                return $entry->save() ? 'ok' : 'no';
            }
        }
        else
        {
            return $validate->getError(false);
        }
    }

    public function action_edit($id)
    {
        $module_id = \Arr::pluck(\Acl\Model_Module::find("all"), "name", "id");
        $edit      = \Acl\Model_Controller::find($id);
        $return    = '<form id="editForm" class="col-md-12">';
        $return .= '<div class="col-md-6">
                        <div class="control-group">
                            '.\Form::label("ماژول", "module_id", array("class" => "control-label")).'
                            <div class="controls">
                                '.\Form::select("module_id", $edit->module_id, $module_id, array("class" => "form-control")).'
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="control-group">
                            '.\Form::label("کنترلر", "name", array("class" => "control-label")).'
                            <div class="controls">
                                '.\Form::input("name", $edit->name, array("class" => "form-control")).'
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="control-group">
                            '.\Form::label("آدرس", "url", array("class" => "control-label")).'
                            <div class="controls">
                                '.\Form::input("url", $edit->url, array("class" => "form-control")).'
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="control-group">
                            '.\Form::label("ترتیب", "order", array("class" => "control-label")).'
                            <div class="controls">
                                '.\Form::input("order", $edit->order, array("class" => "form-control")).'
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="control-group">
                            '.\Form::label("وضعیت", "is_active", array("class" => "control-label")).'
                            <div class="controls">
                                '.\Form::select('is_active', $edit->is_active, array('1' => 'فعال', '0' => 'غیر فعال'), array("class" => "form-control")).'
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="control-group" >'.\Form::label("&nbsp;", "btn", array("class" => "control-label")).'
                            <div class="controls">
                                <span class="btn btn-primary btn-block" onclick="updateRec('.$edit->id.')">ویرایش</span>
                            </div>
                        </div>
                    </div>
                </form>';
        return $return;
    }

    public function action_update($id)
    {
        $validate = \Myclasses\Validate::forge();
        $validate->add("module_id", \Input::post("module_id"), "ماژول", array('req'));
        $validate->add("name", \Input::post("name"), "کنترلر", array('req'));
        $validate->add("url", \Input::post("url"), "آدرس", array('req'));
        $validate->add("order", \Input::post("order"), "ترتیب", array('req'));
        if ($validate->isValid())
        {
            $entry            = \Acl\Model_Controller::find($id);
            $entry->module_id = \Input::post('module_id');
            $entry->name      = \Input::post('name');
            $entry->url       = \Input::post('url');
            $entry->order     = \Myclasses\FNC::str2num(\Myclasses\FNC::pen(\Input::post('order'), false));
            $entry->is_active = \Input::post('is_active');
            if ($entry->save())
            {
                return 'ok';
            }
            else
            {
                return 'no';
            }
        }
        else
        {
            return $validate->getError(false);
        }
    }

    public function action_delete($id)
    {
        $delete = \Acl\Model_Controller::find($id);
        if ($delete->delete())
        {
            return 'ok';
        }
        else
        {
            return 'no';
        }
    }

    public function action_currentorder($module_id)
    {
        return \Acl\Model_Controller::current_order($module_id);
    }

    public function action_moduleaddress($module_id)
    {
        $module = \Acl\Model_Module::find($module_id);
        return \Str::lower($module->url);
    }

}

?>