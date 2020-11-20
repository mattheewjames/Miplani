<?php defined('BASEPATH') OR exit('No direct script access allowed');?> 
<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center info font-weight-bold">
                  	<a href="<?php echo base_admin_url("login");?>"><img src="<?php echo base_admin_url("app-assets/images/logo/logo.png");?>" width="150" /></a>
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-weight-bold pt-2"><span>Reset Password</span></h6>
                  
                </div>
                <div class="card-content">
                  <div class="card-body">
					<?php
                    if(empty($error_message))
                    {
                    ?>
                        <ul class="col-12 alert alert-danger" id="error_div" style="display:none;"></ul>
                        <ul class="col-12 alert alert-success" id="success_div" style="display:none;"></ul>
                        <form class="form-horizontal" name="form_data" id="form_data" action=""  method="post" novalidate>
                           <fieldset class="form-group position-relative has-icon-left">
                            <input type="text" class="form-control input-lg" name="email" id="email" placeholder="Enter Email">
                            <div class="form-control-position"><i class="ft-user"></i></div>
                            <div class="help-block font-small-3"></div>
                          </fieldset>	
                          <fieldset class="form-group position-relative has-icon-left">
                            <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Enter new password" tabindex="1" onkeypress="return RestrictSpace();">
                            <div class="form-control-position"><i class="ft-lock"></i></div>
                            <div class="help-block font-small-3"></div>
                          </fieldset>
                          <fieldset class="form-group position-relative has-icon-left">
                            <input type="password" class="form-control input-lg" name="cpassword" id="cpassword" placeholder="Confirm new password" tabindex="2" onkeypress="return RestrictSpace();">
                            <div class="form-control-position"><i class="ft-lock"></i></div>
                            <div class="help-block font-small-3"></div>
                          </fieldset>
                          <?php
                          if(!empty($data_link))
                          {
                          ?>
                              <input type="hidden" id="data_link" name="data_link" value="<?php echo $data_link;?>" />
                          <?php
                          }
                          ?>
                          <button type="submit" name="reset_password_btn" id="reset_password_btn" class="btn btn-info btn-block btn-lg mt-3"><i class="ft-unlock"></i>  Reset Password</button>
                          <div class="clearfix"></div>
                          <div class="form-group row mt-1">
                            <div class="col-md-6 col-12 text-center text-md-left">&nbsp;</div>
                            <div class="col-md-6 col-12 text-center text-md-right"><a href="<?php echo base_admin_url("login");?>" class="card-link"><i class="ft-arrow-left"></i> Back to Login</a></div>
                          </div>
                        </form>
                    <?php
					}
					else
					{
					?>
                    	<div class="col-12 alert alert-danger"><?php echo $error_message;?></div>
                        <div class="clearfix"></div>
                        <div class="form-group row mt-1">
                    	<div class="col-md-6 col-12 text-center text-md-left">&nbsp;</div>
                    	<div class="col-md-6 col-12 text-center text-md-right"><a href="<?php echo base_admin_url("login");?>" class="card-link"><i class="ft-arrow-left"></i> Back to Login</a></div>
                    </div>
                    <?php	
					}
					?>
                   </div>
                </div>
               </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
