<style>
    #chartwrapper {
        position: relative;
        width: 100%;
        height: 250px;
    }
    #chartdiv {
        position: absolute;
        top: -40%;
        left: -50%;
        width : 200%;
        height : 200%;
    }
</style>
<div class="col-md-3 col-sm-12">
    <div class="box box-solid">
        <div class="box-header with-border bg-blue">
            <h3 class="box-title yekan">کاربران تایید نشده</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12" id="unconfirmtable" style="height:250px"></div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-sm-12">
    <div class="box box-solid">
        <div class="box-header with-border bg-blue">
            <h3 class="box-title yekan">گروه های کاربری</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div id="chartwrapper"><div id="chartdiv"></div></div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-sm-12">
    <div class="box box-solid">
        <div class="box-header with-border bg-blue">
            <h3 class="box-title yekan">کاربران مسدود شده</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12" id="blockedusers" style="height:250px"></div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-sm-12">
    <div class="box box-solid">
        <div class="box-header with-border bg-blue">
            <h3 class="box-title yekan">گروه های کاربری</h3>
        </div>
        <div class="box-body">
            <div class="row">
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-sm-12">
    <div class="box box-solid">
        <div class="box-header with-border bg-blue">
            <h3 class="box-title yekan">جستجوی کاربران</h3>
        </div>
        <div class="box-body">
            <form class="row" style="height:250px" id="search_form">
                <div class="col-lg-6">
                    <div class="control-group">
                        <?php echo \Form::label("جستجو", "search", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo \Form::input("search", null, array("class" => "form-control")); ?> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="control-group">
                        <?php echo \Form::label("گروه کاربری", "group_id", array("class" => "control-label")); ?>
                        <div class="controls">
                            <?php echo \Form::select("group_id", null, $group_id, array("class" => "form-control")); ?> 
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="control-group"><?php echo \Form::label("&nbsp;", "btn", array("class" => "control-label")); ?>
                        <div class="controls">
                            <span class="btn btn-primary btn-block btn-flat" onclick="goTopage(1)">جستجو</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-6 col-sm-12">
    <div class="box box-solid">
        <div class="box-header with-border bg-blue">
            <h3 class="box-title yekan">لیست کاربران</h3>
        </div>
        <div class="box-body">
            <div class="row sh" style="height:250px" id="searchplace">

            </div>
        </div>
    </div>
</div>
<?php echo Asset::js(['amcharts/amcharts.js', 'amcharts/pie.js']); ?>
<script>
    var chart;
    var legend;
    var chartData = [
<?php foreach ($user_in_groups as $uig): ?>
        {<?php echo '"name":"'.$uig->name.'","value":"'.$uig->num.'"'; ?>},
<?php endforeach; ?>
    ];
            AmCharts.ready(function () {
                chart = new AmCharts.AmPieChart();
                chart.dataProvider = chartData;
                chart.startDuration = "0";
                chart.innerRadius = "50%";
                chart.titleField = "name";
                chart.valueField = "value";
                chart.colors = ["#43a047", "#3d5afe", "#FF9E01", "#f4511e", "#F8FF01", "#546e7a", "#04D215", "#0D8ECF", "#0D52D1", "#2A0CD0", "#8A0CCF", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                legend = new AmCharts.AmLegend();
                legend.align = "center";
                legend.markerType = "circle";
                chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                chart.addLegend(legend);
                chart.write("chartdiv");
            });
    $(function () {
        unconfirm_users(1);
    });
    function edituser(i) {

    }
    function goTopage(i) {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create('dashboard/users/ajax/searchuser/'); ?>" + i,
            data: $("#search_form").serialize(),
            //contentType: 'JSON',
            success: function (d) {
                $("#searchplace").html(json2table(d[0], 'ed') + d[1]);
            }
        });
    }
    function unconfirm_users(i) {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create('dashboard/users/ajax/unconfirmuserslist/'); ?>" + i,
            contentType: 'JSON',
            success: function (d) {
                if (d[1] == 'no') {
                    $("#unconfirmtable").html(d[0]);
                } else {
                    $("#unconfirmtable").html(json2table(d[0], 'us') + d[1]);
                }
            }
        });
    }
    function blocked_users(i) {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create('dashboard/users/ajax/blockeduserslist/'); ?>" + i,
            contentType: 'JSON',
            case: false,
            success: function (d) {
                if (d[1] == 'no') {
                    $("#blockedusers").html(d[0]);
                } else {
                    $("#blockedusers").html(json2table(d[0], 'su') + d[1]);
                }
            }
        });
    }
    function json2table(data, id) {
        var content = '<table class="table">';
        jQuery.each(data, function (i, val) {
            content += '<tr id="' + id + i + '">';
            jQuery.each(val, function (j, v) {
                content += "<td>" + v + "</td>";
            });
            content += "</tr>";
        });
        content += "</table>";
        return content;
    }
    function confirm_user(i) {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create('dashboard/users/ajax/confirmuser/'); ?>" + i,
            success: function (d) {
                $("#us" + i).remove();
            }
        });
    }
    function unblocked_user(i) {
        $.ajax({
            type: "POST",
            url: "<?php echo \Uri::create('dashboard/users/ajax/unblockuser/'); ?>" + i,
            data: $("#form").serialize(),
            success: function (d) {
                if (d == 'ok') {
                    $("#form")[0].reset();
                } else {
                }
            }
        });
    }
</script>