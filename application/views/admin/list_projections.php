<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">

          <div class="row">
             <div class="col-md-6">
                <h2> Manage Projections </h2>
             </div>
             <div class="col-md-6 mb-md-3">
                 <!-- <a href="<?php echo base_url(); ?>admin/coupons/add"><button class="btn btn-danger  round btn-glow px-2 float-right" type="button"  aria-haspopup="true" aria-expanded="false">Add</button></a> -->
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
								<th > Title</th>
                <th> User </th>
								<th > Projection Status</th>
								
								<th> Created Date</th>
								 
							</tr>
							</thead>
							<tbody>
              
              <?php $i=1; foreach($projections as $p){  ?>
							<tr id="company_<?php echo $p->projection_id; ?>" class="odd gradeX">
						      
								<td>
								
								<?php echo $i; ?>
								
								</td>
							  
								<td>
                    <?php echo $p->projection_name; ?>
								</td>

                <td>
                    <?php echo $p->username; ?>
                </td>

								<td>
                    <?php echo $p->projection_status; ?>
                </td>
                
                

                <td>
                    <?php echo date('Y-m-d', $p->add_date); ?>
                </td>
               

							</tr>
						     <?php $i++; } ?>
						
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
                $('#company_'+id).remove();
              }else{
                $("#err_text").text("Something went wrong!");
              }
           });
		
}

</script>
