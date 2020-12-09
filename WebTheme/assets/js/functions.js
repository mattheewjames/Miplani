/*============================ call Modal=========================*/
function call_url_modal(url)
{
 	path = web_js_path+url;
 	$('#load_modal_data').html('');
    $('#default').on('show.bs.modal', function (e) {
        $(this).removeData('bs.modal');
    });
    $('#default').modal({
       show: true,
       data:'',
       remote: path,
    });
	$.ajax({
		   type: "POST",
		   url: path,
		   data: '',
		
		   beforeSend: function(){
		   },
		
		   success: function(data){
				$("#load_modal_data").append(data);
			},
			error: function() {
			}
	});
}
function call_url_key_modal(url,key_id)
{
	var path = web_js_path+url+'?key_id='+key_id;
  	$('#load_modal_data').html('');
    $('#default').on('show.bs.modal', function (e) {
        $(this).removeData('bs.modal');
    });
    $('#default').modal({
       show: true,
       data:'',
       remote: path,
    });
	$.ajax({
		   type: "POST",
		   url: path,
		   data: '',
		
		   beforeSend: function(){
		   },
		
		   success: function(data){
				$("#load_modal_data").append(data);
			},
			error: function() {
			}
	});
}
function load_user_projection_wizard(stp,pid,action_type)
{
	$.LoadingOverlay("show");
	var formdata = $('#projection_form').serialize();
	 $.ajax({
		type:'POST',
		url:web_js_path+'projections/ProjectionStep',
		data : {'form_step':stp,'form_pid':pid, 'action_type':action_type, 'form_data':formdata},
		dataType : "json",
		success:function(data)
		{
			if(data.response_code==200)
			{
				
				$('html,body').animate({scrollTop: $("#projection_data").offset().top},'slow');
				$("#projection_data").html("");
				$('#projection_data').html(data.html);
			}
			else if(data.response_code==204)
			{
				 window.location = web_js_path+'projections';
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function edit_user_projection_wizard(stp,pid)
{
	$.LoadingOverlay("show");
	var formdata = $('#projection_form').serialize();
	 $.ajax({
		type:'POST',
		url:web_js_path+'projections/EditProjectionStep',
		data : {'form_step':stp,'form_pid':pid},
		dataType : "json",
		success:function(data)
		{
			if(data.response_code==200)
			{
				$("#projection_data").html("");
				$('#projection_data').html(data.html);
			}
			else if(data.response_code==204)
			{
				 window.location = web_js_path+'projections';
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function get_global_expenses_analysis(id,type)
{
	$.LoadingOverlay("show");
	var input_text = '';
	var load_id = '';
	if(type=='operating expenses')
	{
		input_text = $("#operating_expenses").val();
		load_id = "#operating_expense_cal_data";
	}
	else if(type=='advertising expenses')
	{
		input_text = $("#advertising_expenses").val();
		load_id = "#adv_expense_cal_data";
	}
	else if(type=='average sold cost')
	{
		input_text = $("#average_product_sold_cost").val();
		load_id = "#cost_of_good_sold_cal_data";
	}
	else
	{
		load_id = '';
	}
	$.ajax({
		type:'POST',
		url:web_js_path+'calculations/global_expenses_analysis_calculation',
		data : {'id':id,'type':type,'input_text':input_text},
		dataType : "json",
		success:function(data)
		{
			if(data.response_code==200)
			{
				$(load_id).show();
				$(load_id).html("");
				$(load_id).html(data.html);
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function get_conversion_rate_calculation(id)
{
	$.LoadingOverlay("show");
	var conversion_rate = $("#conversion_rate").val(); 
	$.ajax({
		type:'POST',
		url:web_js_path+'calculations/conversion_rate_calculation',
		data : {'id':id,'input_text':conversion_rate},
		dataType : "json",
		success:function(data)
		{
			if(data.response_code==200)
			{
				$("#conversion-rate-div").show();
				$("#conversion-rate-div").html("");
				$("#conversion-rate-div").html(data.html);
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}

function get_scenario_one_calculation(id)
{
	$.LoadingOverlay("show");
	var scenario_one_expense = $("#scenario_one_expense").val(); 
	$.ajax({
		type:'POST',
		url:web_js_path+'calculations/scenario_one_expense_calculation',
		data : {'id':id,'input_text':scenario_one_expense},
		dataType : "json",
		success:function(data)
		{
			if(data.response_code==200)
			{
				$("#scenario-one-data").show();
				$("#scenario-one-data").html("");
				$("#scenario-one-data").html(data.html);
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function get_scenario_two_calculation(id)
{
	$.LoadingOverlay("show");
	var scenario_two_conversion = $("#scenario_two_conversion").val(); 
	$.ajax({
		type:'POST',
		url:web_js_path+'calculations/scenario_two_conversion_calculation',
		data : {'id':id,'input_text':scenario_two_conversion},
		dataType : "json",
		success:function(data)
		{
			if(data.response_code==200)
			{
				$("#scenario-two-data").show();
				$("#scenario-two-data").html("");
				$("#scenario-two-data").html(data.html);
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function get_additional_product_buyer_ratio_calculation(id)
{
	$.LoadingOverlay("show");
	var additional_product_buyer_ratio = $("#additional_product_buyer_ratio").val(); 
	$.ajax({
		type:'POST',
		url:web_js_path+'calculations/get_additional_product_buyer_ratio_calculation',
		data : {'id':id,'input_text':additional_product_buyer_ratio},
		dataType : "json",
		success:function(data)
		{
			if(data.response_code==200)
			{
				$("#additional-product-buyer-ration-data").show();
				$("#additional-product-buyer-ration-data").html("");
				$("#additional-product-buyer-ration-data").html(data.html);
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function get_additional_product_price_calculation(id)
{
	$.LoadingOverlay("show");
	var additional_product_buyer_ratio = $("#additional_product_buyer_ratio").val(); 
	var additional_product_price = $("#additional_product_price").val(); 
	$.ajax({
		type:'POST',
		url:web_js_path+'calculations/get_additional_product_price_calculation',
		data : {'id':id,'input_text':additional_product_price,'additional_product_buyer_ratio':additional_product_buyer_ratio},
		dataType : "json",
		success:function(data)
		{
			if(data.response_code==200)
			{
				$("#additional-product-price-data").show();
				$("#additional-product-price-data").html("");
				$("#additional-product-price-data").html(data.html);
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}

function get_multiple_product_buyer_ratio_calculation(id)
{
	$.LoadingOverlay("show");
	var multiple_product_buyer_ratio = $("#multiple_product_buyer_ratio").val(); 
	$.ajax({
		type:'POST',
		url:web_js_path+'calculations/get_multiple_product_buyer_ratio_calculation',
		data : {'id':id,'input_text':multiple_product_buyer_ratio},
		dataType : "json",
		success:function(data)
		{
			if(data.response_code==200)
			{
				$("#multiple-product-buyer-ratio-data").show();
				$("#multiple-product-buyer-ratio-data").html("");
				$("#multiple-product-buyer-ratio-data").html(data.html);
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function get_multiple_product_price_calculation(id)
{
	$.LoadingOverlay("show");
	var multiple_product_price = $("#multiple_product_price").val(); 
	var multiple_product_buyer_ratio = $("#multiple_product_buyer_ratio").val();
	var additional_product_buyer_ratio = $("#additional_product_buyer_ratio").val(); 
	var additional_product_price = $("#additional_product_price").val();
	$.ajax({
		type:'POST',
		url:web_js_path+'calculations/get_multiple_product_price_calculation',
		data : {'id':id,'input_text':multiple_product_price,'multiple_product_buyer_ratio':multiple_product_buyer_ratio, 'additional_product_buyer_ratio':additional_product_buyer_ratio, additional_product_price: additional_product_price },
		dataType : "json",
		success:function(data)
		{
			if(data.response_code==200)
			{
				$("#multiple-product-price-data").show();
				$("#multiple-product-price-data").html("");
				$("#multiple-product-price-data").html(data.html);
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function wizard_main_projection(stp,pid,action_type)
{
	$.LoadingOverlay("show");
	var formdata = $('#main_projection_form').serialize();
	 $.ajax({
		type:'POST',
		url:web_js_path+'projection/WizardMainProjection',
		data : {'form_step':stp,'form_pid':pid, 'action_type':action_type, 'form_data':formdata},
		dataType : "json",
		success:function(data)
		{
 			if(data.response_code==200)
			{
				$("#main-projection-data").html("");
				$('#main-projection-data').html(data.html);
			}
			else if(data.response_code==204)
			{
				 window.location = web_js_path+'projection';
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function wizard_edit_main_projection(stp,pid)
{
	$.LoadingOverlay("show");
	 $.ajax({
		type:'POST',
		url:web_js_path+'projection/WizardEditMainProjection',
		data : {'form_step':stp,'form_pid':pid},
		dataType : "json",
		success:function(data)
		{
 			if(data.response_code==200)
			{
				$("#main-projection-data").html("");
				$('#main-projection-data').html(data.html);
			}
			else if(data.response_code==204)
			{
				 window.location = web_js_path+'projection';
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function get_main_projection_calculation(step,type)
{
	$.LoadingOverlay("show");
	var input_text = '';
	var load_id = '';
	var annual_billing ='';
	var achieve_goal_year = '';
	var average_product_price = '';
	var conversion_rate = '';
	var operating_expenses = '';
	var advertising_expenses = '';
	var average_product_sold_cost ='';
	
 	if(step=='1')
	{
		annual_billing = $("#annual_billing").val();
		achieve_goal_year = $("#achieve_goal_year").val();
		average_product_price = $("#average_product_price").val();
 		conversion_rate = $("#conversion_rate").val();
		operating_expenses = $("#operating_expenses").val();
		advertising_expenses = $("#advertising_expenses").val();
		average_product_sold_cost = $("#average_product_sold_cost").val();
		load_id = "#step-one-calculation-div";
	}
	else if(step=='2')
	{
 		
		annual_billing = $("#second_annual_billing").val();
		achieve_goal_year = 1;
		average_product_price = $("#second_average_product_price").val();
 		conversion_rate = $("#second_conversion_rate").val();
		operating_expenses = $("#second_operating_expenses").val();
		advertising_expenses = $("#second_advertising_expenses").val();
		average_product_sold_cost = $("#second_average_product_sold_cost").val();
		load_id = "#step-two-calculation-div";
	}
	else if(step=='3')
	{
 		annual_billing = $("#third_annual_billing").val();
		achieve_goal_year = 1;
		average_product_price = $("#third_average_product_price").val();
 		conversion_rate = $("#third_conversion_rate").val();
		operating_expenses = $("#third_operating_expenses").val();
		advertising_expenses = $("#third_advertising_expenses").val();
		average_product_sold_cost = $("#third_average_product_sold_cost").val();
		load_id = "#step-three-calculation-div";
	}
	$.ajax({
		type:'POST',
		url:web_js_path+'calculations/MainProjectionCalculation',
		data : {'step':step, 'type':type, 'annual_billing':annual_billing, 'achieve_goal_year':achieve_goal_year, 'average_product_price':average_product_price , 'conversion_rate':conversion_rate, 'operating_expenses':operating_expenses, 'advertising_expenses':advertising_expenses, 'average_product_sold_cost':average_product_sold_cost, 'average_product_sold_cost':average_product_sold_cost},
		dataType : "json",
		success:function(data)
		{
			if(data.response_code==200)
			{
				$(load_id).show();
				$(load_id).html("");
				$(load_id).html(data.html);
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function form_data_validation(id,record_name,record_type)
{
	if(id!='' && record_name!='' && record_type!='')
	{
   		var form = "#"+record_type+"_form_data";
		var btn = "#"+record_type+"_form_btn";  
		var error_div = "#"+record_type+"_error_div";  
		var success_div = "#"+record_type+"_success_div";  
		$.LoadingOverlay("show");
 		$(btn).hide();
		$(error_div).hide();
		$(success_div).hide();
 		$(form).submit(function(e) 
		{
			var form = $(this);
			var formdata = false;
			if(window.FormData)
			{
				formdata = new FormData(form[0]);
			}
		
			var formAction = form.attr('action');
		
			$.ajax({
				type : 'POST',
				url : web_js_path+'validation?id='+id,
				cache : false,
				data : formdata ? formdata : form.serialize(),
				contentType : false,
				processData : false,
		
				success: function(data) 
				{
					if(record_name=='newsletter subscriptions' || record_name=='change password' || record_name=='profile' || record_name=='contact us')
					{

					}
					else if(record_name=='review')
					{
						$('html, body').animate({scrollTop:450}, 'slow');		
					}
 					else
					{
						$('html, body').animate({scrollTop:0}, 'slow');		
					}
					$.LoadingOverlay("hide");
					myarray = new Array();
					myarray = data.split('-SEPARATOR-');		
					if(data.search('done') != -1)
					{
						$(error_div).html('');
						$(error_div).hide();
						$(success_div).fadeIn("slow");
						$(form).each(function(){
							this.reset();
						});
 						if(myarray[1]=='update')
						{
							$(success_div).html('Record updated successfully!');
						}
						else if(myarray[1]=='sent')
						{
							$(success_div).html('Message Sent successfully!');
						}
						else if(myarray[1]=='subscribe')
						{
							$(success_div).html('You have successfully subscribed to the newsletter!');
						}
						else if(myarray[1]=='cpass')
						{
							$(success_div).html('Password changed successfully');
						}
						else
						{
							$(success_div).html('Record added successfully!');
						}
						if(record_name=='newsletter subscriptions' || record_name=='change password' || record_name=='profile' || record_name=='contact us')
						{
							setTimeout(function(){ window.location.reload(); }, 3000); 
						}
						else
						{
							setTimeout('gotolink(\''+myarray[2]+'\')', 1500);
						}
					} 
					else 
					{
 						$(success_div).hide();
						$(btn).show();
						$(error_div).fadeIn("slow");
						$(error_div).html('');
						$(error_div).html(data);
						$(form).removeAttr('onsubmit').submit(e);
					}
				}
			});
			e.preventDefault();
		});
	}
	else
	{
		alert('Please refresh your page');	
	}
}
function projection_comment(id)
{
 	$.LoadingOverlay("show");
  	$('#form_btn').hide();
	$('#comment_error_div').hide();
	$('#comment_success_div').hide();
    $('#comment_form_data').submit(function(e) 
	{
  		var form = $(this);
		var formdata = false;
		if(window.FormData)
		{
			formdata = new FormData(form[0]);
		}
		var formAction = form.attr('action');
 		$.ajax({
			type : 'POST',
			url : web_js_path+'validation?id='+id,
  			cache : false,
			data : formdata ? formdata : form.serialize(),
			contentType : false,
			processData : false,
	
			success: function(data) 
			{
				$.LoadingOverlay("hide");
  				var myarray = new Array();
				myarray = data.split('-SEPARATOR-');
 				if(data.search('done') != -1)
				{
					$('#comment_error_div').html('');
					$('#comment_error_div').hide();
					$('#comment_success_div').fadeIn("slow");
 					$('#comment_form_data').each(function(){
						this.reset();
					});
					$('#comment_success_div').html('Comment Posted successfully!');
					setTimeout('gotolink(\''+myarray[2]+'\')', 1000);
 				} 
				else 
				{
 					$('#comment_success_div').hide();
					$("#form_btn").show();
  					$('#comment_error_div').fadeIn("slow");
					$('#comment_error_div').html('');
					$('#comment_error_div').html(data);
					$('#comment_form_data').removeAttr('onsubmit').submit(e);
				}
			}
		});
		e.preventDefault();
	});
}
function load_projection_comments(page,id,type)
{
	$.ajax({
		type:'POST',
		url:web_js_path+'pages/ProjectionAjaxComments',
 		data : {'page_number':page,'id':id,'type':type},
		success:function(data)
		{
 			$("#comment-data-div").html("");
			$('#comment-data-div').html(data);
 		}
	}); 
}
function get_projection_previous(fun_name,record_id,type)
{ 
	var me = this;
    var hrefValue = document.getElementById("pagination-active").href;
    var split = hrefValue.split("#");
    var page = parseInt(split[1]);
	if(page>1)
	{
		var new_page = page-1;
		me[fun_name](new_page,record_id,type);
	}
}
function get_projection_next(total,fun_name,record_id,type)
{
 	var me = this;
    var hrefValue = document.getElementById("pagination-active").href;
    var split = hrefValue.split("#");
    var page = parseInt(split[1]);
	if(total>page)
	{
		var new_page = page+1
		me[fun_name](new_page,record_id,type);
 	}
}
function record_deletion(id,type,divid)
{
	var result = confirm("Are you sure, You want to delete?");
	if (result==true) 
	{
		$.ajax({
				method: 'POST',
				data: {'ids': id, 'type' : type},
				url: web_js_path+'validation?type='+type,
				success: function(data){
				if(data.search('done')!=-1)
				{
 					$("#row_"+divid).remove();
					swal({
					  title: "",
					  text: 'Record deleted successfully!',
					  type: "success",
					  showCancelButton: false,
					  showConfirmButton: false,
					  closeOnConfirm: false,
					  timer: 3000,
					  closeModal: true,	
					});
					location.reload();
				}
				else
				{
					swal({
					  title: "",
					  text: data,
					  type: "error",
					  showCancelButton: false,
					  showConfirmButton: false,
					  closeOnConfirm: false,
					  timer: 3000,
					  closeModal: true,	
					});
 				}
			},
			error: function() 
			{
				 alert('An Error occurred, please refresh the page and try again');
			}
		});
	} 
	else 
	{
		return false;
	}
	 
}
function guest_projection_wizard(stp,pid,key_url)
{
	$.LoadingOverlay("show");
	var formdata = $('#projection_form').serialize();
	 $.ajax({
		type:'POST',
		url:web_js_path+'guestProjections/GuestModifyProjection',
		data : {'form_step':stp,'form_pid':pid,'key_url':key_url},
		dataType : "json",
		success:function(data)
		{
			console.log(data.response_code);
			if(data.response_code==200)
			{
				$("#projection_data").html("");
				$('#projection_data').html(data.html);
			}
			else if(data.response_code==204)
			{
				swal({
				  title: "",
				  text: 'Record saved Successfully',
				  type: "success",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function load_guest_projection_wizard(stp,pid,action_type,key_url)
{
	$.LoadingOverlay("show");
	var formdata = $('#projection_form').serialize();
	 $.ajax({
		type:'POST',
		url:web_js_path+'guestProjections/ProjectionGuestStep',
		data : {'form_step':stp,'form_pid':pid, 'action_type':action_type, 'form_data':formdata,'key_url':key_url},
		dataType : "json",
		success:function(data)
		{
			if(data.response_code==200)
			{
				$("#projection_data").html("");
				$('#projection_data').html(data.html);
			}
			else if(data.response_code==204)
			{
				 //window.location = web_js_path+'projections';
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function guest_main_projection_wizard(stp,pid,key_url)
{
	$.LoadingOverlay("show");
	var formdata = $('#main_projection_form').serialize();
	 $.ajax({
		type:'POST',
		url:web_js_path+'GuestProjection/GuestModifyMainProjection',
		data : {'form_step':stp,'form_pid':pid,'key_url':key_url},
		dataType : "json",
		success:function(data)
		{
 			if(data.response_code==200)
			{
				$("#main-projection-data").html("");
				$('#main-projection-data').html(data.html);
			}
			else if(data.response_code==204)
			{
				  
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function guest_main_projection_steps(stp,pid,action_type,key_url)
{
	$.LoadingOverlay("show");
	var formdata = $('#main_projection_form').serialize();
	 $.ajax({
		type:'POST',
		url:web_js_path+'GuestProjection/WizardGuestMainProjection',
		data : {'form_step':stp,'form_pid':pid, 'action_type':action_type, 'form_data':formdata,'key_url':key_url},
		dataType : "json",
		success:function(data)
		{
 			if(data.response_code==200)
			{
				$("#main-projection-data").html("");
				$('#main-projection-data').html(data.html);
			}
			else if(data.response_code==204)
			{
				  
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function printData()
{
   var divToPrint=document.getElementById("projection-contents");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   setTimeout(function(){newWin.close();},10);
}
function load_ajax_reviews(page)
{
	$.ajax({
		type:'POST',
		url:web_js_path+'reviews/AjaxReviews',
 		data : {'page_number':page},
		success:function(data)
		{
 			$("#reviews-data-div").html("");
			$('#reviews-data-div').html(data);
 		}
	}); 
}
function get_Previous(fun_name,record_id)
{ 
	var me = this;
    var hrefValue = document.getElementById("pagination-active").href;
    var split = hrefValue.split("#");
    var page = parseInt(split[1]);
	if(page>1)
	{
		if(record_id==0)
		{
			var new_page = page-1;
			me[fun_name](new_page);
 		}
		else if(record_id!='')
		{
			var new_page = page-1;
 			me[fun_name](record_id,new_page);
		}
	}
}
function get_Next(total,fun_name,record_id)
{
 	var me = this;
    var hrefValue = document.getElementById("pagination-active").href;
    var split = hrefValue.split("#");
    var page = parseInt(split[1]);
	if(total>page)
	{
		if(record_id==0)
		{
			me[fun_name](page+1);
 		}
		else if(record_id!='')
		{
			me[fun_name](record_id,page+1);
		}
 	}
}
function CopyProjection(pid)
{
	$.ajax({
		type:'POST',
		url:web_js_path+'projections/CopyProjection',
 		data : {'pid':pid},
		success:function(data)
		{
 			alert(data);
			window.location.reload();
 		}
	}); 
}
function CopyMainProjection(pid)
{
	$.ajax({
		type:'POST',
		url:web_js_path+'projection/CopyProjection',
 		data : {'pid':pid},
		success:function(data)
		{
			alert(data);
			window.location.reload();
  		}
	}); 
}
function CopyDreamProjection(pid)
{
	$.ajax({
		type:'POST',
		url:web_js_path+'DreamProjection/CopyProjection',
 		data : {'pid':pid},
		success:function(data)
		{
			alert(data);
			window.location.reload();
  		}
	}); 
}

function create_dream_financial_goal(type)
{
    $.LoadingOverlay("show");
	var formdata = $('#dream_projection_form').serialize();
	 $.ajax({
		type:'POST',
		url:web_js_path+'commonProjection/DreamProjectionValidation',
		data : {'type':type,'form_data':formdata},
		dataType : "json",
		success:function(data)
		{
 			if(data.response_code==200)
			{
				 window.location.href = data.html;
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function update_dream_financial_goal(type)
{
    $.LoadingOverlay("show");
	var formdata = $('#dream_projection_form').serialize();
	 $.ajax({
		type:'POST',
		url:web_js_path+'commonProjection/DreamProjectionUpdateValidation',
		data : {'type':type,'form_data':formdata},
		dataType : "json",
		success:function(data)
		{
 			if(data.response_code==200)
			{
				 window.location.href = data.html;
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function guest_dream_financial_goal(id,type)
{
    $.LoadingOverlay("show");
	var formdata = $('#dream_projection_form').serialize();
	 $.ajax({
		type:'POST',
		url:web_js_path+'commonProjection/GuestDreamProjectionValidation',
		data : {'type':type,'form_data':formdata,'id':id,},
		dataType : "json",
		success:function(data)
		{
 			if(data.response_code==200)
			{
				 window.location.href = data.html;
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function get_dream_projection_calculation(type)
{
	$.LoadingOverlay("show");
	var annual_billing ='';
	var achieve_goal_year = '';
	var average_product_price = '';
	var conversion_rate = '';
	var operating_expenses = '';
	var advertising_expenses = '';
	var average_product_sold_cost ='';
	
	annual_billing = $("#annual_billing").val();
	achieve_goal_year = $("#achieve_goal_year").val();
	average_product_price = $("#average_product_price").val();
	conversion_rate = $("#conversion_rate").val();
	operating_expenses = $("#operating_expenses").val();
	advertising_expenses = $("#advertising_expenses").val();
	average_product_sold_cost = $("#average_product_sold_cost").val();
 	$.ajax({
		type:'POST',
		url:web_js_path+'CommonProjection/DreamProjectionCalculation',
		data : {'type':type, 'annual_billing':annual_billing, 'achieve_goal_year':achieve_goal_year, 'average_product_price':average_product_price , 'conversion_rate':conversion_rate, 'operating_expenses':operating_expenses, 'advertising_expenses':advertising_expenses, 'average_product_sold_cost':average_product_sold_cost, 'average_product_sold_cost':average_product_sold_cost},
		dataType : "json",
		success:function(data)
		{
			if(data.response_code==200)
			{
				$("#calculation-main-div").show();
				$("#calculation-main-div").html("");
				$("#calculation-main-div").html(data.html);
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}
function get_guest_dream_projection_calculation(type,id)
{
	$.LoadingOverlay("show");
	var annual_billing ='';
	var achieve_goal_year = '';
	var average_product_price = '';
	var conversion_rate = '';
	var operating_expenses = '';
	var advertising_expenses = '';
	var average_product_sold_cost ='';
	
	annual_billing = $("#annual_billing").val();
	achieve_goal_year = $("#achieve_goal_year").val();
	average_product_price = $("#average_product_price").val();
	conversion_rate = $("#conversion_rate").val();
	operating_expenses = $("#operating_expenses").val();
	advertising_expenses = $("#advertising_expenses").val();
	average_product_sold_cost = $("#average_product_sold_cost").val();
 	$.ajax({
		type:'POST',
		url:web_js_path+'CommonProjection/DreamGuestProjectionCalculation',
		data : {'type':type, 'annual_billing':annual_billing, 'achieve_goal_year':achieve_goal_year, 'average_product_price':average_product_price , 'conversion_rate':conversion_rate, 'operating_expenses':operating_expenses, 'advertising_expenses':advertising_expenses, 'average_product_sold_cost':average_product_sold_cost, 'average_product_sold_cost':average_product_sold_cost,'id':id},
		dataType : "json",
		success:function(data)
		{
			if(data.response_code==200)
			{
				$("#calculation-main-div").show();
				$("#calculation-main-div").html("");
				$("#calculation-main-div").html(data.html);
			}
			else
			{
 				swal({
				  title: "",
				  text: data.response_message,
				  type: "error",
				  showCancelButton: false,
				  showConfirmButton: false,
 				  closeOnConfirm: false,
				  timer: 3000,
				  closeModal: true,	
				});
			}
		}
	});
	$.LoadingOverlay("hide");
}


