<div class="col-md-6 col-sm-1">
    <div class="box box-solid">
        <div class="box-header with-border bg-blue"><h3 class="box-title yekan">لیست توابع</h3></div>
        <div class="box-body">
            <?php echo Form::open(['class' => 'row', 'id' => 'serach_form']); ?>
            <div class="col-lg-8">
                <div class="control-group">
                    <?php echo \Form::label("جستجو", "search", array("class" => "control-label")); ?>
                    <div class="controls">
                        <?php echo \Form::input("search", null, array("class" => "form-control")); ?> 
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="control-group" ><?php echo \Form::label("&nbsp;", "btn", array("class" => "control-label")); ?>
                    <div class="controls">
                        <span class="btn btn-primary btn-block btn-flat" onclick="search()">جستجو</span>
                    </div>
                </div>
            </div>
            <?php echo Form::close(); ?>
            <div class="row"><div class="col-lg-12" id="view_place"></div></div>
        </div>
    </div>
</div>
<div class="col-md-6 col-sm-1">
    <div class="box box-solid">
        <div class="box-header with-border bg-blue"><h3 class="box-title yekan">تابع جدید</h3></div>
        <div class="box-body">
            <?php echo Form::open(['class' => 'row', 'id' => 'newForm']); ?>
            <div class="col-md-6">
                <div class="control-group">
                    <?php echo \Form::label("ماژول", "module_id", array("class" => "control-label")); ?>
                    <div class="controls">
                        <?php echo \Form::select("module_id", null, $modules_id, array("class" => "form-control")); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="control-group">
                    <?php echo \Form::label("کنترلر", "controller_id", array("class" => "control-label")); ?>
                    <div class="controls" id="controllers_places"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="control-group">
                    <?php echo \Form::label("نام", "name", array("class" => "control-label")); ?>
                    <div class="controls">
                        <?php echo \Form::input("name", null, array("class" => "form-control")); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="control-group">
                    <?php echo \Form::label("آدرس", "uri", array("class" => "control-label urlp")); ?>
                    <div class="controls">
                        <?php echo \Form::input("uri", null, array("class" => "form-control ltr")); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="control-group">
                    <?php echo \Form::label("ترتیب", "order", array("class" => "control-label")); ?>
                    <div class="controls">
                        <?php echo \Form::input("order", null, array("class" => "form-control")); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="control-group">
                    <?php echo \Form::label("وضعیت", "is_active", array("class" => "control-label")); ?>
                    <div class="controls">
                        <?php echo Form::select('is_active', null, array('1' => 'فعال', '0' => 'غیر فعال'), array("class" => "form-control")); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="control-group">
                    <?php echo \Form::label("قابل نمایش", "is_visible", array("class" => "control-label")); ?>
                    <div class="controls">
                        <?php echo Form::select('is_visible', null, array('1' => 'قابل نمایش', '0' => 'غیر قابل نمایش'), array("class" => "form-control")); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="control-group" ><?php echo \Form::label("&nbsp;", "btn", array("class" => "control-label")); ?>
                    <div class="controls">
                        <span class="btn btn-primary btn-block btn-flat" onclick="newRec()">ایجاد رکورد</span>
                    </div>
                </div>
            </div>
            <?php echo Form::close(); ?>
        </div>
    </div>
</div>
<script>
    $(function () {
        goTopage(1);
        currentOrder();
        getcontroller();
        $("#form_module_id").on('change', function () {
            getcontroller();
        });
    });
    function controllerpath() {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address.'/controllerpath/'); ?>" + $("#form_controller_id option:selected").val(),
            success: function (d) {
                $(".urlp").html('آدرس ' + d);
                currentOrder();
            }
        });
    }
    function currentOrder() {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address.'/currentorder/'); ?>" + $("#form_controller_id option:selected").val(),
            success: function (d) {
                $("#form_order").val(d);
            }
        });
    }
    function getcontroller() {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address.'/controllerlist/'); ?>" + $("#form_module_id option:selected").val(),
            success: function (d) {
                $("#controllers_places").html(d);
                controllerpath();
                $("#form_controller_id").on('change', function () {
                    controllerpath();
                });
            }
        });
    }
    function cdec(i) {
        cm("حذف رکورد", '<p class="text-center red">آیا از حذف این رکورد اطمینان دارید؟</p><span class="btn btn-danger pull-left" onclick="delRec(' + i + ')">حذف شود</span>');
    }
    function delRec(i) {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address."/delete/"); ?>" + i,
            success: function (d) {
                ccm();
                if (d == "ok") {
                    cm("ثبت موفق", "رکورد شما با موفقیت حذف شد");
                    refreshcurrent();
                } else if (d == "no") {
                    cm("خطا", "خطایی رخ داده، با مدیر سیستم تماس بگیرید");
                } else {
                    cm("خطا", d);
                }
            }
        });
    }
    function editRec(i) {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address."/edit/"); ?>" + i,
            success: function (d) {
                cm("ویرایش رکورد", d);
            }
        });
    }
    function updateRec(i) {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address."/update/"); ?>" + i,
            data: $("#editForm").serialize(),
            success: function (d) {
                ccm();
                if (d == "ok") {
                    cm("ثبت موفق", "رکورد شما با موفقیت تایید شد");
                    refreshcurrent();
                } else if (d == "no") {
                    cm("خطا", "خطایی رخ داده، با مدیر سیستم تماس بگیرید");
                } else {
                    cm("خطا", d);
                }
            }
        });
    }
    function newRec() {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address."/create/"); ?>",
            data: $("#newForm").serialize(),
            success: function (d) {
                if (d == "ok") {
                    cm("ثبت موفق", "رکورد شما با موفقیت تایید شد");
                    $("#newForm")[0].reset();
                    refreshcurrent();
                } else if (d == "no") {
                    cm("خطا", "خطایی رخ داده، با مدیر سیستم تماس بگیرید");
                } else {
                    cm("خطا", d);
                }
            }
        });
    }
    function search() {
        goTopage(1);
    }
    function refreshcurrent() {
        goTopage($("#currentPage").val());
    }
    function goTopage(i) {
        $.ajax({
            type: "post",
            url: "<?php echo \Uri::create($address."/search/"); ?>" + i,
            data: $("#serach_form").serialize(),
            success: function (d) {
                $("#view_place").html(d);
            }
        });
    }
</script>