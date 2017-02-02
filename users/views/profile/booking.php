<div class="container">
    <h1 class="page-title"><?php echo Lang::get('booking_history'); ?></h1>
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
            <div class="checkbox">
                <label>
                    <input class="i-check" type="checkbox" />Show only current trip
                </label>
            </div>
            <table class="table table-bordered table-striped table-booking-history">
                <thead>
                    <tr>
                        <th><?php echo Lang::get('type'); ?></th>
                        <th><?php echo Lang::get('title'); ?></th>
                        <th><?php echo Lang::get('location'); ?></th>
                        <th><?php echo Lang::get('order_date'); ?></th>
                        <th><?php echo Lang::get('execution_date'); ?> </th>
                        <th><?php echo Lang::get('cost'); ?></th>
                        <th><?php echo Lang::get('current'); ?></th>
                        <th><?php echo Lang::get('cancel'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="booking-history-type"><i class="fa fa-plane"></i><small><?php echo Lang::get('flight'); ?></small>
                        </td>
                        <td class="booking-history-title">London to New York City</td>
                        <td>New york City</td>
                        <td>4/12/2014</td>
                        <td>4/25/2014</td>
                        <td>$350</td>
                        <td class="text-center"><i class="fa fa-check"></i>
                        </td>
                        <td class="text-center"><a class="btn btn-default btn-sm" href="#"><?php echo Lang::get('cancel'); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="booking-history-type"><i class="fa fa-building-o"></i><small><?php echo Lang::get('hotel'); ?></small>
                        </td>
                        <td class="booking-history-title">InterContinental New York Barclay</td>
                        <td>New york City</td>
                        <td>4/12/2014</td>
                        <td>4/25/2014 <i class="fa fa-long-arrow-right"></i> 4/30/2014</td>
                        <td>$1200</td>
                        <td class="text-center"><i class="fa fa-check"></i>
                        </td>
                        <td class="text-center"><a class="btn btn-default btn-sm" href="#"><?php echo Lang::get('cancel'); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="booking-history-type"><i class="fa fa-dashboard"></i><small><?php echo Lang::get('car'); ?></small>
                        </td>
                        <td class="booking-history-title">Maserati GranTurismo</td>
                        <td>New york City</td>
                        <td>4/12/2014</td>
                        <td>4/25/2014 <i class="fa fa-long-arrow-right"></i> 4/30/2014</td>
                        <td>$500</td>
                        <td class="text-center"><i class="fa fa-check"></i>
                        </td>
                        <td class="text-center"><a class="btn btn-default btn-sm" href="#"><?php echo Lang::get('cancel'); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="booking-history-type"><i class="fa fa-bolt"></i><small><?php echo Lang::get('activity'); ?></small>
                        </td>
                        <td class="booking-history-title">Central Park Trip</td>
                        <td>New york City</td>
                        <td>4/12/2014</td>
                        <td>4/27/2014</td>
                        <td>$0</td>
                        <td class="text-center"><i class="fa fa-check"></i>
                        </td>
                        <td class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="booking-history-type"><i class="fa fa-bolt"></i><small><?php echo Lang::get('activity'); ?></small>
                        </td>
                        <td class="booking-history-title">Music Festival</td>
                        <td>New york City</td>
                        <td>4/12/2014</td>
                        <td>4/28/2014</td>
                        <td>$100</td>
                        <td class="text-center"><i class="fa fa-check"></i>
                        </td>
                        <td class="text-center"><a class="btn btn-default btn-sm" href="#"><?php echo Lang::get('cancel'); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="booking-history-type"><i class="fa fa-bolt"></i><small><?php echo Lang::get('activity'); ?></small>
                        </td>
                        <td class="booking-history-title">Adrenaline Madness</td>
                        <td>New york City</td>
                        <td>4/12/2014</td>
                        <td>4/29/2014</td>
                        <td>$210</td>
                        <td class="text-center"><i class="fa fa-check"></i>
                        </td>
                        <td class="text-center"><a class="btn btn-default btn-sm" href="#"><?php echo Lang::get('cancel'); ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="booking-history-type"><i class="fa fa-plane"></i><small><?php echo Lang::get('flight'); ?></small>
                        </td>
                        <td class="booking-history-title">London to Bali</td>
                        <td>Bali</td>
                        <td>2/12/2014</td>
                        <td>2/20/2014</td>
                        <td>$500</td>
                        <td class="text-center"><i class="fa fa-times"></i>
                        </td>
                        <td class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="booking-history-type"><i class="fa fa-home"></i><small><?php echo Lang::get('rental'); ?></small>
                        </td>
                        <td class="booking-history-title">Modern Chic 3BR Villa Fanisa</td>
                        <td>Bali</td>
                        <td>2/12/2014</td>
                        <td>2/20/2014 <i class="fa fa-long-arrow-right"></i> 2/23/2014</td>
                        <td>$800</td>
                        <td class="text-center"><i class="fa fa-times"></i>
                        </td>
                        <td class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="booking-history-type"><i class="fa fa-plane"></i><small><?php echo Lang::get('flight'); ?></small>
                        </td>
                        <td class="booking-history-title">London to San Fancisco</td>
                        <td>San Fancisco</td>
                        <td>1/01/2014</td>
                        <td>1/05/2014</td>
                        <td>$423</td>
                        <td class="text-center"><i class="fa fa-times"></i>
                        </td>
                        <td class="text-center"></td>
                    </tr>
                    <tr>
                        <td class="booking-history-type"><i class="fa fa-building-o"></i><small><?php echo Lang::get('hotel'); ?></small>
                        </td>
                        <td class="booking-history-title">Wellington Hotel</td>
                        <td>San Fancisco</td>
                        <td>1/01/2014</td>
                        <td>1/05/2014 <i class="fa fa-long-arrow-right"></i> 1/15/2014</td>
                        <td>$850</td>
                        <td class="text-center"><i class="fa fa-times"></i>
                        </td>
                        <td class="text-center"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
