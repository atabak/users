<style>
    .direct-chat-messages{height:300px}
    textarea{resize: none}
</style>
<form class="col-md-12" id="create_form" method="get" action="/dashboard/users/user/createa">
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
                            <?php echo \Form::input("username", null, array("class" => "form-control")); ?> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("ایمیل", "email", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo \Form::input("email", null, array("class" => "form-control")); ?> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("کلمه عبور", "password", array("class" => "control-label")); ?>
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
                            <?php echo Form::select('group_id', null, $group_id, array("class" => "form-control")); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("وضعیت فعال سازی", "is_active", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo Form::select('is_active', null, array('1' => 'کاربر فعال باشد', '0' => 'کاربر غیر فعال باشد'), array("class" => "form-control")); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("وضعیت ورود", "is_locked", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo Form::select('is_locked', null, array('1' => 'وارد حساب کاربری شود', '0' => 'وارد حساب کاربری نشود'), array("class" => "form-control")); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("وضعیت تایید", "is_confirm", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo Form::select('is_confirm', null, array('1' => 'اطلاعات کاربر صحیح است', '0' => 'اطلاعات کاربر صحیح نیست'), array("class" => "form-control")); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="control-group" ><?php echo \Form::label("&nbsp;", "btn", array("class" => "control-label")); ?>
                        <div class="controls">
                            <button class="btn btn-success btn-block btn-flat">ثبت کاربر</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="box box-solid">
            <div class="box-header with-border bg-green">
                <h3 class="box-title yekan">فیلدهای گروه کاربری</h3>
            </div>
            <div class="box-body sh" style="height:350px" id="group_field_place">
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="box box-solid">
            <div class="box-header with-border bg-orange">
                <h3 class="box-title yekan">مشخصات عمومی</h3>
            </div>
            <div class="box-body sh" style="height:350px">
                <?php echo Users\Fields::create_user_fields(6); ?>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
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
                                <div class="box-body">
                                    <?php foreach ($module->controlles as $controller): ?>
                                        <?php if ($controller->is_active): ?>
                                            <p class="text-green"><?php echo $controller->name; ?></p>
                                            <?php foreach ($controller->actions as $action): ?>
                                                <?php if ($action->is_active): ?>
                                                    <?php echo Form::checkbox('actions[]', $module->id.'-'.$controller->id.'-'.$action->id).' '.$action->name; ?>&nbsp;&nbsp;&nbsp;
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
</form>
<script>
    function submitform() {

    }
    $(function () {
        $("#form_group_id").on('change', function () {
            getfields();
            getgroupfields();
        });
        getfields();
        getgroupfields();
    });
    function getfields() {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address.'/groupfields/'); ?>" + $("#form_group_id option:selected").val(),
            success: function (d) {
                $("#group_field_place").html(d);
            }
        });
    }
    function getgroupfields() {
        var g = $("#form_group_id option:selected").val();
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create('dashboard/users/ajax/creategroupfields/'); ?>" + g,
            data: $("#form").serialize(),
            success: function (d) {
                $("#user_group_sps_field_place").html(d);
                if (g == 5) {
                    $("#form_doc_type_id").on('change', function () {
                        getspc();
                    });
                    getspc();
                }
            }
        });
    }
</script>
