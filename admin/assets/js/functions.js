/*============================ call Modal=========================*/
function call_url_modal(url)
{
 	path = js_base_path+url;
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
	path = js_base_path+url+'?key_id='+key_id;
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
/*============================ Forgot Password validation=========================*/
$('#forgot_password_btn').click(function()
{
 	$.LoadingOverlay("show");
 	$('#forgot_password_btn').hide();
	$('#fg_error_div').hide();
    $('#fg_form_data').submit(function(e) 
	{
		e.preventDefault();
		$('#fg_form_data').removeAttr('onsubmit').submit(e);
 		var form = $(this);
		var formdata = false;
		if(window.FormData)
		{
			formdata = new FormData(form[0]);
		}
	
		var formAction = form.attr('action');
	
		$.ajax({
			type : 'POST',
			url : js_base_path+'login/Checkfg',
  			cache : false,
			data : formdata ? formdata : form.serialize(),
			contentType : false,
			processData : false,
	
			success: function(data) 
			{
  				myarray = new Array();
				myarray = data.split('-SEPARATOR-');	
				if(data.search('done') != -1)
				{
 					$("#fg_form_data").remove();
					$("#user_email").remove();
 					$('#fg_success_div').show();
					$('#fg_error_div').html('');
					$('#fg_error_div').hide();
 					$('#fg_form_data').each(function(){
						this.reset();
					});
					$('html, body').animate({scrollTop:0}, 'slow');
					alert('Please check your email to reset password!');
					setTimeout('gotolink(\''+myarray[1]+'\')', 1000);
 				} 
				else 
				{
					$('html, body').animate({scrollTop:0}, 'slow');
					$("#forgot_password_btn").show();
  					$('#fg_error_div').fadeIn("slow");
					$('#fg_success_div').hide();
					$('#fg_error_div').html('');
					$('#fg_error_div').html(data);
					$('#fg_form_data').removeAttr('onsubmit').submit(e);
				}
			}
		});
		e.preventDefault();
	});
	$.LoadingOverlay("hide"); 
 });
/*============================ form Record validation=========================*/
function form_common_data_validation(id,type)
{
 	$.LoadingOverlay("show");
  	$('#form_btn').hide();
	$('#error_div').hide();
	$('#success_div').hide();
    $('#form_data').submit(function(e) 
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
			url : js_base_path+'validation?id='+id,
  			cache : false,
			data : formdata ? formdata : form.serialize(),
			contentType : false,
			processData : false,
	
			success: function(data) 
			{
				$.LoadingOverlay("hide");
  				myarray = new Array();
				myarray = data.split('-SEPARATOR-');
				if(type!='note' && type!='call' && type!='remark' && type!='folow up' && type!='send email')
				{
					$('html, body').animate({scrollTop:0}, 'slow');		
				}
				if(data.search('done') != -1)
				{
					$('#error_div').html('');
					$('#error_div').hide();
					$('#success_div').fadeIn("slow");
 					$('#form_data').each(function(){
						this.reset();
					});
					if(myarray[1]=='add')
					{
						$('#success_div').html('Record added successfully!');
					}
					else if(myarray[1]=='update')
					{
						$('#success_div').html('Record updated successfully!');
					}
					else if(myarray[1]=='upload')
					{
						$('#success_div').html('Image uploaded successfully!');
					}
					else if(myarray[1]=='save')
					{
						$('#success_div').html('Record saved successfully!');
					}
					else
					{
						$('#success_div').html('Record added successfully!');
					}
					setTimeout('gotolink(\''+myarray[2]+'\')', 1000);
 				} 
				else 
				{
 					$('#success_div').hide();
					$("#form_btn").show();
  					$('#error_div').fadeIn("slow");
					$('#error_div').html('');
					$('#error_div').html(data);
					$('#form_data').removeAttr('onsubmit').submit(e);
				}
			}
		});
		e.preventDefault();
	});
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
				url : js_base_path+'validation?id='+id,
				cache : false,
				data : formdata ? formdata : form.serialize(),
				contentType : false,
				processData : false,
		
				success: function(data) 
				{
					if(record_name!='send email')
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
						else if(myarray[1]=='send email')
						{
							$(success_div).html('Message Sent successfully!');
						}
						else
						{
							$(success_div).html('Record added successfully!');
						}
 						setTimeout('gotolink(\''+myarray[2]+'\')', 1500);
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
/*============================ Search Reset=========================*/
function search_reset()
{
	$('#search_form').each(function(){this.reset();});
	window.location.reload();
}
/*============================ Load Data=========================*/
function get_Previous(fun_name,record_id)
{ 
	var me = this;
	if(fun_name=='load_ajax_customer_notes_list')
	{
		var hrefValue = document.getElementById("notes-page-active").href;
	}
	else if(fun_name=='load_ajax_customer_payments_list')
	{
		var hrefValue = document.getElementById("payments-page-active").href;
	}
	else if(fun_name=='load_ajax_customer_registered_items_list')
	{
		var hrefValue = document.getElementById("items-page-active").href;
	}
	else if(fun_name=='load_ajax_customer_call_list')
	{
		var hrefValue = document.getElementById("call-page-active").href;
	}
	else if(fun_name=='load_ajax_customer_remarks_list')
	{
		var hrefValue = document.getElementById("remarks-page-active").href;
	}
 	else
	{
		var hrefValue = document.getElementById("pagination-active").href;
	}
    
    var split = hrefValue.split("#");
    var page = parseInt(split[1]);
	if(page>1)
	{
		if(record_id==0)
		{
			me[fun_name](page-1);
 		}
		else if(record_id!='')
		{
			me[fun_name](page-1,record_id);
		}
	}
}
function get_Next(total,fun_name,record_id)
{
 	var me = this;
    if(fun_name=='load_ajax_customer_notes_list')
	{
		var hrefValue = document.getElementById("notes-page-active").href;
	}
	else if(fun_name=='load_ajax_customer_payments_list')
	{
		var hrefValue = document.getElementById("payments-page-active").href;
	}
	else if(fun_name=='load_ajax_customer_registered_items_list')
	{
		var hrefValue = document.getElementById("items-page-active").href;
	}
	else if(fun_name=='load_ajax_customer_call_list')
	{
		var hrefValue = document.getElementById("call-page-active").href;
	}
	else if(fun_name=='load_ajax_customer_remarks_list')
	{
		var hrefValue = document.getElementById("remarks-page-active").href;
	}
	else
	{
		var hrefValue = document.getElementById("pagination-active").href;
	}
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
			me[fun_name](page+1,record_id);
		}
 	}
}

function record_deletion(id,type)
{
	swal({
		title: "Are you sure?",
		text: "You want to delete this record?",
		icon: "error",
 		buttons: {
 			confirm: {
				text: "Delete",
				value: true,
				visible: true,
				className: "btn-danger",
				closeModal: true
			},
			cancel: {
				text: "cancel",
				value: null,
				visible: true,
				className: "btn-info",
				closeModal: true,
			}
		}
	})
	.then(isConfirm => 
	{
		if (isConfirm) 
		{
			$.ajax({
					method: 'POST',
					data: {'ids': id, 'type' : type},
					url: js_base_path+'validation?type='+type,
					success: function(data){
					if(data.search('done')!=-1)
					{
						swal({
						  title: "Deleted",
						  icon: "success",
						  text: "Record deleted successfully!",
						  type: "success",
						  timer: 2000,
						  closeModal: true
						});
						location.reload();
					}
					else
					{
						swal({
						  title: "Error",
						  icon: "error",
						  text: data,
						  type: "error",
						  timer: 2000,
						  closeModal: true,
						});
					}
				},
				error: function() 
				{
					swal({
					  title: "Error",
					  icon: "error",
					  text: 'An Error occurred, please refresh the page and try again!',
					  type: "error",
					  timer: 2000,
					  closeModal: true
					});
					location.reload();
				}
			});
		} 
		else 
		{
			
		}
	});
}
 