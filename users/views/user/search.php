<style>
    .direct-chat-messages{height:300px}
    textarea{resize: none}
</style>
<?php echo Form::open(['id' => 'searchform', 'class' => 'col-md-4 col-sm-12']); ?>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-right">
        <li class="pull-right header"><i class="fa fa-search"></i> جستجوی کاربر</li>
        <li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="false">مشخصات عمومی</a></li>
        <li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="false">فیلدها</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1-1">
            <div class="row">
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
                        <?php echo \Form::label("گروه کاربری", "group_id", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo Form::select('group_id', 0, $group_id, array("class" => "form-control")); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("وضعیت فعال سازی", "is_active", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo Form::select('is_active', 2, array('2' => 'همه', '1' => 'کاربر فعال باشد', '0' => 'کاربر غیر فعال باشد'), array("class" => "form-control")); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("وضعیت ورود", "is_locked", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo Form::select('is_locked', 2, array('2' => 'همه', '1' => 'وارد حساب کاربری شود', '0' => 'وارد حساب کاربری نشود'), array("class" => "form-control")); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("وضعیت تایید", "is_confirm", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo Form::select('is_confirm', 2, array('2' => 'همه', '1' => 'اطلاعات کاربر صحیح است', '0' => 'اطلاعات کاربر صحیح نیست'), array("class" => "form-control")); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="control-group">
                        <?php echo \Form::label("&nbsp;", "btn", array("class" => "control-label")); ?>
                        <div class="controls">
                            <span class="btn btn-block btn-flat btn-success" onclick="goTopage(1)">نمایش</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_2-2">
            <div class="row" id="group_field_place"></div>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>
<?php echo Form::open(['id' => 'resultform', 'class' => 'col-md-8 col-sm-12']); ?>
<div class="box box-solid">
    <div class="box-header with-border bg-blue">
        <h3 class="box-title yekan">لیست کاربران</h3>
    </div>
    <div class="box-body" id="searchResult">
    </div>
</div>
<?php echo Form::close(); ?>
<script>
    $(function () {
        $("#form_group_id").on('change', function () {
            getgroupfields();
        });
        getgroupfields();
    });
    function getgroupfields() {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address.'/groupfields/'); ?>" + $("#form_group_id option:selected").val(),
            success: function (d) {
                $("#group_field_place").html(d);
            }
        });
    }
    function goTopage(i) {
        $.ajax({
            type: "get",
            url: "<?php echo \Uri::create($address.'/searchResult/'); ?>" + i,
            data: $("#searchform").serialize(),
            success: function (d) {
                $("#searchResult").html(d);
            }
        });
    }
</script>