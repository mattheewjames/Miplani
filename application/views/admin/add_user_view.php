
<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0 d-inline-block">Add User</h3>
          
        </div>
        <div class="content-header-right col-md-6 col-12">
        </div>
      </div>
      <div class="content-body">
        <section id="basic-form-layouts">
             
             
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
             
             
          
          <div class="row match-height">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                    <h4 class="card-title form-section">Information</h4>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <form method="post" class="form" action="<?php echo base_url(); ?>admin/users/do_add_user" enctype="multipart/form-data">
                    
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput1">First Name </label>
                              
                              <input type="text" name="first_name" class="form-control border-primary" value="" placeholder="First Name" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput2">Last Name</label>
                              <input type="text" name="last_name" class="form-control border-primary" value="" placeholder="Last Name" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput2">Username</label>
                              <input type="text" name="username" class="form-control border-primary" value="" placeholder="Username" required>
                            </div>
                          </div>
                        

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput3">Email Address</label>
                              <input type="email" name="user_email" class="form-control border-primary" value="" placeholder="Email Address" required>
                            </div>
                          </div>

                        </div>

                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput3">Password</label>
                              <input type="password" name="password" minlength="6" class="form-control border-primary" value="" placeholder="Passworrd" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput3">Confirm Password</label>
                              <input type="password" name="cpassword" minlength="6" class="form-control border-primary" value="" placeholder="Confirm Password" required>
                            </div>
                          </div>
                        </div>


                       
						<div class="col-md-12 text-right">
							<button type="submit" class="btn btn-primary">
							Add User
							</button>
                        </div>

              </div>
            </div>
              </div>
        </section>
      </div>
    </div>
  </div>
  

