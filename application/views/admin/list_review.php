
<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">

          <div class="row">
             <div class="col-md-6">
                <h2> Manage Reviews </h2>
             </div>
             <div class="col-md-6 mb-md-3">
                 <!-- <a href="<?php echo base_url(); ?>admin/reviews/add"><button class="btn btn-danger  round btn-glow px-2 float-right" type="button"  aria-haspopup="true" aria-expanded="false">Add</button></a> -->
             </div>
          </div>
          
       
        
      <div class="content-body">

        <section id="horizontal">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">

				  
						<table class="table display table-striped zero-configuration" >
							<thead>
							<tr>								
								 <th> SNo</th>
                 <th >User</th>
                 <th> Rating</th>
                 <th style="width: 40%"> Description</th>
								 <th> Created At</th>
								 
                  <th style="100px !important; padding:5px;"> Action</th>
							</tr>
							</thead>
							<tbody>
              
              <?php $i=1; foreach($reviews as $row){  ?>
                    <tr id="company_<?php echo $row->review_id; ?>" class="odd gradeX">
                        
                      <td>
                      
                      <?php echo $i; ?>
                      
                      </td>

                      <td >
                        <?php echo $row->first_name.' '.$row->last_name; ?>
                      </td>
                      
                      <td>
                        <?php echo $row->rating; ?>
                      </td>

                      <td style="width: 40%">
                        <?php echo $row->review_details; ?>
                      </td>

                      <td>
                        
                      <?php echo date('Y-m-d', $row->review_date); ?> 
                      </td>
                      
                    
                      <td class="center" style="">
                            <a  onclick="del_company(<?php echo $row->review_id; ?>)" style="color: white" class="btn btn-danger btn-xs">Delete</a>
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


function del_company(review_id){
		
		if (confirm("Delete this record! Are you sure?") == false) {
                return;
		}
		
      $.post("<?php echo base_url(); ?>admin/reviews/delete_review/",{review_id:review_id},function(data)
      { 
          if(data == 'success'){
            $('#company_'+review_id).remove();
          }else{
            alert("something went wrong");
          }
      });
		
}

</script>
 
