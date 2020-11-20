<?php $ci=& get_instance();?>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
               	<th width="10%">Sr#/th>
                <th>Sr</th>
              </tr>
        </thead>
        <tbody>
            <?php	
            if(!empty($results))
            {
                $counter = 0;
                foreach($results as $val)
                {
                    $counter++;
                    $record_number = $counter+$start;
                 ?>
                    <tr>
                        <td><?php echo $record_number;?></td>
                     </tr>
                <?php
                }
            }
            else
            {
                echo '<tr><td colspan="7" class="danger text-center font-weight-bold">No Record Found!</td></tr>';
            }
            ?>
        </tbody> 
    </table>
</div>
<?php	
if(!empty($total_pages) && !empty($results))
{
	if($total_pages>1)
	{
	?>
		<nav aria-label="Page navigation">
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" href="javascript:;" onclick="get_Previous('load_js_companies','0')" aria-label="Previous">&laquo;</a>
				</li>
				<?php
				for($i=1;$i<=$total_pages;$i++)
				{
					if($i== $page_number)
					{
					?>
						<li class="page-item active">
							<a class="page-link" id="pagination-active" href="#<?php echo $i;?>" onclick="load_js_companies('<?php echo $i;?>')"><?php echo $i;?></a>
						</li>
					<?php	
					}
					else
					{
					?>
						<li class="page-item">
							<a class="page-link" href="#<?php echo $i;?>" onclick="load_js_companies('<?php echo $i;?>')"><?php echo $i;?></a>
						</li>
					<?php
					}
				}
				?>
				<li class="page-item">
					<a class="page-link" href="javascript:;" onclick="get_Next('<?php echo $total_pages;?>','load_js_companies','0')" aria-label="Next">&raquo;</a>
				</li>
			</ul>
		</nav>
	<?php
	}
}
?>
