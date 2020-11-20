<?php //$this->load->view("admin/include/header"); ?>

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">

          <div class="row">
             <div class="col-md-6">
                <h2> Manage Users </h2>
             </div>
             <div class="col-md-6 mb-md-3">
                 <a href="<?php echo base_url(); ?>admin/users/add_user"><button class="btn btn-primary  round btn-glow px-2 float-right" type="button"  aria-haspopup="true" aria-expanded="false">Add</button></a>
             </div>
          </div>
          
       
        
      <div class="content-body">

        <section id="horizontal">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">

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

                    <table class="table display nowrap table-striped zero-configuration">
                      <thead>
                        <tr>
                          <!-- <th>S.No</th> -->
                          <th >Full Name</th>
						  <th >Last Name</th>
						  <th >Username</th>
                          <th >Email</th>
                          <th style="width: 30%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        
						<?php $i=1; foreach($users as $user){ ?>
						
							<tr id="user_<?php echo $user->user_id; ?>">
							  <!-- <td> <?php //echo $i; ?> </td> -->
                			  <td><?php echo $user->first_name; ?></td>
							  <td> <?php echo $user->last_name; ?> </td>
							  <td> <?php echo $user->username; ?> </td>
							  <td><?php echo $user->user_email; ?></td>
							  
							  <td>

							  	
								 <span id="block_<?php echo $user->user_id; ?>">

								 <?php if($user->user_status == 'active') { ?>
								  	<a id="status_<?php echo $user->user_id; ?>" style="color: white" onclick="block_user('<?php echo $user->user_id; ?>', '<?php echo $user->user_status; ?>')" class="btn btn-primary" data-toggle="tooltip" title="Block User"> Block </a>
								 <?php }else{ ?>
									<a id="status_<?php echo $user->user_id; ?>" style="color: white" onclick="block_user('<?php echo $user->user_id; ?>', '<?php echo $user->user_status; ?>')" class="btn btn-danger" data-toggle="tooltip" title="Activate User"> Activate </a>
								 <?php } ?>

								 </span>
								 <a style="color: white" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Edit" href="<?php echo base_url(); ?>admin/users/view_user_management/<?php echo $user->user_id; ?>">Edit</a>
								 <a style="color: white"onclick="delete_user('<?php echo $user->user_id; ?>')" class="btn btn-danger btn-xs" id="cancel-button" title="Delete">Delete</a>
							  </td>
							</tr>
						
						
						<?php $i++; } ?>
						
						
						<script>
						
						function block_user(user_id, status){
							
							var new_status = 'active';
							var new_text = 'Block';
							var new_class = 'btn-primary';
							if(status == 'active'){
								new_status = 'block';
								new_text = 'Activate';
								new_class = 'btn-danger';
							}
							
							$.ajax({
								url:"<?php echo base_url(); ?>admin/users/update_user_status",
								type: "POST",
								data:{"user_id": user_id, 'new_status': new_status},
								success:function(resp)
								{
									if(resp == 'success'){
										$("#status_"+user_id).text(new_status);
										
										
										var params = "'"+user_id+"',"+"'"+new_status+"'";

										$("#block_"+user_id).html('');
										$("#block_"+user_id).html('<a style="color: white" onclick="block_user('+params+')" class="btn '+new_class+' btn-xs" data-toggle="tooltip" title="'+new_text+' User"> '+new_text+'</a>');
										
										alert('User is '+new_status+' Now');
										// $("#suc_text").text('User is '+new_status+' Now');
										// $("#SuccessModal").modal('show');
									}else{
										alert("Somthing went wrong!");
										// $("#err_text").text("Somthing went wrong!");
										// $("#ErrorModal").modal('show');
									}
								}
							});
						}
						
						function delete_user(id){
							
							if(confirm("Are you sure to delete this user?")){
								
								$.ajax({
									url:"<?php echo base_url(); ?>admin/users/delete_user",
									type: "POST",
									data:{"id": id},
									success:function(resp)
									{
										if(resp == 'success'){
											$("#user_"+id).remove();
										}else{
											alert("Somthing went wrong!");
											// $("#err_text").text("Somthing went wrong!");
											// $("#ErrorModal").modal('show');
										}
									}
								});
								
							}
							
							
						}
						
						</script>
						
						
        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
       
      </div>
    </div>
  </div>
    </div>
  
  

