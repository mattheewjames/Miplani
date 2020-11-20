function user_authentication(id,record_type)
{
	// alert('aa gaya');
	$.LoadingOverlay("show");
	if(id!='' && record_type!='')
	{
		// alert(id);
		// alert(record_type);
   		var form = "#"+record_type+"_form_data";
		var btn = "#"+record_type+"_form_btn";  
		var error_div = "#"+record_type+"_error_div";  
		var success_div = "#"+record_type+"_success_div";  
		 
  		$(btn).hide();
		$(error_div).hide();
		$(success_div).hide();
 		$(form).submit(function(e) 
		{
			e.preventDefault();
			var form = $(this);
			var formdata = false;
			if(window.FormData)
			{
				formdata = new FormData(form[0]);
			}
		
			var formAction = form.attr('action');
		
			$.ajax({
				type : 'POST',
				url : web_js_path+'authentication?id='+id,
				cache : false,
				data : formdata ? formdata : form.serialize(),
				contentType : false,
				processData : false,
		
				success: function(data) 
				{
					if(record_type=='fpass')
					{

					}
					else
					{
						$('html, body').animate({scrollTop:0}, 'slow');	
					}
						
 					var myarray = new Array();
					myarray = data.split('-SEPARATOR-');		
					if(data.search('done') != -1)
					{
						$(error_div).html('');
						$(error_div).hide();
						$(form).each(function(){
							this.reset();
						});
						if(myarray[1]=='EmptyMsg')
						{
							$(success_div).hide();
							$(success_div).html('');
							setTimeout('gotolink(\''+myarray[2]+'\')', 100);
						}
 						else
						{
							$(success_div).fadeIn("slow");
							$(success_div).html(myarray[1]);
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
			
		});
	}
	else
	{
		alert('Please refresh your page');	
	}
	$.LoadingOverlay("hide");
}