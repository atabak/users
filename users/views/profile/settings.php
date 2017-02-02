<div class="container">
    <h1 class="page-title"><?php echo Lang::get('profile_settings_page_title'); ?></h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <aside class="user-profile-sidebar">
                <div class="user-profile-avatar text-center">
                    <img src="<?php echo ($user->profile->pic ? : 'assets/img/300x300.png'); ?>" alt="Image Alternative text" title="AMaze" />
                    <h5><?php echo $user->profile->first.' '.$user->profile->last; ?></h5>
                    <p>Member Since May 2012</p>
                </div>
                <ul class="list user-profile-nav">
                    <?php echo $side_menu; ?>
                </ul>
            </aside>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5">
                    <?php echo Form::open(['id' => 'account_info']); ?>
                    <h4><?php echo \Lang::get('settings.profile_account_title'); ?></h4>
                    <div class="form-group form-group-icon-left">
                        <i class="fa fa-user input-icon"></i>
                        <?php echo \Form::label(\Lang::get('settings.first')); ?>
                        <?php echo \Form::input('first', $user->profile->first, ['class' => 'form-control']); ?>
                    </div>
                    <div class="form-group form-group-icon-left">
                        <i class="fa fa-user input-icon"></i>
                        <?php echo \Form::label(\Lang::get('settings.last')); ?>
                        <?php echo \Form::input('last', $user->profile->last, ['class' => 'form-control']); ?>
                    </div>
                    <div class="form-group form-group-icon-left">
                        <i class="fa fa-envelope input-icon"></i>
                        <?php echo \Form::label(\Lang::get('settings.username')); ?>
                        <?php echo \Form::input('username', $user->username, ['class' => 'form-control']); ?>
                    </div>
                    <div class="form-group form-group-icon-left">
                        <i class="fa fa-envelope input-icon"></i>
                        <?php echo \Form::label(\Lang::get('settings.email')); ?>
                        <?php echo \Form::input('email', $user->email, ['class' => 'form-control']); ?>
                    </div>
                    <div class="form-group form-group-icon-left"><i class="fa fa-phone input-icon"></i>
                        <?php echo \Form::label(\Lang::get('settings.cell')); ?>
                        <?php echo \Form::input('cell', $user->profile->cell, ['class' => 'form-control']); ?>
                    </div>
                    <span class="btn btn-primary pull-left" onclick="changeaccount()"><?php echo \Lang::get('settings.save_change_btn'); ?></span>
                    <?php echo Form::close(); ?>
                </div>
                <div class="col-md-4 col-md-offset-1">
                    <h4><?php echo \Lang::get('settings.change_password_title'); ?></h4>
                    <?php echo Form::open(['id' => 'change_password']); ?>
                    <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                        <?php echo \Form::label(\Lang::get('settings.current_password')); ?>
                        <?php echo \Form::password('password', '**********', ['class' => 'form-control']); ?>
                    </div>
                    <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                        <?php echo \Form::label(\Lang::get('settings.new_password')); ?>
                        <?php echo \Form::password('new_password', null, ['class' => 'form-control']); ?>
                    </div>
                    <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                        <?php echo \Form::label(\Lang::get('settings.new_password_again')); ?>
                        <?php echo \Form::password('re_new_password', null, ['class' => 'form-control']); ?>
                    </div>
                    <span class="btn btn-primary pull-left" onclick="changePass()"><?php echo \Lang::get('settings.change_password_btn'); ?></span>
                    <?php echo Form::close(); ?>
                </div>

                <div class="col-md-12">
                    <hr/>
                    <h4><?php echo \Lang::get('settings.account_info_label'); ?></h4>
                    <?php
                    if ($fields = \Acl\Fields::user_profile_fields()):
                        echo $fields;
                    else:
                        echo \Lang::get('settings.no_fields');
                    endif;
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>