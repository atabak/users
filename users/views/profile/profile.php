<div class="container">
    <h1 class="page-title"><?php echo Lang::get('profile_main_page_title'); ?></h1>
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
            <h4><?php echo Lang::get('total_traveled'); ?></h4>
            <ul class="list list-inline user-profile-statictics mb30">
                <li>
                    <i class="fa fa-dashboard user-profile-statictics-icon"></i>
                    <h5>12540</h5>
                    <p><?php echo Lang::get('miles'); ?></p>
                </li>
                <li>
                    <i class="fa fa-globe user-profile-statictics-icon"></i>
                    <h5>2%</h5>
                    <p><?php echo Lang::get('world'); ?></p>
                </li>
                <li>
                    <i class="fa fa-building-o user-profile-statictics-icon"></i>
                    <h5>15</h5>
                    <p><?php echo Lang::get('cityes'); ?></p>
                </li>
                <li>
                    <i class="fa fa-flag-o user-profile-statictics-icon"></i>
                    <h5>3</h5>
                    <p><?php echo Lang::get('countries'); ?></p>
                </li>
                <li>
                    <i class="fa fa-plane user-profile-statictics-icon"></i>
                    <h5>20</h5>
                    <p><?php echo Lang::get('trips'); ?></p>
                </li>
            </ul>
            <div id="map-canvas" style="width:100%; height:400px;"></div>
        </div>
    </div>
</div>