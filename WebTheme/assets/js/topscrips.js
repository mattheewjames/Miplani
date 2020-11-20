function get_checkout_coupon(pid)
{
	var coupon_code = $("#coupon_code").val();
	if(coupon_code!='')
	{
		$.ajax({
			type:'POST',
			dataType : "json",
			url:web_js_path+'pages/UseCouponCode',
			data : {'pid':pid,'code':coupon_code},
			success:function(data)
			{
				if(data.response_code==200)
				{
					$("#checkout-data").html("");
					$('#checkout-data').html(data.html);
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
	}
	else
	{
		swal({
			title: "",
			text: 'Please enter coupon code',
			type: "error",
			showCancelButton: false,
			showConfirmButton: false,
			closeOnConfirm: false,
			timer: 3000,
			closeModal: true,	
		});
	}
}