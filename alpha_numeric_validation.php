on form:-
<input name="txt_officer_name" type="text" onkeypress="return alphaOnly(event);"  onpaste="false" />

Only Alpha:-
function alphaOnly(event) {
  var inputValue = event.charCode;
	  if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
		  event.preventDefault();
	}
}

Only Numeric:-
function onlyNumberKey(evt) {  
	var ASCIICode = (evt.which) ? evt.which : evt.keyCode
	if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
	return false;
	return true;
 }
