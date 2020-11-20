<div class="contact_area" id="contact">
        <div class="container">
            <div class="row">
                 <div class="col-lg-2 col-md-12">
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="col-md-12 contact_message content row mb-4">
                        <div class="text-center">
                        <h1>CONTACT US</h1>
                        <p>Customer service by phone is open Monday through Friday from 10:00 am to 2:00 pm (Spanish time). If you need help after hours ...</p>
                         <h5>Visit the <a href="#" class="blue">Help Center</a> to find solutions to common problems.</h5>
                        </div>
                        <div class="col-lg-4 col-md-4 text-center">
                              <span><i class="fa fa-commenting-o" aria-hidden="true"></i><br>Chat live now</span>
                        </div>
                        <div class="col-lg-4 col-md-4 text-center">
                               <span><i class="fa fa-envelope-o"></i> <a href="#"><br> abc@info.com</a></span>
                        </div>
                        <div class="col-lg-4 col-md-4 text-center">
                              <span><i class="fa fa-phone"></i>  <a href="tel:0(1234)567890"> <br> 0 (1234) 567 890</a> </span>
                        </div>
                    </div>
                    <div class="contact_message form" id="contact-inner">
                         <form name="contact_us_form_data" id="contact_us_form_data" method="post" action=""> 
                           <div class="col-lg-12 col-md-12 row m-0 p-0 contact-field">
                               <div class="col-lg-6 col-md-6 pl-0">
                                    <p>
                                        <input name="name" id="name" placeholder="Name" type="text">
                                    </p>
                               </div>
                               <div class="col-lg-6 col-md-6 pr-0">
                                    <p>
                                        <input name="email" id="email" placeholder="Email" type="text" onkeypress="return RestrictSpace();">
                                    </p>
                                </div>
                           </div>
                             <div class="col-lg-12 col-md-12 p-0">
                                <div class="contact_textarea">
                                    <textarea name="message" id="message"  placeholder="How can we help?" class="form-control2"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 p-0 text-right">
                                <button type="submit"  id="contact_us_form_btn" name="contact_us_form_btn" class="contact-send-btn" onClick="form_data_validation('<?php echo base64_encode(1);?>','contact us','contact_us');">Send <i class="fa fa-envelope-o"></i></button>
                            </div>
                            <br>
                            <ul class="col-md-12 alert alert-danger contact_msg" id="contact_us_error_div" style="display: none;"></ul>
							<ul class="col-md-12 alert alert-success contact_msg" id="contact_us_success_div" style="display: none;"></ul>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>