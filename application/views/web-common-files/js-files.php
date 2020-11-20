<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?> 
<!--jquery min js-->
<script src="<?php echo base_url("WebTheme/assets/js/vendor/jquery-3.4.1.min.js");?>"></script>
<!--popper min js-->
<script src="<?php echo base_url("WebTheme/assets/js/popper.js");?>"></script>
<!--bootstrap min js-->
<script src="<?php echo base_url("WebTheme/assets/js/bootstrap.min.js");?>"></script>
<!--owl carousel min js-->
<script src="<?php echo base_url("WebTheme/assets/js/owl.carousel.min.js");?>"></script>
<!--slick min js-->
<script src="<?php echo base_url("WebTheme/assets/js/slick.min.js");?>"></script>
<!--magnific popup min js-->
<script src="<?php echo base_url("WebTheme/assets/js/jquery.magnific-popup.min.js");?>"></script>
<!--jquery countdown min js-->
<script src="<?php echo base_url("WebTheme/assets/js/jquery.countdown.js");?>"></script>
<!--jquery ui min js-->
<script src="<?php echo base_url("WebTheme/assets/js/jquery.ui.js");?>"></script>
<!--jquery elevatezoom min js-->
<script src="<?php echo base_url("WebTheme/assets/js/jquery.elevatezoom.js");?>"></script>
<!--isotope packaged min js-->
<script src="<?php echo base_url("WebTheme/assets/js/isotope.pkgd.min.js");?>"></script>
<!--slinky menu js-->
<script src="<?php echo base_url("WebTheme/assets/js/slinky.menu.js");?>"></script>
<!-- Plugins JS -->
<script src="<?php echo base_url("WebTheme/assets/js/plugins.js");?>"></script>
<!-- Main JS -->
<script src="<?php echo base_url("WebTheme/assets/js/main.js");?>"></script>
<script src="<?php echo base_url("WebTheme/assets/js/datatable/datatable-basic.js");?>" type="text/javascript"></script>
<script src="<?php echo base_url("WebTheme/assets/js/datatable/datatables.min.js");?>" type="text/javascript"></script>
<script src="<?php echo base_url("WebTheme/assets/sweetalert/sweetalert.js");?>"></script>
<script src="<?php echo base_url("WebTheme/assets/js/loadingoverlay.min.js");?>"></script>
<script src="<?php echo base_url("WebTheme/assets/js/functions.js");?>"></script>
<?php
 if(empty($this->session->userdata('MiPlani_user_id')))
{
?>
	<script src="<?php echo base_url("WebTheme/assets/js/login.js");?>"></script>
<?php	
}
?>
<?php
if($this->router->class=='pages')
{
	if($this->router->method=='ViewProjection')
	{
		if(!empty($_GET['key_id']))
		{
			if(empty($error_message))
			{
				if(!empty($row))
				{
				?>
					<script>load_projection_comments('1','<?php echo $_GET['key_id'];?>','sub');</script>
				<?php
				}
			}
		}
	}
}
if($this->router->class=='projections')
{
	if($this->router->method=='EditProjection')
	{
		if(!empty($_GET['key_id']))
		{
			if(empty($error_message))
			{
				if(!empty($row))
				{
					$step_number = 1;
					if($row->projection_status=='active')
					{
						$step_number = 1;
					}
					else
					{
						$step_number = $row->completed_step;
					}
 				?>
					<script>edit_user_projection_wizard('<?php echo $step_number;?>','<?php echo $_GET['key_id'];?>');</script>
				<?php
				}
			}
		}
	}
}
if($this->router->class=='projection')
{
	if($this->router->method=='EditProjection')
	{
		if(!empty($_GET['key_id']))
		{
			if(empty($error_message))
			{
				if(!empty($row))
				{
					$step_number = 1;
					if($row->projection_status=='active')
					{
						$step_number = 1;
					}
					else
					{
						$step_number = $row->completed_step;
					}
 				?>
					<script>wizard_edit_main_projection('<?php echo $step_number;?>','<?php echo $_GET['key_id'];?>');</script>
				<?php
				}
			}
		}
	}
}
if($this->router->class=='guestProjections')
{
	if($this->router->method=='index')
	{
		if(!empty($_GET['key']))
		{
			if(empty($error_message))
			{
				if(!empty($projection_row))
				{
 				?>
					<script>guest_projection_wizard('1','<?php echo $projection_row->projection_id;?>','<?php echo $_GET['key'];?>');</script>
				<?php
				}
			}
		}
	}
}
if($this->router->class=='guestProjection')
{
	if($this->router->method=='index')
	{
		if(!empty($_GET['key']))
		{
			if(empty($error_message))
			{
				if(!empty($projection_row))
				{
 				?>
					<script>guest_main_projection_wizard('1','<?php echo $projection_row->projection_id;?>','<?php echo $_GET['key'];?>');</script>
				<?php
				}
			}
		}
	}
}
if($this->router->class=='reviews')
{
	if($this->router->method=='index')
	{
	?>
		<script>load_ajax_reviews('1');</script>
	<?php
 	}
}
?>

<script>	
$(document).on('keyup', "input[data-type='currency']", function(event) {
	formatCurrency($(this));
});

	$(document).on('blur', "input[data-type='currency']", function(event) {
	 formatCurrency($(this), "blur");
});


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}


function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(",") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(",");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = left_side + "," + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = input_val;
    
    // final formatting
    if (blur === "blur") {
      //input_val += ",00";
    }
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  /*var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);*/
}
</script>
<script>
$(window).scroll(function() {
	if ($(this).scrollTop() > 50 ) {

		$('.scrolltop:hidden').stop(true, true).fadeIn();
	} else {
		$('.scrolltop').stop(true, true).fadeOut();
	}
});
$(function(){$(".scroll").click(function(){$("html,body").animate({scrollTop:$(".thetop").offset().top},"1000");return false})})
</script>
<?php
if($this->router->class=='pages' || $this->router->class=='Pages')
{
	if($this->router->method=='Order')
	{
		$this->load->view('web-common-files/credit_card_js');
 	}
}
?>