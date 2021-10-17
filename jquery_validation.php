<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

</head>
<body>
<form method="post" action="#" id="myform">
	name : <input type="text" name="name" id="name"><br><br>
	email : <input type="text" name="email" id="email"><br><br>
	mobile : <input type="text" name="mobile" id="mobile"><br><br>
	<input type="submit" name="submit">
</form>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
	$(document).ready(function(){
		$("#myform").validate({
			rules:{
				name : {
					required:true,
					maxlength: 20,
					minlength: 4,
				},
				email:{
					required : true,
					email : true,
				},
				mobile:{
					required : true,
					number : true,
				},
			},
			messages:{
				name : {
					required : 'Please Fill This',
					maxlength : 'Max Length 20 Character',
					minlength : 'Min Length 4 character',
				},
				email:{
					required : 'Please Fill email',
					email : 'Enter Valid Mail',
				},
				mobile : {
					required : 'Please Fill Number',
					number: 'Only Number',
				},
			},

			submitHandler: function(form) {
		        $.ajax({
		            url: 'submit.php',
		            type: 'POST',
		            data: $("#myform").serialize(),
		            success: function(response) {
		                console.log(response);
		            }            
		        });
		    }

		});
	});
</script>
</body>
</html>
