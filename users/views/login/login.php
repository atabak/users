<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ورود کاربران</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php echo Asset::css(['bootstrap.min.css', 'bootstrap-rtl.min.css', 'AdminLTE.min.css', 'style.css']); ?>
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-box-body">
                <p class="login-box-msg yekan">نام کاربری و کلمه عبور خود را واردکنید</p>
                <?php echo Form::open(array('id' => 'login')); ?>
                <div class="form-group has-feedback">
                    <?php echo Form::input('username', null, array('class' => 'form-control ltr', 'placeholder' => 'Username Or Email')); ?>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <?php echo Form::password('password', null, array('class' => 'form-control ltr', 'placeholder' => 'Password')); ?>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <?php echo Form::checkbox('remember', null, false, array('class' => 'pull-right', 'style' => 'margin-top:2px')); ?>
                        <span class="pull-right">مرابه خاطر بسپار  </span>
                    </div>
                    <div class="col-xs-4">
                        <span type="submit" class="btn btn-danger btn-xs btn-block btn-flat" onclick="login()">ورود</span>
                    </div>
                </div>
                <?php echo Form::close(); ?>
                <a href="#">فراموش کردن کلمه عبور</a><br>
                <a href="register.html" class="text-center">ثبت نام به عنوان کاربر جدید</a>
            </div>
        </div>
        <?php echo Asset::js(['jquery.min.js', 'bootstrap.min.js', 'app.js']); ?>
        <script>
            $(function () {
                $("#form_password").keypress(function (e) {
                    if (e.which == 13) {
                        login();
                    }
                });
            });
            function login() {
                $.ajax({
                    type: "get",
                    url: "<?php echo \Uri::create('login/loginproccess/'); ?>",
                    data: $("#login").serialize(),
                    success: function (d) {
                        if (d === 'ok') {
                            window.location = "<?php echo Uri::create('dashboard'); ?>";
                        } else {
                            cm('خطا', d);
                        }
                    }
                });
            }
        </script>
    </body>
</html>