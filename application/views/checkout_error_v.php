  <div class="unlimited_services" id="pricing-plan">
	<div class="container">
	<div class="col-md-12 text-center"><h1>404</h1></div>
	</div>
</div>
<?php
if(!empty($error_message))
{
?>
	<div class="header_bottom bottom_two" id="bottom-header">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-12 row m-0 p-0 mb-2">
					<div class="register-btns"><p style="font-size:24px;"><?php echo $error_message;?></p></div>
				</div> 
			</div>
		</div>
	</div>
<?php  
}
else
{
?>
	<div class="header_bottom bottom_two" id="bottom-header">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-12 row m-0 p-0 mb-2">
					<div class="register-btns"><p style="font-size:24px;">We are sorry, you are trying to access invalid page</p></div>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>
	 