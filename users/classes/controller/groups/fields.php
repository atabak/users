<?php

namespace Users;

class Controller_Groups_Fields extends \Helper\Dashboard
{

    public function action_index()
    {

        \Breadcrumb::set('مدیریت کاربران', \Uri::create('dashboard/users/index.html'), 2);
        \Breadcrumb::set('مدیریت گروه ها', '', 3);
        \Breadcrumb::set('مدیریت فیلد ها', '', 4);
        $data["address"]   = 'dashboard/users/groups/fields';
        $data["type_id"]   = \Arr::pluck(\Acl\Model_Group_Field_Type::find("all"), "name", "id");
        $data["groups_id"] = \Arr::pluck(\Acl\Model_Group::find("all"), "name", "id");
        return \Theme::instance()
                        ->get_template()
                        ->set('title', 'مدیریت فیلد ها')
                        ->set('menu', array('users', 'groups', 'fields'))
                        ->set('content', \Theme::instance()->view('fields', $data));
    }

    public function action_create($group_id)
    {
        $validate = \Myclasses\Validate::forge();
        $validate->add('label', \Input::post('label'), 'نام فیلد', array('req'));
        $validate->add('type_id', \Input::post('type_id'), 'نوع فیلد', array('req'));
        $validate->add('order', \Input::post('order'), 'ترتیب نمایش', array('req'));
        $validate->add('size', \Input::post('size'), 'اندازه فیلد', array('req'));
        if ($validate->isValid()) {
            if (!\Acl\Model_Group_Field::is_duplicate($group_id, \Input::post('label'))) {
                $entry                 = \Acl\Model_Group_Field::forge();
                $entry->group_id       = (int) $group_id;
                $entry->label          = \Input::post('label');
                $entry->type_id        = (int) \Input::post('type_id');
                $entry->order          = (int) \Myclasses\FNC::str2num(\Myclasses\FNC::pen(\Input::post('order'), false));
                $entry->size           = (int) \Myclasses\FNC::str2num(\Myclasses\FNC::pen(\Input::post('size'), false));
                $entry->is_editable    = \Input::post('is_editable');
                $entry->is_required    = \Input::post('is_required');
                $entry->default_values = self::default_values_creator(\Input::post('type_id'), \Input::post('default_values'));
                return $entry->save() ? 'ok' : 'no';
            } else {
                return 'نام فیلد در گروه تکراری است';
            }
        } else {
            return $validate->getError(false);
        }
    }

    public function action_edit($id)
    {
        $field          = \Acl\Model_Group_Field::find($id);
        $default_values = $field->default_values;
        if ($field->type_id == 5) {
            $default_values = implode("\n", unserialize($default_values));
        }
        $type_id   = \Arr::pluck(\Acl\Model_Group_Field_Type::find("all"), "name", "id");
        $groups_id = \Arr::pluck(\Acl\Model_Group::find("all"), "name", "id");
        $edit      = '
        <form class="col-md-12 col-sm-12" id="edit_field">
            <div class="col-md-4">
                <div class="control-group">
                    '.\Form::label("نوع فیلد", "type_id", array("class" => "control-label")).'
                    <div class="controls">
                        '.\Form::select('type_id', $field->type_id, $type_id, array("class" => "form-control")).'
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="control-group">
                    '.\Form::label("نام فیلد", "label", array("class" => "control-label")).'
                    <div class="controls">
                        '.\Form::input('label', $field->label, array("class" => "form-control")).'
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="control-group">
                    '.\Form::label("ترتیب", "order", array("class" => "control-label")).'
                    <div class="controls">
                        '.\Form::input('order', $field->order, array("class" => "form-control")).'
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="control-group">
                    '.\Form::label("اندازه", "size", array("class" => "control-label")).'
                    <div class="controls">
                        '.\Form::input('size', $field->size, array("class" => "form-control")).'
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="control-group">
                    '.\Form::label("قابل ویرایش", "is_editable", array("class" => "control-label")).'
                    <div class="controls">
                        '.\Form::select('is_editable', $field->is_editable, array('1' => 'قابل ویرایش ', '0' => 'غیر قابل ویرایش'), array("class" => "form-control")).'
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="control-group">
                    '.\Form::label("اجباری", "is_required", array("class" => "control-label")).'
                    <div class="controls">
                        '.\Form::select('is_required', $field->is_required, array('1' => 'حتما پر شود', '0' => 'اجباری به پر شدن ندارد'), array("class" => "form-control")).'
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="control-group">
                    '.\Form::label("مقادیر", "default_values", array("class" => "control-label")).'
                    <div class="controls">
                        '.\Form::textarea('default_values', $default_values, array("class" => "form-control")).'
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="control-group" >'.\Form::label("&nbsp;", "btn", array("class" => "control-label")).'
                    <div class="controls">
                        <span class="btn btn-primary btn-block btn-flat" onclick="updatefield('.$id.')">ویرایش فیلد</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="control-group" >'.\Form::label("&nbsp;", "btn", array("class" => "control-label")).'
                    <div class="controls">
                        <span class="btn btn-danger btn-block btn-flat" onclick="deletefield('.$id.')">حذف فیلد</span>
                    </div>
                </div>
            </div>
        </div>
        ';
        return $edit;
    }

    public function action_update($id)
    {
        $entry = \Acl\Model_Group_Field::find($id);
        if ($entry) {
            $validate = \Myclasses\Validate::forge();
            $validate->add('label', \Input::post('label'), 'نام فیلد', array('req'));
            $validate->add('type_id', \Input::post('type_id'), 'نوع فیلد', array('req'));
            $validate->add('order', \Input::post('order'), 'ترتیب نمایش', array('req'));
            $validate->add('size', \Input::post('size'), 'اندازه فیلد', array('req'));
            if ($validate->isValid()) {
                if (!\Acl\Model_Group_Field::is_duplicate($entry->group_id, \Input::post('label'), $id)) {

                    $entry->label          = \Input::post('label');
                    $entry->type_id        = (int) \Input::post('type_id');
                    $entry->order          = (int) \Input::post('order');
                    $entry->size           = (int) \Input::post('size');
                    $entry->is_editable    = \Input::post('is_editable');
                    $entry->is_required    = \Input::post('is_required');
                    $entry->default_values = self::default_values_creator(\Input::post('type_id'), \Input::post('default_values'));
                    return $entry->save() ? 'ok' : 'no';
                } else {
                    return 'نام فیلد در گروه تکراری است';
                }
            } else {
                return $validate->getError(false);
            }
        } else {
            return 'لطفا مجدد صفحه را بارگذاری کنید';
        }
    }

    public function action_delete($id)
    {
        $entry = \Acl\Model_Group_Field::find($id);
        return $entry->delete() ? 'ok' : 'خطای  پیش آمده، با مدیر سیستم تماس بگیرید';
    }

    private static function default_values_creator($type_id, $default_values)
    {
        if ($type_id == 5) {
            $defaults = explode("\n", $default_values);
            $values   = [];
            $counter  = 1;
            foreach ($defaults as $default) {
                $values[$counter++] = $default;
            }
            return serialize($values);
        } elseif ($type_id == 2 || $type_id == 3) {
            return str_replace(':', '', str_replace('\\', '', str_replace('/', '', $default_values)));
        } elseif ($type_id == 1 || $type_id == 6 || $type_id == 4) {
            return $default_values;
        }
    }

    public function action_groupfield($group_id)
    {
        $fields = \Acl\Model_Group_Field::query()->where('group_id', $group_id)->get();
        $return = '';
        if ($fields) {
            foreach ($fields as $field) {
                $return .= '<span class="btn btn-success btn-block btn-flat" onclick="editfield('.$field->id.')">'.$field->label.'</span>';
            }
        } else {
            $return = '<p class="text-green">فیلدی برای این گروه تعریف نشده<p>';
        }
        return $return;
    }

}
