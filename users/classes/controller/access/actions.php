<?php

namespace Users;

class Controller_Access_Actions extends \Helper\Dashboard
{

    public function action_index()
    {
        \Breadcrumb::set('مدیریت کاربران', \Uri::create('dashboard/users/index.html'), '2');
        \Breadcrumb::set('مدیریت توابع', '', '3');
        $data["address"]    = 'dashboard/users/access/actions';
        $data["modules_id"] = \Arr::pluck(\Acl\Model_Module::query()->order_by('order')->get(), "name", "id");
        return \Theme::instance()
                        ->get_template()
                        ->set('title', 'مدیریت توابع')
                        ->set('menu', array('users', 'access', 'actions'))
                        ->set('content', \Theme::instance()->view('access/actions', $data));
    }

    public function action_search($page = 1)
    {
        $count_search = \Acl\Model_Actions::query();
        $result       = \Acl\Model_Actions::query();
        if (\Input::post("search"))
        {
            
            $module_subquery = \Acl\Model_Module::query()->select('id')->where("name", "LIKE", "%".\Input::post("search")."%");
            $controller_subquery = \Acl\Model_Controller::query()->select('id')->where("name", "LIKE", "%".\Input::post("search")."%")->or_where("module_id", "IN", $module_subquery->get_query(false));
            $count_search->or_where("name", "LIKE", "%".\Input::post("search")."%");
            $count_search->or_where("uri", "LIKE", "%".\Input::post("search")."%");
            $count_search->or_where("order", "LIKE", "%".\Input::post("search")."%");
            $count_search->or_where("controller_id", "IN", $controller_subquery->get_query(false));
            $result->or_where("name", "LIKE", "%".\Input::post("search")."%");
            $result->or_where("uri", "LIKE", "%".\Input::post("search")."%");
            $result->or_where("order", "LIKE", "%".\Input::post("search")."%");
            $result->or_where("controller_id", "IN", $controller_subquery->get_query(false));
        }
        $count      = $count_search->count();
        $config     = array("pagination_url" => "", "total_items" => $count, "per_page" => 20, "uri_segment" => 1, "show_first" => true, "show_last" => true, "current_page" => $page);
        $pagination = \Pagination::forge("Model_\Acl\Actions_pagination", $config);
        $result->rows_limit($pagination->per_page)
                ->rows_offset($pagination->offset)
                ->order_by('controller_id')
                ->order_by('order');
        $records    = $result->get();
        $pages      = $pagination->render(true);
        $return     = '<table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" width="50">ردیف</th>
                                <th class="text-center">ماژول</th>
                                <th class="text-center">کلاس</th>
                                <th class="text-center">تابع</th>
                                <th class="text-center">منو</th>
                                <th class="text-center">وضعیت</th>
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
                    <td class="text-center">'.$record->controller->module->name.'</td>
                    <td class="text-center">'.$record->controller->name.'</td>
                    <td class="text-center">'.$record->name.'</td>
                    <td class="text-center">'.($record->is_visible ? 'قابل نمایش' : 'مخفی').'</td>
                    <td class="text-center">'.($record->is_active ? 'فعال' : 'غیر فعال').'</td>
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
        $validate->add("controller_id", \Input::post("controller_id"), "کنترلر", array('req'));
        $validate->add("name", \Input::post("name"), "نام", array('req'));
        $validate->add("uri", \Input::post("uri"), "آدرس", array('req'));
        $validate->add("order", \Input::post("order"), "ترتیب", array('req'));
        if ($validate->isValid())
        {
            $entry                = \Acl\Model_Actions::forge();
            $entry->controller_id = \Input::post('controller_id');
            $entry->name          = \Input::post('name');
            $entry->uri           = \Input::post('uri');
            $entry->order         = \Myclasses\FNC::str2num(\Myclasses\FNC::pen(\Input::post('order'), false));
            $entry->is_active     = \Input::post('is_active');
            $entry->is_visible    = \Input::post('is_visible');
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

    public function action_edit($id)
    {
        $edit   = \Acl\Model_Actions::find($id);
        $return = '<form id="editForm" class="col-md-12">';
        $return .= '    <div class="col-md-6">
                            <div class="control-group">
                                '.\Form::label("ماژول", "module_id", array("class" => "control-label")).'
                                <div class="controls">
                                    '.\Acl\Model_Module::getename($edit->controller->module_id).'
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="control-group">
                                '.\Form::label("کلاس", "module_id", array("class" => "control-label")).'
                                <div class="controls">'.\Acl\Model_Controller::getname($edit->controller_id).'</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="control-group">
                                '.\Form::label("نام", "name", array("class" => "control-label")).'
                                <div class="controls">
                                    '.\Form::input("name", $edit->name, array("class" => "form-control")).'
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="control-group">
                                '.\Form::label("آدرس", "uri", array("class" => "control-label")).'
                                <div class="controls">
                                    '.\Form::input("uri", $edit->uri, array("class" => "form-control ltr")).'
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
                            <div class="control-group">
                                '.\Form::label("قابل نمایش", "is_visible", array("class" => "control-label")).'
                                <div class="controls">
                                    '.\Form::select('is_visible', $edit->is_visible, array('1' => 'قابل نمایش', '0' => 'غیر قابل نمایش'), array("class" => "form-control")).'
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
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
        $validate->add("name", \Input::post("name"), "نام", array('req'));
        $validate->add("uri", \Input::post("uri"), "آدرس", array('req'));
        $validate->add("order", \Input::post("order"), "ترتیب", array('req'));
        if ($validate->isValid())
        {
            $entry             = \Acl\Model_Actions::find($id);
            $entry->name       = \Input::post('name');
            $entry->uri        = \Input::post('uri');
            $entry->order      = \Myclasses\FNC::str2num(\Myclasses\FNC::pen(\Input::post('order'), false));
            $entry->is_active  = \Input::post('is_active');
            $entry->is_visible = \Input::post('is_visible');
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
        $delete = \Acl\Model_Actions::find($id);
        if ($delete->delete())
        {
            return 'ok';
        }
        else
        {
            return 'no';
        }
    }

    public function action_controllerlist($module)
    {
        $controllers = \Acl\Model_Controller::query()
                ->select('id', 'name')
                ->where('module_id', $module)
                ->order_by('order')
                ->get();
        return \Form::select("controller_id", null, \Arr::pluck($controllers, "name", "id"), array("class" => "form-control"));
    }

    public function action_controllerpath($controller_id)
    {
        $controller = \Acl\Model_Controller::find($controller_id);
        return $controller->module->url.'/'.$controller->url;
    }

    public function action_currentorder($controller_id)
    {
        return \Acl\Model_Actions::current_order($controller_id);
    }

}

?>
