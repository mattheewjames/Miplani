<script src="<?php echo base_url("WebTheme/assets/js/creditCardValidator.js");?>"></script>
<script>
function cardFormValidate(){
	var cardValid = 0;
	  
	//card number validation
	$('#card_number').validateCreditCard(function(result){ console.log(result);
		var cardType = (result.card_type == null)?'':result.card_type.name;
		if(cardType == 'Visa'){
			var backPosition = result.valid?'2px -163px, 260px -87px':'2px -163px, 260px -61px';
		}else if(cardType == 'visa_electron'){
			var backPosition = result.valid?'2px -205px, 260px -87px':'2px -163px, 260px -61px';
		}else if(cardType == 'MasterCard'){
			var backPosition = result.valid?'2px -247px, 260px -87px':'2px -247px, 260px -61px';
		}else if(cardType == 'Maestro'){
			var backPosition = result.valid?'2px -289px, 260px -87px':'2px -289px, 260px -61px';
		}else if(cardType == 'Discover'){
			var backPosition = result.valid?'2px -331px, 260px -87px':'2px -331px, 260px -61px';
		}else if(cardType == 'Amex'){
			var backPosition = result.valid?'2px -121px, 260px -87px':'2px -121px, 260px -61px';
		}else{
			var backPosition = result.valid?'2px -121px, 260px -87px':'2px -121px, 260px -61px';
		}
		$('#card_number').css("background-position", backPosition);
		if(result.valid){
			$("#card_type").val(cardType);
			$("#card_number").removeClass('required');
			cardValid = 1;
		}else{
			$("#card_type").val('');
			$("#card_number").addClass('required');
			cardValid = 0;
		}
	});
	  
	//card details validation
	var cardName = $("#name_on_card").val();
	var expMonth = $("#expiry_month").val();
	var expYear = $("#expiry_year").val();
	var cvv = $("#cvv").val();
	var regName = /^[a-z ,.'-]+$/i;
	var regMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
	var regYear = /^2017|2018|2019|2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
	var regCVV = /^[0-9]{3,3}$/;
	if (cardValid == 0) {
		$("#card_number").addClass('required');
		$("#card_number").focus();
		return false;
	}else if (!regMonth.test(expMonth)) {
		$("#card_number").removeClass('required');
		$("#expiry_month").addClass('required');
		$("#expiry_month").focus();
		return false;
	}else if (!regYear.test(expYear)) {
		$("#card_number").removeClass('required');
		$("#expiry_month").removeClass('required');
		$("#expiry_year").addClass('required');
		$("#expiry_year").focus();
		return false;
	}else if (!regCVV.test(cvv)) {
		$("#card_number").removeClass('required');
		$("#expiry_month").removeClass('required');
		$("#expiry_year").removeClass('required');
		$("#cvv").addClass('required');
		$("#cvv").focus();
		return false;
	}else if (!regName.test(cardName)) {
		$("#card_number").removeClass('required');
		$("#expiry_month").removeClass('required');
		$("#expiry_year").removeClass('required');
		$("#cvv").removeClass('required');
		$("#name_on_card").addClass('required');
		$("#name_on_card").focus();
		return false;
	}else{
		$("#card_number").removeClass('required');
		$("#expiry_month").removeClass('required');
		$("#expiry_year").removeClass('required');
		$("#cvv").removeClass('required');
		$("#name_on_card").removeClass('required');
		$("#cardSubmitBtn").removeAttr('disabled');
		return true;
	}
}
$(document).ready(function() {
	//Demo card numbers
	$('.card-payment .numbers li').wrapInner('<a href="javascript:void(0);"></a>').click(function(e) {
		e.preventDefault();
		$('.card-payment .numbers').slideUp(100);
		cardFormValidate();
		return $('#card_number').val($(this).text()).trigger('input');
	});
	$('body').click(function() {
		return $('.card-payment .numbers').slideUp(100);
	});
	$('#sample-numbers-trigger').click(function(e) {
		e.preventDefault();
		e.stopPropagation();
		return $('.card-payment .numbers').slideDown(100);
	});
	
	//Card form validation on input fields
	$('#paymentForm input[type=text]').on('keyup',function(){
		cardFormValidate();
	});
	
	//Submit card form
	$("#cardSubmitBtn").on('click',function(){
		if(cardFormValidate())
		{
			var key_id = $('#key_id').val();
			var code = $('#code').val();
			var card_number = $('#card_number').val();
 			var card_number = $('#card_number').val();
			var valid_thru = $('#expiry_month').val()+'/'+$('#expiry_year').val();
			var expiry_month =  $('#expiry_month').val();
			var expiry_year = $('#expiry_year').val();
			var cvv = $('#cvv').val();
			var card_name = $('#name_on_card').val();
			/*var cardInfo = '<p>Card Number: <span>'+card_number+'</span></p><p>Valid Thru: <span>'+valid_thru+'</span></p><p>CVV: <span>'+cvv+'</span></p><p>Name on Card: <span>'+card_name+'</span></p><p>Status: <span>VALID</span></p>';
			$('.cardInfo').slideDown('slow');
			$('.cardInfo').html(cardInfo);*/
			$.ajax({
				type:'POST',
				url:web_js_path+'pages/CreditCardValidation',
				data : {'key_id':key_id, 'code':code, 'card_number':card_number, 'cvv':cvv, 'expiry_month':expiry_month, 'expiry_year':expiry_year, 'card_name':card_name},
				success:function(data)
				{
					if(data.search('Success') != -1)
					{
						swal({
						  title: "",
						  text: 'Payment is done successfully!',
						  type: "success",
						  showCancelButton: false,
						  showConfirmButton: false,
						  closeOnConfirm: false,
						  timer: 3000,
						  closeModal: true,	
						});
						window.location.href = web_js_path+'panel/Payments';
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
				}
			}); 
		}
		else
		{
			/*$('.cardInfo').slideDown('slow');
			$('.cardInfo').html('<p>Wrong card details given, please try again.</p>');*/
			//alert('Please filled all the information and then click proceed button');
			swal({
			  title: "",
			  text: 'Please filled all the information and then click proceed button',
			  type: "error",
			  showCancelButton: false,
			  showConfirmButton: false,
			  closeOnConfirm: false,
			  timer: 3000,
			  closeModal: true,	
			});
		}
	});
});
</script>