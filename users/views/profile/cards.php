<div class="container">
    <h1 class="page-title"><?php echo Lang::get('debit_cards'); ?></h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <aside class="user-profile-sidebar">
                <div class="user-profile-avatar text-center">
                    <img src="img/300x300.png" alt="Image Alternative text" title="AMaze" />
                    <h5>John Doe</h5>
                    <p>Member Since May 2012</p>
                </div>
                <ul class="list user-profile-nav">
                    <?php echo $side_menu; ?>
                </ul>
            </aside>
        </div>
        <div class="col-md-9">
            <div class="mfp-with-anim mfp-hide mfp-dialog" id="edit-card-dialog">
                <h3 class="mb0"><?php echo Lang::get('edit_card'); ?></h3>
                <p>Visa XXXX XXXX XXXX 1234</p>
                <form class="cc-form">
                    <div class="clearfix">
                        <div class="form-group form-group-cc-number">
                            <label><?php echo Lang::get('card_number'); ?></label>
                            <input class="form-control" placeholder="xxxx xxxx xxxx xxxx" type="text" /><span class="cc-card-icon"></span>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="form-group form-group-cc-name">
                            <label><?php echo Lang::get('cardholder_name'); ?></label>
                            <input class="form-control" value="John Doe" type="text" />
                        </div>
                        <div class="form-group form-group-cc-date">
                            <label><?php echo Lang::get('valid_thru'); ?></label>
                            <input class="form-control" placeholder="mm/yy" type="text" />
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input class="i-check" type="checkbox" /><?php echo Lang::get('set_as_primary'); ?></label>
                    </div>
                    <ul class="list-inline">
                        <li>
                            <input class="btn btn-primary" type="submit" value="<?php echo Lang::get('edit_card'); ?>" />
                        </li>
                        <li>
                            <button class="btn btn-primary"><i class="fa fa-times"></i><?php echo Lang::get('remove_card'); ?> </button>
                        </li>
                    </ul>
                </form>
            </div>
            <div class="mfp-with-anim mfp-hide mfp-dialog" id="new-card-dialog">
                <h3><?php echo Lang::get('new_card'); ?></h3>
                <form class="cc-form">
                    <div class="clearfix">
                        <div class="form-group form-group-cc-number">
                            <label><?php echo Lang::get('card_number'); ?></label>
                            <input class="form-control" placeholder="xxxx xxxx xxxx xxxx" type="text" /><span class="cc-card-icon"></span>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="form-group form-group-cc-name">
                            <label><?php echo Lang::get('cardholder_name'); ?></label>
                            <input class="form-control" value="John Doe" type="text" />
                        </div>
                        <div class="form-group form-group-cc-date">
                            <label><?php echo Lang::get('valid_thru'); ?></label>
                            <input class="form-control" placeholder="mm/yy" type="text" />
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input class="i-check" type="checkbox" checked/><?php echo Lang::get('set_as_primary'); ?></label>
                    </div>
                    <input class="btn btn-primary" type="submit" value="<?php echo Lang::get('add_card'); ?>" />
                </form>
            </div>
            <div class="row row-wrap">
                <div class="col-md-4">
                    <div class="card-thumb">
                        <ul class="card-thumb-actions">
                            <li>
                                <a class="fa fa-pencil popup-text" href="#edit-card-dialog" rel="tooltip" data-placement="top" title="<?php echo Lang::get('edit'); ?>" data-effect="mfp-zoom-out"></a>
                            </li>
                            <li>
                                <a class="fa fa-times" href="#" rel="tooltip" data-placement="top" title="<?php echo Lang::get('remove'); ?>"></a>
                            </li>
                        </ul>
                        <p class="card-thumb-number">XXXX XXX XXXX 6058</p>
                        <p class="card-thumb-valid"><?php echo Lang::get('valid_thru'); ?> <span>3 / 16</span>
                        </p>
                        <img class="card-thumb-type" src="img/payment/american-express-curved-32px.png" alt="Image Alternative text" title="Image Title" /><small><?php echo Lang::get('cardholder_name'); ?></small>
                        <h5 class="uc">John Doe</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-thumb card-thumb-primary"><span class="card-thumb-primary-label">primary</span>
                        <ul class="card-thumb-actions">
                            <li>
                                <a class="fa fa-pencil popup-text" href="#edit-card-dialog" rel="tooltip" data-placement="top" title="<?php echo Lang::get('edit'); ?>" data-effect="mfp-zoom-out"></a>
                            </li>
                            <li>
                                <a class="fa fa-times" href="#" rel="tooltip" data-placement="top" title="<?php echo Lang::get('remove'); ?>"></a>
                            </li>
                        </ul>
                        <p class="card-thumb-number">XXXX XXX XXXX 3961</p>
                        <p class="card-thumb-valid"><?php echo Lang::get('valid_thru'); ?> <span>9 / 18</span>
                        </p>
                        <img class="card-thumb-type" src="img/payment/american-express-curved-32px.png" alt="Image Alternative text" title="Image Title" /><small><?php echo Lang::get('cardholder_name'); ?></small>
                        <h5 class="uc">John Doe</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-thumb">
                        <ul class="card-thumb-actions">
                            <li>
                                <a class="fa fa-pencil popup-text" href="#edit-card-dialog" rel="tooltip" data-placement="top" title="<?php echo Lang::get('edit'); ?>" data-effect="mfp-zoom-out"></a>
                            </li>
                            <li>
                                <a class="fa fa-times" href="#" rel="tooltip" data-placement="top" title="<?php echo Lang::get('remove'); ?>"></a>
                            </li>
                        </ul>
                        <p class="card-thumb-number">XXXX XXX XXXX 2065</p>
                        <p class="card-thumb-valid"><?php echo Lang::get('valid_thru'); ?> <span>3 / 15</span>
                        </p>
                        <img class="card-thumb-type" src="img/payment/american-express-curved-32px.png" alt="Image Alternative text" title="Image Title" /><small><?php echo Lang::get('cardholder_name'); ?></small>
                        <h5 class="uc">John Doe</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-thumb">
                        <ul class="card-thumb-actions">
                            <li>
                                <a class="fa fa-pencil popup-text" href="#edit-card-dialog" rel="tooltip" data-placement="top" title="<?php echo Lang::get('edit'); ?>" data-effect="mfp-zoom-out"></a>
                            </li>
                            <li>
                                <a class="fa fa-times" href="#" rel="tooltip" data-placement="top" title="<?php echo Lang::get('remove'); ?>"></a>
                            </li>
                        </ul>
                        <p class="card-thumb-number">XXXX XXX XXXX 9080</p>
                        <p class="card-thumb-valid"><?php echo Lang::get('valid_thru'); ?> <span>1 / 15</span>
                        </p>
                        <img class="card-thumb-type" src="img/payment/mastercard-curved-32px.png" alt="Image Alternative text" title="Image Title" /><small><?php echo Lang::get('cardholder_name'); ?></small>
                        <h5 class="uc">John Doe</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-thumb">
                        <ul class="card-thumb-actions">
                            <li>
                                <a class="fa fa-pencil popup-text" href="#edit-card-dialog" rel="tooltip" data-placement="top" title="<?php echo Lang::get('edit'); ?>" data-effect="mfp-zoom-out"></a>
                            </li>
                            <li>
                                <a class="fa fa-times" href="#" rel="tooltip" data-placement="top" title="<?php echo Lang::get('remove'); ?>"></a>
                            </li>
                        </ul>
                        <p class="card-thumb-number">XXXX XXX XXXX 3122</p>
                        <p class="card-thumb-valid"><?php echo Lang::get('valid_thru'); ?> <span>3 / 16</span>
                        </p>
                        <img class="card-thumb-type" src="img/payment/mastercard-curved-32px.png" alt="Image Alternative text" title="Image Title" /><small><?php echo Lang::get('cardholder_name'); ?></small>
                        <h5 class="uc">John Doe</h5>
                    </div>
                </div>
                <div class="col-md-4"><a class="card-thumb popup-text" href="#new-card-dialog" data-effect="mfp-zoom-out"><i class="fa fa-plus card-thumb-new"></i><p ><?php echo Lang::get('add_new_card'); ?></p></a>
                </div>
            </div>
        </div>
    </div>
</div>