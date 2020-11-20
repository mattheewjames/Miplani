<div class="unlimited_services" id="pricing-plan">
	<div class="container">
		<div class="col-md-12 text-center"><h1>WRITE A REVIEW</h1></div>
	</div>
</div>
<!-- my account start  -->
<section class="main_content_area">
	<div class="container">
		<div class="account_dashboard">
		<?php
		if(!empty($this->session->userdata('MiPlani_user_id')))
		{	
		?>
			<form class="form" action="" name="list_form_data" id="list_form_data" method="post" enctype="multipart/form-data" novalidate>
				<div class="row">
					<ul class="col-md-12 alert alert-danger" id="list_error_div" style="display: none;"></ul>
					<div class="col-md-12 alert alert-success" id="list_success_div" style="display: none;"></div>
					<div class="col-sm-12 col-md-12 col-lg-12 p-0">
						<div class="col-md-12">
							<div class="col-md-12 row p-0">
								<div class="col-md-7 text-left">
									 <h5 class="fs-17 fw-600">How would you rate this product overall?</h5>
										<div class="inner-content">
											<input type="radio" name="rating" id="star5" value="5">
											<label for="star5"><i class="fa fa-star"></i></label>

											<input type="radio" name="rating" id="star4" value="4">
											<label for="star4"><i class="fa fa-star"></i></label>

											<input type="radio" name="rating" id="star3" value="3">
											<label for="star3"><i class="fa fa-star"></i></label>

											<input type="radio" name="rating" id="star2" value="2">
											<label for="star2"><i class="fa fa-star"></i></label>

											<input type="radio" name="rating" id="star1" value="1">
											<label for="star1"><i class="fa fa-star"></i></label>
										</div>
								</div>
							</div>
							 <p>
								<label  class="fw-600">Write a review<span>*</span></label>
								<textarea class="form-control" id="review" name="review" rows="5"></textarea>
							</p>
							<div class="col-md-12 text-center mt-5">
								<button id="ilist_form_btn" name="ilist_form_btn" type="submit" class="print-btn" onClick="form_data_validation('<?php echo base64_encode(10);?>','review','list');">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		<?php
		}
		else
		{
		?>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 p-0">
					<div class="col-md-12">
						<ul class="col-md-12 alert alert-danger">After Sigin or signup please refrsh page to write review</ul>
						<div class="col-md-12 row p-0">
							<div class="col-md-7 text-left">
								 <h5 class="fs-17 fw-600">How would you rate this product overall?</h5>
									<div class="inner-content">
										<input type="radio" name="rating" id="star1" value="1" disabled>
										<label for="star1"><i class="fa fa-star"></i></label>

										<input type="radio" name="rating" id="star2" value="2" disabled>
										<label for="star2"><i class="fa fa-star"></i></label>

										<input type="radio" name="rating" id="star3" value="3" disabled>
										<label for="star3"><i class="fa fa-star"></i></label>

										<input type="radio" name="rating" id="star4" value="4" disabled>
										<label for="star4"><i class="fa fa-star"></i></label>

										<input type="radio" name="rating" id="star5" value="5" disabled>
										<label for="star5"><i class="fa fa-star"></i></label>
									</div>
							</div>
						</div>
						 <p>
							<label  class="fw-600">Write a review<span>*</span></label>
							<textarea class="form-control" rows="5" disabled></textarea>
						</p>
						<div class="col-md-12 text-center mt-5">
							<div class="register-btns">
								<a target="_blank" class="button" id="signup-btn" href="<?php echo base_url('users/SignUp');?>">Sign Up</a>
								<a target="_blank" class="button" id="signin-btn" href="<?php echo base_url('users/SignIn');?>">Sign In</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		?>
		</div>
	</div>
</section>