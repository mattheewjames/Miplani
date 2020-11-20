<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$ci=&get_instance(); 
?>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted font-weight-bold">Total Users</h6>
                                        <h3><?php echo $total_users;?></h3>
                                    </div>
                                    <div class="align-self-center"><i class="la la-users info font-large-2 float-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted font-weight-bold">Total Projections</h6>
                                        <h3><?php echo $total_projections;?></h3>
                                    </div>
                                    <div class="align-self-center"><i class="ficon ft-mail warning font-large-2 float-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted font-weight-bold">Total Earning</h6>
                                        <h3><?php echo $total_earning;?> &euro;</h3>
                                    </div>
                                    <div class="align-self-center"><i class="la la-money primary font-large-2 float-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
      </div>
</div>