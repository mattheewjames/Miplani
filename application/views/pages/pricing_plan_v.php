 <div class="priceing_table" id="pricing-home">
        <div class="container">
             <div class="row pricing-content">
                <div class="col-lg-3 col-md-6">
                    <div class="single_priceing">
                        <div class="priceing_title">
                            <h1>Freemium</h1>
                            <span class="color-white">Try for free, zero risk</span>
                        </div>
                        <div class="priceing_list">
                            <h1 class="p-0">Free</h1>
                            <p>Always</p>
                             <a href="<?php echo free_package_url();?>" id="price-btn1"><?php echo $this->lang->line('Start now');?> </a><br>
                            <span style="color: rgb(204, 153, 85);" class="btn-bottom-text">* Maximum amount allowed for simulation: &euro; 30,000</span>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_priceing">
                        <div class="priceing_title">
                            <h1>Annual</h1>
                            <span class="color-white">Per month, billed once a year</span>
                        </div>
                        <div class="priceing_list">
                            <h1><strike style="color:  grey">19.97</strike></h1>
                             <h2>&euro; 15.97</h2>
                             <p>For 12 Months</p>
                           
                            <a  href="<?php echo base_url('pages/checkout?key_id='.base64_encode('3'));?>" id="price-btn2"><?php echo $this->lang->line('Choose the annual plan');?> </a><br>
                            <span style="color: gray;" class="btn-bottom-text">* Billed at &euro; 191.64 per year.</span>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_priceing">
                        <div class="priceing_title">
                            <h1>Monthly</h1>
                            <span class="color-white">Per month, billed once a year</span>
                        </div>
                        <div class="priceing_list">
                            <h2><span>&euro; 19.97</span></h2>
                             <p>Month-to-Month</p>
                            <a href="<?php echo base_url('pages/checkout?key_id='.base64_encode('2'));?>" id="price-btn1"><?php echo $this->lang->line('Choose the monthly plan');?> </a><br>
                            <span style="color:gray;" class="btn-bottom-text">* &euro; 19.97 per month. Once / month</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single_priceing">
                        <div class="priceing_title" style="background: #4054b2 !important">
                            <h1>Lifetime</h1>
                            <span class="color-white">Unlimited software forever</span>
                        </div>
                       <div class="priceing_list">
                            <h1><strike style="color:  grey">4955</strike></h1>
                             <h2>&euro; 495</h2>
                             <p>Single Payment</p>
                           
                            <a  href="<?php echo base_url('pages/checkout?key_id='.base64_encode('4'));?>" id="price-btn2"><?php echo $this->lang->line('Choose the plan for life');?> </a><br>
                           <span style="color: gray;" class="btn-bottom-text">* Billed &euro; 495 one time.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="unlimited_services" id="gurantee-section">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 col-md-6 text-center">
				<div class="services_section_thumb">
					<img src="<?php echo base_url('WebTheme/assets/img/product/gurantee.jpg');?>" alt="">
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="unlimited_services_content text-left">
					<p><?php echo $this->lang->line('Try all the features of MIPLANiAPP   Free');?></p>
				 <h6><?php echo $this->lang->line('It is our best Satisfaction Guarantee.');?></h6>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="priceing_table mb-5" id="payment-plans">
	<div class="container">
		<div class="row ">
			<div class="col-lg-12 text-center mb-5">
				<h3><?php echo $this->lang->line('All of the following are included in payment plans');?></h3>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="single_paymentplan">
					<div class="priceing_list">
						<ul>
							<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo $this->lang->line('Unlimited financial goal');?></li>
							<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo $this->lang->line('Max. No. of years of forecast: Unlimited');?></li>
							<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo $this->lang->line('Web Traffic Report');?></li>
							<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo $this->lang->line('Option to save reports');?></li>
						</ul>
					</div>

				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="single_paymentplan colored-plan" style="background-image: url(<?php echo base_url('WebTheme/assets/img/product/payment-planimg.jpg');?>)">
					<div class="priceing_list">
						<ul>
							<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo $this->lang->line('Option to share reports');?></li>
							<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo $this->lang->line('Detailed plan summary');?></li>
							<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo $this->lang->line('Results Optimization Plan');?></li>
							<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo $this->lang->line('Unlimited use');?></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="single_paymentplan">
					<div class="priceing_list">
					   <ul>
							<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo $this->lang->line('Scenario Analysis');?></li>
							<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo $this->lang->line('Print Options');?></li>
							<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo $this->lang->line('Technical support');?></li>
							<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo $this->lang->line('Option to download PDF reports');?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		 <div class="col-md-12 text-center mt-4">
			<a class="button start-test-btn" href="<?php echo $start_test_link;?>" ><?php echo $this->lang->line('Start your test now');?></a>
		</div>
	</div>
</div>

<div class="unlimited_services" id="benefits">
	<div class="container">
		<div class="col-md-12 p-0">
		<h4><?php echo $this->lang->line('Benefits');?></h4>
		</div>
		<div class="row col-lg-12">
			<div class="col-lg-4 col-md-4 p-0">
				<div class="services_section_thumb">
					<img src="<?php echo base_url('WebTheme/assets/img/product/benefits.jpg');?>" alt="">
				</div>
			</div>
			<div class="col-lg-8 col-md-8">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<h5><?php echo $this->lang->line('Automatic simulations');?></h5>
						<p><?php echo $this->lang->line('No problem with formulas. Simulations and reports are created automatically.');?></p>
					</div>
					<div class="col-lg-6 col-md-6">
						 <h5><?php echo $this->lang->line('Step by step instructions');?></h5>
						<p><?php echo $this->lang->line('the answers. It really is that simple.');?></p>
					</div>
				</div>
				 <div class="row">
					<div class="col-lg-6 col-md-6">
						 <h5><?php echo $this->lang->line('Easy simulation export');?></h5>
						<p><?php echo $this->lang->line('Export your simulations at any time in PDF format.');?></p>
					 </div>
					<div class="col-lg-6 col-md-6">
						<h5><?php echo $this->lang->line('Fast customer support');?></h5>
						<p><?php echo $this->lang->line('MIPLANiAPP asks you questions, you provide the answers. It really is that simple.');?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-12 text-center mb-4">
			<a class="button start-test-btn" href="<?php echo $start_test_link;?>" ><?php echo $this->lang->line('Start your test now');?></a>
</div>
<div class="accordion_area" id="FAQ"> 
	<div class="container">
		<div class="col-md-12 p-0">
			<div class="col-12 p-0">
				<div class="testimonial_titile">
					<h3><?php echo $this->lang->line('Frequent questions');?> </h3>
				</div>
			</div>
			<div class="col-md-12 p-0 row m-0">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<h6>  <?php echo $this->lang->line('Learning about MIPLANiAPP');?> </h6>
					<div id="accordion" class="card__accordion">
						<div class="card card_dipult">
							<div class="card-header card_accor" id="headingOne">
								<button class="btn btn-link  collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								   <?php echo $this->lang->line('What is MIPLANiAPP?');?>
									<i class="fa fa-plus"></i>
									<i class="fa fa-minus"></i>
								</button>
							</div>
							<div id="collapseOne" class="collapse collapsed" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<p> <?php echo $this->lang->line('MIPLANiAPP is a profit and profit simulator that takes the guesswork');?></p>
								</div>
							</div>
						</div>
						<div class="card  card_dipult">
							<div class="card-header card_accor" id="headingTwo">
								<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								  <?php echo $this->lang->line('Will MIPLANiAPP work for my industry?');?>
									<i class="fa fa-plus"></i>
									<i class="fa fa-minus"></i>

								</button>
							</div>
							<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="card-body">
									<p><?php echo $this->lang->line('MIPLANiAPP works for all industries and all businesses');?></p>
								</div>
							</div>
						</div>
						<div class="card  card_dipult">
							<div class="card-header card_accor" id="headingfour">
								<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseeight" aria-expanded="false" aria-controls="collapseeight">
								<?php echo $this->lang->line('Can anyone use MIPLANiAPP?');?>
									<i class="fa fa-plus"></i>
									<i class="fa fa-minus"></i>
								</button>
							</div>
							<div id="collapseeight" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
								<div class="card-body">
									<p><?php echo $this->lang->line('MIPLANiAPP is for all those who sell online:');?></p>
									<ul class="list-style">
										<li><?php echo $this->lang->line('Digital entrepreneurs');?></li>
										<li><?php echo $this->lang->line('Startups');?></li>
										<li><?php echo $this->lang->line('Marketing agencies');?></li>
										<li><?php echo $this->lang->line('Software / SAAS');?></li>
										<li><?php echo $this->lang->line('And many more!');?></li>
									</ul>
									<p><?php echo $this->lang->line('Regardless of your niche, industry, or level of business');?></p>
									<h5 class="fw-600"><?php echo $this->lang->line('Building your first online business?');?></h5>
									<p><?php echo $this->lang->line('MIPLANiAPP is ideal for NEW entrepreneurs and entrepreneurs.');?></p>
									<p><?php echo $this->lang->line('It will allow you to create a simulated model');?></p>
									<p><?php echo $this->lang->line('It helps you know beforehand');?></p>
								<h5 class="fw-600"><?php echo $this->lang->line('Already have an online business?');?></h5>
									<p><?php echo $this->lang->line('MIPLANiAPP is the perfect tool to help you optimize and scale your results.');?></p>
									<p> <?php echo $this->lang->line('Plan for new expansions, and analyze what-if scenarios?');?></p>
									<p><?php echo $this->lang->line('Insert small modifications in product prices, expenses');?></p>
									<h5 class="fw-600"><?php echo $this->lang->line('Do you have a traditional business but also sell online?');?></h5>
									<p><?php echo $this->lang->line('MIPLANiAPP is the tool you need to help you make the transition successfully.');?></p>
								</div>
							</div>
						</div>
						<div class="card  card_dipult">
							<div class="card-header card_accor" id="headingfive">
								<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseseven" aria-expanded="false" aria-controls="collapseseven">
								<?php echo $this->lang->line('Are there actual MIPLANiAPP customer reviews I can read?');?>
									<i class="fa fa-plus"></i>
									<i class="fa fa-minus"></i>
								</button>
							</div>
							<div id="collapseseven" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
								<div class="card-body">
									<p><?php echo $this->lang->line('Absolutely. We are extremely proud of the positive feedback');?></p>
								</div>
							</div>
						</div>

						<div class="card  card_dipult">
							<div class="card-header card_accor" id="headingsix">
								<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
								 <?php echo $this->lang->line('What are the benefits of subscribing to the annual plan?');?>
									<i class="fa fa-plus"></i>
									<i class="fa fa-minus"></i>
								</button>
							</div>
							<div id="collapsefour" class="collapse" aria-labelledby="headingsix" data-parent="#accordion">
								<div class="card-body">
									<p><?php echo $this->lang->line('Purchasing MIPLANiAPP for a full year allows you to run');?></p>
								</div>
							</div>
						</div>
						<div class="card  card_dipult">
							<div class="card-header card_accor" id="headingseven">
								<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
								   <?php echo $this->lang->line('What are the benefits of subscribing to MIPLANiAPP with the lifetime offer?');?>
									<i class="fa fa-plus"></i>
									<i class="fa fa-minus"></i>
								</button>
							</div>
							<div id="collapsefive" class="collapse" aria-labelledby="headingseven" data-parent="#accordion">
								<div class="card-body">
									<p><?php echo $this->lang->line('The acquisition of MIPLANiAPP with lifetime access');?></p>
								</div>
							</div>
						</div>
						<div class="card  card_dipult">
							<div class="card-header card_accor" id="headingeight">
								<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
								   <?php echo $this->lang->line('Can MIPLANiAPP help me achieve my financial goals?');?>
									<i class="fa fa-plus"></i>
									<i class="fa fa-minus"></i>
								</button>
							</div>
							<div id="collapsesix" class="collapse" aria-labelledby="headingeight" data-parent="#accordion">
								<div class="card-body">
									<p><?php echo $this->lang->line('Yes, MIPLANiAPP shows you a detailed and comprehensive roadmap');?></p>
								</div>
							</div>
						</div>
						<div class="card  card_dipult">
							<div class="card-header card_accor" id="headingnine">
								<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsenine" aria-expanded="false" aria-controls="collapsenine">
								   <?php echo $this->lang->line('What if I have more questions?');?>
									<i class="fa fa-plus"></i>
									<i class="fa fa-minus"></i>
								</button>
							</div>
							<div id="collapsenine" class="collapse" aria-labelledby="headingnine" data-parent="#accordion">
								<div class="card-body">
									<p><?php echo $this->lang->line('In the');?> <a href="faq.html" class="color-blue"> <?php echo $this->lang->line('Frequently Asked Questions');?></a> <?php echo $this->lang->line('section, we have tried to answer the vast majority of customer questions.');?></p>
									<p><?php echo $this->lang->line("If you can't find the answer to your question,");?> <a href="contact.html" class="color-blue"></a><?php echo $this->lang->line('contact_us');?> .</p>
									<p><?php echo $this->lang->line('We will be happy to serve you.');?></p>
								</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</div>
</div>
<div class="col-md-12 text-center mt-4 mb-4">
			<a class="button start-test-btn" href="<?php echo $start_test_link;?>" ><?php echo $this->lang->line('Start your test now');?></a>
</div>
<div class="testimonial_are" id="testimonial">
	<div class="container">
		<div class="col-md-12 p-0">
			<div class="col-12">
				<div class="testimonial_titile">
					<h2><?php echo $this->lang->line('Praised by satisfied entrepreneurs');?></h2>
				</div>
			</div>
			<div class="col-12">
			 <div class="testimonial_active owl-carousel">
				<div class="col-12">
					<div class="single_testimonial">
						<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>
						<img src="<?php echo base_url('WebTheme/assets/img/product/testimonial4.jpg');?>" alt="">
						<span class="name">Zoey amanda</span>
						<span class="job_title">Arteselado.com</span>
						<div class="product_ratting">
							<ul>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="single_testimonial">
						<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>
						<img src="<?php echo base_url('WebTheme/assets/img/product/testimonial4.jpg');?>" alt="">
						<span class="name">Emma Redshaw</span>
						<span class="job_title">Arteselado.com</span>
						<div class="product_ratting" >
							<ul>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="single_testimonial">
						<p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..</p>
						<img src="<?php echo base_url('WebTheme/assets/img/product/testimonial4.jpg');?>" alt="">
						<span class="name">Anna Smith</span>
						<span class="job_title">Arteselado.com</span>
						<div class="product_ratting">
							<ul>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			</div>
			 <div class="col-md-12 text-center mt-5">
			 	<a href="<?php echo $add_review_link;?>"><button type="button" class="print-btn"><?php echo $this->lang->line('Rate this app');?></button></a>
			</div>
		</div>
	</div>
	<div class="col-md-12 text-center mt-4 mb-4">
 		<a class="button start-test-btn" href="<?php echo $start_test_link;?>" ><?php echo $this->lang->line('Start your test now');?></a>
	</div>
</div>
<div class="unlimited_services" id="ten-minute-section">
	<div class="container">
			 <div class="col-lg-12 col-md-12 mb-5">
				<div class="services_section_thumb">
					<img src="<?php echo base_url('WebTheme/assets/img/product/price-tenminutes.png');?>" alt="">
				</div>
			</div>
			<div class="col-lg-12 col-md-12">
				<div class=" text-left">
					<h2><?php echo $this->lang->line('Choose the plan that works best for you');?></h2>
					<p class="text-black"><?php echo $this->lang->line('Go to MIPLANiAPP and know');?> <i class="underline fw-600"><?php echo $this->lang->line('exactly');?></i> <?php echo $this->lang->line('what to do to reach your financial goals at the beginning of each year, or to discover how it will shape your NEXT business, marketing campaign or any other project you have to invest in.');?></p>
					<p class="mt-3 text-black"><i class="fw-600"><?php echo $this->lang->line('Instantly discover how your vision will materialize with personalized reports.');?></i></p>
					<p class="text-black mt-3"><?php echo $this->lang->line("The 'Freemium' version is free and allows you to access all the functionalities");?><span class="fw-600"> <?php echo $this->lang->line("30 thousand euros, as a");?></span> <?php echo $this->lang->line("financial objective .");?></p>
					<p class="text-black mt-3"><?php echo $this->lang->line("Therefore, for larger amounts, you will need to choose another plan.");?></p>
				</div>
				 <div class="col-md-12 text-center">
						<a class="button start-test-btn" href="#"><?php echo $this->lang->line('Choose your plan now');?></a>
				</div>
			</div>
	</div>
</div>
<div class="priceing_table" id="pricing-home">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="services_title">
					<h3><?php echo $this->lang->line('You are just 10 minutes away from discovering how to achieve any desired financial goal.');?></h3>
				<p class="text-center"><i><?php echo $this->lang->line('Choose a package and sign up in less than 60 seconds.<br>You can change or cancel at any time.');?></i></p>
				</div>
			</div>
		</div>
		<div class="row pricing-content">
			<div class="col-lg-3 col-md-6">
				<div class="single_priceing">
					<div class="priceing_title">
						<h1>Freemium</h1>
						<span class="color-white">Try for free, zero risk</span>
					</div>
					<div class="priceing_list">
						<h1 class="p-0">Free</h1>
						<p>Always</p>
						<a href="javascript:;" id="price-btn1"><?php echo $this->lang->line('Start now');?> </a><br>
						<span style="color: rgb(204, 153, 85);" class="btn-bottom-text">* Maximum amount allowed for simulation: &euro; 30,000</span>
					</div>

				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="single_priceing">
					<div class="priceing_title">
						<h1>Annual</h1>
						<span class="color-white">Per month, billed once a year</span>
					</div>
					<div class="priceing_list">
						<h1><strike style="color:  grey">19.97</strike></h1>
						 <h2>&euro; 15.97</h2>
						 <p>For 12 Months</p>

						<a  href="checkout.html" id="price-btn2"><?php echo $this->lang->line('Choose the annual plan');?></a><br>
						<span style="color: gray;" class="btn-bottom-text">* Billed at &euro; 191.64 per year.</span>

					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="single_priceing">
					<div class="priceing_title">
						<h1>Monthly</h1>
						<span class="color-white">Per month, billed once a year</span>
					</div>
					<div class="priceing_list">
						<h2><span>&euro; 19.97</span></h2>
						 <p>Month-to-Month</p>
						<a href="checkout.html" id="price-btn1"><?php echo $this->lang->line('Choose the monthly plan');?> </a><br>
						<span style="color:gray;" class="btn-bottom-text">* &euro; 19.97 per month. Once / month</span>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="single_priceing">
					<div class="priceing_title" style="background: #4054b2 !important">
						<h1>Lifetime</h1>
						<span class="color-white">Unlimited software forever</span>
					</div>
				   <div class="priceing_list">
						<h1><strike style="color:  grey">4955</strike></h1>
						 <h2>&euro; 495</h2>
						 <p>Single Payment</p>

						<a  href="checkout.html" id="price-btn2"><?php echo $this->lang->line('Choose the plan for life');?></a><br>
					   <span style="color: gray;" class="btn-bottom-text">* Billed &euro; 495 one time.</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="unlimited_services" id="gurantee-section">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 col-md-6 text-center">
				<div class="services_section_thumb">
					<img src="<?php echo base_url('WebTheme/assets/img/product/gurantee.jpg');?>" alt="">
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="unlimited_services_content text-left">
				<p><?php echo $this->lang->line('Try all the features of MIPLANiAPP   Free');?></p>
				 <h6><?php echo $this->lang->line('It is our best Satisfaction Guarantee.');?></h6>
				</div>
			</div>
		</div>
	</div>
</div>
  