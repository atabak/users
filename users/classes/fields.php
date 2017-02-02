<?php

namespace Users;

class Fields
{

    public static function create_user_fields($size = 6)
    {
        $return = '
            <div class="col-md-'.$size.'">
                <div class="control-group">
                    '.\Form::label("نام", "first", array("class" => "control-label")).'
                    <div class="controls">
                        '.\Form::input("first", null, array("class" => "form-control")).'
                    </div>
                </div>
            </div>
            <div class="col-md-'.$size.'">
                <div class="control-group">
                    '.\Form::label("نام خانوادگی", "last", array("class" => "control-label")).'
                    <div class="controls">
                        '.\Form::input("last", null, array("class" => "form-control")).'
                    </div>
                </div>
            </div>
            <div class="col-md-'.$size.'">
                <div class="control-group">
                    '.\Form::label("تصویر", "pic", array("class" => "control-label")).'
                    <div class="controls">
                        '.\Form::file("pic").'
                    </div>
                </div>
            </div>
            <div class="col-md-'.$size.'">
                <div class="control-group">
                    '.\Form::label("گمرک", "customs_id", array("class" => "control-label")).'
                    <div class="controls">
                        '.\Form::select("customs_id", null, \Arr::pluck(\Customs\Model_Customs::find('all'), 'name', 'id'), array("class" => "form-control")).'
                    </div>
                </div>
            </div>
        ';
        return $return;
    }

}
