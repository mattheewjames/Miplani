<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!empty($results))
{
?>
	<div class="row">
		<?php
		foreach($results as $val)
		{
		?>
			<div class="col-md-6">
				<div class="single_testimonial">
					<p><?php echo $val->review_details;?></p>
					<span class="name"><?php echo $val->name;?></span>
					<div class="product_ratting" >
						<ul>
							<?php
							for($i=0;$i<$val->rating;$i++)
							{
							?>
								<li><a href="javascript:;"><i class="fa fa-star"></i></a></li>
							<?php
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		<?php
		}
		?>
	</div>
	<?php
	if($total_pages>1)
	{
	?>
		<div class="col-md-12 text-center">
			<div class="pagination">
				<ul>
					<li>
						<a class="page-link" href="javascript:;" onclick="get_Previous('load_ajax_reviews','0')" aria-label="Previous">&laquo;</a>
					</li>
					<?php
					for($i=1;$i<=$total_pages;$i++)
					{
						if($i== $page_number)
						{
						?>
							<li class="current"><a id="pagination-active" href="#<?php echo $i;?>" onclick="load_ajax_reviews('<?php echo $i;?>','0')"><?php echo $i;?></a></li>
						<?php
						}
						else
						{
						?>
							<li><a href="javascript:;" onclick="load_ajax_reviews('<?php echo $i;?>','0')"><?php echo $i;?></a></li>
						<?php
						}
					}
					?>
					<li class="page-item">
						<a class="page-link" href="javascript:;" onclick="get_Next('<?php echo $total_pages;?>','load_ajax_reviews','0')" aria-label="Next">&raquo;</a>
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
