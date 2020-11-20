<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!empty($results))
{
?>
	<h3><?php echo $total_comments;?> Comments </h3>  
	<?php
 	foreach($results as $val)
	{
 	?>
		<div class="comment_list">
			<div class="comment_content">
				<div class="comment_meta">
					<h5  class="m-0"><span><?php echo $val->name;?></span></h5>
					<span class="m-0"><?php echo date('M d, Y h:i:s',$val->comment_date);?></span>
				</div>
				<p><?php echo $val->comments;?></p>
			</div>
		</div>
	<?php
	}
	if($total_pages>1)
	{
	?>
		<div class="col-md-12 text-center">
			<div class="pagination">
				<ul>
					<li>
						<a class="page-link" href="javascript:;" onclick="get_projection_previous('load_projection_comments','<?php echo $id;?>','sub')" aria-label="Previous">&laquo;</a>
					</li>
					<?php
					for($i=1;$i<=$total_pages;$i++)
					{
						if($i== $page_number)
						{
						?>
							<li class="current"><a id="pagination-active" href="#<?php echo $i;?>" onclick="load_projection_comments('<?php echo $i;?>','<?php echo $id;?>','sub')"><?php echo $i;?></a></li>
						<?php
						}
						else
						{
						?>
							<li><a href="javascript:;" onclick="load_projection_comments('<?php echo $i;?>','<?php echo $id;?>','sub')"><?php echo $i;?></a></li>
						<?php
						}
					}
					?>
					<li class="page-item">
						<a class="page-link" href="javascript:;" onclick="get_projection_next('<?php echo $total_pages;?>','load_projection_comments','<?php echo $id;?>','sub')" aria-label="Next">&raquo;</a>
					</li>
				</ul>
			</div>
		</div>
	<?php
	}
}
else
{
?>
	<h3>Comments </h3>
 	<div class="comment_list">
		<div class="comment_content">
			<div class="comment_meta">
 				<span class="red">No Comment is posted!</span>
			</div>
 		</div>
	</div>
 <?php
}
?>
