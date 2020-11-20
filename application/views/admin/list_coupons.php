<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">

          <div class="row">
             <div class="col-md-6">
                <h2> Manage Coupons </h2>
             </div>
             <div class="col-md-6 mb-md-3">
                 <a href="<?php echo base_url(); ?>admin/coupons/add"><button class="btn btn-danger  round btn-glow px-2 float-right" type="button"  aria-haspopup="true" aria-expanded="false">Add</button></a>
             </div>
          </div>
          
       
        
      <div class="content-body">
        <section id="horizontal">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
						<table class="table display nowrap table-striped zero-configuration" >
							<thead>
							<tr>								
								<th> SNo</th>
								<th> Code</th>
								<th> Discount</th>
								<th> Start Date</th>
								<th> Expiry Date</th>
								<th> Frequency</th>
								<th> Action</th>
							</tr>
							</thead>
							<tbody>
                            <?php 
							if(!empty($coupons))
							{
								$i=0; 
								foreach($coupons as $c)
								{  
									$i++; 
									$exp_class = 'success';
									$start_class = '';
									if($c->coupon_expiry_date<time())
									{
										$exp_class = 'danger';
									}
									if(time()<=$c->coupon_start_date)
									{
										$start_class = 'info';
									}
									?>
									<tr id="coupon_<?php echo $c->coupon_id;?>" class="odd gradeX">
										<td><?php echo $i;?></td>
										<td><?php echo $c->coupon_code; ?></td>
										<td><?php echo $c->coupon_discount_amount;?>%</td>
										<td  class="<?php echo $start_class;?>"><?php echo date('Y-m-d', $c->coupon_start_date); ?></td>
										<td class="<?php echo $exp_class;?>"><?php echo date('Y-m-d', $c->coupon_expiry_date); ?></td>
										<td><?php echo $c->frequency; ?></td>
										<td>
											<a style="color: white" onclick="del_company('<?php echo $c->coupon_id;?>')" class="btn btn-danger btn-xs ">Delete</a>
										</td>
									</tr>
								 <?php 
								}  
							}
							else
							{
							?>
								<tr><td colspan="7" class="red" align="center">No Record Found!</td></tr>
							<?php
							}
						?>
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


<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {       
  $('#sample_1').dataTable({
	});
});


function del_company(id){
		
		if (confirm("Delete this coupon! Are you sure?") == false) {
                return;
		}
		
           $.post("<?php echo base_url(); ?>admin/coupons/delete_coupon/",{id:id},function(data)
           { 
              if(data == 'success'){
                $('#coupon_'+id).remove();
              }else{
                $("#err_text").text("Something went wrong!");
              }
           });
		
}

</script>
