var web_js_path = 'http://'+location.hostname+'/Miplani/';
/*============================ Common Function=========================*/
function gotolink(url)
{
	window.location = url;
}
function open_win(url_add)
{
	window.open(url_add, 'welcome', 'width=600,height=600,menubar=no,status=no, location=no,toolbar=no,scrollbars=no');
}
function scrolpage(y)
{
	window.scroll(0,y); // horizontal and vertical scroll increments
}
function popupWindow(url)
{
	window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=No,resizable=No,copyhistory=no,width=950,height=500,screenX=150,screenY=150,top=150,left=150')
}
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;
	return true;
} 

function isNumbericKey(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode != 46 && charCode > 31 
	&& (charCode < 48 || charCode > 57))
	return false;
	return true;
} 
function RestrictSpace() 
{
    if (event.keyCode == 32) 
	{
        return false;
    }
}