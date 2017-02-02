<div class="col-md-6 col-sm-1">
    <div class="box box-solid">
        <div class="box-header with-border bg-blue">
            <h3 class="box-title yekan">لیست کنترلر ها</h3>
        </div>
        <div class="box-body">
            <form class="row" id="serach_form">
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
            </form>
            <div class="row"><div class="col-lg-12" id="view_place"></div></div>
        </div>
    </div>
</div>
<div class="col-md-6 col-sm-1">
    <div class="box box-solid">
        <div class="box-header with-border bg-blue">
            <h3 class="box-title yekan">لیست کنترلر ها</h3>
        </div>
        <div class="box-body">
            <form id="newForm" class="row">
                <div class="col-md-6">
                    <div class="control-group">
                        <?php echo \Form::label("ماژول", "module_id", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo \Form::select("module_id", null, $module_id, array("class" => "form-control")); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="control-group">
                        <?php echo \Form::label("نام کنترلر", "name", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo \Form::input("name", null, array("class" => "form-control")); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="control-group">
                        <?php echo \Form::label("آدرس", "url", array("class" => "control-label newa")); ?>
                        <div class="controls">
                            <?php echo \Form::input("url", null, array("class" => "form-control ltr")); ?>
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
                    <div class="control-group" ><?php echo \Form::label("&nbsp;", "btn", array("class" => "control-label")); ?>
                        <div class="controls">
                            <span class="btn btn-primary btn-block" onclick="newRec()">ایجاد رکورد</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function () {
        goTopage(1);
        currentOrder();
        getaddress();
        $("#form_module_id").on('change', function () {
            currentOrder();
            getaddress();
        });
    });
    function getaddress() {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address.'/moduleaddress/'); ?>" + $("#form_module_id option:selected").val(),
            success: function (d) {
                $(".newa").html('آدرس - '+d);
            }
        });
    }
    function currentOrder() {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create($address.'/currentorder/'); ?>" + $("#form_module_id option:selected").val(),
            success: function (d) {
                $("#form_order").val(d);
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
                    currentOrder();
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
            type: "post",
            url: "<?php echo \Uri::create($address."/create/"); ?>",
            data: $("#newForm").serialize(),
            success: function (d) {
                if (d == "ok") {
                    cm("ثبت موفق", "رکورد شما با موفقیت تایید شد");
                    $("#newForm")[0].reset();
                    refreshcurrent();
                    currentOrder();
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
            type: "POST",
            url: "<?php echo \Uri::create($address."/search/"); ?>" + i,
            data: $("#serach_form").serialize(),
            success: function (d) {
                $("#view_place").html(d);
            }
        });
    }
</script>