<style>
    .direct-chat-messages{height:300px}
</style>
<form class="col-md-12" id="serach_form" method="get" action="<?php echo Uri::create('dashboard/users/user/update/'.$user->id) ?>">
    <div class="col-md-4 col-sm-12">
        <div class="box box-solid">
            <div class="box-header with-border bg-blue">
                <h3 class="box-title yekan">مشخصات کاربر</h3>
            </div>
            <div class="box-body sh" style="height:350px">
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("نام کاربری", "username", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo \Form::input("username", $user->username, array("class" => "form-control")); ?> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("ایمیل", "email", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo \Form::input("email", $user->email, array("class" => "form-control")); ?> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("تغییر کلمه عبور", "password", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo \Form::password("password", null, array("class" => "form-control")); ?> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("تکرار کلمه عبور", "password_retry", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo \Form::password("password_retry", null, array("class" => "form-control")); ?> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("گروه کاربری", "group_id", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo Form::select('group_id', $user->group_id, $group_id, array("class" => "form-control")); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("وضعیت فعال سازی", "is_active", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo Form::select('is_active', $user->is_active, array('1' => 'کاربر فعال باشد', '0' => 'کاربر غیر فعال باشد'), array("class" => "form-control")); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("وضعیت ورود", "is_locked", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo Form::select('is_locked', $user->is_locked, array('1' => 'وارد حساب کاربری شود', '0' => 'وارد حساب کاربری نشود'), array("class" => "form-control")); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("وضعیت تایید", "is_confirm", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo Form::select('is_confirm', $user->is_confirm, array('1' => 'اطلاعات کاربر صحیح است', '0' => 'اطلاعات کاربر صحیح نیست'), array("class" => "form-control")); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="control-group" ><?php echo \Form::label("&nbsp;", "btn", array("class" => "control-label")); ?>
                        <div class="controls">
                            <button class="btn btn-success btn-block btn-flat">ویرایش کاربر</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="box box-warning direct-chat direct-chat-warning">
            <div class="box-header with-border">
                <h3 class="box-title">فیلدهای گروه کاربری</h3>
            </div>
            <div class="box-body sh" style="height:350px">
                <div class="direct-chat-messages" id="group_field_place">

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="box box-solid">
            <div class="box-header with-border bg-red">
                <h3 class="box-title yekan">دسترسی ها</h3>
            </div>
            <div class="box-body sh" style="height:350px">
                <?php foreach ($modules as $module) : ?>
                    <div class="box-group" id="accordion">
                        <div class="panel box box-danger">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a class="collapsed" aria-expanded="false" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $module->id ?>"><?php echo $module->name; ?></a>
                                </h4>
                            </div>
                            <div style="height:0px" aria-expanded="false" id="collapse<?php echo $module->id; ?>" class="panel-collapse collapse">
                                <div class="box-body sh">
                                    <?php foreach ($module->controlles as $controller): ?>

                                        <?php if ($controller->is_active): ?>

                                            <div class="col-md-12 text-green"><?php echo $controller->name; ?></div>

                                            <?php foreach ($controller->actions as $action): ?>

                                                <?php if ($action->is_active): ?>

                                                    <?php $check = (in_array($action->id, $access_actions) ? true : false); ?>

                                                    <?php //var_dump($check.'-'.$action->id,$access_actions) ?>

                                                    <div class="col-md-6"><?php echo Form::checkbox('actions[]', $module->id.'-'.$controller->id.'-'.$action->id, $check).' '.$action->name; ?>&nbsp;&nbsp;&nbsp;</div>

                                                <?php endif; ?>

                                            <?php endforeach; ?>

                                            <br><br>
                                        <?php endif; ?>

                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="box box-solid">
            <div class="box-header with-border bg-orange">
                <h3 class="box-title yekan">پروفایل کاربر</h3>
            </div>
            <div class="box-body sh" style="height:350px">
                <div class="col-lg-3">
                    <div class="control-group">
                        <?php echo \Form::label("نام", "first", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo \Form::input("first", $user->profile->first, array("class" => "form-control")); ?> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="control-group">
                        <?php echo \Form::label("نام خانوادگی", "last", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo \Form::input("last", $user->profile->last, array("class" => "form-control")); ?> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="control-group">
                        <?php echo \Form::label("تصویر کاربر", "pic", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo \Form::file("pic"); ?> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="control-group">
                        <?php echo \Form::label("گمرک", "customs_id", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo \Form::select("customs_id", $user->profile->customs_id, \Arr::pluck(\Customs\Model_Customs::find('all'), 'name', 'id'), array('class' => 'form-control')); ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="box box-solid">
            <div class="box-header with-border bg-orange">
                <h3 class="box-title yekan">فیلد های خاص گروه</h3>
            </div>
            <div class="box-body" id="spcfield">

            </div>
        </div>
    </div>
</form>
<script>
    $(function () {
        $("#form_group_id").on('change', function () {
            getfields();
        });
        getfields();
    });
    function getfields() {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address.'/usereditfields/'.$user->id); ?>",
            success: function (d) {
                $("#group_field_place").html(d);
            }
        });
    }
</script>
