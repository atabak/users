<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title yekan">ویرایش فیلد</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <p class="text-center" id="editbody"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-block" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-sm-12">
    <div class="box box-solid">
        <div class="box-header with-border bg-blue">
            <h3 class="box-title yekan">لیست فیلد ها</h3>
        </div>
        <div class="box-body">
            <div class="col-lg-12">
                <div class="control-group">
                    <?php echo \Form::label("گروه کاربری", "groups_id", array("class" => "control-label")); ?>
                    <div class="controls">
                        <?php echo Form::select('groups_id', null, $groups_id, array("class" => "form-control")); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-12" id="group_field_place">
            </div>
        </div>
    </div>
</div>
<form class="col-md-9 col-sm-12" id="create_field">
    <div class="box box-solid">
        <div class="box-header with-border bg-blue">
            <h3 class="box-title yekan">فیلد جدید</h3>
        </div>
        <div class="box-body">
            <div class="col-md-3">
                <div class="control-group">
                    <?php echo \Form::label("نوع فیلد", "type_id", array("class" => "control-label")); ?>
                    <div class="controls">
                        <?php echo Form::select('type_id', null, $type_id, array("class" => "form-control")); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="control-group">
                    <?php echo \Form::label("نام فیلد", "label", array("class" => "control-label")); ?>
                    <div class="controls">
                        <?php echo Form::input('label', null, array("class" => "form-control")); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="control-group">
                    <?php echo \Form::label("ترتیب", "order", array("class" => "control-label")); ?>
                    <div class="controls">
                        <?php echo Form::input('order', null, array("class" => "form-control")); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="control-group">
                    <?php echo \Form::label("اندازه", "size", array("class" => "control-label")); ?>
                    <div class="controls">
                        <?php echo Form::input('size', null, array("class" => "form-control")); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="control-group">
                    <?php echo \Form::label("قابل ویرایش", "is_editable", array("class" => "control-label")); ?>
                    <div class="controls">
                        <?php echo Form::select('is_editable', null, array('1' => 'قابل ویرایش ', '0' => 'غیر قابل ویرایش'), array("class" => "form-control")); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="control-group">
                    <?php echo \Form::label("اجباری", "is_required", array("class" => "control-label")); ?>
                    <div class="controls">
                        <?php echo Form::select('is_required', null, array('1' => 'حتما پر شود', '0' => 'اجباری به پر شدن ندارد'), array("class" => "form-control")); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="control-group">
                    <?php echo \Form::label("مقادیر", "default_values", array("class" => "control-label")); ?>
                    <div class="controls">
                        <?php echo Form::textarea('default_values', null, array("class" => "form-control", 'rows' => 20)); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="control-group" ><?php echo \Form::label("&nbsp;", "btn", array("class" => "control-label")); ?>
                    <div class="controls">
                        <span class="btn btn-primary btn-block btn-flat" onclick="create()">ثبت فیلد</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(function () {
        $("#form_groups_id").on('change', function () {
            getfields('group_field_place', $("#form_groups_id option:selected").val());
        });
        getfields('group_field_place', $("#form_groups_id option:selected").val());
    });
    function getfields(p, v) {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address.'/groupfield/'); ?>" + v,
            success: function (d) {
                $("#" + p).html(d);
            }
        });
    }
    function create() {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address.'/create/'); ?>" + $("#form_groups_id option:selected").val(),
            data: $("#create_field").serialize(),
            success: function (d) {
                if (d == 'ok') {
                    cm('ثبت موفق', 'فیلد شما با موفقیت ثبت شد');
                    $("#create_field")[0].reset();
                    getfields('group_field_place', $("#form_groups_id option:selected").val());
                } else if (d == 'no') {
                    cm('خطا', 'خطایی در ثبت اطلاعات پیشآمده، با مدیر سیستم تماس بگیرید');
                } else {
                    cm('خطا', d);
                }
            }
        });
    }
    function editfield(i) {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address.'/edit/'); ?>" + i,
            success: function (d) {
                $("#editbody").html(d);
                $('#editModal').modal();
            }
        });
    }
    function updatefield(i) {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address.'/update/'); ?>" + i,
            data: $("#edit_field").serialize(),
            success: function (d) {
                $('#editModal').modal('hide');
                if (d == 'ok') {
                    cm('ثبت موفق', 'فیلد شما با موفقیت ثبت شد');
                    $("#edit_field")[0].reset();
                    getfields('group_field_place', $("#form_groups_id option:selected").val());
                } else if (d == 'no') {
                    cm('خطا', 'خطایی در ثبت اطلاعات پیشآمده، با مدیر سیستم تماس بگیرید');
                } else {
                    cm('خطا', d);
                }
            }
        });
    }
    function deletefield(i) {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address.'/delete/'); ?>" + i,
            success: function (d) {
                ccm();
                if (d == 'ok') {
                    getfields('group_field_place', $("#form_groups_id option:selected").val());
                } else {
                    cm('خطا', d);
                }
            }
        });
    }
</script>
