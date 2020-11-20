  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-2">
          <div class="row">
             <div class="col-md-6">
                <h2>Add Coupon</h2>
             </div>
             <div class="col-md-6 mb-md-3">
                 <a href="<?php echo base_url(); ?>admin/coupons"><button class="btn btn-danger  round btn-glow px-2 float-right" type="button"  aria-haspopup="true" aria-expanded="false">Back</button></a>
             </div>
          </div>
        </div>
      </div>
      <div class="content-body">

			<section id="dropzone-examples">
                      <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"></h4>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">

							<form class="form-horizontal" id="add_user" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/coupons/add_process" role="form">
                          		       
                                  <div class="form-body">

									  <?php if($this->session->flashdata('error')){ ?>
										 <div class="alert alert-block  alert-danger form-group col-md-9">
											  <strong></strong> <?php echo $this->session->flashdata('error'); ?>
										  </div>

									   <?php } ?>

									   <?php if($this->session->flashdata('success')){ ?>
										 <div class="alert alert-block  alert-success form-group col-md-9">
											  <strong></strong> <?php echo $this->session->flashdata('success'); ?>
										  </div>

									   <?php } ?>

										<div class="form-group">  
											<label class="col-md-3 control-label">Coupon Code</label>
											<div class="col-md-9">
											<input type="text" id="coupon_code" name="coupon_code" class="form-control"  required="true">
											</div>
										</div>
										<div class="form-group">  
											<label class="col-md-3 control-label">Frequency</label>
											<div class="col-md-9">
											<input type="number" min="1" id="frequency" name="frequency" class="form-control"  required="true">
											</div>
										</div>
										<div class="form-group">  
											<label class="col-md-3 control-label" >Discount (Percentage)</label>
											<div class="col-md-9">
												<input type="number" id="coupon_discount_amount" class="form-control" name="coupon_discount_amount" min="1" max="99" maxlength="3" required="true">
											</div>
										</div>
										<div class="form-group">  
											<label class="col-md-3 control-label" >Start Date</label>
											<div class="col-md-9">
												<input type="date" name="start_date" id="start_date" class="form-control" required="true">
											</div>
										</div>
										<div class="form-group">  
											<label class="col-md-3 control-label" >Expiry Date</label>
											<div class="col-md-9">
												<input type="date" name="expiry_date" id="expiry_date" class="form-control" required="true">
											</div>
										</div>
										</div>  
                                        </div>
                                    </div>

                                    
                                    <div class="">
                                        <div class="row">
                                            <div class="col-md-9">
                                            <button type="submit" class="btn btn-primary" style="float: right;">Add</button>
                                            </div>
                                            
                                        </div>
                                    </div>

								</div>
								
							</form>
						
                            </div>
                </div>
              </div>
            </div>
          </div>
         
        </section>
                        </div>
    
  
  
       </div>
                  
        
</div>
