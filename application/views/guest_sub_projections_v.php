 <?php
if(empty($error_message))
{
	if(!empty($projection_row))
	{
	?>
		<div class="contact_area">
			<div class="container">
				<form id="projection_form" name="projection_form" method="" action="">
					<div class="col-md-12 content" id="projection_data"></div>
				</form>
			</div>
		</div>
	<?php
	}
	else
	{
	?>
		<div class="contact_area">
			<div class="container">
				<p class="alert alert-danger">Please select valid record</p>
			</div>
		</div>
	<?php
	}
}
else
{
?>
	<div class="contact_area">
		<div class="container">
			<p class="alert alert-danger"><?php echo $error_message;?></p>
		</div>
	</div>
<?php
}
?>
