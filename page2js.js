function validateForm() {
var td = document.forms["Form"]["transactiondate"].value;
var sn = document.forms["Form"]["stockname"].value;
var tp = document.forms["Form"]["transactionprice"].value;
var qa = document.forms["Form"]["transactionquantity"].value;
var rt = document.forms["Form"]["message"].value;
var mail = document.forms["Form"]["email"].value;
var ab = document.Form.abc.checked || document.Form.def.checked;
var im = document.getElementById("imag")
var isValid = /\.jpe?g$/i.test(im)
if ( td == "" || td == null )
{
alert("Transaction date must be filled");
return false;
}
if(!/^[A-Z]+$/g.test(sn)){
alert("Enter valid name (ALL UPPER CASE LETTERS ONLY)");
return false;
}
else if ( sn == "" || sn == null ){
alert("Enter Stock Name");
return false;
} 
if (tp == "" || tp == null) 
{
alert("Enter the valid Transaction Price");
return false;
}
if ( isNaN (tp) )
{
alert("Enter the valid Transaction Price");
return false;
}
if (qa == "" || qa==null) 
{
alert("Enter the valid Transaction Quantity");
return false;
}
if ( isNaN (qa) )
{
alert("Enter the valid Transaction Quantity");
return false;
}
if ( rt == "" || rt == null ){
alert("Enter any comment.");
return false;
}
var fileName = im.value;
var cc = fileName.substring(fileName.lastIndexOf('.') + 1);
if(cc == "gif" || cc == "GIF" || cc == "JPEG" || cc == "jpeg" || cc == "jpg" || cc == "JPG")
	{
	return true;
	} 
	else
	{
	alert("Upload Gif,Jpg or JPEG images only");
	return false;
	}

var sym = mail.indexOf("@");
var dot = mail.lastIndexOf(".");
if (sym<1 || dot<sym+2 || dot+2>=mail.length || mail == "" || mail==null) 
{
alert("Enter the valid e-mail address");
return false;
}
if (ab == true){}
else{alert("check any one box")
return false;}
}