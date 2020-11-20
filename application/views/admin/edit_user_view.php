
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-2">
          <div class="row">
             <div class="col-md-6">
                <h2>User Management</h2>
             </div>
             <div class="col-md-6 mb-md-3">
                 <a href="<?php echo base_url(); ?>admin/users"><button class="btn btn-success  round btn-glow px-2 float-right" type="button"  aria-haspopup="true" aria-expanded="false">Back</button></a>
             </div>
          </div>
        </div>
      </div>
      <div class="content-body">
           
                  
        <section id="dropzone-examples">
                      <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- <div class="card-header">
                  <h4 class="card-title"></h4>
                </div> -->
                <div class="card-content collapse show">
                  <div class="card-body">
                    <form method="post" action="<?php echo base_url(); ?>admin/users/update_user">
                      <div class="form-body">

					  	<?php if($this->session->flashdata('error')){ ?>
							<div class="col-12">
								<div class="alert alert-block  alert-danger">
									<button data-dismiss="alert" class="close close-sm" style="font-size: 15px;" type="button"> <i class="fa fa-times"></i> </button> <strong></strong>
									<?php echo $this->session->flashdata('error'); ?>
								</div>
							</div>
						<?php } ?>
						
						
						<?php if($this->session->flashdata('success')){ ?>
							<div class="col-12">
								<div class="alert alert-block  alert-success">
									<button data-dismiss="alert" class="close close-sm" style="font-size: 15px;" type="button"> <i class="fa fa-times"></i> </button> <strong></strong>
									<?php echo $this->session->flashdata('success'); ?>
								</div>
							</div>
						<?php } ?>
                        
						
                        <div class="row">
                            
							<div class="col-md-6">
                              <label>First Name</label>
                            	<div class="form-group half-group">
                              		<input name="first_name" type="text" class="form-control" value="<?php echo $user->first_name ?>" required>
							 		<input name="user_id" type="hidden" value="<?php echo $this->uri->segment('4'); ?>" />
						   		</div>
							</div>
							
							<div class="col-md-6">
                              <label>Last Name</label>
                            	<div class="form-group half-group">
                              		<input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>" required>
						   		</div>
                            </div>

							<div class="col-md-6">
                                <label>Username</label>
								<div class="form-group">
								<input type="text" class="form-control" name="username" value="<?php echo $user->username; ?>" required>
								</div>
							</div>
							
							
							<div class="col-md-6">
                            	<label>Email</label>
                              	<div class="form-group half-group">
                             	 <input type="text" class="form-control" name="user_email" value="<?php echo $user->user_email; ?>" readonly>
                            	</div>
                             </div>



							 
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput3">Password (Leave it blank if you do not want to change the password)</label>
                              <input type="password" name="password" minlength="6" class="form-control border-primary" value="" placeholder="Passworrd" >
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput3">Confirm Password</label>
                              <input type="password" name="cpassword" minlength="6" class="form-control border-primary" value="" placeholder="Confirm Password" >
                            </div>
                          </div>
                        
                            

						
						  <div class="col-md-12 text-right" style="margin-top: 40px">
                        <button type="submit" class="btn btn-primary">
                          <i class="la la-check-square-o"></i>Update
                        </button>
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
